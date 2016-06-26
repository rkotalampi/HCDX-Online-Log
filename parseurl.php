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

$logformat = $_REQUEST["logformat"];
$fq = $_REQUEST["fq"];
$days = $_REQUEST["days"];
$added = $_REQUEST["added"];
$band = $_REQUEST["band"];
$order = $_REQUEST["order"];
$k_cat = $_REQUEST["k_cat"];
$k_min = $_REQUEST["k_min"];
$k_max = $_REQUEST["k_max"];
$S_listener = $_REQUEST["S_listener"];
$S_country = $_REQUEST["S_country"];
$uniq = $_REQUEST["uniq"];
$ascdesc = $_REQUEST["ascdesc"];

?>
