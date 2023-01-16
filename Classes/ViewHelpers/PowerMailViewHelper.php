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

namespace RK\CNSlider\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;


class PowerMailViewHelper extends AbstractViewHelper {

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
     * @param int $uid UID of any content element
     * @return string Parsed Content Element
     */
    public function render($uid) {
        $configuration = [
            'tables' => 'tt_content',
            'source' => (int)$uid,
            'dontCheckPid' => 1,
        ];

        return $this->contentObject->cObjGetSingle('RECORDS', $configuration);

    }
}