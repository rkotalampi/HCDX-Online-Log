
delete from users where (UNIX_TIMESTAMP()-Added)/60/60 > 48 AND emailconfirmed = 0;
optimize table log;
optimize table users;
