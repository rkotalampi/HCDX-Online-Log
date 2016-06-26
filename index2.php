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

if(!$cmd){
print "<HTML>";
print "<head><link rel=stylesheet type=text/css href=hcdx.css />";

print "<TITLE>Hard-Core-DX Online Log</TITLE>";
print "</HEAD>";
print "  <FRAMESET COLS=\"15%,85%\">";
print "    <FRAME SRC=menu.php?language=" . $_REQUEST["language"] . ">";
print "    <FRAME SRC=empty.php name=\"$resultframe\">";
print "  </FRAMESET>";
print "</HTML>";

}
?>
