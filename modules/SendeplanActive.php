<?php

/**
* Contao Open Source CMS
*/

namespace sioweb\contao\extensions\sendeplan;
use Contao;

/**
* @file SendeplanActive.php
* @class SendeplanActive
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.sendeplan
* @copyright Sascha Weidner, Sioweb
*/

class SendeplanActive extends SendeplanWeek {
    
    protected $strTemplate = 'mod_sendeplan_active';
    
    protected function compile() {
        parent::compile();
        foreach($this->Template->sendeplan as $day => $hours) {
            foreach($hours as $key => $hour) {
                if($hour['active'] == 1) {
                    $djObj = new \FrontendTemplate('sendeplan_active');
                    $djObj->setData($hour);
                    $this->Template->activeDJ = $djObj->parse();
                }
            }
        }
    }
}