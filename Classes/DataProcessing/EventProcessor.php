<?php
namespace HF\CNSlider\DataProcessing;

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

use Doctrine\DBAL\Exception;
use PDO;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class EventProcessor implements DataProcessorInterface {

    /**
     * Process data for the content element "eventSlider"
     *
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     * @throws Exception
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData): array {

        $items = array();

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_cnslider_member_picture');
        $row = $queryBuilder
            ->select('tx_cnslider_event.uid', 'tx_cnslider_event.tx_cnslider_event_name', 'tx_cnslider_event.tx_cnslider_event_date', 'tx_cnslider_event.tx_cnslider_event_content', 'tx_cnslider_event.tx_cnslider_event_location', 'tx_cnslider_event.tx_cnslider_event_location_name', 'tx_cnslider_event.tx_cnslider_event_highlight', 'sys_file.identifier')
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
            ->where (
                $queryBuilder->expr()->eq('tx_cnslider_event.tt_content_id', $queryBuilder->createNamedParameter($cObj->data['uid'], PDO::PARAM_INT))
            )
            ->andWhere (
                $queryBuilder->expr()->eq('sys_file_reference.tablenames', $queryBuilder->createNamedParameter('tx_cnslider_event', PDO::PARAM_STR))
            )
            ->orderBy('tx_cnslider_event.sorting')
            ->executeQuery()
            ->fetchAllAssociative();

        if(!empty($row) && is_array($row)) {
            foreach($row as $key => $value) {
                $row[$key]['google'] =  urlencode($value['tx_cnslider_event_location_name'] . " " . $value['tx_cnslider_event_location']);
                $row[$key]['popupid'] = strtolower(urlencode($this->replace($value['tx_cnslider_event_name'])) . '_' . $value['uid']);
            }
            $items = $row;
        }

        $processedData['items'] = $items;

        return $processedData;
    }

    /**
     * @param $string
     * @return string
     */
    public function replace($string) : string {

        $string = str_replace("ä", "ae", $string);
        $string = str_replace("ü", "ue", $string);
        $string = str_replace("ö", "oe", $string);
        $string = str_replace("ß", "ss", $string);
        $string = str_replace("´", "", $string);
        $string = str_replace(" ", "_", $string);

        return str_replace("-", "", $string);
    }

}