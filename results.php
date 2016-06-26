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

include_once("config.php");

$logformat = $_REQUEST["logformat"];

print "<head><link rel=stylesheet type=text/css href=hcdx.css /></head>";

//if($logformat != "csv"){
print "<body bgcolor=$bgcolor>";
//}

if($cmd == "user"){
  userprofile($_REQUEST, $save);
 }

if($cmd == "view"){
  viewlog($hcdx_server, $hcdx_username, $hcdx_password, 
	  $hcdx_database, $logtable, $_REQUEST);
 }

if($delete){
  deletelog($k, $remuser, $logtable);
 }

if($submit && !$delete){
  
  $MYSQL_Date = "$HCDX_Year" . "-" . "$HCDX_Month" . "-" . "$HCDX_Date";
  if(!checkdate ($HCDX_Month, $HCDX_Date, $HCDX_Year)){
    print "That date is not valid\n";
    exit();
  }
  
  if($Listener){
    $User = "$Listener";
  }
  else
    {
      $User = $remuser;
    }
  
  submitlog($FQ, $MYSQL_Date, $StartUTC, $EndUTC, $Country, $StationQTH, $Comments, 
	    $User, $ListenerHandle, $c_input, $k, $uniq, $k, $logtable, 
	    $Plus, $underline, $Tentative, $StartUTCStar, $EndUTCStar);
 }

if($cmd == "add"){
  addlog($hcdx_server, $hcdx_username, $hcdx_password, 
	 $hcdx_database, $logtable, $k, $remuser, $ListenerHandle);
 }

?>
