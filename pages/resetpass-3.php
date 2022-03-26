<!DOCTYPE html>
<html>
<head>
<title>Bazzar</title>
<link rel="shortcut icon" href="img/favicon.png" type="image/x-icon"><link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<div class="box">
<div class="logo"></div>
<div class="content">
<h1>Reset Password</h1>
<?php
if(isset($auth->errormsg)) { echo "<span class=\"errormsg\">"; foreach ($auth->errormsg as $emsg) { echo "$emsg<br/>"; } echo "</span><br/>"; }
if(isset($auth->successmsg)) { echo "<span class=\"successmsg\">"; foreach ($auth->successmsg as $smsg) { echo "$smsg<br/>"; } echo "</span><br/>"; }  
if(isset($virtualtrader->errormsg)) { echo "<span class=\"errormsg\">"; foreach ($virtualtrader->errormsg as $vemsg) { echo "$vemsg<br/>"; } echo "</span><br/>"; }
if(isset($virtualtrader->successmsg)) { echo "<span class=\"successmsg\">"; foreach ($virtualtrader->successmsg as $vsmsg) { echo "$vsmsg<br/>"; } echo "</span><br/>"; }  
?>
<br/><span class="small"><a href="?page=home"><button class="button button3">Return to the homepage</button></a></span>
</div>
</div>
</body>
</html>