<!DOCTYPE html>
<html>
<head>
<title>Bazzar</title>
<link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
<link rel="stylesheet" href="css/style.css" type="text/css">
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
<form method="post" action="?page=resetpass">
<input type="hidden" name="username" value="<?php echo $username; ?>">
<input type="hidden" name="key" value="<?php echo $key; ?>">
  <table class="center" width="356" border="0" cellspacing="3" cellpadding="3">
    <tr>
      <td width="163">
      New Password :</td>
      <td width="172"><input name="newpass" type="password" maxlength="30"></td>
    </tr>
    <tr>
      <td>Verify New Password :</td>
      <td><input name="verifynewpass" type="password" maxlength="30"></td>
    </tr>
    <tr>
      <td colspan="2"><br><input type="submit" value="Reset Password &gt;"></td>
    </tr>
  </table>
</form><br/><span class="small"><a href="?page=home"><button class="button button3">Return to the homepage</button></a></span>
</div>
</div>
</body>
</html>