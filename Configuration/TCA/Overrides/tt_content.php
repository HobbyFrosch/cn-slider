<?php

$tx_cnslider = [
    'tx_cnslider_height'       => [
        'label'  => 'Höhe',
        'config' => [
            'renderType' => 'selectSingle',
            'type'       => 'select',
            'size'       => 1,
            'items'      => [
                ['Volle Höhe', 'fullScreenSlider'],
                ['Halbe höhe', 'halfScreenSlider']
            ]
        ]
    ],
    'tx_cnslider_show_in_menu' => [
        'label'  => 'Im Menu anzeigen',
        'config' => [
            'type'    => 'check',
            'default' => '1'

        ]
    ],
    'tx_cnslider_nav_title'    => [
        'label'  => 'Bezeichnung in der Navigation',
        'config' => [
            'type' => 'input',
            'size' => 255
        ]
    ],
    'tx_cnslider_video_url'    => [
        'label'  => 'URL des Videos',
        'config' => [
            'type' => 'input',
            'size' => 255,
            'eval' => 'required'
        ]
    ],
    'bodytext'                 => [
        'label'         => 'Text',
        'config'        => [
            'type' => 'text',
            'cols' => 40,
            'rows' => 6
        ],
        'defaultExtras' => 'richtext[]'
    ],

    'tx_cnslider_member_picture' => [
        'label'  => 'Beschreibung',
        'config' => [
            'type'           => 'inline',
            'foreign_table'  => 'tx_cnslider_member_picture',
            'foreign_field'  => 'tt_content_id',
            'foreign_label'  => 'tx_cnslider_member_name',
            'foreign_sortby' => 'sorting',
            'appearance'     => [
                'useSortable'        => 1,
                'collapseAll'        => true,
                'expandSingle'       => true,
                'newRecordLinkTitle' => 'Neues Profilbild hinzufügen',
                'enabledControls '   => true,
            ],
            'maxitems'       => 1000,
            'minitems'       => 0,
        ]
    ],

    'tx_cnslider_event' => [
        'label'  => 'Beschreibung',
        'config' => [
            'type'           => 'inline',
            'foreign_table'  => 'tx_cnslider_event',
            'foreign_field'  => 'tt_content_id',
            'foreign_label'  => 'tx_cnslider_event_name',
            'foreign_sortby' => 'sorting',
            'appearance'     => [
                'useSortable'        => 1,
                'collapseAll'        => true,
                'expandSingle'       => true,
                'newRecordLinkTitle' => 'Neue Veranstaltung hinzufügen',
                'enabledControls '   => true,
            ],
            'maxitems'       => 1000,
            'minitems'       => 0,
        ]
    ]

];

$tcaTtContent = [
    'types'   => [
        'backgroundSlider' => [
            'showitem' => '--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
                           header; Titel (Wird nicht angezeigt),
                           tx_cnslider_height;Höhe des Sliders,
                           image;Hintergrundbild,
                           --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
                           --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
                           --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
                           --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended'

        ],
        'contentSlider'    => [
            'showitem' => '--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
                           tx_cnslider_show_in_menu, In Menü anzeigen,
                           tx_cnslider_nav_title, Bezeichnung in der Navigation,
                           header; Überschrift,
                           bodytext; Inhalt,
                           --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
                           --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
                           --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
                           --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended'
        ],
        'eventSlider'      => [
            'showitem' => '--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
                           tx_cnslider_show_in_menu, In Menü anzeigen,
                           tx_cnslider_nav_title, Bezeichnung in der Navigation,
                           header; Überschrift,
                           tx_cnslider_event, Veranstaltung hinzufügen'
        ],
        'gallerySlider'    => [
            'showitem' => '--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
                           tx_cnslider_show_in_menu, In Menü anzeigen,
                           tx_cnslider_nav_title, Bezeichnung in der Navigation,
                           header; Überschrift,
                           tx_cnslider_member_picture; Bilder,
                           --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
                           --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
                           --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
                           --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended'
        ],
        'videoSlider'      => [
            'showitem' => '--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
                           header; Titel (Wird nicht angezeigt),
                           tx_cnslider_height;Höhe des Sliders,
                           tx_cnslider_video_url;URL des Videos,
                           --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
                           --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
                           --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
                           --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended'
        ],
        'contactSlider'    => [
            'showitem' => '--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
                           tx_cnslider_show_in_menu, In Menü anzeigen,
                           header; Titel (Wird nicht angezeigt),
                           bodytext; Inhalt,
                           tx_powermail_domain_model_page foo,
                           --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
                           --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
                           --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
                           --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended'
        ],

    ],
    'columns' => [
        'CType' => [
            'config' => [
                'items' => [
                    'backgroundSlider' => [
                        'Slider mit Hintergrundbild',
                        'backgroundSlider',
                        'EXT:cnslider/Resources/Public/Images/Backend/ContentElements/VideoContent.png'
                    ],
                    'videoSlider'      => [
                        'Slider mit Hintergrundvideo',
                        'videoSlider',
                        'EXT:cnslider/Resources/Public/Images/Backend/ContentElements/GalleryContent.png'
                    ],
                    'contentSlider'    => [
                        'Slider mit Text',
                        'contentSlider',
                        'EXT:cnslider/Resources/Public/Images/Backend/ContentElements/TextContent.png'
                    ],
                    'eventSlider'      => [
                        'Slider für Termine',
                        'eventSlider',
                        'EXT:cnslider/Resources/Public/Images/Backend/ContentElements/EventContent.png'
                    ],
                    'gallerySlider'    => [
                        'Slider für Chorbilder',
                        'gallerySlider',
                        'EXT:cnslider/Resources/Public/Images/Backend/ContentElements/GalleryContent.png'
                    ],
                    'contactSlider'    => [
                        'Slider für Kontakt',
                        'contactSlider',
                        'EXT:cnslider/Resources/Public/Images/Backend/ContentElements/GalleryContent.png'
                    ]
                ]
            ]
        ]
    ]
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tx_cnslider);
\TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule($GLOBALS['TCA']['tt_content'], $tcaTtContent);
