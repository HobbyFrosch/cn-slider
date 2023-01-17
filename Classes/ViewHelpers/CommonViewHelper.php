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


use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 *
 */
class CommonViewHelper extends AbstractViewHelper {

    /**
     * @return void
     */
    public function initializeArguments() {
        $this->registerArgument('content', 'string', 'content to be rendered', true);
    }

    /**
     * @return string
     */
    public function render() {

        $content = $this->arguments['content'];

        $content = str_replace("ä", "ae", $content);
        $content = str_replace("ü", "ue", $content);
        $content = str_replace("ö", "oe", $content);
        $content = str_replace("ß", "ss", $content);
        $content = str_replace(" ", "_", $content);
        $content = str_replace("-", "", $content);
	    $content = str_replace("&", "", $content);

        return strtolower($content);

    }
}