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

namespace HF\CNSlider\ViewHelpers;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;


class SchemaViewHelper extends AbstractViewHelper {

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * @var ContentObjectRenderer
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

    /**
     * @param float $timestamp
     * @return string
     */
    private function convertTimestamp(float $timestamp) : string {
        return gmdate("Y-m-d H:m", $timestamp);
    }

    /**
     * @param string $cruser_id
     * @return string
     */
    private function getAuthor(string $cruser_id) : string {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('be_users');
        $row = $queryBuilder
            ->select('realName')
            ->from('be_users')
            ->where (
                $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($cruser_id, \PDO::PARAM_INT))
            )
            ->executeQuery();

        return $row[0]['realName'];

    }

}