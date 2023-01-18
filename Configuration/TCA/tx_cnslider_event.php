<?php

use TYPO3\CMS\Core\Resource\AbstractFile;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

return [

    'ctrl' => [
        'titel' => 'TextSlider',
        'label' => 'TextSlider',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'versioningWS' => TRUE,
        'origUid' => 't3_origuid',
    ],

    'columns' => [
        'tx_cnslider_event_name' => [
            'label' => 'Name der Veranstaltung',
            'config' => [
                'type' => 'input',
                'size' => 255,
                'eval' => 'required'
            ]
        ],
        'tx_cnslider_event_content' => [
            'label' => 'Beschreibung der Veranstaltung',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 6,
                'enableRichtext' => true,
            ],
        ],
        'tx_cnslider_event_location_name' => [
            'label' => 'Name des Veranstaltungsorts',
            'config' => [
                'type' => 'input',
                'size' => 255,
            ]
        ],
        'tx_cnslider_event_date' => [
            'label' => 'Datum & Uhrzeit der Veranstaltung',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
            ]
        ],
        'tx_cnslider_event_location' => [
            'label' => 'Adresse der Veranstaltung',
            'config' => [
                'type' => 'input',
                'size' => 255,
            ]
        ],
        'tx_cnslider_event_highlight' => [
            'label' => 'Veranstaltung hervorheben',
            'config' => [
                'type' => 'check',
                'default' => '0'
            ]
        ],
        'tx_cnslider_event_image' => [
            'label' => 'Flyer der Veranstaltung',
            'config' => ExtensionManagementUtility::getFileFieldTCAConfig(
                'image', [
                'appearance' => [
                    'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference',
                    'useSortable' => true
                ],
                'minitems' => '1',
                'maxitems' => '1',
                'eval' => 'required',
                'overrideChildTca' => [
                    'types' => [
                        '0' => [
                            'showitem' => '
                                    --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                    --palette--;;filePalette'
                        ],
                        AbstractFile::FILETYPE_TEXT => [
                            'showitem' => '
                                    --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                    --palette--;;filePalette'
                        ],
                    ],
                ],
            ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),

        ],

        'tt_content_id' => [
            'config' => [
                'type' => 'passthrough'
            ]
        ]

    ],

    'types' => [
        '0' => [
            'showitem' => 'tx_cnslider_event_highlight, tx_cnslider_event_name, tx_cnslider_event_date, tx_cnslider_event_location_name, tx_cnslider_event_location, tx_cnslider_event_image, tx_cnslider_event_content'
        ]
    ]

];