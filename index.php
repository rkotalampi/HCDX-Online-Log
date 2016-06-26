<html>
<head><link rel=stylesheet type=text/css href=hcdx.css /></head>

<body bgcolor=#aaaaff>

<center>
<h1> Welcome to Online Log </h1>
<table border="0" cellspacing="5" cellpadding="5">
<form action="login.php" method="POST">
<tr>
	<td>Username</td>
	<td><input type="text" size="10" name="f_user"></td>
</tr>
<tr>
	<td>Password</td>
	<td><input type="password" size="10" name="f_pass"></td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit"
name="submit" value="Log In"></td> </tr> </form> </table> 

<h2> No account yet? </h2>

<a href=account.php>Get an Online Log account here</a>.
<p>
<a href="<?
include("config.db.php");
print "mailto:$sender";
?>
">Problems?</a> 
</center>
</body>
</html>
