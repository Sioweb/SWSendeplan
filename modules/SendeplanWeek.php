<?php

/**
* Contao Open Source CMS
*/

namespace sioweb\contao\extensions\sendeplan;
use Contao;

/**
* @file SendeplanWeek.php
* @class SendeplanWeek
* @author Sascha Weidner
* @version 3.0.0
* @package sioweb.contao.extensions.sendeplan
* @copyright Sascha Weidner, Sioweb
*/
class SendeplanWeek extends \Module {

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_sendeplan';
	
	protected $sendeplan_id = 0;
	
	/*
	private $days = array(
		'montag_04','montag_06','montag_16','montag_18','montag_20','montag_22',
		'dienstag_04','dienstag_06','dienstag_16','dienstag_18','dienstag_20','dienstag_22',
		'mittwoch_04','mittwoch_06','mittwoch_16','mittwoch_18','mittwoch_20','mittwoch_22',
		'donnerstag_04','donnerstag_06','donnerstag_16','donnerstag_18','donnerstag_20','donnerstag_22',
		'freitag_04','freitag_06','freitag_16','freitag_18','freitag_20','freitag_22',
		'samstag_04','samstag_06','samstag_16','samstag_18','samstag_20','samstag_22',
		'sonntag_04','sonntag_06','sonntag_16','sonntag_18','sonntag_20','sonntag_22',
	);
	/**/
	
	private $days = array(
		'monday'=>array('18','20','22'),
		'tuesday'=>array('18','20','22'),
		'wednesday'=>array('18','20','22'),
		'thursday'=>array('18','20','22'),
		'friday'=>array('18','20','22'),
		'saturday'=>array('18','20','22'),
		'sunday'=>array('18','20','22'),
	);


	/**
	 * Generate module
	 */
	protected function compile() {
		$this->loadLanguageFile('tl_sendeplan');
		$this->sendeplan_id = 1;
		$Sendeplan = SendeplanModel::findByPk($this->sendeplan);
		if(!$Sendeplan)
			return;

		$w = date('w')-1;
		if($w < 0)
			$w = 7;

		$ThisDay = time() - ((date('w') != 0?date('w'):7)*86400);

		$sendeplan = $this->getDjData($Sendeplan);
		$this->Template->today = array_keys($sendeplan)[$w];
		$arrDates = array();
		foreach($sendeplan as $day => $hours) {
			$ThisDay += 86400;
			$arrDates[$day] = array(
				'date' => date(\Config::get('dateFormat')?\Config::get('dateFormat'):'d.m.Y',$ThisDay),
				'tstamp' => $ThisDay
			);
			if($day === $this->Template->today) {
				$sendeplan = array_merge(array('today'=>$hours),$sendeplan);
				$arrDates['today'] = array(
					'date' => date(\Config::get('dateFormat')?\Config::get('dateFormat'):'d.m.Y',$ThisDay),
					'tstamp' => $ThisDay
				);
			}
		}
		$this->Template->dates = $arrDates;
		$this->Template->url = false;
		if($this->sendeplan_jt)
			$this->Template->url = ampersand($this->generateFrontendUrl(\PageModel::findByPk($this->sendeplan_jt)->row()));
		$this->Template->sendeplan = $sendeplan;
	}

	private function getDjData($sendeplan) {

		$time = time();

		date_default_timezone_set('Europe/Berlin'); 
		if(date('I', strtotime(date('d.m.Y'))) == 0)
			$time += 0;

		$arrSendeplan = array();
		$dayIndex = 1;
		foreach($this->days as $day => $hours) {
			foreach($hours as $key => $hour) {
				if($sendeplan->{$day.'_'.$hour}) {

					$DJ = $sendeplan->getRelated($day.'_'.$hour);
					if(!$DJ)
						continue;

					if($DJ->addImage && $DJ->singleSRC) {
						$file = \FilesModel::findByUuid($DJ->singleSRC);
						if($file && is_file(TL_ROOT . '/' . $file->path)) {
							$DJ->singleSRC = $file->path;
							$this->addImageToTemplate($DJ, $DJ->row());
						}
					}

					$n = date('n'); /* Monatszahl ohne führende Nullen */
					$j = date('j'); /* Tag des Monats ohne führende Nullen */
					$w = date('w'); /* Wochentag */
					$Y = date('Y'); /* 2014 */

					#$time = mktime(20, 0, 0, $n, $j, $Y);

					$time_from = mktime($hour, 0, 0, $n, $j, $Y);
					$time_until = mktime($hours[($key+1)]?$hours[($key+1)]:($hour+2), 0, 0, $n, $j, $Y);

					if($w == $dayIndex && $time >= $time_from && $time < $time_until)
						$DJ->active = true;

					$arrSendeplan[$day][$hour] = $DJ->row();
				}
				if($sendeplan->{$day.'_'.$hour.'_sondersendung'}) {
					$Special = $sendeplan->getRelated($day.'_'.$hour.'_sondersendung');
					if($Special)
						$arrSendeplan[$day][$hour]['special'] = $Special->row();
				}
			}
			$dayIndex++;
			if($dayIndex==7)
				$dayIndex = 0;
		}

		return $arrSendeplan;
	}
}