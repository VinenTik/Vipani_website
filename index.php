<?php

include("inc/auth.class.php");
include("inc/virtualtrader.class.php");

$auth = new Auth;
$virtualtrader = new VirtualTrader;

if(isset($_COOKIE['auth_session']))
{
	if($auth->checksession($_COOKIE['auth_session']))
	{
		$session = $auth->sessioninfo($_COOKIE['auth_session']);
		$userbalance = $virtualtrader->GetUserBalance($session['username']);
	}
}

if(isset($_GET['page']))
{
	$page = $_GET['page'];
	
	switch($page)
	{
		case 'home':
			include("pages/home.php");
			break;
		case 'admin':
			include("pages/admin.php");
			break;
		case 'login':
			include("pages/login.php");
			break;
		case 'register':
			include("pages/register.php");
			break;
		case 'resetpass':
			include("pages/resetpass.php");
			break;
		case 'activate':
			include("pages/activate.php");
			break;
		case 'change-pass':
			include("pages/change-pass.php");
			break;
		case 'change-email':
			include("pages/change-email.php");
			break;
		case 'logout':
			include("pages/logout.php");
			break;
		case 'stocks':
			include("pages/stocks.php");
			break;
		case 'stockinfo':
			include("pages/stockinfo.php");
			break;
		case 'userinfo':
			include("pages/userinfo.php");
			break;
		case 'mystocks':
			include("pages/mystocks.php");
			break;
		case 'admin_stocks':
			include("pages/admin_stocks.php");	
			break;
			
		case 'top-10':
			include("pages/top-10.php");
			break;
	
			case 'about':
				include("pages/about.php");
				break;
				case 'changeprice':
					include("pages/changeprice.php");
					break;
					case 'all':
						include("pages/all.php");
						break;
						case 'faq':
							include("pages/faq.php");
							break;
							case 'contact':
								include("pages/contact.php");
								break;
								case 'news':
									include("pages/news.php");
									break;
									case 'event':
										include("pages/event.php");
										break;

		default:
			include("pages/404.php");
			break;
	}
}
else
{
	header("Location: ?page=home");
	exit();
}

?>