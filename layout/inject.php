<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * A one column layout for the minusone theme.
 *
 * @package   theme_minusone
 * @copyright 2019 Open Campus Team
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$theme = theme_config::load('minusone');
$uwicampus = $theme->settings->uwicampus;

$campuses = array(
	'XCM' => array(
		'UWI',
		'uwi.edu'
	),
	'OC' => array(
		'UWI Open Campus',
		'open.uwi.edu'
	),
	'STA' => array(
		'UWI St. Augustine',
		'sta.uwi.edu'
	),
	'MON' => array(
		'UWI Mona',
		'mona.uwi.edu'
	),
	'CAV' => array(
		'UWI Cave Hill',
		'cavehill.uwi.edu'
	));

   $uwicampusname = $campuses[$uwicampus][0];
   $uwicampusurl = $campuses[$uwicampus][1];




	$r = get_performance_info();
	$h = substr(gethostname(), 0, 11);
	$l = $h . ' '. $_SERVER['HTTP_HOST'] .' '. time() . ' ' . $r['txt']."\n";
	$f = '/data/tlog/' . $h . '.' . $_SERVER['HTTP_HOST'] . '.log';
	$perfinfo =  $h . ' | ';
	$perfinfo .= number_format($r['memory_total']/1024/1024, 1). 'M/';
	$perfinfo .= number_format($r['memory_peak']/1024/1024, 1). 'M | ';
	$perfinfo .= $r['sessionsize']. ' | ';
	$perfinfo .= $r['dbqueries']. ' | ';
	$perfinfo .= number_format($r['dbtime'], 3). 's/';
	$perfinfo .= number_format($r['realtime'], 3). 's | ';
	$perfinfo .= $r['serverload']. '';
