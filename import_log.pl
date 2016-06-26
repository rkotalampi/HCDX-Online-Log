#!/usr/bin/perl

# DO NOT USE YET

my $sendmail = "/usr/sbin/sendmail -t -f risto\@kotalampi.com";

use Getopt::Long;
GetOptions("email=s", "delim=s", "listener=s", "backdate=i", "clean") or die "Try again\n";

$delim = $opt_delim;
$listener = $opt_listener;
$listenerhandle_org = $listener;

if($opt_clean){
    print STDOUT "delete from log where Listener = '$opt_listener';\n";
}

while($line = <STDIN>){
    $lines++;
    chomp($line);
    print STDERR "$line\n";
    $line =~ s/\'/\\\'/g;

    $OK = 1;

    $errors = "";
    $d = "";
    $m = "";
    $y = "";
    $category = "";
    $fq = "";
    $date = "";
    $startutc = "";
    $endutc = "";
    $plus = "";
    $tent = "";
    $country = ""; 
    $stationqth = "";
    $comments = "";
    $l1 = "";
    $l2 = "";

    ($category, $fq, $date, $startutc, $endutc, $plus, $tent, 
     $country, $stationqth, $comments, $l1) 
	= split($delim, $line);

    if(!$l1){
	$listenerhandle = $listenerhandle_org;
    }
    else
    {
	$listenerhandle = $l1;
    }


    $comments =~ s/\223/\"/g;
    $comments =~ s/\224/\"/g;
    $listenerhandle =~ s/\n//g;
    $listenerhandle =~ s/\r//g;
    $listenerhandle =~ s/\.//g;
    $listenerhandle =~ s/\x0d//g;

    $comments =~ s/\"\"\"/\"/g;
    $comments =~ s/\"\"\.\"/\"/g;
    $comments =~ s/\"\"/\"/g;
    $startutc =~ s/\ $//g;
    $endutc =~ s/\ $//g;

    if($date){
	($d, $m, $y) = split('\.', $date);
	
	if(($d <1 || $d > 31) 
	   || ($m < 1 || $m > 12) 
	   || ($y < 1945 || $y > 2100)){
	    $errors = "Line $lines. $stationqth: invalid date: $date\n";
	}
    }
    else
    {
	$errors = "Line $lines. $stationqth: missing date\n";
    }

    if(length($d) == 1){
	$d = "0$d";
    }

    if(length($m) == 1){
	$m = "0$m";
    }

    $date = "$y-$m-$d";

    $t = time();

    if($opt_backdate){
	$t = $t - $opt_backdate;
    }

    if(!$errors){
	$x++;

	$sql = "INSERT INTO log (Category, FQ, Date, StartUTC, EndUTC, Plus, Tentative, Country, StationQTH, Comments, Listener, ListenerHandle, Added, Modified, Status, usergroup) VALUES ('$category', '$fq', '$date', '$startutc', '$endutc', '$plus', '$tent', '$country', '$stationqth', '$comments', '$listener', '$listenerhandle', $t, $t, 'Active', 'Finland');";
	$sqlall = "$sqlall$sql\n";
    }
    if($errors){
	$errorsall = "$errorsall$errors";
    }
}

if($OK){
    print STDOUT "$sqlall\n";
}

    if($opt_email){
        open(SENDMAIL, "|$sendmail") or die "Cannot open $sendmail: $!";
        print SENDMAIL "Return-Path: risto\@kotalampi.com\n";
        print SENDMAIL "Reply-To: risto\@kotalampi.com\n";
        print SENDMAIL "Cc: risto\@kotalampi.com\n";
        print SENDMAIL "Subject: Online Log Mass Import Report\n";
        print SENDMAIL "From: Risto Kotalampi <risto\@kotalampi.com>\n";
        print SENDMAIL "To: $opt_email\n";
        print SENDMAIL "Content-type: text/plain\n\n";
	print SENDMAIL "Successfully imported $x of $lines logs of $listener\n";
	print SENDMAIL "Following errors were found and logs were not imported:\n";
	print SENDMAIL "$errorsall";
	close(SENDMAIL);
    }

