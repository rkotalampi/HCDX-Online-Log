
select login, (UNIX_TIMESTAMP()-Added)/60/60 as A, email, emailconfirmed from users;
select login, (UNIX_TIMESTAMP()-lastvisit)/60/60 as L, email from users order by L;
select login, (UNIX_TIMESTAMP()-lastvisit)/60/60 as L, email from users where lastvisit > 0 order by L desc;


