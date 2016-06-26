<?
//
// Hard-Core-DX Online Log
// Copyright (C) 2009 Risto Kotalampi, risto@kotalampi.com
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
//

$email = "online-log@hard-core-dx.com";

//// You should not change anything below this line.

include_once("session_check.php");

$version = "2.1";
$maturity = "prod";

#$bgcolor = "#E2E3E5";
$bgcolor = "#aaaaff";

include("config.db.php");

$t = time();

$a = date ( "H, i, s, m, d, y", $t);
$b = gmdate ( "H, i, s, m, d, y", $t);
$a = mktime($a);
$b = mktime($b);

$utctimediff = $b - $a;
// $out = gmdate("M d Y H:i:s", $in);  
// print "$out<br>$a<br>$b<br>$c";

$resultframe = "results_frame";

$fqvar = 0.5;
$VALIDLANGS = array('english', 'finnish', 'swedish');
$VALIDLOGFORMATS = array('clusive', 'table');
$VALIDSHORTYEARS = array('1', '0');

$curyear = gmdate("Y");
$lastvisitlimit = 3600;

if($REMOTE_USER){
  $remuser = $REMOTE_USER;
 }

if($_SERVER['REMOTE_USER']){
  $remuser = $_SERVER['REMOTE_USER'];
 }

if($SESSION_UNAME){
  $remuser = $SESSION_UNAME;
 }

$userlogin = $remuser;

$numbers = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

// $remuser = str_replace($numbers, '', $remuser);
// $remuser = strtoupper($remuser);

include("nocache.php");
include("functions.php");
include("userprefs.php");

$GLOBALPREFS["country_pulldown"] = 0;

if($USERPREFS["language"] && !$_REQUEST["language"]){
  $_REQUEST["language"] = $USERPREFS["language"];
 }

include("setlanguage.php");

?>
