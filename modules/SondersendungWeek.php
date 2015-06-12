<?php

/**
* Contao Open Source CMS
*/

namespace sioweb\contao\extensions\sendeplan;
use Contao;

/**
* @file SondersendungWeek.php
* @class SondersendungWeek
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.sendeplan
* @copyright Sascha Weidner, Sioweb
*/

class SondersendungWeek extends SendeplanWeek
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'tl_sondersendung_week';
	
	public function compile()
	{
		$this->loadLanguageFile('tl_sendeplan');
		$Data = array();
		parent::compile();
		
		foreach($this->Template->sendeplan as $dKey => $day)
		{
			foreach($day as $hKey => $hour)
			{
				$plan = $this->Database->prepare('SELECT '.$hour['day'].'_sondersendung FROM tl_sendeplan WHERE id = ?')->execute($this->sendeplan_id)->row();
				$Sondersendung = $plan[$hour['day'].'_sondersendung'];
				if($Sondersendung != 0)
				{
					$Sondersendung = $this->Database->prepare("SELECT * FROM tl_sondersendung WHERE id = ?")->execute($Sondersendung)->row();
					$Data[$dKey][$hKey] = array_merge($hour,array('sondersendung'=>$Sondersendung));
				}else{
					$Data[$dKey][$hKey] = $hour;
				}
			}
		}
		$this->Template->sendeplan = $Data;
	}
}