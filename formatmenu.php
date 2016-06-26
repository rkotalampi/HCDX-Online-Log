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

print "<select name=Category>\n";

$query = "SELECT * from Categories";

$results = runsql($query);

print "<option value=0>" . $TEXT["select_category"];

$o = 0;

while($data = mysql_fetch_array($results)){
  
  $selected = "";
  
  $k_c = $data["k"];
  
  
  $e = "\$cat = \$TEXT[\"category$k_c\"];";
  eval($e);
  if(($USERPREFS["usergroup"] == 'Finland') || ($k_c != 2 && $k_c != 3)){
    print "<option value=$k_c $selected>$cat";
  }
 }

print "</select>\n";
