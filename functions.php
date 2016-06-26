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

// include("config.php");

function text ($text){
  include("globals.php");
  
  if($TEXT["$text"]){
    print $TEXT["$text"];
  }
  else
    {
      print "<em>" . $text . "</em>";
    }
}

function runsql ($query) {
  include("globals.php");
  $link = mysql_connect("$hcdx_server", "$hcdx_username", 
			"$hcdx_password") or die ($TEXT["couldnotconnect"]);
  if($debug){
    print $TEXT["connectedsuccessfully"];
  }
  
  mysql_select_db ("$hcdx_database")
    or die ($TEXT["couldnotselectdatabase"]);
  
  $result = mysql_query ($query)
    or die ($TEXT["queryfailed"]);
  mysql_close($link);
  return $result;
}

function viewlog 
($server, $username, $password, $database, $logtable, $_REQUEST){
  
  include("globals.php");
  include_once("parseurl.php");
  
  
  $logformat = $USERPREFS["logformat"];
  
  if($_REQUEST["logformat"]){
    $logformat = $_REQUEST["logformat"];
  }
  
  $query = "SELECT * FROM $logtable WHERE Status = 'Active'";
  
  $usergroup = $USERPREFS["usergroup"];
  $usergroupq = "AND usergroup = '$usergroup'";
  
  
  $fq = $_REQUEST["fq"];
  
  if($fq < 109.0 && $fq > 86.0){
    $fq = $fq * 1000;
  }
  
  $band = $_REQUEST["band"];
  
  $datemin = $_REQUEST["datemin"];
  $datemax = $_REQUEST["datemax"];
  $Date = $_REQUEST["Date"];
  
  if($Date){
    $dq = "AND Date like '%$Date%'";
  }
  
  if($datemin){
    $dmq1 = "AND Date >= '$datemin'";
  }
  
  if($datemax){
    $dmq2 = "AND Date <= '$datemax'";
  }
  
  $year = $_REQUEST["year"];
  if($_REQUEST["year"]){
    $yq = "AND Date like '$year%'";
  }
  
  if($_REQUEST["band"]){
    $bquery = "SELECT * from Bands WHERE Name = '$band'";
    $bqdata = runsql($bquery);
    $bdata = mysql_fetch_array($bqdata);
    $fqmaxb = $bdata["End"];
    $fqminb = $bdata["Start"];
  }
  
  if($_REQUEST["ignorehandle"]){
    $ignorethem = $_REQUEST["ignorehandle"];
    $ignorethem = "\"$ignorethem\"";
    $ignorethem = str_replace(",", "\",\"", $ignorethem);
    $ignoreq1 = "AND ListenerHandle NOT IN ($ignorethem)";
  }
  
  if($_REQUEST["includehandle"]){
    $includehandle = $_REQUEST["includehandle"];
    $ihandleorg = $includehandle;
    $includehandle = "\"$includehandle\"";
    $includehandle = str_replace(",", "\",\"", $includehandle);
    $ihandleorg = str_replace('*', '%', $ihandleorg);
    $includeq1 = "AND (ListenerHandle IN ($includehandle) OR ListenerHandle like '$ihandleorg')";
  }
  
  if($_REQUEST["ignorecategory"]){
    $ignorecat = $_REQUEST["ignorecategory"];
    $ignorecat = "\"$ignorecat\"";
    $ignorecat = str_replace(",", "\",\"", $ignorecat);
    $ignoreq2 = "AND Category NOT IN ($ignorecat)";
  }
  
  if($_REQUEST["days"]){
    $_REQUEST["newer"] = time() - ($_REQUEST["days"]*60*60*24);
    //		$added = time() - (60 * 60 * 24 * $days);
  }
  
  
  if($_REQUEST["newer"]){
    $newer = $_REQUEST["newer"];
    $nq = "AND ((Added >= $newer)
			OR (Modified >= $newer)) ";
  }
  
  if($_REQUEST["older"]){
    $newer = $_REQUEST["older"];
    $nq = "AND ((Added <= $older)
			AND (Modified <= $older)) ";
  }
  
  if($_REQUEST["neweradd"]){
    $neweradd = $_REQUEST["neweradd"];
    $neweradd = preg_replace("/UTC/", "GMT", $neweradd);
    $neweradd = strtotime($neweradd);
    $neweradd = $neweradd;
    $ndq = "AND Added >= $neweradd";
  }
  
  if($_REQUEST["newermod"]){
    $newermod = $_REQUEST["newermod"];
    $newermod = preg_replace("/UTC/", "GMT", $newermod);
    $newermod = strtotime($newermod);
    $newermod = $newermod;
    $mdq = "AND Modified >= $newermod";
  }
  
  if($_REQUEST["Plus"]){
    $pq = "AND Plus = 1";
  }
  
  if($_REQUEST["Underline"]){
    $uq = "AND (Plus =1 OR Underline = 1)";
  }
  
  if($_REQUEST["olderadd"]){
    $olderadd = $_REQUEST["olderadd"];
    $olderadd = preg_replace("/UTC/", "GMT", $olderadd);
    $olderadd = strtotime($olderadd);
    $olderadd = $olderadd;
    $odq = "AND Added <= $olderadd";
  }
  
  if($_REQUEST["Country"]){
    $cq = $_REQUEST["Country"];
    $cq = "\"$cq\"";
    $cq = str_replace(",", "\",\"", $cq);
    $cq1 = "AND Country IN ($cq)";
  }
  
  if($_REQUEST["Station"]){
    $sq = $_REQUEST["Station"];
    $sq = "AND StationQTH like '%$sq%'";
  }
  
  if($_REQUEST["startutcmin"]){
    $startutcmin = $_REQUEST["startutcmin"];
    $timeq1 = "AND StartUTC >= '$startutcmin'";
  }
  
  if($_REQUEST["startutcmax"]){
    $startutcmax = $_REQUEST["startutcmax"];
    $timeq2 = "AND StartUTC <= '$startutcmax'";
  }
  
  if($_REQUEST["endutcmin"]){
    $endutcmin = $_REQUEST["endutcmin"];
    $timeq3 = "AND EndUTC >= '$endutcmin'";
  }
  
  if($_REQUEST["endutcmax"]){
    $endutcmax = $_REQUEST["endutcmax"];
    $timeq4 = "AND EndUTC <= '$endutcmax'";
  }
  
  if($_REQUEST["fq"]){
    $fqlimitq = "AND FQ > ($fq-$fqvar) AND FQ < ($fq+$fqvar)";
  }
  
  if($fqmaxb){
    $fqmaxbq = "AND FQ <=" . $fqmaxb;
  }
  
  if($fqminb){
    $fqminbq = "AND FQ >=" . $fqminb;
  }
  
  if($_REQUEST["fqmin"]){
    $fqminq = "AND FQ >=". $_REQUEST["fqmin"];
  }
  
  if($_REQUEST["fqmax"]){
    $fqmaxq = "AND FQ <=". $_REQUEST["fqmax"];
  }
  
  if($_REQUEST["sinceheard"]){
    $sinceheard = $_REQUEST["sinceheard"];
    $hq = "AND Date >= (DATE_SUB(CURDATE(),
			INTERVAL $sinceheard day))";
  }
  
  $fqq = "";
  
  if($fqlimitq){
    $fqq = "$fqq $fqlimitq";
  }
  
  if($fqminq){
    $fqq = "$fqq $fqminq";
  }
  
  if($fqmaxq){
    $fqq = "$fqq $fqmaxq";
  }
  
  else
    {
      $fqlimit = "AND FQ >= 0 AND FQ <= 1000000000000000";
    }
  
  if($added){
    $addedlimit = "AND Added > $added";
  }
  
  if(!$order){
    if(!$order && ($logformat == "clusive" || $logformat == "csv" || $logformat == "clusive2" ||  $logformat == "radiomaailma")){
      $order = "Category,FQ,Country,StationQTH,Date,ListenerHandle";
    }
    else
      {
	$order = "FQ";
      }
  }
  
  if($order){
    if($ascdesc == "DESC"){
      $nextascdesc = "ASC";
    }
    else if($ascdesc == "ASC"){
      $nextascdesc = "DESC";
    }
    else
      {
	$nextascdesc = "ASC";
      }
  }
  
  if($k_cat){
    $where = "AND FIND_IN_SET('$k_cat',Category)>0";
  }
  
  $Category = $_REQUEST["Category"];
  if($Category){
    $cwhere = "AND FIND_IN_SET('$Category',Category)>0";
  }
  
  if($k_min){
    $kwhere = "AND k >= $k_min";
  }
  
  if($k_max){
    $kwhere = "$kwhere AND k <= $k_max";
  }
  
  if($S_listener){
    $where = "AND ListenerHandle = '$S_listener'";
  }
  
  if($S_country){
    $where = "AND Country = '$S_country'";
  }
  
  //	if($days){
  //		if(preg_match("/-/", $days)){
  //			$dwhere = "AND Date = '$days'";
  //		}
  //		else
  //		{
  //			if(!$added){
  //			$dwhere = "AND (TO_DAYS(NOW())- TO_DAYS(Date)) 
  //					< $days";
  //			}
  //		}
  //	}
  
  if($uniq){
    $query = "SELECT * FROM $logtable WHERE UNIQUE_ID = '$uniq' AND 
			Status = 'Active'";
  }
  else
    {
      $query = "$query $fqq $addedlimit $where $dwhere $ignoreq1
					$ignoreq2 $includeq1 $cq1 $yq 
					$dmq1 $dmq2 $dq $cwhere $sq $odq $ndq $mdq
					$fqmaxbq $fqminbq $hq $nq $usergroupq
					$timeq1 $timeq2 $timeq3 $timeq4 $uq $pq
				$kwhere ORDER by $order $ascdesc";
    }
  
  //	print "$query<br>";
  $result = runsql($query);
  
  $color = "#aaaaff";
  
  if($logformat != "csv"){
    print "<table>\n";
  }
  else
    {
      print "<pre>";
    }
  
  $S_country = str_replace(" ", "%20", $S_country);
  
  if($logformat == "table"){
    
    $language = $_REQUEST["language"];
    
    $urlparams = 	"?cmd=view&language=$language".
      "&ascdesc=$nextascdesc&added=$added&fq=$fq".
      "&days=$days&S_country=$S_country".
      "&k_cat=$k_cat&k_max=$k_max".
      "&k_min=$k_min&logformat=$logformat".
      "&band=$band&S_listener=$S_listener";
    
    print "<tr bgcolor=$color>";
    
    print "<td valign=top>
			<a href=results.php".
      $urlparams . "&order=FQ>".
      $TEXT["frequency"].
      "</a></td>\n";
    
    print "<td valign=top>
			<a href=results.php".
      $urlparams . "&order=Date>".
      $TEXT["date"].
      "</a></td>\n";
    
    print "<td valign=top>
			<a href=results.php".
      $urlparams . "&order=StartUTC>".
      $TEXT["start_utc"].
      "</a></td>\n";
    
    print "<td valign=top>
			<a href=results.php".
      $urlparams . "&order=EndUTC>".
      $TEXT["end_utc"].
      "</a></td>\n";
    
    print "<td valign=top>
			<a href=results.php".
      $urlparams . "&order=Country>".
      $TEXT["country"].
      "</a></td>\n";
    
    print "<td valign=top>
			<a href=results.php".
      $urlparams . "&order=StationQTH>".
      $TEXT["station"].
      "</a></td>\n";
    
    print "<td valign=top>
			<a href=results.php".
      $urlparams . "&order=Comments>".
      $TEXT["comments"].
      "</a></td>\n";
    
    print "<td valign=top>
			<a href=results.php".
      $urlparams . "&order=ListenerHandle>".
      $TEXT["listener"].
      "</a></td>\n";
    
    print 	"<td valign=top>". 
      $TEXT["edit"].
      "</td>\n";
    
    print "</tr>\n";
  }
  
  while($row = mysql_fetch_array($result)){
    
    $fq = $row["FQ"];
    
    if(!$fq){
      $fq = "&nbsp;";
    }
    
    if($fq > 35000){
      $fq = $fq/1000;
      $fq = sprintf("%3.3f", $fq);
    }
    
    
    $date = $row["Date"];
    
    if(!$date){
      $date = "&nbsp;";
    }
    
    $curcategory = $row["Category"];
    
    $startutc = $row["StartUTC"];
    
    $endutc = $row["EndUTC"];
    
    $startutc = str_replace(".", "", $startutc);
    $endutc = str_replace(".", "", $endutc);
    
    $startutc = str_replace(";", "", $startutc);
    $endutc = str_replace(";", "", $endutc);
    
    
    $startutc = str_replace(":", "", $startutc);
    $endutc = str_replace(":", "", $endutc);
    
    if(strlen($startutc) == 3){
      $startutc = "0$startutc";
    }
    
    if(strlen($endutc) == 3){
      $endutc = "0$endutc";
    }
    
    $StartUTCStar = $row["StartUTCStar"];
    $EndUTCStar = $row["EndUTCStar"];
    $pluscolumn = "";
    $tentcolumn = "";
    
    $Plus = $row["Plus"];
    $underline = $row["Underline"];
    
    $Tentative = $row["Tentative"];
    
    $country = $row["Country"];
    
    if(!$country){
      $country = "UNID";
    }
    
    $country = ucfirst($country);
    
    $station = $row["StationQTH"];
    
    if(!$station){
      $station = "UNID";
    }
    
    $comments = $row["Comments"];
    
    $comments = str_replace("\\\"", "\"", $comments);
    $StationQTH = str_replace("\\\"", "\"", $StationQTH);
    $comments = str_replace("\\'", "'", $comments);
    $StationQTH = str_replace("\\'", "'", $StationQTH);
    $comments = str_replace("\\\\", "", $comments);
    $StationQTH = str_replace("\\\\", "", $StationQTH);
    
    $listener = $row["Listener"];
    if($row["ListenerHandle"]){
      $listenerhandle = $row["ListenerHandle"];
    }
    else
      {
	$listenerhandle = $listener;
      }
    
    $listenerhandle = str_replace("\\\"", "\"", $listenerhandle);
    $listenerhandle = str_replace("\\'", "'", $listenerhandle);
    $listenerhandle = str_replace("\\\\", "", $listenerhandle);
    
    if(!$listener){
      $listener = "&nbsp;";
    }
    
    if(!$listenerhandle){
      $listenerhandle = "&nbsp;";
    }
    
    $line++;
    
    if($line % 2 == 0){
      $color = "#dddddd"; 
    }
    else
      {
	$color = "#bbbbbb";
      }
    
    if($USERPREFS["admincategories"] == "all"){ 
      $admin = 1;
    }
    
    if(($listener == $remuser) || $admin){
      $k = $row["k"];
      $editb = "<a href=results.php?k=$k&cmd=add&language=" . 
	$_REQUEST["language"] . ">" . $TEXT["edit"] . "</a>";
    }
    else
      {
	$editb = "";
      }
    
    if(!$startutc){
      $startutc = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    }
    
    if(!$endutc){
      $endutc = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    }
    
    if($k_cat == 10 || $band == "FM"){
      if($fq > 300.0){
	$fq = $fq / 1000;
      }
    }
    
    if(preg_match("/^Category/i", $order) && 
       ($curcategory != $lastCategory)){
      $e = "\$cat = \$TEXT[\"category$curcategory\"];";
      eval($e);
      
      if($logformat != "csv"){
	print "</table><table><tr></tr><tr><td><b>$cat</b><p></td></tr>
		</table><table width=100%>";
      }
      $lastCategory = $curcategory;
    }
    
    list($year, $month, $day) = split ("-", $date);
    
    $longyear=$year;
    
    if($USERPREFS["shortyear"] == "yes"){
      $year = str_replace("20", "", $year);
      $year = str_replace("19", "", $year);
    }
    
    $curyearshort = str_replace("19", "", $curyear);
    $curyearshort = str_replace("20", "", $curyearshort);
    
    $day = ltrim($day, "0");
    $month = ltrim($month, "0");
    
    
    if($USERPREFS["dateformat"] == "European"){
      if($day){
	$day = "$day.";
      }
      if($month){
	$month = "$month.";
      }
      if($USERPREFS["printyear"] == "Y"){
	$date = "$day$month$year";
      }
      else
	{
	  if($year == $curyear || $year == $curyearshort){
	    $date = "$day$month";
	  }
	  else
	    {
	      $date = "$day$month$year";
	    }
	}
    }
    
    $fulldate = "$day$month$longyear";
    
    // print $USERPREFS["dateformat"];
    
    if($USERPREFS["dateformat"] == "Universal"){
      switch($month){
      case "1":
	$date = "Jan $day";
	break;
      case "2":
	$date = "Feb $day";
	break;
      case "3":
	$date = "Mar $day";
	break;
      case "4":
	$date = "Apr $day";
	break;
      case "5":
	$date = "May $day";
	break;
      case "6":
	$date = "Jun $day";
	break;
      case "7":
	$date = "Jul $day";
	break;
      case "8":
	$date = "Aug $day";
	break;
      case "9":
	$date = "Sep $day";
	break;
      case "10":
	$date = "Oct $day";
	break;
      case "11":
	$date = "Nov $day";
	break;
      case "12":
	$date = "Dec $day";
	break;
      }
      
      if($USERPREFS["printyear"] == "Y"){
	$date = "$date, $year";
      }
      else
	{
	  if($year == $curyear || $year == $curyearshort){
	    $date = $date;
	  }
	  else
	    {
	      $date = "$date, $year";
	    }
	}
    }
    
    if($USERPREFS["dateformat"] == "American"){
      if(!$month){
	$month = "X";
      }
      
      if(!$day){
	$day = "X";
      }
      
      if(!$year){
	$year = "X";
      }
      
      if($USERPREFS["printyear"] == "Y"){
	$date = "$month/$day/$year";
      }
      else
	{
	  if($year == $curyear || $year == $curyearshort){
	    $date = "$month/$day";
	  }
	  else
	    {
	      $date = "$month/$day/$year";
	    }
	}
    }
    
    
    $startutc = str_replace("-", "", $startutc);
    $endutc = str_replace("-", "", $endutc);
    
    $country = str_replace(":", "", $country);
    if($country == "?"){
      $country = "UNID";
    }
    
    
    if((preg_match("/\*/", $startutc)) || $StartUTCStar){
      if($logformat != "csv"){
	$startutc = str_replace('*', "", $startutc);
	$startutc = "<u>$startutc</u>";
      }
      else
	{
	  $startutc = "*$startutc";
	}
    }
    
    if((preg_match("/\*/", $endutc))|| $EndUTCStar){
      if($logformat != "csv"){
	$endutc = str_replace('*', "", $endutc);
	$endutc = "<u>$endutc</u>";
      }
      else
	{
	  $endutc = "$endutc*";
	}
    }
    
    if($comments){
      $comments = trim($comments);
      if($comments){
	if(!preg_match("/(\.|\?|\!)$/", $comments)){
	  $comments = $comments . ".";
	}
      }
    }
    
    if($underline){
      $station = "<u><b>$station</b></u>";
    }
    
    if(preg_match("/^\+/", $station) || $Plus){
      
      if($logformat != "csv"){
	$station = "<u><b>$station</b></u>";
      }
      $station = str_replace("+", "", $station);  
      
      $pluscolumn = "+";
      
    }
    
    
    if($Tentative){
      if($logformat != "csv"){
	$station = "<em>Tentative: $station</em>";
      }
      else
	{
	  $tentcolumn = "t";
	}
    }
    
    
    if($station){
      $station = rtrim($station);
      $station = rtrim($station, '.');
      if($station){
	if(!preg_match("/\?$/", $station)){
	  $station = "$station. ";
	}
      }
    }
    
    if($country){
      $country = rtrim($country);
      $country = rtrim($country, '.');
      $country = "$country";
    }
    
    $comments = str_replace("$listenerhandle.", "", $comments);
    
    $listener = $listener . " ";
    $listenerhandle = $listenerhandle . " ";
    
    if($logformat == "clusive"){
      print "<tr width=100% align=left>\n
		<td valign=top width=7%>$fq</td>\n
		<td valign=top width=10%>$date</td>\n
		<td valign=top width=10%>$startutc-$endutc</td>\n
 	        <td valign=top align=right width=1%>$pluscolumn</td>\n	
		<td valign=top width=73%>$country: $station $comments $listenerhandle $editb</td>\n
		</tr>\n";
    }
    
    if($logformat == "csv"){
      
      
      //	$comments = preg_replace("/\"/", "\\\"", $comments);
      $endutc = preg_replace("/&nbsp;/", "", $endutc);
      $startutc = preg_replace("/&nbsp;/", "", $startutc);
      
      if($endutc == "&nbsp;"){
	$endutc = "";
      }
      
      if($startutc == "&nbsp;"){
	$startutc = "";
      }
      
      //	print "<tr width=100% align=left><td>\"$curcategory\"; \"$fq\"; \"$fulldate\"; \"$startutc\"; \"$endutc\"; \"$pluscolumn\"; \"$tentcolumn\"; \"$country\"; \"$station\"; \"$comments\"; \"$listenerhandle\"</td></tr>";
      
      //	print "<tr width=100% align=left><td>\"$curcategory\", \"$fq\", \"$fulldate\", \"$startutc\", \"$endutc\", \"$pluscolumn\", \"$tentcolumn\", \"$country\", \"$station\", \"$comments\", \"$listenerhandle\"</td></tr>";
      
      $comments = preg_replace("/\"/", "\"\"", $comments);
      #	$comments = preg_replace("/<br>/", "\"\"", $comments);
      $station = preg_replace("/\"/", "\"\"", $station);
      $country = preg_replace("/\"/", "\"\"", $country);
      
      
      $comments = preg_replace("/\n/", "", $comments);
      $comments = preg_replace("/\t/", "", $comments);
      $comments = preg_replace("/\r/", "", $comments);
      
      if(preg_match("/,/", $comments) || preg_match("/\"/", $comments)){
	$comments = "\"$comments\"";
      }
      
      if(preg_match("/,/", $station) || preg_match("/\"/", $station)){
	$station = "\"$station\"";
      }
      
      if(preg_match("/,/", $country) || preg_match("/\"/", $country)){
	$country = "\"$country\"";
      }
      
      
      print "$curcategory,$fq,$fulldate,$startutc,$endutc,$pluscolumn,$tentcolumn,$country,$station,$comments,$listenerhandle\n";
      //	print "$curcategory; $fq; $fulldate; $startutc; $endutc; $pluscolumn; $tentcolumn; $country; $station; $comments; $listenerhandle<br>\n";
    }
    
    if($logformat == "clusive2"){
      print "<tr width=100% align=left>\n
		<td valign=top width=7%>$fq</td>\n
		<td valign=top width=10%>$date</td>\n
		<td valign=top width=10%>$startutc-$endutc</td>\n
 	        <td valign=top align=right width=1%>$pluscolumn</td>\n	
		<td valign=top width=73%>$country: $station $comments $listenerhandle $editb</td>\n
		</tr>";
    }
    
    if($logformat == "radiomaailma"){
      print "<tr width=100% align=left>\n
		<td valign=top width=7%>$fq</td>\n
		<td valign=top width=10%>$startutc-$endutc</td>\n
 	        <td valign=top align=right width=1%>$pluscolumn</td>\n	
		<td valign=top width=83%>$country: $station $comments $date $listenerhandle $editb</td>\n
		</tr>\n";
    }
    
    if($logformat == "table"){
      
      print "<tr bgcolor=$color>\n
	<td valign=top>$fq</td>\n
	<td valign=top>$date</td>\n";
      print "<td valign=top>\n";
      print "$startutc</td>\n";
      print "<td valign=top>$endutc</td>\n";
      print "</td>\n
	<td valign=top>$country</td>\n
	<td valign=top>$station</td>\n";
      print "<td valign=top>$comments</td>\n
	<td valign=top>$listenerhandle</td>\n
	<td valign=top>$editb</td>\n
	</tr>\n";
    }
  }
  
  if($logformat != "csv"){
    print "</table>\n";
  }
  else
    {
      print "</pre>";
    }
}

function submitlog($FQ, $Date, $StartUTC, $EndUTC, $Country, $StationQTH, $Comments, $Listener, $ListenerHandle, $c_input, $k, $uniq, $k, $logtable, $Plus, $underline, $Tentative, $StartUTCStar, $EndUTCStar)
{
  
  include("globals.php");
  
  $FQ = str_replace(",", ".", $FQ);
  
  $Comments = str_replace("\\\"", "\"", $Comments);
  $StationQTH = str_replace("\\\"", "\"", $StationQTH);
  $Comments = str_replace("\\'", "'", $Comments);
  $StationQTH = str_replace("\\'", "'", $StationQTH);
  
  $ListenerHandle = str_replace("\\\"", "\"", $ListenerHandle);
  $ListenerHandle = str_replace("\\'", "'", $ListenerHandle);
  
  $Comments = addslashes($Comments);
  $StartUTC = addslashes($StartUTC);
  $EndUTC = addslashes($EndUTC);
  $Country = addslashes($Country);
  $StationQTH = addslashes($StationQTH);
  $ListenerHandle = addslashes($ListenerHandle);
  $Listener = addslashes($Listener);
  $usergroup = $USERPREFS["usergroup"];
  
  $t = time();
  if(!$k)	$uniq = uniqid("hard-core-dx.com.", "1");
  

  // Need to do some frequency autoscaling.

  if($FQ < 45.1){
    $FQ = $FQ * 1000;
  }
  
  if($c_input == 10){
    if($FQ < 300.0){
      $FQ = $FQ * 1000;
    }
  }

  //

  $EndUTC = str_replace(".", "", $EndUTC);
  $StartUTC = str_replace(".", "", $StartUTC);
  
  if(strtotime($Date)> time()){
    print $TEXT["futurelog"];
    exit();
  }

  if($k){
    $sqlquery = "UPDATE $logtable SET FQ = '$FQ', Date = '$Date', StartUTC =  '$StartUTC', EndUTC = '$EndUTC', 
		Country = '$Country', StationQTH = '$StationQTH', 
		Comments = '$Comments', ListenerHandle = '$ListenerHandle',
		Listener = '$Listener', Plus = '$Plus', Underline = '$underline',
		Tentative = '$Tentative', StartUTCStar = '$StartUTCStar',
		EndUTCStar = '$EndUTCStar', usergroup = '$usergroup', 
		Modified = $t, Category = '$c_input' WHERE k = $k";
  }
  else
    {
      $sqlquery = "INSERT INTO $logtable (FQ, Date, StartUTC, EndUTC, 
		Country, StationQTH, 
		Comments, ListenerHandle, Listener, Added, UNIQUE_ID, 
		Category, Plus, Underline, Tentative, 
		StartUTCStar, EndUTCStar, usergroup) 
		VALUES 
	('$FQ', '$Date', '$StartUTC', '$EndUTC', '$Country', 
		'$StationQTH', '$Comments', '$ListenerHandle', '$Listener', $t, '$uniq', '$c_input', '$Plus', '$underline', '$Tentative', '$StartUTCStar', 
		'$EndUTCStar', '$usergroup')";
    }
  
  $lastcategoryq = "update users SET lastcategoryadded = 
		'$c_input' where login = '$userlogin'";
  $lasthandleq = "update users SET lasthandleadded = 
		'$ListenerHandle' where login = '$userlogin'";
  $result = runsql($sqlquery);
  $lastcategoryqresult = runsql($lastcategoryq);
  $lasthandleqresults = runsql($lasthandleq);
  
  if($k) {
    print $TEXT["modified"];
    print "<br>\n";
  }
  else
    {
      print $TEXT["added"];
      print "<br>\n";
    }
  
  $_REQUEST["uniq"] = $uniq;
  
  if($email){
    if($k){
      $mailsubject = "Online Log ($version, $maturity): Change";
    }
    else
      {
	$mailsubject = "Online Log ($version, $maturity): Add";
      }
    mail($email, $mailsubject, 
	 "$FQ $Date $StartUTC $EndUTC\t$Country: $StationQTH. $Comments. $ListenerHandle ($Listener)\n\n 
			k: $k, Category: $c_input, t: $t",
	 "From: $sender\r\n".
	 "X-Mailer: HCDX Online Log v$version");
  }
  
  viewlog ($server, $username, $password, $database, $logtable, $_REQUEST);
  
}

function deletelog($k, $User, $logtable){
  
  include("globals.php");
  
  $query = "SELECT * FROM $logtable WHERE k = $k";
  $result = runsql($query);
  
  if(!mysql_num_rows($result)){
    print "What are you trying to do? The attemt is logged.";
    exit();
  }
  
  $data = mysql_fetch_array($result);
  $listenerhandle = $data["ListenerHandle"];
  $listener = $data["Listener"];
  
  if($USERPREFS["admincategories"] == "all"){ 
    $admin = 1;
  }
  
  //	print $User . " " . $listener;
  
  if(!(($User == $listener) || $admin)) {
    print $TEXT["notyourlogging"];
    exit();
  }
  
  if($k){
    $query = "UPDATE $logtable SET Status = 'Deleted' WHERE k = $k limit 1";
    $result = runsql($query);
    if($result){
      if($email){
	$mailsubject = "Online Log ($version, $maturity): Delete";
	mail($email, $mailsubject, "$k deleted",
	     "From: $sender\r\n".
	     "X-Mailer: HCDX Online Log v$version");
      }
      print $TEXT["deleted"];
    }
    else
      {
	print $TEXT["wrong"];
      }
  }
  else
    {
      print $TEXT["wrong"];
    }
}

function userprofile($_REQUEST, $save){
  include("globals.php");
  
  $sql = "select * from users where login = '$userlogin'";
  
  if($save){
    print "Updating your record\n";
    $addsql = "update users SET logformat = ".
      "'". $_REQUEST["logformat"] ."',".
      "shortyear =".
      "'". $_REQUEST["shortyear"] ."',".
      "dateformat =".
      "'". $_REQUEST["dateformat"] ."'".
      "where login = '$userlogin'";
    $results = runsql($addsql);
    $results = runsql($sql);
  }
  else
    {
      $results = runsql($sql);
      
      if(!mysql_num_rows($results)){
	$addsql = "insert into users (login, logformat, shortyear, 
			dateformat) VALUES (" . "'". $userlogin ."'," .
	  "'". $USERPREFS["logformat"] ."'," .
	  "'". $USERPREFS["shortyear"] ."'," .
	  "'". $USERPREFS["dateformat"] ."'"
	  .")";
	$results = runsql($addsql);
	$results = runsql($sql);
      }
    }
  
  /// Why don't this work????
  
  print "<form method=post
		 action=results.php?cmd=user&save=1>";
  
  while($line = mysql_fetch_array($results)){
    print $TEXT["login"].": ". $line["login"];
    print "<br>";
    
    print $TEXT["language"]. ": ";
    askinput("language", $line["language"], $VALIDLANGS);
    print "<br>";
    
    print $TEXT["logformat"] . ": ";
    askinput("logformat", $line["logformat"], $VALIDLOGFORMATS);
    print "<br>";
    
    print $TEXT["shortyear"] . ": ";
    askinput("shortyear", $line["shortyear"], $VALIDSHORTYEARS);
    print "<br>";
    
    print "<input type=hidden name=save value=1>";
    print "<input type=submit value=\"" . 
      "Save preferences" .
      "\"></input>\n";
    print "</form>";
    
  }
}

function askinput ($parameter, $current, $valids){
  $i = 0;
  print "<select name=$parameter>";
  while($valids["$i"]){
    $selected = "";
    if($current == $valids["$i"]){
      $selected = "Selected";
    }
    print "<option value=".
      $valids["$i"]." $selected>".$valids["$i"];
    $i++;
  }
  print "</select><br>";
}


function addlog ($server, $username, $password, $database, $logtable, $k, $User, $ListenerHandle){
  include("globals.php");
  include("config.db.php");
  if($k)
    {
      $query = "SELECT * FROM $logtable WHERE k = $k";
      $result = runsql($query);
      
      $data = mysql_fetch_array($result);
      
      $fq = $data["FQ"];
      
      $usergroup = $USERPREFS["usergroup"];
      $date = $data["Date"];
      
      list ($logyear, $logmonth, $logdate) = split ('[/.-]', $date, 3);
      
      $startutc = $data["StartUTC"];
      $endutc = $data["EndUTC"];
      $uniq = $data["UNIQUE_ID"];
      $country = $data["Country"];
      $underline = $data["Underline"];
      $Plus = $data["Plus"];
      $StartUTCStar = $data["StartUTCStar"];
      $EndUTCStar = $data["EndUTCStar"];
      $Tentative = $data["Tentative"];
      $logcategory = $data["Category"];
      $station = $data["StationQTH"];
      $comments = $data["Comments"];
      $k = $data["k"];
      $listenerhandle = $data["ListenerHandle"];
      $listener = $data["Listener"];
      
      if($USERPREFS["admincategories"] == "all"){ 
	$admin = 1;
      }
      
      if(!(($User == $listener) || $admin)) {
	print $TEXT["notyourlogging"];
	exit();
      }
      
      if($k){
	$comments = htmlspecialchars($comments);
	$startutc = htmlspecialchars($startutc);
	$endutc = htmlspecialchars($endutc);
	$country = htmlspecialchars($country);
	$station = htmlspecialchars($station);
	$listener = htmlspecialchars($listener);
	$listenerhandle = htmlspecialchars($listenerhandle);
      }
    }
  
  $language = $_REQUEST["language"];
  
  print "<a href=addloghelp.html>". $TEXT["addloghelp"] . "</a><p>";
  
  print "<form method=post action=results.php?submit=1&language=$language>\n";
  
  if($USERPREFS["admincategories"] == "all"){ 
    $admin = 1;
  }
  
  if(!$admin){
    print "<input type=hidden name=Listener value='$remuser'>\n";
  }
  else
    {
      print "<input type=hidden name=Listener value='$listener'>\n";
    }
  
  print "<input type=hidden name=k value=$k>\n";
  print "<input type=hidden name=uniq value=$uniq>\n";
  print "<input type=hidden name=language value=$language>\n";
  
  print "<b>\n";
  print $TEXT["select_category"] . ":</b> <select name=c_input size=1>\n";
  
  $query = "SELECT * from Categories";
  
  $results = runsql($query);
  
  print "<option value=0>" . $TEXT["select_category"];
  
  $o = 0;
  
  while($data = mysql_fetch_array($results)){
    $selected = "";
    
    $k_c = $data["k"];
    
    $qc_pulldown = "select * from ITU where FIND_IN_SET($k_c, 
			category)>0 ORDER by ". $_REQUEST["language"] .
      ",english" ;
    $c_pulldown = runsql($qc_pulldown);
    while($cpd_data = mysql_fetch_array($c_pulldown)){
      $o++;
      $countries["$o"] = $cpd_data["$cat"] . 
	"/" . 
	$cpd_data["english"]. "/" . $cpd_data[Code];
      //		print $countries["$o"];
      if($cpd_data["$language"]){
	$countries["$o"] = $cpd_data["$cat"] .
	  "/" .
	  $cpd_data["$language"]. "/" . $cpd_data[Code];
      }
    }
    
    $e = "\$cat = \$TEXT[\"category$k_c\"];";
    eval($e);
    if($k_c == $logcategory){
      $selected = "Selected";
    }
    
    if((!$k) && ($k_c == $USERPREFS["lastcategoryadded"])){
      $selected = "Selected";
    }
    
    if(($USERPREFS["usergroup"] == 'Finland') || ($k_c != 2 && $k_c != 3)){
      print "<option value=$k_c $selected>$cat";	
    }
  }
  
  print "</select>\n";
  print "<p>\n";
  
  if($underline){
    $CHECKEDUL = "CHECKED";
  }
  
  if($Plus){
    $CHECKED = "CHECKED";
    $Plusv = 1;
  }
  
  if($StartUTCStar){
    $CHECKEDU1 = "CHECKED";
  }
  
  if($EndUTCStar){
    $CHECKEDU2 = "CHECKED";
  }
  
  
  if($Tentative){
    $CHECKEDT = "CHECKED";
    $Tentativev = 1;
  }
  
  print "<table border=0>";
  print "<tr><td>";
  print "<b>". $TEXT["frequency"] . "</b>\n";
  print "</td><td>";
  print "<input size=10 type=text ";
  if($fq){
    print "value=\"$fq\""; 
  }
  print " name=FQ ></input>\n";
  print "</td></tr>";
  
  print "<tr><td>";
  print "<b>". $TEXT["country"] . "</b>\n";
  print "</td><td>";
  if($GLOBALPREFS["country_pulldown"] || $USERPREFS["countrypulldown"]){ 	
    $oo = 0;
    print "<select name=Country>\n";
    
    while($oo <= $o){ 
      $cntry = $countries["$oo"];
      print "<option value=" . $cntry . ">". $cntry ;
      $oo++;
    }
    
    print "</select>";
  }
  else
    {
      print "<input size=50 type=text ";
      
      if($country){
        print "value=\"$country\"";
      }
      print " name=Country ></input>\n";
    }
  print "</td></tr>";
  
  print "<tr><td>";
  print "<b>" . $TEXT["plus"] . "</b>";
  print "</td>";
  print "<td valign=top><input type=checkbox name=Plus value=\"1\" $CHECKED>";
  print "</td></tr>";
  
  print "<tr><td>";
  print "<b>" . $TEXT["underline"] . "</b>";
  print "</td>";
  print "<td valign=top><input type=checkbox name=underline value=\"1\" $CHECKEDUL>";
  print "</td></tr>";
  
  print "<tr><td>";
  print "<b>" . $TEXT["tentative"] . "</b>";
  print "</td>";
  print "<td valign=top><input type=checkbox name=Tentative value=\"1\" $CHECKEDT>";
  print "</td></tr>";
  print "<tr><td>";
  print "<b>". $TEXT["station"] . "</b>\n";
  print "</td>";
  print "<td valign=top><input size=50 type=text ";
  
  if($station){
    print "value=\"$station\""; 
  }
  
  print " name=StationQTH </input><br>\n ";
  print "</td></tr>";
  print "</table>";
  
  if(!$k){
    $month = gmdate("F");
    $mday = gmdate("d");
    $year = gmdate("Y");
  }
  
  $curyear = gmdate("Y");
  
  print "<table><tr>
		<td valign=top><b>" . $TEXT["month"] . "</b></td>
		<td valign=top><b>" . $TEXT["date"] . "</b></td>
		<td valign=top><b>" . $TEXT["year"] . "</b></td></tr>";
  print "<tr><td valign=top>";
  print "<select name=HCDX_Month size=1>";
  
  $selected = "";
  if($month == "January"){
    if(!$k){
      $selected = "Selected";
    }
  }
  
  if($logmonth == "01") $selected = "Selected";
  
  $month_X = $TEXT["Month1"];
  
  print "<option value=01 $selected>$month_X";
  
  $selected = "";
  if($month == "February"){
    if(!$k){
      $selected = "Selected";
    }
  }
  
  if($logmonth == "02") $selected = "Selected";
  
  $month_X = $TEXT["Month2"];
  
  print "<option value=02 $selected>$month_X";
  
  $selected = "";
  if($month == "March"){
    if(!$k){
      $selected = "Selected";
    }
  }
  
  if($logmonth == "03") $selected = "Selected";
  
  $month_X = $TEXT["Month3"];
  
  print "<option value=03 $selected>$month_X";
  
  $selected = "";
  if($month == "April"){
    if(!$k){
      $selected = "Selected";
    }
  }
  
  
  if($logmonth == "04") $selected = "Selected";
  
  $month_X = $TEXT["Month4"];
  
  print "<option value=04 $selected>$month_X";
  
  $selected = "";
  if($month == "May"){
    if(!$k){
      $selected = "Selected";
    }
  }
  
  if($logmonth == "05") $selected = "Selected";
  
  $month_X = $TEXT["Month5"];
  
  print "<option value=05 $selected>$month_X";
  
  $selected = "";
  if($month == "June"){
    if(!$k){
      $selected = "Selected";
    }
  }
  
  if($logmonth == "06") $selected = "Selected";
  
  $month_X = $TEXT["Month6"];
  
  print "<option value=06 $selected>$month_X";
  
  $selected = "";
  if($month == "July"){
    if(!$k){
      $selected = "Selected";
    }
  }
  
  if($logmonth == "07") $selected = "Selected";
  
  $month_X = $TEXT["Month7"];
  
  print "<option value=07 $selected>$month_X";
  
  $selected = "";
  if($month == "August"){
    if(!$k){
      $selected = "Selected";
    }
  }
  
  if($logmonth == "08") $selected = "Selected";
  
  $month_X = $TEXT["Month8"];
  
  print "<option value=08 $selected>$month_X";
  
  $selected = "";
  if($month == "September"){
    if(!$k){
      $selected = "Selected";
    }
  }
  
  if($logmonth == "09") $selected = "Selected";
  
  $month_X = $TEXT["Month9"];
  
  print "<option value=09 $selected>$month_X";
  
  $selected = "";
  if($month == "October"){
    if(!$k){
      $selected = "Selected";
    }
  }
  
  if($logmonth == "10") $selected = "Selected";
  
  $month_X = $TEXT["Month10"];
  
  print "<option value=10 $selected>$month_X";
  
  $selected = "";
  if($month == "November"){
    if(!$k){
      $selected = "Selected";
    }
  }
  
  if($logmonth == "11") $selected = "Selected";
  
  $month_X = $TEXT["Month11"];
  
  print "<option value=11 $selected>$month_X";
  
  $selected = "";
  if($month == "December"){
    if(!$k){
      $selected = "Selected";
    }
  }
  
  if($logmonth == "12") $selected = "Selected";
  
  $month_X = $TEXT["Month12"];
  
  print "<option value=12 $selected>$month_X";
  
  print "</select>";
  
  print "</td><td valign=top>";
  
  print "<select name=HCDX_Date size=1>";
  
  $x_date = 1;
  while($x_date <= 31){
    $selected = "";
    if(($mday == $x_date) || ($logdate == $x_date)){
      $selected = "Selected";
    } 
    print "<option $selected>$x_date";
    $x_date=$x_date+1;
  }
  
  print "</select>";
  
  print "</td><td valign=top>";
  
  print "<select Name=HCDX_Year size=1>";
  
  $start_y = 1945;
  $x_date = $start_y;
  
  while($x_date <= $curyear){
    $selected = "";
    if(($year == $x_date)||($logyear == $x_date)){
      $selected = "Selected";
    }
    
    print "<option $selected>$x_date";
    $x_date=$x_date+1;
  }
  
  print "</select></td></tr></table>\n";
  
  print "<table>";
  print "<tr><td>*</td><td valign=top><b>" . 
    $TEXT["start_utc"] . "</b></td><td>&nbsp;</td><td>".
    "<b>". $TEXT["end_utc"]."</b>".
    "</td><td>*</td></tr>\n";
  print "<tr>\n";
  print "<td valign=top>".
    "<input type=checkbox name=StartUTCStar value=\"1\" $CHECKEDU1></td>" .
    "<td><input type=text ";
  
  if($startutc){
    print "value=\"$startutc\"";
  }
  
  print "name=StartUTC></input></td><td>-</td>";
  
  print "<td><input type=text ";
  
  if($endutc){
    print "value=\"$endutc\"";
  }
  
  print "name=EndUTC></input></td>".
    "<td><input type=checkbox name=EndUTCStar value=\"1\" $CHECKEDU2>" .
    "</td>\n";
  print "</tr>\n";
  print "</table>\n";
  
  print "<table>\n";
  print "<tr>\n";
  print "<td valign=top><b>" . $TEXT["comments"] . "</b></td>\n";
  print "</tr>\n";
  print "<tr>\n";
  print "<td valign=top><textarea ";
  print "cols=120 rows=4 wrap=on name=Comments>\n";
  
  if($comments){
    print "$comments";
  }
  
  print "</textarea></td>\n";
  
  print "</tr>\n";
  
  print "<td valign=top><b>". $TEXT["listener"]. "</b>: <input type=text ";
  if($listenerhandle){
    print "value=\"$listenerhandle\"";
  }
  else
    {
      
      if($USERPREFS["lasthandleadded"]){
	print "value=\"". $USERPREFS["lasthandleadded"] . "\"";
      }
      else
	{ 
	  print "value=\"$remuser\"";
	}
    }
  
  print "name=ListenerHandle></input>";
  
  print "</table>\n";
  
  print "<input type=submit name=submit value=\"" . $TEXT["submit"] . "\"></input>\n";
  
  $language = $_REQUEST["language"];
  
  print "<input type=hidden name=language value=$language>\n";
  
  if($k) {
    print "<input type=\"submit\" name=\"delete\" value=\"" . $TEXT["delete"] . "\"></input>\n";
  }
  print "</form>\n";
}

?>
