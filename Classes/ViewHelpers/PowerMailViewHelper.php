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


use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 *
 */
class PowerMailViewHelper extends AbstractViewHelper {

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    public function initializeArguments() {
        $this->registerArgument('uid', 'string', 'contact uid', true);
    }

    /**
     * @return string
     */
    public function render() {

        $uid = $this->arguments['uid'];

        $configuration = [
            'tables' => 'tt_content',
            'source' => (int)$uid,
            'dontCheckPid' => 1,
        ];

        $contentObject = GeneralUtility::makeInstance('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');

        return $contentObject->cObjGetSingle('RECORDS', $configuration);

    }
}