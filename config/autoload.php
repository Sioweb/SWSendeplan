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
    'sioweb\contao\extensions\sendeplan\SendeplanModel'     => 'system/modules/Sendeplan/models/SendeplanModel.php',
    'sioweb\contao\extensions\sendeplan\SondersendungModel' => 'system/modules/Sendeplan/models/SondersendungModel.php',
    // modules
    'sioweb\contao\extensions\sendeplan\SendeplanActive'    => 'system/modules/Sendeplan/modules/SendeplanActive.php',
    'sioweb\contao\extensions\sendeplan\SendeplanWeek'      => 'system/modules/Sendeplan/modules/SendeplanWeek.php',
    'sioweb\contao\extensions\sendeplan\SondersendungWeek'  => 'system/modules/Sendeplan/modules/SondersendungWeek.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'mod_sendeplan'         => 'system/modules/Sendeplan/templates',
    'mod_sendeplan_active'  => 'system/modules/Sendeplan/templates',
    'sendeplan_week'        => 'system/modules/Sendeplan/templates',
    'sendeplan_active'		=> 'system/modules/Sendeplan/templates',
    'tl_sondersendung_week' => 'system/modules/Sendeplan/templates',
));