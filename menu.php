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

print "<head><link rel=stylesheet type=text/css href=hcdx.css /></head>";
print "<body bgcolor=$bgcolor>";
print "<h2>". $TEXT["welcome"]. ", $remuser</h2>";

// print "<font size=-1>";

print "<b>";
print $TEXT["functions"];

print "</b><br>";

// print " ";
// print "<a href=TODO target=$resultframe>". $TEXT["view_todo"] . "</a>";
// print " ";

print "<a href=results.php?cmd=add&language=$language target=$resultframe>" . $TEXT["add_log"] . "</a>";
print "<br>";

print "<a href=search.php?language=$language target=$resultframe>" . $TEXT["search"] . "</a>&nbsp;";
print "<br>";

print "<a href=logout.php target=_top>" . $TEXT["logout"] . "</a> ";

print "<br>";

print " ";

$bquery = "SELECT * from Bands ORDER by oid, Name";
$dquery = "SELECT * from DatesMenu";

#$bresults = runsql($bquery);

#print $TEXT["bands"]; 
#print ":";

#while($data = mysql_fetch_array($bresults)){
#	$band = $data["Name"];
#	$bandstring = str_replace(" ","%20", $band); 
#	print "<a href=results.php?cmd=view&language=$language&band=$bandstring target=\"$resultframe\">$band</a>\n";
#}

print "<br>";

print "<b>" . $TEXT["since"] . "</b>:";

// $month = gmdate("F");
// $m = gmdate("n");
// $mday = gmdate("d");
// $year = gmdate("Y");
// $utc = gmdate("Hi");
// $xmonth = gmdate("m");
// $z = gmdate("z");
// $e = "\$month_X = \$TEXT[\"Month$m\"];";
// eval($e);

// $prevyear=$year-1;

print "<br>";
print "<a href=results.php?cmd=view&days=90&language=$language target=\"$resultframe\">" . $TEXT["last"] . " 90 " . $TEXT["days"] . "</a>\n";
print "<br>";
print "<a href=results.php?cmd=view&days=30&language=$language target=\"$resultframe\">" . $TEXT["last"] . " 30 " . $TEXT["days"] . "</a>\n";
print "<br>";
print "<a href=results.php?cmd=view&days=14&language=$language target=\"$resultframe\">" . $TEXT["last"] . " 14 " . $TEXT["days"] . "</a>\n";
print "<br>";
print "<a href=results.php?cmd=view&days=7&language=$language target=\"$resultframe\">" . $TEXT["last"] . " 7 " . $TEXT["days"] . "</a>\n";
print "<br>";
print "<a href=results.php?cmd=view&days=3&language=$language target=\"$resultframe\">" . $TEXT["last"] . " 3 " . $TEXT["days"] . "</a>\n";
print "<br>";
print "<a href=results.php?cmd=view&days=2&language=$language target=\"$resultframe\">" . $TEXT["last"] . " 2 " . $TEXT["days"] . "</a>\n";
print "<br>";
print "<a href=results.php?cmd=view&days=1&language=$language target=\"$resultframe\">" . $TEXT["last"] . " 1 " . $TEXT["days"] . "</a>\n";
print "<br>";
print "<a href=results.php?cmd=view&days=0.0833333333&language=$language target=\"$resultframe\">" . $TEXT["last"] . " 2 " . $TEXT["hours"] . "</a>\n" . "<br>";

$lastlastvisit = $USERPREFS["lastlastvisit"];

if($lastlastvisit){
  if($USERPREFS["dateformat"] == "European"){
    $lf = "d.m.Y Hi";
  }
  elseif($USERPREFS["dateformat"] == "American"){
    $lf = "m/d/Y Hi";
  }
  elseif($USERPREFS["dateformat"] == "Universal"){
    $lf = "d M Y Hi";
  }
  
  $lastlastvisitdate = gmdate($lf, $lastlastvisit);
  print "<a href=results.php?cmd=view&newer=$lastlastvisit&language=$language target=\"$resultframe\">" . $TEXT["sincelastvisit"] . " ($lastlastvisitdate UTC)" . "</a>\n" . "<br>";
 }


print "<p><b>" . $TEXT["choose_language"] . "</b>:";

print "<br>";
$query = "SELECT * from languages where maturity = 'prod'";
$lresults = runsql($query);

while($ldata = mysql_fetch_array($lresults)){
  $l = $ldata["language"];
  print "<a href=index2.php?language=$l target=_top>". 
    $TEXT["$l"]. "</a>\n";
 }

print "<br>";
print "<p><b> YLE Teksti-TV pilotti </b>:<br>";
print "<a href=P591_03.gif target=\"$resultframe\"><img src=P591_03.gif width=250 height=190></a>";


if($GLOBALPREFS["editprefsenabled"]){
  print "<a href=results.php?cmd=user&language=$language target=$resultframe>" .
    $TEXT["editpreferences"] . "</a>";
 }

print " ";
// print "<a href=results.php?cmd=preferences&language=$language target=$resultframe>" . $TEXT["change_prefs"] . "</a>";
print "<p>";

print "Version: $version ($maturity)";

print "</font>";
