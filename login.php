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

$status = authenticate($f_user, $f_pass);

include("config.db.php");

// print "<h1> Welcome to Online Log </h1>";

// if  user/pass combination is correct
if ($status == 1)
  {
    // initiate a session
    
    //	session_cache_expire(180);
    session_start();
    
    // register some session variables
    session_register("SESSION");
    
    // including the username
    session_register("SESSION_UNAME");
    $SESSION_UNAME = $f_user;
    
    // redirect to protected page
    header("Location: /index2.php");
    exit();
  }
 else
   // user/pass check failed
   {
     // redirect to error page
     header("Location: /error.php?e=$status");
     exit();
   }

// authenticate username/password against a database
// returns: 0 if username and password is incorrect
//          1 if username and password are correct

function authenticate($user, $pass)
{
  // configuration variables
  // normally these should be sourced from an external file
  // for example: include("dbconfig.php");
  // variables explicitly set here for illustrative purposes
  
  // check login and password
  // connect and execute query
  
  
  include("config.db.php");      
  
  $connection = mysql_connect($hcdx_server, $hcdx_username, $hcdx_password) or die ("Unable to connect!");
  
  $query = "SELECT password from users WHERE login = '$user' and emailconfirmed = '1'"; 
  
  mysql_select_db($hcdx_database);
  
  $result = mysql_query($query, $connection) or die ("Error in query: $query. " . mysql_error());
  
  // if row exists -> user/pass combination is correct
  
  $data = mysql_fetch_array($result);
  $pwddb = $data["password"];
  
  //	print "$pwddb, $password<br>";
  if (crypt($pass, $pwddb) == $pwddb) {
    return 1;
  }
  // user/pass combination is wrong
  else
    {
      return 0;
    }
}

?>
