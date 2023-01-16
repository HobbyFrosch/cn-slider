<?php
/**
 * Created by PhpStorm.
 * User: rkraemer
 * Date: 05.02.2018
 * Time: 15:40
 */

namespace HobbyFrosch\CNSlider\Service;

/*
 *  Copyright notice
 *
 *  (c) 2017 Ronny Krämer <info@ronnykraeme.de>
 *  All rights reserved
 *
 *
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class JsonLDRenderService {

    public function render() {

        $content = $this->renderOrganization();
        $content .= $this->renderArticles();
        $content .= $this->renderEvents();
        $content = preg_replace( '%(?>[^\S ]\s*| \s{2,})(?=(?:(?:[^<]++| <(?!/?(?:textarea|pre)\b))*+)(?:<(?>textarea|pre)\b| \z))%ix' , ' ' , $content );

        return $content;

    }

    private function renderEvents () {

        $events = '';

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_cnslider_event');

       $row = $queryBuilder
            ->select('tx_cnslider_event.tt_content_id','tx_cnslider_event.uid', 'tx_cnslider_event.tx_cnslider_event_name', 'tx_cnslider_event.tx_cnslider_event_date', 'tx_cnslider_event.tx_cnslider_event_content', 'tx_cnslider_event.tx_cnslider_event_location', 'tx_cnslider_event.tx_cnslider_event_location_name', 'tx_cnslider_event.tx_cnslider_event_highlight', 'sys_file.identifier')
            ->from('tx_cnslider_event')
            ->join (
                'tx_cnslider_event',
                'sys_file_reference',
                'sys_file_reference',
                $queryBuilder->expr()->eq('sys_file_reference.uid_foreign', $queryBuilder->quoteIdentifier('tx_cnslider_event.uid'))
            )
            ->join (
                'sys_file_reference',
                'sys_file',
                'sys_file',
                $queryBuilder->expr()->eq('sys_file.uid', $queryBuilder->quoteIdentifier('sys_file_reference.uid_local'))
            )
            ->Where (
                $queryBuilder->expr()->eq('sys_file_reference.tablenames', $queryBuilder->createNamedParameter('tx_cnslider_event', \PDO::PARAM_STR))
            )
            ->orderBy('tx_cnslider_event.sorting')
            ->execute()
            ->fetchAll();

        if(!empty($row) && is_array($row)) {
            foreach ($row as $key => $value) {

                $eventLocation = $this->getEventAdress($value['tx_cnslider_event_location']);

                $event = $this->getScriptHeader();
                $event .= $this->getEventHeader();
                $event .= '"name" : "' . $this->convertText($value['tx_cnslider_event_name']) . '",';
                $event .= '"description" : "' . $this->convertText($value['tx_cnslider_event_content']) . '",';
                $event .= '"startDate" : "' . $this->convertTimestamp($value['tx_cnslider_event_date']) . '",';
                $event .= '"endDate" : "' . $this->convertTimestamp($value['tx_cnslider_event_date'], 2) . '",';
                $event .= '"url" : "https://www.chor-nection.de/#termine_' . $value['tt_content_id'] . '",';
                $event .= '"location" : {';
                $event .= '"@type" : "Place",';
                $event .= '"name" : "' . $this->convertText($value['tx_cnslider_event_location_name']) . '",';
                $event .= '"address": {';
                $event .= '"@type" : "PostalAddress",';
                $event .= '"streetAddress" : "' . $eventLocation['street'] . '",';
                $event .= '"addressLocality" : "' . $eventLocation['city'] . '",';
                $event .= '"postalCode" : "' . $eventLocation['zip'] . '"';
                $event .= '}';
                $event .= '},';
                $event .= '"image" : {';
                $event .= '"@type" : "imageObject",';
                $event .= '"url" : "https://www.chor-nection.de/fileadmin' . $value['identifier'] . '"';
                $event .= '},';
                $event .= '"offers" : {';
                $event .= '"@type" : "Offer",';
                $event .= '"description" : "Eintritt frei",';
                $event .= '"availability": "http://schema.org/InStock",';
                $event .= '"price" : "0",';
                $event .= '"priceCurrency" : "EUR",';
                $event .= '"validFrom" : "' . $this->convertTimestamp($value['tx_cnslider_event_date']) . '",';
                $event .= '"url" : "https://www.chor-nection.de/#termine_' . $value['tt_content_id'] . '"';
                $event .= '},';
                $event .= '"performer" : {';
                $event .= '"@type" : "Organization",';
                $event .= '"name" : "Chor-Nection"';
                $event .= '}';
                $event .= $this->getScriptFooter();

                $events .= $event;

            }
        }

        return $events;

    }

    private function renderArticles() {

        $articles = '';
        $mainEntityOfPage = true;

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
        $row = $queryBuilder
            ->select( 'uid', 'bodytext', 'crdate', 'tstamp', 'header')
            ->from ('tt_content')
            ->where (
                $queryBuilder->expr()->eq('CType', $queryBuilder->createNamedParameter('contentSlider', \PDO::PARAM_STR))
            )
            ->andWhere(
                $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
            )
            ->orderBy('sorting')
            ->execute()
            ->fetchAll();

        if(!empty($row) && is_array($row)) {
            foreach ($row as $key => $value) {
                $article = $this->getScriptHeader();
                $article .= $this->getArticleHeader();
                if ($mainEntityOfPage) {
                    $mainEntityOfPage = false;
                    $article .= '"mainEntityOfPage" : "true",';
                }
                else {
                    $article .= '"mainEntityOfPage" : "false",';
                }
                $article .= '"headline" : "' . htmlentities($value['header']) . '",';
                $article .= '"author" : { "@type" : "person", "name" : "' . htmlentities("Florian Krämer") . '" },';
                $article .= '"image" : { "@type" : "imageObject", "url" : "https://www.chor-nection.de/fileadmin/template/images/logo_schrift_black.png" },';
                $article .= '"url" : "https://www.chor-nection.de/#' . $this->getArticleUrl($value['header'], $value['uid']) . '",';
                $article .= '"publisher" : {';
                $article .= '"@type" : "Organization",';
                $article .= '"name" : "Chor-Nection",';
                $article .= '"logo" : {';
                $article .= '"@type" : "imageObject",';
                $article .= '"url" : "https://www.chor-nection.de/fileadmin/template/images/logo_schrift_black.png"';
                $article .= '}},';
                $article .= '"datePublished" : "' . $this->convertTimestamp($value['crdate']) . '",';
                $article .= '"dateModified" : "' . $this->convertTimestamp($value['tstamp']) . '",';
                $article .= '"articleBody":"' . $this->convertText($value['bodytext']) . '"';
                $article .= $this->getScriptFooter();

                $articles .= $article;
            }

        }

        return $articles;

    }

    private function renderOrganization() {

        $organization =  '<script type="application/ld+json">';
        $organization .= '{';
        $organization .= '"@context": "http://schema.org",';
        $organization .= '"@type": "Website",';
        $organization .= '"name": "Chor-Nection",';
        $organization .= '"url": "https://www.chor-nection.de",';
        $organization .= '"author": {';
        $organization .= '"@type": "Person",';
        $organization .= '"name": "Florian Krämer",';
        $organization .= '"jobTitle": "Chorleiter",';
        $organization .= '"sameAs": [';
        $organization .= '"https://www.instagram.com/floriantkraemer/",';
        $organization .= '"https://de-de.facebook.com/chornection/"';
        $organization .= ']';
        $organization .= '},';
        $organization .= '"funder": {';
        $organization .= '"@type": "Organization",';
        $organization .= '"name": "Chor-Nection",';
        $organization .= '"url": "https://www.chor-nection.de",';
        $organization .= '"logo": "https://www.chor-nection.de/fileadmin/template/images/logo_schrift_black.png",';
        $organization .= '"description": "Singen mit Freunden",';
        $organization .= '"foundingDate": "2008-02-01",';
        $organization .= '"address":{';
        $organization .= '"@type":"PostalAddress",';
        $organization .= '"addressLocality":"Bremen",';
        $organization .= '"postalCode":"28215",';
        $organization .= '"streetAddress":"Winterstr. 54"';
        $organization .= '},';
        $organization .= '"contactPoint":{';
        $organization .= '"@type":"ContactPoint",';
        $organization .= '"telephone":"+49 421 9594140",';
        $organization .= '"contactType":"customer service"';
        $organization .= '}';
        $organization .= '}';
        $organization .= '}';
        $organization .= '</script>';

        return $organization;

    }

    private function getArticleUrl($header, $uid) {
        return $this->convertText(strtolower(str_replace(' ', '_', $header)) . '_' . $uid);
    }

    private function convertText($content) {
        return htmlentities(strip_tags($content));
    }

    private function getArticleHeader() {
        $articleHeader = '"@context": "http://schema.org",';
        $articleHeader .= '"@type": "Article",';
        return $articleHeader;
    }

    private function getEventHeader() {
        $eventHeader = '"@context": "http://schema.org",';
        $eventHeader .= '"@type": "Event",';
        return $eventHeader;
    }

    private function getScriptHeader() {
        $header =  '<script type="application/ld+json">';
        $header .= '{';
        return $header;
    }

    private function getScriptFooter() {
        $footer = '}';
        $footer .= '</script>';
        return $footer;
    }

    private function convertTimestamp($timestamp, $additionalTime = 0) {
        if ($additionalTime == 0) {
            return gmdate("Y-m-d H:m", (float)$timestamp);
        }
        else {
            $time = gmdate("Y-m-d H:m", (float)$timestamp);
            $time = date('Y-m-d H:i',strtotime('+2 hours',strtotime($time)));
            return $time;
        }
    }

    private function getEventAdress($locationString) {
        $locationResult = array();
        $location = explode(',', $locationString);
        if (is_array($location) && count($location) == 2) {
            $locationResult['street'] = trim($location[0]);
            $location = explode(' ', $locationString);
            if (is_array($location) && count($location) == 2) {
                $locationResult['zip'] = trim($location[0]);
                $locationResult['city'] = trim($location[1]);
            }
            else {
                $locationResult = $this->getDefaultEventAdress();
            }
        }
        else {
            $locationResult = $this->getDefaultEventAdress();
        }
        return $locationResult;
    }

    private function getDefaultEventAdress() {
        $location['street'] = 'Brookdamm 4';
        $location['zip'] = '28816';
        $location['city'] = 'Stuhr';
        return $location;
    }

}