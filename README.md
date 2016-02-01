# DMA Fontsizer

## Contao Extension

Ermöglicht es einfache Font-Vergrößerungen und -Verkleinerung auf Session-Basis zu implementieren.

### Standard-Configuration:
```php
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
```

### Insert-Tags
`{{dmafontsize::class}}` gibt die aktuell gewählte Größe bsp. zur Nutzung als CSS-Klasse aus, bsp. `fontsize_small`.

`{{dmafontsize::style}}` gibt die aktuell gewählte Größe zur Nutzung als Inline-Style aus, bsp. `style="font-size:60%`

`{{dmafontsize::increaser}}` generiert den Link zum Vergrößern der Schriftart.

`{{dmafontsize::decreaser}}` generiert den Link zum Verkleinern der Schriftart.

