<?php

/**
* Contao Open Source CMS
*  
* @file tl_sendeplan.php
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.sendeplan
* @copyright Sascha Weidner, Sioweb
*/


/**
 * Table tl_sendeplan 
 */
$GLOBALS['TL_DCA']['tl_sendeplan'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'sql' => array(
			'keys' => array (
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('headline'),
			'flag'                    => 1
		),
		'label' => array
		(
			'fields'                  => array('headline', 'id'),
			'format'                  => '%s <span style="color:#b3b3b3; padding-left:3px;">[%s]</span>'
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_sendeplan']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_sendeplan']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_sendeplan']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_sendeplan']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array(
		'default'                     => '{title_legend},headline,alias,author;{monday_legend},monday_18,monday_18_sondersendung,monday_20,monday_20_sondersendung,monday_22,monday_22_sondersendung;{tuesday_legend},tuesday_18,tuesday_18_sondersendung,tuesday_20,tuesday_20_sondersendung,tuesday_22,tuesday_22_sondersendung;{wednesday_legend},wednesday_18,wednesday_18_sondersendung,wednesday_20,wednesday_20_sondersendung,wednesday_22,wednesday_22_sondersendung;{thursday_legend},thursday_18,thursday_18_sondersendung,thursday_20,thursday_20_sondersendung,thursday_22,thursday_22_sondersendung;{friday_legend},friday_18,friday_18_sondersendung,friday_20,friday_20_sondersendung,friday_22,friday_22_sondersendung;{saturday_legend},saturday_18,saturday_18_sondersendung,saturday_20,saturday_20_sondersendung,saturday_22,saturday_22_sondersendung;{sunday_legend},sunday_18,sunday_18_sondersendung,sunday_20,sunday_20_sondersendung,sunday_22,sunday_22_sondersendung'
	),

	// Fields
	'fields' => array(
		'id' => array(
			'sql'					  => "int(10) unsigned NOT NULL auto_increment"
		),
		'sorting' => array(
			'sql'					  => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp' => array(
			'sql'					  => "int(10) unsigned NOT NULL default '0'"
		),
		'headline' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['headline'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
			'sql'					  => "varchar(255) NOT NULL default ''"
		),
		'alias' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['alias'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'alnum', 'unique'=>true, 'spaceToUnderscore'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'save_callback' => array(
				array('tl_sendeplan', 'generateAlias')
			),
			'sql'					  => "varchar(255) NOT NULL default ''"
		),
		'author' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['author'],
			'default'				  => $this->User->id,
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'              => 'tl_user.name',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
			'sql'					  => "int(10) unsigned NOT NULL default '0'"
		),
		'groups' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['groups'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'checkboxWizard',
			'foreignKey'              => 'tl_member_group.name',
			'eval'                    => array('multiple'=>true, 'feEditable'=>true, 'submitOnChange'=>true, 'tl_class'=>'long clr'),
			'sql'					  => "varchar(255) NOT NULL default ''"
			
		),


		'monday_18' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['monday_18'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),
		'monday_20' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['monday_20'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),
		'monday_22' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['monday_22'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),
		
		
		'tuesday_18' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['tuesday_18'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),
		'tuesday_20' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['tuesday_20'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),
		'tuesday_22' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['tuesday_22'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),


		'wednesday_18' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['wednesday_18'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),
		'wednesday_20' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['wednesday_20'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),
		'wednesday_22' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['wednesday_22'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),
		
		
		'thursday_18' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['thursday_18'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),
		'thursday_20' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['thursday_20'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),
		'thursday_22' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['thursday_22'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),
		
		
		'friday_18' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['friday_18'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),
		'friday_20' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['friday_20'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),
		'friday_22' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['friday_22'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),
		
		
		
		'saturday_18' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['saturday_18'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),
		'saturday_20' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['saturday_20'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),
		'saturday_22' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['saturday_22'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),
		
		
		
		'sunday_18' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['sunday_18'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),
		'sunday_20' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['sunday_20'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		),
		'sunday_22' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['sunday_22'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'			  => 'tl_member.dj_nick',
			'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'					  => "int(10) unsigned NOT NULL default '0'",
			'relation'				  => array('type'=>'hasOne','load'=>'eager')
		)
	)
);


$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['monday_18_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['monday_18_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);
$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['monday_20_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['monday_20_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);
$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['monday_22_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['monday_22_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);


$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['tuesday_18_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['tuesday_18_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);
$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['tuesday_20_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['tuesday_20_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);
$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['tuesday_22_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['tuesday_22_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);


$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['wednesday_18_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['wednesday_18_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);
$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['wednesday_20_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['wednesday_20_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);
$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['wednesday_22_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['wednesday_22_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);


$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['thursday_18_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['thursday_18_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);
$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['thursday_20_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['thursday_20_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);
$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['thursday_22_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['thursday_22_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);


$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['friday_18_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['friday_18_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);
$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['friday_20_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['friday_20_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);
$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['friday_22_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['friday_22_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);


$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['saturday_18_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['saturday_18_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);
$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['saturday_20_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['saturday_20_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);
$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['saturday_22_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['saturday_22_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);


$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['sunday_18_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['sunday_18_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);
$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['sunday_20_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['sunday_20_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);
$GLOBALS['TL_DCA']['tl_sendeplan']['fields']['sunday_22_sondersendung'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_sendeplan']['sunday_22_sondersendung'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'			  => 'tl_sondersendung.title',
	'eval'                    => array( 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'					  => "int(10) unsigned NOT NULL default '0'",
	'relation'				  => array('type'=>'hasOne','load'=>'eager')
);



class tl_sendeplan extends Backend{
	
	public function __construct(){
		parent::__construct();
		$this->import('BackendUser', 'User');
	}
	
	public function editHeader($row, $href, $label, $title, $icon, $attributes){
		return ($this->User->isAdmin || count(preg_grep('/^tl_form::/', $this->User->alexf)) > 0) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ' : '';
	}
	
	public function getAllDJ(DataContainer $dc){
		
		$Sendeplan = $this->Database->prepare("SELECT * FROM tl_sendeplan WHERE id = ?")->execute($dc->activeRecord->id);
		$Sendeplan = $Sendeplan->row();
		$User = $this->Database->prepare("SELECT * FROM tl_member")->execute();

		$groups = deserialize($Sendeplan['groups']);
		$user = array();
		while($User->next()){
			$row  = $User->row();
			$usergroups = deserialize($row['groups']);
			if(is_array($groups) && is_array($usergroups))
				$diff = array_diff($groups,$usergroups);
			else $diff = array();
			if(empty($diff)){
				$user[$row['id']] = $row['firstname'].' '.$row['lastname'];
			};
		}
		
		return $user;
		
	}
	
	public function generateAlias($varValue, DataContainer $dc){
		$autoAlias = false;

		// Generate alias if there is none
		if (!strlen($varValue))
		{
			$autoAlias = true;
			$varValue = standardize($dc->activeRecord->headline);
		}

		$objAlias = $this->Database->prepare("SELECT id FROM tl_sendeplan WHERE alias=?")
								   ->execute($varValue);

		// Check whether the news alias exists
		if ($objAlias->numRows > 1 && !$autoAlias)
		{
			throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
		}

		// Add ID to alias
		if ($objAlias->numRows && $autoAlias)
		{
			$varValue .= '-' . $dc->id;
		}

		return $varValue;
	}

	public function getAllEvents() {
		$Special = \SondersendungModel::findAll();
		if(!$Special)
			return array();

		$arrSpecial = array();
		while($Special->next())
			$arrSpecial[$Special->id] = $Special->title;

		return $arrSpecial;
	}
}