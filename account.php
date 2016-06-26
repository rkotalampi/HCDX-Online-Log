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

print "<center>";
print "<head><link rel=stylesheet type=text/css href=hcdx.css /></head>";

include_once("functions.public.php");

if ($_REQUEST["action"] == "approve") {
  approveAccount($random,$random2);
  exit(0);
 }

if ($_REQUEST["action"] != "signup" && $_REQUEST["action"] != "confirm" ) {
  
  print "<h2> Please input the login and password you'd like to have and
	your email to verify the identity</h2>";
  
  signupForm();
 }


if ($_REQUEST["action"] == "signup") {
  $login = $_POST["login"];
  $password1 = $_POST["password1"];
  $password2 = $_POST["password2"];
  $email    = $_POST["email"];
  $usergroup = $_POST["usergroup"];
  createAccount($login,$password1, $password2, $email, $usergroup);
 }

if ($_REQUEST["action"] == "confirm" && $_REQUEST["confirm"] != "") {
  confirm($_REQUEST["confirm"]);
 }

print "</center>";
?>
