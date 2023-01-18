<?php

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

        'tx_cnslider_member_name' => [
            'label' => 'Vorname',
            'config' => [
                'type' => 'input',
                'size' => 255,
                'eval' => 'required'
            ]
        ],

        'tx_cnslider_member_description' => [
            'label' => 'Beschreibung',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 6,
                'enableRichtext' => true,
            ]
        ],

        'tx_cnslider_member_picture' => [
            'label' => 'Profilbild',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
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
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
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
            'showitem' => 'tx_cnslider_member_name, tx_cnslider_member_picture,tx_cnslider_member_description'
        ]
    ]

];