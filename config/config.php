<?php

/**
* Contao Open Source CMS
*  
* @file config.php
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.sendeplan
* @copyright Sascha Weidner, Sioweb
*/


if(TL_MODE == 'FE')
	$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/SWSendeplan/assets/sondersendung.js';

array_insert($GLOBALS['BE_MOD']['sioweb'], 4, array(
	'sendeplan' => array(
		'tables' => array('tl_sendeplan'),
		'icon' => 'system/modules/SWSendeplan/assets/sioweb16x16.png'
	),
	'sondersendung' => array(
		'tables' => array('tl_sondersendung'),
		'icon' => 'system/modules/SWSendeplan/assets/sioweb16x16.png'
	)
));

array_insert($GLOBALS['FE_MOD'], 2, array (
	'sendeplan' => array (
		'sendeplan'   		=> 'SendeplanWeek',
		'sondersendungen' 	=> 'SondersendungWeek',
		'activeDJ'     		=> 'SendeplanActive'
	)
));
