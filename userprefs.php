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

include_once("session_check.php");

$user_query = "select * from $usertable where login = '$userlogin'";
$u = runsql($user_query, $language);

$logformat = $USERPREFS["logformat"];
$printyear = $USERPREFS["printyear"];

$USERPREFS = mysql_fetch_array($u);
$uid = $USERPREFS["uid"];
$bgcolor = $USERPREFS["bgcolor"];
$added = $USERPREFS["Added"];

if(!$added){
  $sqladd = "update users SET Added = $t where login = '$userlogin'";
  $addresult = runsql($sqladd);
 }

if($USERPREFS["lastvisit"] < ($t-$lastvisitlimit)){
  $uq2 = "update $usertable SET lastlastvisit = lastvisitstart 
			where uid = $uid";
  $uq3 = "update $usertable SET lastvisitstart = $t
			where uid = $uid";
  $uq4 = "update $usertable SET visits = (visits + 1) 
			where uid = $uid";
  $uq2 = runsql($uq2, $language);
  $uq3 = runsql($uq3, $language);
  $uq4 = runsql($uq4, $language);
  $USERPREFS["lastlastvisit"] = $USERPREFS["lastvisit"];
 }

$uq = "update $usertable SET lastvisit = $t where uid = $uid";
$u = runsql($uq, $language);
?>
