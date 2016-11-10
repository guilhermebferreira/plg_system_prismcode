<?php
/**
 * @package     CedHighlightjs
 * @subpackage  com_cedhighlightjs
 * http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL 3.0</license>
 * @copyright   Copyright (C) 2013-2016 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

class plgSystemCedHighlightJs extends JPlugin
{

    const HIGHLIGHT_JS = "9.4.0";

    function plgSystemAdd2Home(& $subject, $config)
    {
        parent::__construct($subject, $config);
        $this->loadLanguage();
    }

    public function onBeforeRender()
    {
        //Do not run in admin area and non HTML  (rss, json, error)
        $app = JFactory::getApplication();
        if ($app->isAdmin() || JFactory::getDocument()->getType() !== 'html')
        {
            return true;
        }
        $document = JFactory::getDocument();
        
        $document->addScript("//cdnjs.cloudflare.com/ajax/libs/highlight.js/" . self::HIGHLIGHT_JS . "/highlight.min.js");

        $skins = $this->params->get('skins', 'default.min.css');
        $document->addStyleSheet("//cdnjs.cloudflare.com/ajax/libs/highlight.js/" . self::HIGHLIGHT_JS . "/styles/$skins");

        $document->addScriptDeclaration("\nhljs.initHighlightingOnLoad();\n");
    }

}
