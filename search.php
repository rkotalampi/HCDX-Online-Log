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

$bquery = "SELECT * from Bands ORDER by oid, Name";

$bresults = runsql($bquery);

print "<head><link rel=stylesheet type=text/css href=hcdx.css /></head>";

print "<body bgcolor=$bgcolor>";

print "<font size=-1>";

print "<table border=0>";
print "<form method=post action=results.php?cmd=view&language=$language target=results_frame>";
print "<tr><td>";
print $TEXT["choosecountry"]; 
print "</td>";
print "<td>";
print "<input type=text name=Country>";
print "</td></tr>";

print "<tr><td>";
print $TEXT["station"] ;
print "</td>";
print "<td>";
print "<input type=text name=Station>";
print "</td></tr>";

print "<tr><td>";
print $TEXT["select_category"] ;
print "</td>";
print "<td>";
include("categorymenu.php");
print "</td></tr>";

print "<tr><td>";
print $TEXT["choose_fq"] . " (min)" ;
print "</td>";
print "<td>";
print "<input type=text name=fqmin>";
print "</td></tr>";

print "<tr><td>";
print $TEXT["choose_fq"];
print "</td>";
print "<td>";
print "<input type=text name=fq>";
print "</td></tr>";

print "<tr><td>";
print $TEXT["choose_fq"] . " (max)" ;
print "</td>";
print "<td>";
print "<input type=text name=fqmax>";
print "</td></tr>";

print "<tr><td>";
print $TEXT["bands"]; 
print "</td>";
print "<td>";
print "<select name=band>";
print "<option value=''>";
while($data = mysql_fetch_array($bresults)){
  $band = $data["Name"];
  $bandstring = str_replace(" ","%20", $band);
  print "<option value=$bandstring>$band";
 }
print "</select>\n";
print "</td></tr>";

print "<tr><td>";
print $TEXT["plus"];
print "</td>";
print "<td>";
print "<input type=checkbox name=Plus>";
print "</td></tr>";

print "<tr><td>";
print $TEXT["underline"];
print "</td>";
print "<td>";
print "<input type=checkbox name=Underline>";
print "</td></tr>";

print "<tr><td>";
print $TEXT["startutcrange"];
print "</td>";
print "<td>";
print "<input type=text name=startutcmin>";
print "-";
print "<input type=text name=startutcmax>";
print "</td></tr>";

print "<tr><td>";
print $TEXT["endutcrange"];
print "</td>";
print "<td>";
print "<input type=text name=endutcmin>";
print "-";
print "<input type=text name=endutcmax>";
print "</td></tr>";

print "<tr><td>";
print $TEXT["choose_date"] . " (min) " . "(YYYY-MM-DD)"; 
print "</td>";
print "<td>";
print "<input type=text name=datemin>";
print "</td></tr>";

print "<tr><td>";
print $TEXT["choose_date"] . " " . "(YYYY-MM-DD)"; 
print "</td>";
print "<td>";
print "<input type=text name=Date>";
print "</td></tr>";

print "<tr><td>";
print $TEXT["choose_date"] . " (max) " . "(YYYY-MM-DD)"; 
print "</td>";
print "<td>";
print "<input type=text name=datemax>";
print "</td></tr>";

print "<tr><td>";
print $TEXT["since"];
print "</td>";
print "<td>";
print "<input type=text name=days>";
print "</td></tr>";

print "<tr><td>";
print $TEXT["neweradd"];
print "</td>";
print "<td>";
print "<input type=text name=neweradd>";
print "</td></tr>";

print "<tr><td>";
print $TEXT["olderadd"];
print "</td>";
print "<td>";
print "<input type=text name=olderadd>";
print "</td></tr>";

print "<tr><td>";
print $TEXT["sinceheard"];
print "</td>";
print "<td>";
print "<input type=text name=sinceheard>";
print "</td></tr>";

print "<tr><td>";
print $TEXT["choose_listener"] ;
print "</td>";
print "<td>";
print "<input type=text name=includehandle>";
print "</td></tr>";

print "<tr><td>";
print $TEXT["exclude_listener"] ;
print "</td>";
print "<td>";
print "<input type=text name=ignorehandle>";
print "</td></tr>";

print "<tr><td>";
print $TEXT["select_logformat"] ;
print "</td>";
print "<td>";
print "<select name=logformat>\n";
print "<option value=clusive>" . "Clusive";
print "<option value=radiomaailma>" . "Radiomaailma";
print "<option value=csv>" . "csv";
print "</select>";
print "</td></tr>";

print "</table>";

print "<input type=submit name=view value=\"" . $TEXT["search"] . "\">\n";
print "</form>";

?>
