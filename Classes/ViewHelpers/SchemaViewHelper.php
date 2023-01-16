<?php
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

namespace HobbyFrosch\CNSlider\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;


class SchemaViewHelper extends AbstractViewHelper {

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
     * @inject
     */
    protected $contentObject;

    /**
     * Parse a content element
     *
     * @param string $content UID of any content element
     * @param string $itemproptype
     * @return string Parsed Content Element
     */
    public function render($content, $itemproptype) {

        switch ($itemproptype) {
            case 'author':
                $content = $this->getAuthor((int) $content);
                break;
            case 'date':
                $content = $this->convertTimestamp((float) $content);
        }

        return $content;

    }

    private function convertTimestamp($timestamp) {
        return gmdate("Y-m-d H:m", $timestamp);
    }

    private function getAuthor($cruser_id) {
        $row = array();
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('be_users');
        $row = $queryBuilder
            ->select('realName')
            ->from('be_users')
            ->where (
                $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($cruser_id, \PDO::PARAM_INT))
            )
            ->execute()
            ->fetchAll();

        return $row[0]['realName'];

    }

}