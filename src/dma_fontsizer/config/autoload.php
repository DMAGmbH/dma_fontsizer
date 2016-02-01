<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'DMA',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'DMA\DmaFontsizer' => 'system/modules/dma_fontsizer/classes/DmaFontsizer.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'fontsizer_link' => 'system/modules/dma_fontsizer/templates',
));
