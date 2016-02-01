<?php

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace DMA;

class DmaFontsizer extends \Frontend
{

    private $blnUseSession = true;
    private $intCurrentFontsize = 0;

    public function __construct()
    {

        $objPersistant = null;

        if ($this->blnUseSession)
        {
            $objPersistant = \Session::getInstance();
        }

        if ($objPersistant !== null && $objPersistant->get('fontsize'))
        {
            $this->intCurrentFontsize = $objPersistant->get('fontsize');
        }

        parent::__construct();
    }

    public function fontsizerReplaceInsertTags($strTag, $blnCache = true)
    {
        $arrSplit = explode('::', $strTag);
        if ($arrSplit[0] == 'dmafontsize')
        {
            switch ($arrSplit[1])
            {
                case "class":
                    if ($GLOBALS['DMA_FONTSIZER']['SIZES'][$this->intCurrentFontsize]['class'])
                    {
                        return $GLOBALS['DMA_FONTSIZER']['CLASS_PREFIX'] . $GLOBALS['DMA_FONTSIZER']['SIZES'][$this->intCurrentFontsize]['class'];
                    }
                    break;
                case "style":
                    if ($GLOBALS['DMA_FONTSIZER']['SIZES'][$this->intCurrentFontsize]['size'])
                    {
                        return 'style="font-size:' . $GLOBALS['DMA_FONTSIZER']['SIZES'][$this->intCurrentFontsize]['size'] . '"';
                    }
                    break;
                case "increaser":
                    return $this->getHandleLink('smaller');
                    break;
                case "decreaser":
                    return $this->getHandleLink('bigger');
                    break;
            }

        }
        return false;
    }

    public function fontsizerGeneratePage(\PageModel $objPage, \LayoutModel $objLayout, \PageRegular $objPageRegular)
    {
        if (\Input::get('fz'))
        {

            $strFontHandler = \Input::get('fz');
            $intNewFontSize = $this->intCurrentFontsize;

            if ($strFontHandler == "bigger")
            {
                $intNewFontSize = $this->intCurrentFontsize+1;
            }
            if ($strFontHandler == "smaller")
            {
                $intNewFontSize = $this->intCurrentFontsize-1;
            }

            if ($GLOBALS['DMA_FONTSIZER']['SIZES'][$intNewFontSize])
            {
                $objPersistant = null;

                if ($this->blnUseSession)
                {
                    $objPersistant = \Session::getInstance();
                }

                if ($objPersistant !== null)
                {
                    $objPersistant->set('fontsize', $intNewFontSize);
                }
            }

            global $objPage;
            $this->redirect($this->generateFrontendUrl($objPage->row()));

        }
    }

    private function getHandleLink($strParam)
    {

        global $objPage;

        $blnDisabled = false;
        $intNewFontSize = $this->intCurrentFontsize;

        if ($strParam == "bigger")
        {
            $intNewFontSize = $this->intCurrentFontsize+1;
        }
        if ($strParam == "smaller")
        {
            $intNewFontSize = $this->intCurrentFontsize-1;
        }

        if ($intNewFontSize && !$GLOBALS['DMA_FONTSIZER']['SIZES'][$intNewFontSize])
        {
            $blnDisabled = true;
        }

        $objTemplate = new \FrontendTemplate('fontsizer_link');

        $objTemplate->linkHref = ampersand($this->generateFrontendUrl($objPage->row()) . '?fz=' . $strParam);
        $objTemplate->linkText = $strParam=="bigger" ? $GLOBALS['TL_LANG']['MISC']['fontsizer_bigger'] : $GLOBALS['TL_LANG']['MISC']['fontsizer_smaller'];
        $objTemplate->disabled = $blnDisabled;

        return $objTemplate->parse();
    }

}