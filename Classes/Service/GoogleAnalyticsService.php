<?php
/**
 * Created by PhpStorm.
 * User: rkraemer
 * Date: 05.02.2018
 * Time: 15:40
 */

namespace RK\CNSlider\Service;

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

class GoogleAnalyticsService {

    public function render() {

        $googleAnalytics = <<<EOF
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-113659327-1"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());
            
              gtag('config', 'UA-113659327-1');
            </script>
EOF;

        return $googleAnalytics;

    }
    
}