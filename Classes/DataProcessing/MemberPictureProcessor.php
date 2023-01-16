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

use PDO;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 *
 */
class MemberPictureProcessor implements DataProcessorInterface {

    /**
     * Process data for the content element "gallerySlider"
     *
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData): array {

        $items = array();

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_cnslider_member_picture');

        $row = $queryBuilder
            ->select('tx_cnslider_member_picture.uid', 'tx_cnslider_member_picture.tx_cnslider_member_name', 'tx_cnslider_member_picture.tx_cnslider_member_description', 'sys_file.identifier')
            ->from('tx_cnslider_member_picture')
            ->join(
                'tx_cnslider_member_picture',
                'sys_file_reference',
                'sys_file_reference',
                $queryBuilder->expr()->eq('sys_file_reference.uid_foreign', $queryBuilder->quoteIdentifier('tx_cnslider_member_picture.uid'))
            )
            ->join(
                'sys_file_reference',
                'sys_file',
                'sys_file',
                $queryBuilder->expr()->eq('sys_file.uid', $queryBuilder->quoteIdentifier('sys_file_reference.uid_local'))
            )
            ->where (
                $queryBuilder->expr()->eq('tx_cnslider_member_picture.tt_content_id', $queryBuilder->createNamedParameter($cObj->data['uid'], PDO::PARAM_INT))
            )
            ->andWhere (
                $queryBuilder->expr()->eq('sys_file_reference.tablenames', $queryBuilder->createNamedParameter('tx_cnslider_member_picture', PDO::PARAM_STR))
            )
            ->orderBy('tx_cnslider_member_picture.sorting')
            ->executeQuery();

        if(!empty($row) && is_array($row)) {
            foreach ($row as $key => $value) {
                $row[$key]['popupid'] = mb_strtolower(urlencode($value['tx_cnslider_member_name']) . '_' . $value['uid']);
            }
            $items = $row;
        }

        $processedData['items'] = $items;

        return $processedData;
    }

}