<?php

/**
 * Settings
 */
$GLOBALS['DMA_FONTSIZER'] = array
(
    'SIZES' => array
    (
        '-1' => array
        (
            'size'=>'60%',
            'class' => 'small'
        ),
        '0' => array
        (
            //'size'=>'100%',
            'class' => 'normal'
        ),
        '1' => array
        (
            'size'=>'140%',
            'class' => 'big'
        )
    ),
    'CLASS_PREFIX' => 'fontsize_'
);

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['generatePage'][]      = array('DmaFontsizer', 'fontsizerGeneratePage');
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('DmaFontsizer', 'fontsizerReplaceInsertTags');