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

function confirm ($random) {
  include("config.db.php");	
  
  $cid = mysql_connect($hcdx_server,$hcdx_username,$hcdx_password);
  
  if (!$cid) {
    
    die("ERROR: " . mysql_error() . "\n");
    
  }
  
# Setup SQL statement, update account to show that user has confirmed.
  $SQL2 = "select count(*) from users where random = '$random'";
  $result = mysql_db_query($hcdx_database,$SQL2,$cid);
  $data = mysql_fetch_row($result);
  
  $SQL3 = "select usergroup, login, email, random2 from users where 
		random = '$random'";
  
  $results3 = mysql_db_query($hcdx_database,$SQL3,$cid);
  $data3 = mysql_fetch_row($results3);
  
  if(!$data[0]){
    print "Invalid request";
    exit(0);
  }

  $usergroup = $data3[0];
  $login = $data3[1];
  $email = $data3[2];
  $random2 = $data3[3];
  
  $joinapproved = 1;

  $sqlmoderated = "select moderated, owner from groups where name = '$usergroup' and status = 'Active'";

  $modresults = mysql_db_query($hcdx_database,$sqlmoderated,$cid);
  $moddata = mysql_fetch_row($modresults);

  if($moddata[0]  == 'Y'){
    $joinapproved = 0;
  }
  
  $SQL = "UPDATE users SET emailconfirmed = '1', joinapproved = '$joinapproved' 
		WHERE random = '$random'";
  $result = mysql_db_query($hcdx_database,$SQL,$cid);
  
# Check for errors.
  if (!$result) {
    
    die("ERROR: " . mysql_error() . "\n");
    
  } else {
    
    if($moddata[0]  == 'Y'){
      print "<h1>Thank you!</h1>Thank you for confirming your email account. <b> Please notice that your account is not yet active </b>. This group requires
	all accounts to be approved before the final activation. The group owner has been notified and your account will be active when he/she has approved the request. You will receive an email once the account has been activated.\n\nThank you!";
      
      $to = $moddata[1];
      $subject = "HCDX Online Log: Account Approval Required";
      $message = "The following request for access has been made\n\n
		Email: $email\n
		Group: $usergroup\n
		Login: $login\n\n
		To approve the request please click\n 
		http://". $_SERVER["HTTP_HOST"] ."/account.php?action=approve&random=$random&random2=$random2\n
Thanks!\n
";
      $from = "From: HCDX Online Log Admin <$sender>";
      mail($to, $subject, $message, $from);
    }
    
    else
      
      {
  	print "Congratulations, your account has been confirmed successfully. 
		You may now login and start using OLL. ";
	print "<a href=index.php>Login to Online Log</a>";
      }
    
  }
  
  mysql_close($cid); 

}

function signupForm () {
  
  include("config.db.php");
  
 # Nothing more than spitting out HTML for the form
  print "<form name=\"signup\" method=\"POST\" action=\"?action=signup\">";
  print "<table border=0>";
  print "<tr>"; 
  print "<td>Login:</td><td> <input type=\"text\" name=\"login\"></td>";
  print "</tr>";
  print "<tr>"; 
  print "<td>Password:</td><td><input type=\"password\" name=\"password1\">
		</td>";
  print "</tr>";
  print "<tr>"; 
  print "<td>Password (again):</td><td><input type=\"password\" name=\"password2\">
		</td>";
  print "</tr>";
  print "<tr>"; 
  
  print "<td>E-Mail:</td><td><input type=\"text\" name=\"email\"></td></tr>";
  
  print "<tr><td>User group:</td><td><select name=usergroup>";

  $sqlfetchgroups = "select name, Description from groups where status='Active' order by gid";

  $gcount=0;

  $cid = mysql_connect($hcdx_server,$hcdx_username,$hcdx_password);
  $groupresults = mysql_db_query($hcdx_database,$sqlfetchgroups,$cid);

  while($datagroups = mysql_fetch_row($groupresults)){
    $gcount++;

    $group = $datagroups[0];
    $description = $datagroups[1];

    if($gcount == 1){
      $gselected = "Selected";
    }
    else
      {
	$gselected = "";
      }

    print "<option value='$group' $gselected>$description";
  }

  print "</select>\n";
  print "</td></tr></table>";
  
  print "<input type=\"submit\" value=\"Create Account\"></form>";
  
}

function approveAccount ($random, $random2){
  include("config.db.php");	
  
  $cid = mysql_connect($hcdx_server,$hcdx_username,$hcdx_password);
  
  if (!$cid) {
    
    die("ERROR: " . mysql_error() . "\n");
    
  } 
  
  $sql = "update users SET joinapproved = 1 where random2 = '$random2'
	AND random = '$random'";
  
  $result = mysql_db_query($hcdx_database,$sql,$cid);	
  
  $sql2 = "select email, usergroup from users where random2 = '$random2'
		AND random = '$random'";
  
 $result = mysql_db_query($hcdx_database,$sql2,$cid);	
 
 $data = mysql_fetch_row($result);
 
 $email = $data[0];
 $usergroup = $data[1];	
 
 $subject = "HCDX Online Log: Request Approved\n";
 $message = "Your request to join the $usergroup-group in HCDX Online Log has been approved. Please log in to http://". $_SERVER["HTTP_HOST"] ."\n\nThank you!";
 $from = "From: Online Log Admin <$sender>";
 mail($email, $subject, $message, $from);
 
 print "Thank you!";
}


function createAccount ($login, $password1, $password2, $email, $usergroup) {
  include("config.db.php");	
  
  if ($login == "" || $password1 == "" || $password2 == "" || $email == "") {
    
    die("ERROR: Please make sure that all entries are valid!");
    
  }
  if($password1 != $password2){
    print "Passwords don't match, please go back and correct the typo";
    exit(0);
  }
  
# Connect to the database and report any errors on connect.
 $cid = mysql_connect($hcdx_server,$hcdx_username,$hcdx_password);
 
 if (!$cid) {
   
   die("ERROR: " . mysql_error() . "\n");
   
 } 
 
# Create Random number
 $floor = 1000000;
 // $ceiling = 9999999;
 $ceiling = getrandmax();
 srand((double)microtime()*1000000);
 $random1 = rand($floor, $ceiling);
 $random2 = rand($floor, $ceiling);
 //$random3 = rand($floor, $ceiling);
 
 $random = "$random1$random2";
 $random3 = rand($floor, $ceiling);
 $random4 = rand($floor, $ceiling);
 $random2 = "$random3$random4";
 
# Message sent in the e-mail to the user that's signing up.
 $message = "You or someone using your email address has requested an account on the HCDX Online Log system for group $usergroup. If you requested the account please confirm it within 48 hours of the request. If this wasn't you, please forward this message to $sender.\n\nTo activate the account please go to\n\n 
http://". $_SERVER["HTTP_HOST"] ."/account.php?action=confirm&confirm=$random
\n
Replying to this email will NOT activate the account. You have to click the
link above.\n
\n
\nThanks!";
 
# Send the confirmation e-mail to the user.
 
# I usually hash the passwords instead of storing the plaintext password in the database.
# Just comment the next line out if you'd prefer to store them as plaintext.
 $password1 = crypt($password1, $random);
 
# Setup SQL statement and add the account into the system.
 $SQL1 = "select uid from users where login = '$login'";
 $SQL2 = "select email from users where email = '$email' 
	and usergroup =	'$usergroup'";
 $dfquery = "select dateformat, language from groups where name = '$usergroup'";

 $result1 = mysql_db_query($hcdx_database,$SQL1,$cid);
 $result2 = mysql_db_query($hcdx_database,$SQL2,$cid);
 $dqresults = mysql_db_query($hcdx_database,$dfquery,$cid);

 $dqdata = mysql_fetch_row($dqresults);

 if(mysql_num_rows($result1)){
   print "This login is taken<br>\n";
   print "<a href=account.php>Try again</a>";
   exit(0);
 }
 
 if(mysql_num_rows($result2)){
   print "This email address already have an account in group $usergroup<br>\n";
   print "<a href=account.php>Try again</a>";
   exit(0);
 }
 
 if(!preg_match("/@/", $email)){
   print "Please give a valid email address";
   exit(0);
 }
 
 if(preg_match("/ /", $email)){
   print "Please give a valid email address";
   exit(0);
 }
 
 if(preg_match("/,/", $email)){
   print "Please give a valid email address";
   exit(0);
 }
 
 $from = "From: Online Log Admin <$sender>";
 mail($email, "HCDX Online Log Account Confirmation", $message, $from);
 $t = time();
 
 $dateformat = $dqdata[0];
 
 $language = $dqdata[1];
 
 $SQL = "INSERT INTO users (login, random2, language, dateformat, password, email, emailconfirmed, random, Added, usergroup) VALUES ('$login','$random2','$language','$dateformat','$password1','$email','0','$random', $t, '$usergroup')";
 $result = mysql_db_query($hcdx_database,$SQL,$cid);
 
# Check for errors.
 if (!$result) {
   
   die("ERROR: " . mysql_error() . "\n");
   
 } else {
   
   print "Congratulations, your account has been added into the system. Check your e-mail for the confirmation message. You have to confirm the email address before logging into the system.";
   
 }
 
 mysql_close($cid);
 
}

?>
