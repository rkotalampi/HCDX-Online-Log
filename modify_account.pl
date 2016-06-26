#!/usr/bin/perl

use DBI;

$mode = $ARGV[1];
$user = $ARGV[0];

print STDOUT "$user\n";

my $dsn = 'DBI:mysql:HCDX:server';
my $db_user_name = 'username';
my $db_password = 'password';
my ($id, $password);
my $dbh = DBI->connect($dsn, $db_user_name, $db_password);

if($mode eq 'Finland'){
$sql1 = "update users SET usergroup = 'Finland', logformat = 'clusive', 
    language = 'finnish', dateformat = 'European' where login = \'$user\'"; 
}

if($mode eq 'hcdx'){
$sql1 = "update users SET usergroup = 'hcdx', logformat = 'clusive', 
    language = 'english', dateformat = 'Universal' where login = \'$user\'"; 
}

print STDOUT "$sql1\n";
my $sth = $dbh->prepare($sql1);
$sth->execute();

print STDOUT "$user converted\n";    
