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

session_start();

if(	(	$_SERVER["REMOTE_ADDR"] == '72.14.184.243' || 
		$_SERVER["REMOTE_ADDR"] == '127.0.0.1') 
	&& $guest){
  session_start();
  session_register("SESSION");
  session_register("SESSION_UNAME");
  if($id){
    $SESSION_UNAME = "$id";
  }
  else
    {
      $SESSION_UNAME = "Guest";
    }
 }
 else
   {
     if (!session_is_registered("SESSION"))
       {
	 // if session check fails, invoke error handler
	 header("Location: /error.php?e=2");
	 exit();
       }
   }
?>
