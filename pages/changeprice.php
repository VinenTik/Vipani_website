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

if(isset($_POST['changeprice']))
{
	$auth->changepass($session['code'], $_POST['price'], $_POST['diff'], $_POST['diff_perc']);
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


<ul>
  <li><img src="img/logo.png" alt="bazzar" style="float:left;width:91px;height:63px;"></li>
  
  <li><a  href="?page=home">Home</a></li>
  <li><a class="active" href="?page=stocks">Stocks</a></li>
  <li><a href="?page=mystocks">Portfolio</a></li>
  <li><a href="?page=top-10">Leaderboard</a></li>
  <li><a href="?page=logout">Logout</a></li>
  <li><a href="#">Balance: ₹ <?php echo $userbalance; ?></a></li>

 
</ul>


<?php
if(isset($auth->errormsg)) { echo "<span class=\"errormsg\">"; foreach ($auth->errormsg as $emsg) { echo "$emsg<br/>"; } echo "</span><br/>"; }
if(isset($auth->successmsg)) { echo "<span class=\"successmsg\">"; foreach ($auth->successmsg as $smsg) { echo "$smsg<br/>"; } echo "</span><br/>"; }  
if(isset($virtualtrader->errormsg)) { echo "<span class=\"errormsg\">"; foreach ($virtualtrader->errormsg as $vemsg) { echo "$vemsg<br/>"; } echo "</span><br/>"; }
if(isset($virtualtrader->successmsg)) { echo "<span class=\"successmsg\">"; foreach ($virtualtrader->successmsg as $vsmsg) { echo "$vsmsg<br/>"; } echo "</span><br/>"; }  
?>
<?php if($data = $virtualtrader->GetStocks())
{
?>
<table width="100%" >
<tr>
	<td height="50"><b>Stock Name</b></td>
	<td><b>Price</b></td>
	<td><b>Difference</b></td>
    <td><b>New Price</b></td>
    <td><b>Difference</b></td>
    <td><b>Percentage</b></td>
	
</tr>
<?php foreach($data as $table)
{ ?>
<tr>
	<td><a href="?page=stockinfo&code=<?php echo $table['code']; ?>"><?php echo $table['name']; ?></td>
	<td>₹ <?php echo $table['price']; ?></td>
	<td><?php if($table['diff'] > 0) { echo "<img src=\"img/up.png\"/> "; } elseif($table['diff'] < 0) { echo "<img src=\"img/down.png\"/> "; } else { echo "<img src=\"img/equal.png\"/> "; } echo abs($table['diff']); ?> (<?php if($table['diff_perc'] > 0) { echo "+"; } echo $table['diff_perc']; ?> %)</td>
	<td>

    <form method="post" action="?page=stockinfo&code=">
<input name="action" type="hidden" value="2">
<input name="quantity" type="text" maxlength="5" placeholder="NewPrice">

    </td>
    <td>
        
    <form method="post" action="?page=stockinfo&code=">
<input name="action" type="hidden" value="2">
<input name="quantity" type="text" maxlength="5" placeholder="Diff">

    </td>
    <td>
        
    <form method="post" action="?page=stockinfo&code=<?php echo $stockinfo['code']; ?>">
<input name="action" type="hidden" value="2">
<input name="quantity" type="text" maxlength="5" placeholder="Per">

    </td>

    

</tr>


<?php } ?>
</table>

<td>
<input type="submit" class="button button2" value="CHange">
</td> 

<?php } else { ?>
0 stocks in database !
<?php } ?>


</body>
</html>