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

?>

<html>

<head><link rel=stylesheet type=text/css href=hcdx.css /></head>

<body bgcolor=#aaaaff>
   
   <?

 // check the error code and generate an appropriate error message switch
switch ($e) {
  case -1:
  $message = "No such user.";
  break;
  
  case 0:
  $message = "Invalid username and/or password.";
  break;
  
  case 2:
  $message = "Unauthorized access. Cookies enabled?";
  
  break;
  
  default:
  $message = "An unspecified error occurred.";
  break;
}
   ?>
   
   <center>
   <? echo $message; ?>
   <br>
   Please <a href="index.php">log in</a> again.
   </center>
   
   </body>
   </html>
   