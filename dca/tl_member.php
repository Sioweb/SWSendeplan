<?php 

/**
 * Table tl_member
 */

$this->loadDataContainer('tl_content');
$this->loadLanguageFile('tl_content');

$GLOBALS['TL_DCA']['tl_member']['list']['label']['fields'] = array('dj_nick', 'firstname');
$GLOBALS['TL_DCA']['tl_member']['list']['label']['format'] = '%s<span style="color:#b3b3b3; padding-left:3px;">[%s]</span>';
$GLOBALS['TL_DCA']['tl_member']['list']['label']['label_callback'] = null;
$GLOBALS['TL_DCA']['tl_member']['list']['label']['showColumns'] = false;

$semicolon = '';
if(substr($GLOBALS['TL_DCA']['tl_member']['palettes']['default'],-1) != ';')
    $semicolon = ';';

$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = $GLOBALS['TL_DCA']['tl_member']['palettes']['default'].$semicolon.'{dj_legend},dj_nick,music,moreInfo';

$GLOBALS['TL_DCA']['tl_member']['fields']['dj_nick'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_member']['dj_nick'],
    'exclude'                 => true,
    'search'                  => true,
    'sorting'                 => true,
    'flag'                    => 1,
    'inputType'               => 'text',
    'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'personal', 'tl_class'=>'w50'),
    'sql'                     => "varchar(250) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_member']['fields']['music'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_member']['music'],
    'exclude'                 => true,
    'inputType'               => 'listWizard',
    'eval'                    => array( 'maxlength'=>255, 'feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'personal', 'tl_class'=>'clr'),
    'sql'                     => "varchar(250) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_member']['fields']['moreInfo'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_member']['moreInfo'],
    'exclude'                 => true,
    'inputType'               => 'listWizard',
    'eval'                    => array( 'maxlength'=>255, 'feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'personal', 'tl_class'=>'clr'),
    'sql'                     => "varchar(250) NOT NULL default ''"
);

class sw_ct_member extends tl_content {

}