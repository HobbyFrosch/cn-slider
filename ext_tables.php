<?php

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    $_EXTKEY,
    'Configuration/TypoScript',
    'CNSlider'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cnslider_member_picture');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cnslider_event');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
mod {
    wizards.newContentElement.wizardItems.extra {
        header = Chor-Nection
        elements {
            backgroundSlider {
                icon = EXT:cnslider/Resources/Public/Images/Backend/ContentElements/VideoContent.png
                title = Hintergrund
                description = Slider mit Hintergrundbild
                tt_content_defValues {
                    CType = backgroundSlider
                }
            }
            contentSlider {
                icon = ../typo3conf/ext/cnslider/Resources/Public/Images/Backend/ContentElements/TextContent.png
                title = Text
                description = Slider mit Text
                tt_content_defValues {
                    CType = contentSlider
                }
            }
            eventSlider {
                icon = ../typo3conf/ext/cnslider/Resources/Public/Images/Backend/ContentElements/VideoContent.png
                title = Termine
                description = Slider für Termine
                tt_content_defValues {
                    CType = eventSlider
                }
            }
            gallerySlider {
                icon = ../typo3conf/ext/cnslider/Resources/Public/Images/Backend/ContentElements/VideoContent.png
                title = Gallerie
                description = Slider mit Bilder der Chormitglieder
                tt_content_defValues {
                    CType = gallerySlider
                }
            }
            videoSlider {    
                icon = ../typo3conf/ext/cnslider/Resources/Public/Images/Backend/ContentElements/VideoContent.png
                title = Video
                description = Slider mit Videos
                tt_content_defValues {
                    CType = videoSlider
                }
            }
            contactSlider {
                icon = ../typo3conf/ext/cnslider/Resources/Public/Images/Backend/ContentElements/VideoContent.png
                title = Kontakt
                description = Slider mit Kontaktinformationen
                tt_content_defValues {
                    CType = contactSlider
                }
            }                               
        },
			
        show = *
    }
}
');
