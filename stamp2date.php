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

$t = time();

$a = date ("H, i, s, m, d, y", $t);
$b = gmdate ( "H, i, s, m, d, y", $t);
$a = mktime($a);
$b = mktime($b);

$utctimediff = $b - $a;

$out1 = gmdate("M d Y H:i:s", $in);  
$out2 = gmdate("M d Y H:i:s", $out);  
print "$out1<br>$out2<br>$utctimediff";

?>
