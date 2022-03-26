<?php

class VirtualTrader
{

	private $mysqli;
	public $errormsg;
	public $successmsg;
	
	function __construct()
	{
		include("config.php");
	
		$this->mysqli = new mysqli($db['host'], $db['user'], $db['pass'], $db['name']); 
	}
	
	/*
	* Fetches info for a specific stockcode from Google Finance
	* @param string $stockcode
	* @return array $stockinfo
	*/
	
	function GetStockInfo($stockcode)
	{
		$url = "http://www.google.com/ig/api?stock=" . $stockcode;
		
		$ch = curl_init();
		
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 5);
		
		$data = curl_exec($ch);
		
		curl_close($ch);
		
		$xml = simplexml_load_string($data);
		$finance = $xml->xpath("/xml_api_reply/finance");
		
		$stockinfo['code'] = $finance[0]->symbol['data']; // Stock code name (ex: GOOG)
		$stockinfo['name'] = $finance[0]->company['data']; // Stock Company Name (ex: Google Inc.)
		$stockinfo['price'] = floatval($finance[0]->last['data']); // Stock price
		$stockinfo['diff'] = floatval($finance[0]->change['data']); // Stock Difference
		$stockinfo['diff_perc'] = floatval($finance[0]->perc_change['data']); // Stock difference in percent
		
		if($stockinfo['price'] == 0)
		{
			return false;
		}
		else
		{
			return $stockinfo;
		}
	}
	
	/*
	* Fetches info for a specific stockcode from database
	* @param string $stockcode
	* @return array $stockinfo
	*/
	
	function GetStockInfoDB($stockcode)
	{
		if(strlen($stockcode) == 0) { return false; }
		elseif(strlen($stockcode) < 1) { return false; }
		elseif(strlen($stockcode) > 10) { return false; }
		else
		{
			$query = $this->mysqli->prepare("SELECT name, code, price, diff, diff_perc, shares, mktcap, eps, per, news FROM stocks WHERE code=?");
			$query->bind_param("s", $stockcode);
			$query->bind_result($stockinfo['name'], $stockinfo['code'], $stockinfo['price'], $stockinfo['diff'], $stockinfo['diff_perc'], $stockinfo['shares'], $stockinfo['mktcap'], $stockinfo['eps'], $stockinfo['per'], $stockinfo['news']);
			$query->execute();
			$query->store_result();
			$count = $query->num_rows;
			
			if($count == 0)
			{
				$query->close();
				
				return false;
			}
			else
			{
				$query->fetch();
				
				$stockinfo['price'] = round($stockinfo['price'], 2);
				$stockinfo['diff'] = round($stockinfo['diff'], 2);
				$stockinfo['diff_perc'] = round($stockinfo['diff_perc'], 2);
				
				$query->close();
				
				return $stockinfo;
			}
		}
	}

	/*
	* Updates the entire stock database based on Stockcode
	* @return boolean
	*/	
	
	function UpdateStockDB()
	{
		$query = $this->mysqli->prepare("SELECT code FROM stocks");
		$query->bind_result($stockcode);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;

		if($count == 0)
		{
			return false;
		}
		else 
		{
			while($query->fetch())
			{
				$stockinfo = $this->GetStockInfo($stockcode);
				
				$query2 = $this->mysqli->prepare("UPDATE stocks SET name=?, price=?, diff=?, diff_perc=? WHERE code=?");
				$query2->bind_param("sddds", $stockinfo['name'], $stockinfo['price'], $stockinfo['diff'], $stockinfo['diff_perc'], $stockcode);
				$query2->execute();
				$query2->close();
			}
			
			return true;
		}
	}
	
	/*
	* Function to check if stock exists in Database based on Stock Code
	* @param string $stockcode
	* @return boolean
	*/
	
	function CheckStock($stockcode)
	{
		$query = $this->mysqli->prepare("SELECT * FROM stocks WHERE code=?");
		$query->bind_param("s", $stockcode);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		$query->close();

		if($count == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	/*
	* Adds x amount of shares to a user's account, and deducts the appropriate sum
	* @param string $stockcode
	* @param int $quantity
	* @param string $username
	* @return boolean
	*/
	
	function BuyShare($stockcode, $quantity, $username)
	{
		include("config.php");
		include("lang.php");
		
		if(strlen($stockcode) == 0) { $this->errormsg[] = $lang[$loc]['virtualtrader']['buyshare_stockcode_empty']; return false; }
		elseif(strlen($stockcode) > 10) { $this->errormsg[] = $lang[$loc]['virtualtrader']['buyshare_stockcode_long']; return false; }
		if(!is_int($quantity)) { $this->errormsg[] = $lang[$loc]['virtualtrader']['buyshare_quantity_isint']; return false; }
		elseif($quantity < 0) { $this->errormsg[] = $lang[$loc]['virtualtrader']['buyshare_quantity_infzero']; return false; }
		if(strlen($username) == 0) { $this->errormsg[] = $lang[$loc]['virtualtrader']['buyshare_username_empty']; return false; }
		elseif(strlen($username) < 3) { $this->errormsg[] = $lang[$loc]['virtualtrader']['buyshare_username_short']; return false; }
		elseif(strlen($username) > 30) { $this->errormsg[] = $lang[$loc]['virtualtrader']['buyshare_username_long']; return false; }
				
		$quantity = round($quantity);
			   
		if(is_countable($this->errormsg) == 0)
		{
			$query = $this->mysqli->prepare("SELECT quantity FROM userstocks WHERE code=? AND username=?");
			$query->bind_param("ss", $stockcode, $username);
			$query->bind_result($db_quantity);
			$query->execute();
			$query->store_result();
			$count = $query->num_rows;
			$query->fetch();
			$query->close();
			
			if($count == 0)
			{
				// User has 0 shares for the provided stock code
				
				$stockinfo = $this->GetStockInfoDB($stockcode);

				$totalprice = $quantity * $stockinfo['price'];
				$totalprice = round($totalprice, 2);
				
				$query = $this->mysqli->prepare("SELECT balance FROM users WHERE username=?");
				$query->bind_param("s", $username);
				$query->bind_result($balance);
				$query->execute();
				$query->fetch();
				$query->close();
				
				if($totalprice <= $balance)
				{
					// User has sufficient funds to purchase x quantity of shares
					
					$newbalance = $balance - $totalprice;
					
					$newquantity = $quantity;
					
					$query = $this->mysqli->prepare("UPDATE users SET balance=? WHERE username=?");
					$query->bind_param("ds", $newbalance, $username);
					$query->execute();
					$query->close();
					
					$query = $this->mysqli->prepare("INSERT INTO userstocks (code, username, quantity, p_price) VALUES (?, ?, ?, ?)");
					$query->bind_param("ssid", $stockcode, $username, $newquantity, $stockinfo['price']);
					$query->execute();
					$query->close();
					
					$this->LogActivity($username, "VIRTUALTRADER_STOCK_BUY_SUCCESS", "Purchased {$quantity} {$stockcode} shares for {$totalprice} $ - New Quantity : {$quantity} - Old Balance : {$balance} $ - New Balance : {$newbalance} $");
					
					$this->successmsg[] = sprintf($lang[$loc]['virtualtrader']['buyshare_success'], $quantity, $stockcode, $totalprice);
					return true;
				}
				else
				{
					$this->LogActivity($username, "VIRTUALTRADER_STOCK_BUY_FAIL", "User attempted to purchase {$quantity} {$stockcode} shares for {$totalprice} - Balance insufficient ({$balance} $)");
				
					$this->errormsg[] = $lang[$loc]['virtualtrader']['buyshare_funds_insufficient'];
					return false;
				}
				
			}
			else
			{
				
			
				$stockinfo = $this->GetStockInfoDB($stockcode);
				
				$totalprice = $quantity * $stockinfo['price'];
				$totalprice = round($totalprice, 2);
				
				$query = $this->mysqli->prepare("SELECT balance FROM users WHERE username=?");
				$query->bind_param("s", $username);
				$query->bind_result($balance);
				$query->execute();
				$query->fetch();
				$query->close();
				
				if($totalprice <= $balance)
				{
					// User has sufficient funds to purchase x quantity of shares
					
					$newbalance = $balance - $totalprice;
					$newquantity = $db_quantity + $quantity;
					
					$query = $this->mysqli->prepare("UPDATE users SET balance=? WHERE username=?");
					$query->bind_param("ds", $newbalance, $username);
					$query->execute();
					$query->close();
					
					$query = $this->mysqli->prepare("UPDATE userstocks SET quantity=?, p_price=? WHERE code=? AND username=?");
					$query->bind_param("idss", $newquantity, $stockinfo['price'], $stockcode, $username);
					$query->execute();
					$query->close();
					
					$this->LogActivity($username, "VIRTUALTRADER_STOCK_BUY_SUCESS", "Purchased {$quantity} {$stockcode} shares for {$totalprice} $ - New Quantity : {$newquantity} - Old Balance : {$balance} $ - New Balance : {$newbalance} $");
					
					$this->successmsg[] = sprintf($lang[$loc]['virtualtrader']['buyshare_success'], $quantity, $stockcode, $totalprice);
					$this->successmsg[] = sprintf($lang[$loc]['virtualtrader']['buyshare_recount'], $newquantity, $stockcode);
					return true;
				}
				else
				{
					$this->LogActivity($username, "VIRTUALTRADER_STOCK_BUY_FAIL", "User attempted to purchase {$quantity} {$stockcode} shares for {$totalprice} - Balance insufficient ({$balance} $)");
				
					$this->errormsg[] = $lang[$loc]['virtualtrader']['buyshare_funds_insufficient'];
					return false;
				}
			}
			
		}
		else
		{
			return false;
		}		  
	}
	
	/*
	* Removes x amount of shares from user's account, and pays user with the appropriate funds
	* @param string $stockcode
	* @param int $quantity
	* @param string $username
	* @return boolean
	*/

	function SellShare($stockcode, $quantity, $username)
	{
		include("config.php");
		include("lang.php");
	
		if(strlen($stockcode) == 0) { $this->errormsg[] = $lang[$loc]['virtualtrader']['sellshare_stockcode_empty']; return false; }
		elseif(strlen($stockcode) > 10) { $this->errormsg[] = $lang[$loc]['virtualtrader']['sellshare_stockcode_long']; return false; }
		if(!is_int($quantity)) { $this->errormsg[] = $lang[$loc]['virtualtrader']['sellshare_quantity_isint']; return false; }
		elseif($quantity < 0) { $this->errormsg[] = $lang[$loc]['virtualtrader']['sellshare_quantity_infzero']; return false; }
		if(strlen($username) == 0) { $this->errormsg[] = $lang[$loc]['virtualtrader']['sellshare_username_empty']; return false; }
		elseif(strlen($username) < 3) { $this->errormsg[] = $lang[$loc]['virtualtrader']['sellshare_username_short']; return false; }
		elseif(strlen($username) > 30) { $this->errormsg[] = $lang[$loc]['virtualtrader']['sellshare_username_long']; return false; }
		
		$quantity = round($quantity);
		
		if(is_countable($this->errormsg) == 0)
		{
			$query = $this->mysqli->prepare("SELECT quantity FROM userstocks WHERE code=? AND username=?");
			$query->bind_param("ss", $stockcode, $username);
			$query->bind_result($db_quantity);
			$query->execute();
			$query->store_result();
			$count = $query->num_rows;
			$query->fetch();
			$query->close();
			
			if($count == 0)
			{
				// User does not have any shares for the provided stockcode
				
				$this->LogActivity($username, "VIRTUALTRADER_STOCK_SELL_FAIL", "User attempted to sell {$quantity} {$stockcode} shares - user has 0 {$stockcode} shares)");
				
				$this->errormsg[] = sprintf($lang[$loc]['virtualtrader']['sellshare_stocks_none'], $stockcode);
				return false;
			}
			else
			{
				if($quantity > $db_quantity)
				{
					// User is attempting to sell more shares than they have
					
					$this->LogActivity($username, "VIRTUALTRADER_STOCK_SELL_FAIL", "User attempted to sell {$quantity} {$stockcode} shares - Sale quantity ({$quantity}) exceeds actual quantity ({$db_quantity})");
					
					$this->errormsg[] = sprintf($lang[$loc]['virtualtrader']['sellshare_stocks_insufficient'], $stockcode);
					return false;
				}
				else
				{
					// User has enough shares to complete transaction
					
					$newquantity = $db_quantity - $quantity;
					
					$stockinfo = $this->GetStockInfoDB($stockcode);
				
					$totalprice = $quantity * $stockinfo['price'];
					
					$query = $this->mysqli->prepare("SELECT balance FROM users WHERE username=?");
					$query->bind_param("s", $username);
					$query->bind_result($db_balance);
					$query->execute();
					$query->fetch();
					$query->close();
					
					$newbalance = $db_balance + $totalprice;
					
					if($newquantity == 0)
					{
						// User is selling all shares for provided stockcode => Delete the row
						
						$query = $this->mysqli->prepare("DELETE FROM userstocks WHERE code=? AND username=?");
						$query->bind_param("ss", $stockcode, $username);
						$query->execute();
						$query->close();
	
						$query = $this->mysqli->prepare("UPDATE users SET balance=? WHERE username=?");
						$query->bind_param("ds", $newbalance, $username);
						$query->execute();
						$query->close();
						
						$this->LogActivity($username, "VIRTUALTRADER_STOCK_SELL_SUCCESS", "Sold  {$quantity} {$stockcode} shares for {$totalprice} $ - New Quantity :  0 - Old Balance : {$db_balance} $ - New Balance : {$newbalance} $");
						
						$this->successmsg[] = sprintf($lang[$loc]['virtualtrader']['sellshare_success'], $quantity, $stockcode, $totalprice);
						$this->successmsg[] = sprintf($lang[$loc]['virtualtrader']['sellshare_recount'], 0, $stockcode);
						
						return true;
					}
					else
					{
						// User will have shares left over after the transaction
						
						$query = $this->mysqli->prepare("UPDATE userstocks SET quantity=? WHERE code=? AND username=?");
						$query->bind_param("iss", $newquantity, $stockcode, $username);
						$query->execute();
						$query->close();
						
						$query = $this->mysqli->prepare("UPDATE users SET balance=? WHERE username=?");
						$query->bind_param("ds", $newbalance, $username);
						$query->execute();
						$query->close();
						
						$this->LogActivity($username, "VIRTUALTRADER_STOCK_SELL_SUCCESS", "Sold {$quantity} {$stockcode} shares for {$totalprice} $ - New Quantity : {$newquantity} - Old Balance : {$db_balance} $ - New Balance : {$newbalance} $");
						
						$this->successmsg[] = sprintf($lang[$loc]['virtualtrader']['sellshare_success'], $quantity, $stockcode, $totalprice);
						$this->successmsg[] = sprintf($lang[$loc]['virtualtrader']['sellshare_recount'], $newquantity, $stockcode);
						
						return true;
					}
				}
			}
		}
		else
		{
			return false;
		}
	}
	
	/*
	* Logs users actions on the site to database for future viewing
	* @param string $username
	* @param string $action
	* @param string $additionalinfo
	* @return boolean
	*/
	
	function LogActivity($username, $action, $additionalinfo = "none")
	{
		include("config.php");
		include("lang.php");
	
		if(strlen($username) == 0) { $this->errormsg[] = $lang[$loc]['virtualtrader']['logactivity_username_empty']; return false; }
		elseif(strlen($username) < 3) { $this->errormsg[] = $lang[$loc]['virtualtrader']['logactivity_username_short']; return false; }
		elseif(strlen($username) > 30) { $this->errormsg[] = $lang[$loc]['virtualtrader']['logactivity_username_long']; return false; }
		
		if(strlen($action) == 0) { $this->errormsg[] = $lang[$loc]['virtualtrader']['logactivity_action_empty']; return false; }
		elseif(strlen($action) < 3) { $this->errormsg[] = $lang[$loc]['virtualtrader']['logactivity_action_short']; return false; }
		elseif(strlen($action) > 100) { $this->errormsg[] = $lang[$loc]['virtualtrader']['logactivity_action_long']; return false; }
		
		if(strlen($additionalinfo) == 0) { $additionalinfo = "none"; }
		elseif(strlen($additionalinfo) > 500) { $this->errormsg[] = $lang[$loc]['virtualtrader']['logactivity_addinfo_long']; return false; }
		
		if(is_countable($this->errormsg) == 0)
		{
			$ip = $_SERVER['REMOTE_ADDR'];
			$date = date("Y-m-d H:i:s");
			
			$query = $this->mysqli->prepare("INSERT INTO activitylog (date, username, action, additionalinfo, ip) VALUES (?, ?, ?, ?, ?)");
			$query->bind_param("sssss", $date, $username, $action, $additionalinfo, $ip);
			$query->execute();
			$query->close();
			
			return true;
		}
	}
	
	/*
	* Fetch quantity of Shares for a user based on stock code
	* @param string $username
	* @param string $stockcode
	* @return int $quantity
	*/
	
	function ShareQty($username, $stockcode)
	{
		$query = $this->mysqli->prepare("SELECT quantity FROM userstocks WHERE username=? AND code=?");
		$query->bind_param("ss", $username, $stockcode);
		$query->bind_result($quantity);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		$query->fetch();
		$query->close();
		
		if($count == 0)
		{
			$quantity = 0;
			return $quantity;
		}
		else
		{
			return $quantity;
		}
	}
	
	/*
	* Returns an array of all stocks available for trading
	* @return array $data
	*/
	
	function GetStocks()
	{
		$query = $this->mysqli->prepare("SELECT id, name, code, price, diff, diff_perc, shares, mktcap, eps, per, news FROM stocks ORDER BY name ASC");
		$query->bind_result($id, $name, $code, $price, $diff, $diff_perc, $shares, $mktcap, $eps, $per, $news);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		
		if($count == 0)
		{
			// Query returned 0 rows
			
			$query->close();
			
			return false;
		}
		else
		{
			// Query returned more than 0 rows
			
			$i = 0;
			
			while($query->fetch())
			{
				$data[$i]['id'] = $id;
				$data[$i]['name'] = $name;
				$data[$i]['code'] = $code;
				$data[$i]['price'] = round($price, 2);
				$data[$i]['diff'] = round($diff, 2);
				$data[$i]['diff_perc'] = round($diff_perc, 2);
				$data[$i]['shares'] = $shares;
				$data[$i]['mktcap'] = $mktcap;
				$data[$i]['eps'] = $eps;
				$data[$i]['per'] = $per;
				$data[$i]['news'] = $news;
				$i++;
			}
			
			$query->close();
			
			return $data;
		}
	}

	function GetStocksGreen()
	{
		$query = $this->mysqli->prepare("SELECT id, name, code, price, diff, diff_perc, shares, mktcap, eps, per, news FROM stocks ORDER BY diff_perc DESC LIMIT 3");
		$query->bind_result($id, $name, $code, $price, $diff, $diff_perc, $shares, $mktcap, $eps, $per, $news);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		
		if($count == 0)
		{
			// Query returned 0 rows
			
			$query->close();
			
			return false;
		}
		else
		{
			// Query returned more than 0 rows
			
			$i = 0;
			
			while($query->fetch())
			{
				$data[$i]['id'] = $id;
				$data[$i]['name'] = $name;
				$data[$i]['code'] = $code;
				$data[$i]['price'] = round($price, 2);
				$data[$i]['diff'] = round($diff, 2);
				$data[$i]['diff_perc'] = round($diff_perc, 2);
				$data[$i]['shares'] = $shares;
				$data[$i]['mktcap'] = $mktcap;
				$data[$i]['eps'] = $eps;
				$data[$i]['per'] = $per;
				$data[$i]['news'] = $news;
				$i++;
			}
			
			$query->close();
			
			return $data;
		}
	}


	function GetStocksRed()
	{
		$query = $this->mysqli->prepare("SELECT id, name, code, price, diff, diff_perc, shares, mktcap, eps, per, news FROM stocks ORDER BY diff_perc ASC LIMIT 3");
		$query->bind_result($id, $name, $code, $price, $diff, $diff_perc, $shares, $mktcap, $eps, $per, $news);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		
		if($count == 0)
		{
			// Query returned 0 rows
			
			$query->close();
			
			return false;
		}
		else
		{
			// Query returned more than 0 rows
			
			$i = 0;
			
			while($query->fetch())
			{
				$data[$i]['id'] = $id;
				$data[$i]['name'] = $name;
				$data[$i]['code'] = $code;
				$data[$i]['price'] = round($price, 2);
				$data[$i]['diff'] = round($diff, 2);
				$data[$i]['diff_perc'] = round($diff_perc, 2);
				$data[$i]['shares'] = $shares;
				$data[$i]['mktcap'] = $mktcap;
				$data[$i]['eps'] = $eps;
				$data[$i]['per'] = $per;
				$data[$i]['news'] = $news;
				$i++;
			}
			
			$query->close();
			
			return $data;
		}
	}

	function GetStocksforNews()
	{
		$query = $this->mysqli->prepare("SELECT id, name, code, price, diff, diff_perc, shares, mktcap, eps, per, news FROM stocks ORDER BY diff_perc DESC LIMIT 4");
		$query->bind_result($id, $name, $code, $price, $diff, $diff_perc, $shares, $mktcap, $eps, $per, $news);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		
		if($count == 0)
		{
			// Query returned 0 rows
			
			$query->close();
			
			return false;
		}
		else
		{
			// Query returned more than 0 rows
			
			$i = 0;
			
			while($query->fetch())
			{
				$data[$i]['id'] = $id;
				$data[$i]['name'] = $name;
				$data[$i]['code'] = $code;
				$data[$i]['price'] = round($price, 2);
				$data[$i]['diff'] = round($diff, 2);
				$data[$i]['diff_perc'] = round($diff_perc, 2);
				$data[$i]['shares'] = $shares;
				$data[$i]['mktcap'] = $mktcap;
				$data[$i]['eps'] = $eps;
				$data[$i]['per'] = $per;
				$data[$i]['news'] = $news;
				$i++;
			}
			
			$query->close();
			
			return $data;
		}
	}

	
	
	function GetNews()
	{
		$query = $this->mysqli->prepare("SELECT id, name, code, price, diff, diff_perc, shares, mktcap, eps, per, news FROM stocks ORDER BY diff_perc");
		$query->bind_result($id, $name, $code, $price, $diff, $diff_perc, $shares, $mktcap, $eps, $per, $news);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		
		if($count == 0)
		{
			// Query returned 0 rows
			
			$query->close();
			
			return false;
		}
		else
		{
			// Query returned more than 0 rows
			
			$i = 0;
			
			while($query->fetch())
			{
				$data[$i]['id'] = $id;
				$data[$i]['name'] = $name;
				$data[$i]['code'] = $code;
				$data[$i]['price'] = round($price, 2);
				$data[$i]['diff'] = round($diff, 2);
				$data[$i]['diff_perc'] = round($diff_perc, 2);
				$data[$i]['shares'] = $shares;
				$data[$i]['mktcap'] = $mktcap;
				$data[$i]['eps'] = $eps;
				$data[$i]['per'] = $per;
				$data[$i]['news'] = $news;
				$i++;
			}
			
			$query->close();
			
			return $data;
		}
	}
	/*
	* Returns an array of stocks for a given user
	* @param string $username
	* @return array $data
	*/
	
	function GetUserStocks($username)
	{
		if(strlen($username) == 0) { return false; }
		elseif(strlen($username) > 30) { return false; }
		elseif(strlen($username) < 3) { return false; }
		else
		{
			$query = $this->mysqli->prepare("SELECT code, quantity, p_price FROM userstocks WHERE username=?");
			$query->bind_param("s", $username);
			$query->bind_result($code, $quantity, $p_price);
			$query->execute();
			$query->store_result();
			$count = $query->num_rows;
		 
			if($count == 0)
			{
				$query->close();
			
				return false;
			}
			else
			{
				$i = 0;
		
				while($query->fetch())
				{
					$stockinfo = $this->GetStockInfoDB($code);
				
					$data[$i]['name'] = $stockinfo['name'];
					$data[$i]['code'] = $code;
					$data[$i]['p_price'] = round($p_price, 2);
					$data[$i]['c_price'] = round($stockinfo['price'], 2);
				
					$diff = round($p_price - $stockinfo['price'], 2);
				
					if($diff == 0) { $data[$i]['diff'] = 0; }
					else { $data[$i]['diff'] = $diff * -1; }
				
					$data[$i]['quantity'] = $quantity;
				
					$i++;
				}
			
				$query->close();
			
				return $data;
			}
		}
	}

	function GetUserStocksforHome($username)
	{
		if(strlen($username) == 0) { return false; }
		elseif(strlen($username) > 30) { return false; }
		elseif(strlen($username) < 3) { return false; }
		else
		{
			$query = $this->mysqli->prepare("SELECT code, quantity, p_price FROM userstocks WHERE username=? ORDER BY quantity DESC LIMIT 6");
			$query->bind_param("s", $username);
			$query->bind_result($code, $quantity, $p_price);
			$query->execute();
			$query->store_result();
			$count = $query->num_rows;
		 
			if($count == 0)
			{
				$query->close();
			
				return false;
			}
			else
			{
				$i = 0;
		
				while($query->fetch())
				{
					$stockinfo = $this->GetStockInfoDB($code);
				
					$data[$i]['name'] = $stockinfo['name'];
					$data[$i]['code'] = $code;
					$data[$i]['p_price'] = round($p_price, 2);
					$data[$i]['c_price'] = round($stockinfo['price'], 2);
				
					$diff = round($p_price - $stockinfo['price'], 2);
				
					if($diff == 0) { $data[$i]['diff'] = 0; }
					else { $data[$i]['diff'] = $diff * -1; }
				
					$data[$i]['quantity'] = $quantity;
				
					$i++;
				}
			
				$query->close();
			
				return $data;
			}
		}
	}


	/*
	* Returns an array of top 10 users
	* @return array $data
	*/
	
	function GetTopUsers()
	{
		$query = $this->mysqli->prepare("SELECT username, balance FROM users ORDER BY balance DESC LIMIT 10");
		$query->bind_result($username, $balance);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		
		if($count == 0)
		{
			$query->close();
			
			return false;
		}
		else
		{
			$i = 0;
		
			while($query->fetch())
			{
				$data[$i]['username'] = $username;
				$data[$i]['balance'] = round($balance, 2);
				
				$i++;
			}
			
			$query->close();
			
			return $data;
		}
	}

	/*
	* Returns an array of top 10 users
	* @return array $data
	*/
	
	function GetTop5Users()
	{
		$query = $this->mysqli->prepare("SELECT username, balance FROM users ORDER BY balance DESC LIMIT 5");
		$query->bind_result($username, $balance);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		
		if($count == 0)
		{
			$query->close();
			
			return false;
		}
		else
		{
			$i = 0;
		
			while($query->fetch())
			{
				$data[$i]['username'] = $username;
				$data[$i]['balance'] = round($balance, 2);
				
				$i++;
			}
			
			$query->close();
			
			return $data;
		}
	}
	
	/*
	* Function that returns the user's balance
	* @param string $username
	* @return double $balance
	*/
	
	function GetUserBalance($username)
	{
		$query = $this->mysqli->prepare("SELECT balance FROM users WHERE username=?");
		$query->bind_param("s", $username);
		$query->bind_result($balance);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		$query->fetch();
		$query->close();
		
		if($count == 0)
		{
			return false;
		}
		else
		{
			$balance = round($balance, 2);
		
			return $balance;
		}
	}


	function Portfolio($username)
	{
		$query = $this->mysqli->prepare("SELECT balance FROM users WHERE username=?");
		$query->bind_param("s", $username);
		$query->bind_result($balance);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		$query->fetch();
		$query->close();
		
		if($count == 0)
		{
			return false;
		}
		else
		{
			$balance = round($balance, 2);
		
			return $balance;
		}
	}

	function getRank($user){
		$query = $this->mysqli->prepare("SELECT username FROM users ORDER BY balance DESC,username ASC");
		$query->bind_result($username);
		$query->execute();
		$query->store_result();
		$count = $query->num_rows;
		
		if($count == 0)
		{
			$query->close();
			return false;
		}
		else
		{
			$i = 1;
		
			while($query->fetch())
			{
				$update_query = $this->mysqli->prepare("UPDATE users SET rank = ? WHERE username = ?");
				$update_query->bind_param("ds", $i,  $username);	
				$update_query->execute();
				$update_query->store_result();
				$i++;
			}
			
			$query->close();
			
		}
		$rank_query = $this->mysqli->prepare("SELECT rank FROM users WHERE username = ?");
		$rank_query->bind_param("s", $user);
		$rank_query->bind_result($rank);
		$rank_query->execute();
		$rank_query->store_result();
		$rank_query->fetch();
		$rank_query->close();
		return $rank;
	}

	function portf($user){
		$p_query = $this->mysqli->prepare("SELECT username, balance from users");
		$p_query->bind_result($username, $balance);
		$p_query->execute();
		$p_query->store_result();
		while($p_query->fetch()){
			$p1_query = $this->mysqli->prepare("SELECT code FROM userstocks WHERE username = ?");
			$p1_query->bind_param("s", $username);
			$p1_query->bind_result($code);
			$p1_query->execute();
			$p1_query->store_result();
			$pl = 0;
			$cp = 0;
			while($p1_query->fetch()){
				$p2_query = $this->mysqli->prepare("SELECT u.p_price, u.quantity, s.price FROM userstocks u JOIN stocks s ON u.code = s.code WHERE u.username = ? and u.code = ?");
				$p2_query->bind_param("ss", $username, $code);
				$p2_query->bind_result($p_price, $quantity, $c_price);
				$p2_query->execute();
				$p2_query->store_result();
				$p2_query->fetch();
				$pl += (($c_price * $quantity) - ($p_price * $quantity));
				$cp += ($c_price * $quantity);
			}
			$portfolio = $pl + $cp + $balance;
			$p2_query = $this->mysqli->prepare("UPDATE users SET portfolio = ? WHERE username = ?");
			$p2_query->bind_param("ds", $portfolio, $username);
			$p2_query->execute();
		}
		$p_query->close();
		$p1_query->close();
		$p2_query->close();
		$p3_query = $this->mysqli->prepare("SELECT portfolio FROM users WHERE username = ?");
		$p3_query->bind_param("s", $user);
		$p3_query->bind_result($portfolio);
		$p3_query->execute();
		$p3_query->store_result();
		$p3_query->fetch();
		$p3_query->close();
		return $portfolio;
	}

	function update_percent($percent, $code){
		
		$query1 = $this->mysqli->prepare("SELECT price, diff FROM stocks WHERE code = ?");
		$query1->bind_param("s", $code);
		$query1->bind_result($price, $difference);
		$query1->execute();
		$query1->store_result();
		$query1->fetch();

		$new_price = $price + ($percent/100);
		$new_diff = $new_price - $price;

		$query = $this->mysqli->prepare("UPDATE stocks SET diff_perc = ?, price = ?, diff = ? WHERE code = ?");
		$query->bind_param("ddds", $percent, $new_price, $new_diff, $code);
		$query->execute();

		$query->close();
		$query1->close();
		log($new_price);
	}

}

?>