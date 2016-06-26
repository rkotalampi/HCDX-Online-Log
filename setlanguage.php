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

$mq = "select * from texts";

$m = runsql($mq);

while($t = mysql_fetch_array($m)){
  $tid = $t["tid"];
  $english = $t["english"];
  $swedish = $t["swedish"];
  $finnish = $t["finnish"];
  $text = $t["text"];
  
  $TEXT["$text"] = "<em>$text</em>";
  
  if($english){
    $TEXT["$text"] = "<em>$english</em>";
  }
  
  if($_REQUEST["language"] == "english"){
    if($english){
      $TEXT["$text"] = $english;
    }
  }
  
  if($_REQUEST["language"] == "finnish"){
    if($finnish){
      $TEXT["$text"] = $finnish;
    }
  }
  
  if($_REQUEST["language"] == "swedish"){
    if($swedish){
      $TEXT["$text"] = $swedish;
    }
  }
  
 }

?>
