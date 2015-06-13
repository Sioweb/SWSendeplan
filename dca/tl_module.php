<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2013 Leo Feyer
 */


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['sendeplan'] = '{title_legend},type,sendeplan;{jump_legend},sendeplan_jt';
$GLOBALS['TL_DCA']['tl_module']['palettes']['sondersendungen'] = '{title_legend},type,sendeplan';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['sendeplan'] = array
(
  'label'             => &$GLOBALS['TL_LANG']['tl_module']['sendeplan'],
  'exclude'           => true,
  'inputType'         => 'select',
  'foreignKey'        => 'tl_sendeplan.headline',
  'eval'              => array( 'includeBlankOption'=>true, 'tl_class'=>'w50','mandatory'=>true),
  'sql'               => "varchar(128) NOT NULL default ''",
  'relation'          => array('type'=>'hasOne','load'=>'eager')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['sendeplan_jt'] = $GLOBALS['TL_DCA']['tl_module']['fields']['jumpTo'];
$GLOBALS['TL_DCA']['tl_module']['fields']['sendeplan_jt']['label'] = $GLOBALS['TL_LANG']['tl_module']['sendeplan_jt'];