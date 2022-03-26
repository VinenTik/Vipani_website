<?php

if(isset($_COOKIE['auth_session']))
{
	if(!$auth->checksession($_COOKIE['auth_session']))
	{
		header("Location: ?page=login&m=1");
		exit();
	}
}
else
{
	header("Location: ?page=login&m=1");
	exit();
}

if(isset($_POST['email']))
{
	$auth->changeemail($session['username'], $_POST['email']);
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Bazzar</title>
<link rel="shortcut icon" href="img/favicon.png" type="image/x-icon"> 
<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
    

<div class="box">
<ul>
  <li><img src="img/logo.png" alt="bazzar" style="float:left;width:91px;height:63px;"></li>
  <li><a class="active" href="#">Home</a></li>
  <li><a href="?page=stocks">Stocks</a></li>
  <li><a href="?page=mystocks">Portfolio</a></li>
  <li><a href="?page=top-10">Leaderboard</a></li>
  <li><a href="?page=logout">Logout</a></li>
  <li><a href="#">Balance: ₹ <?php echo $userbalance; ?></a></li>
</ul>
<br>
<div class="content">
<h1>Change Email</h1>
<?php
if(isset($auth->errormsg)) { echo "<span class=\"errormsg\">"; foreach ($auth->errormsg as $emsg) { echo "$emsg<br/>"; } echo "</span><br/>"; }
if(isset($auth->successmsg)) { echo "<span class=\"successmsg\">"; foreach ($auth->successmsg as $smsg) { echo "$smsg<br/>"; } echo "</span><br/>"; }  
if(isset($virtualtrader->errormsg)) { echo "<span class=\"errormsg\">"; foreach ($virtualtrader->errormsg as $vemsg) { echo "$vemsg<br/>"; } echo "</span><br/>"; }
if(isset($virtualtrader->successmsg)) { echo "<span class=\"successmsg\">"; foreach ($virtualtrader->successmsg as $vsmsg) { echo "$vsmsg<br/>"; } echo "</span><br/>"; }  
?>
<form action="?page=change-email" method="post">
<table class="center" border="0" cellspacing="5" cellpadding="5">
<tr>
<td>New Email :</td>
<td><input type="text" name="email" maxlength="100" /></td>
</tr>
<tr>
<td colspan="2"><br/><input type="submit" value="Change Email >" /></td>
</tr>
</table></form><br/><span class="small"><a href="?page=home">Return to the Homepage ></a></span>
</div>
</div>
</body>
</html>