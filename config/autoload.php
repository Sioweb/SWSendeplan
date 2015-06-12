<?php

/**
* Contao Open Source CMS
*  
* @file autoload.php
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.sendeplan
* @copyright Sascha Weidner, Sioweb
*/


ClassLoader::addNamespaces(array
(
    'sioweb\contao\extensions\sendeplan'
));

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // models
    'sioweb\contao\extensions\sendeplan\SendeplanModel'     => 'system/modules/SWSendeplan/models/SendeplanModel.php',
    'sioweb\contao\extensions\sendeplan\SondersendungModel' => 'system/modules/SWSendeplan/models/SondersendungModel.php',
    // modules
    'sioweb\contao\extensions\sendeplan\SendeplanActive'    => 'system/modules/SWSendeplan/modules/SendeplanActive.php',
    'sioweb\contao\extensions\sendeplan\SendeplanWeek'      => 'system/modules/SWSendeplan/modules/SendeplanWeek.php',
    'sioweb\contao\extensions\sendeplan\SondersendungWeek'  => 'system/modules/SWSendeplan/modules/SondersendungWeek.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'mod_sendeplan'         => 'system/modules/SWSendeplan/templates',
    'mod_sendeplan_active'  => 'system/modules/SWSendeplan/templates',
    'sendeplan_week'        => 'system/modules/SWSendeplan/templates',
    'sendeplan_active'		=> 'system/modules/SWSendeplan/templates',
    'tl_sondersendung_week' => 'system/modules/SWSendeplan/templates',
));