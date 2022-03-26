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

if($_GET['code']) { $stockcode = $_GET['code']; } else { $virtualtrader->errormsg[] = "Stock code is invalid ! 1"; }

if($stockcode) { if(!$virtualtrader->CheckStock($stockcode)) { $virtualtrader->errormsg[] = "Stock code is invalid !"; } }

if(is_countable($virtualtrader->errormsg) == 0) 
{ $stockinfo = $virtualtrader->GetStockInfoDB($stockcode);	}

if(isset($_POST['action']))
{
	if($_POST['action'] == '1')
	{
		$quantity = (int) $_POST['quantity'];
		$virtualtrader->BuyShare($stockcode, $quantity, $session['username']);
	}
	elseif($_POST['action'] == '2')
	{
		$quantity = (int) $_POST['quantity'];
		$virtualtrader->SellShare($stockcode, $quantity, $session['username']);
	}
}

?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
  <!--plugins-->
  <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
  <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
  <link href="assets/css/icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  

  <!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />

  <!--Theme Styles-->
  <link href="assets/css/dark-theme.css" rel="stylesheet" />
  <link href="assets/css/light-theme.css" rel="stylesheet" />
  <link href="assets/css/semi-dark.css" rel="stylesheet" />
  <link href="assets/css/header-colors.css" rel="stylesheet" />

  <title>Vipani - Paper trading platform</title>
</head>

<body>


  <!--start wrapper-->
  <div class="wrapper">
    <!--start top header-->
      <header class="top-header">        
        <nav class="navbar navbar-expand gap-3">
          <div class="mobile-toggle-icon fs-3">
              <i class="bi bi-list"></i>
            </div>
            <form class="searchbar">
                <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><i class="bi bi-search"></i></div>
                <input class="form-control" type="text" placeholder="Type here to search">
                <div class="position-absolute top-50 translate-middle-y search-close-icon"><i class="bi bi-x-lg"></i></div>
            </form>
            <div class="top-navbar-right ms-auto">
              <ul class="navbar-nav align-items-center">
                <li class="nav-item search-toggle-icon">
                  <a class="nav-link" href="#">
                    <div class="">
                      <i class="bi bi-search"></i>
                    </div>
                  </a>
              </li>
              <li class="nav-item dropdown dropdown-user-setting">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                  <div class="user-setting d-flex align-items-center">
                    <img src="assets/images/avatars/avatar-1.png" class="user-img" alt="">
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                     <a class="dropdown-item" href="#">
                       <div class="d-flex align-items-center">
                          <img src="assets/images/avatars/avatar-1.png" alt="" class="rounded-circle" width="54" height="54">
                          <div class="ms-3">
                            <h6 class="mb-0 dropdown-user-name"><?php echo $session['username']; ?></h6>
                            
                          </div>
                       </div>
                     </a>
                   </li>
                   <li><hr class="dropdown-divider"></li>
                   <li>
                      <a class="dropdown-item" href="pages-user-profile.html">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-person-fill"></i></div>
                           <div class="ms-3"><span>Profile</span></div>
                         </div>
                       </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-gear-fill"></i></div>
                           <div class="ms-3"><span>Settings</span></div>
                         </div>
                       </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="?page=home">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-speedometer"></i></div>
                           <div class="ms-3"><span>Dashboard</span></div>
                         </div>
                       </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="?page=mystocks">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-piggy-bank-fill"></i></div>
                           <div class="ms-3"><span>Portfolio</span></div>
                         </div>
                       </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="assets/images/logo-icon.png">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-cloud-arrow-down-fill"></i></div>
                           <div class="ms-3"><span>Downloads</span></div>
                         </div>
                       </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                      <a class="dropdown-item" href="?page=logout">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-lock-fill"></i></div>
                           <div class="ms-3"><span>Logout</span></div>
                         </div>
                       </a>
                    </li>
                </ul>
              </li>
              
              
              <li class="nav-item dropdown dropdown-large">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                  <div class="notifications">
                    <span class="notify-badge">0</span>
                    <i class="bi bi-bell-fill"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end p-0">
                  <div class="p-2 border-bottom m-2">
                      <h5 class="h5 mb-0">Notifications</h5>
                  </div>
                  <div class="header-notifications-list p-2">
                      <a class="dropdown-item" href="#">
                        <div class="d-flex align-items-center">
                           <div class="notification-box bg-light-primary text-primary"><i class="bi bi-basket2-fill"></i></div>
                           <div class="ms-3 flex-grow-1">
                             <h6 class="mb-0 dropdown-msg-user">New Orders <span class="msg-time float-end text-secondary">id</span></h6>
                             <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">You have recived new orders</small>
                           </div>
                        </div>
                      </a>
                     
                 </div>
                 <div class="p-2">
                   <div><hr class="dropdown-divider"></div>
                     <a class="dropdown-item" href="#">
                       <div class="text-center">View All Notifications</div>
                     </a>
                 </div>
                </div>
              </li>
              </ul>
              </div>
        </nav>
      </header>
       <!--end top header-->

        <!--start sidebar -->
        <aside class="sidebar-wrapper" data-simplebar="true">
          <div class="sidebar-header">
            <div>
              <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
            </div>
            <div>
              <h4 class="logo-text">VIPANI</h4>
            </div>
            <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
            </div>
          </div>
          <!--navigation-->
          <ul class="metismenu" id="menu">
          <li class="menu-label">Dashboard</li>
            <li>
              <a href="?page=home">
                <div class="parent-icon"><i class="bi bi-house-fill"></i>
                </div>
                <div class="menu-title">Dashboard</div>
              </a>
            </li>
            <li class="menu-label">Content</li>
            <li>
              <a href="?page=stocks">
                <div class="parent-icon"><i class="bi bi-bar-chart-fill"></i>
                </div>
                <div class="menu-title">Stocks</div>
              </a>
            </li>
            <li>
              <a href="?page=mystocks">
                <div class="parent-icon"><i class="bi bi-wallet2"></i>
                </div>
                <div class="menu-title">Portfolio</div>
              </a>
            </li>
            <li>
              <a href="?page=top-10">
                <div class="parent-icon"><i class="bi bi-award-fill"></i>
                </div>
                <div class="menu-title">Leaderboard</div>
              </a>
            </li>
            <li>
              <a href="?page=news">
                <div class="parent-icon"><i class="bi bi-newspaper"></i>
                </div>
                <div class="menu-title">News</div>
              </a>
            </li>
            <li class="menu-label">About</li>
            <li>
              <a href="?page=about">
                <div class="parent-icon"><i class="bi bi-collection-play-fill"></i>
                </div>
                <div class="menu-title">About</div>
              </a>
            </li>
            
            <li>
              <a href="?page=faq">
                <div class="parent-icon"><i class="bi bi-question-lg"></i>
                </div>
                <div class="menu-title">FAQ</div>
              </a>
            </li>
            <li>
              <a href="?page=contact" target="_blank">
                <div class="parent-icon"><i class="bi bi-telephone-fill"></i>
                </div>
                <div class="menu-title">Support</div>
              </a>
            </li>
            <li class="menu-label">Authentication</li>
            
            <li>
              <a href="?page=logout">
                <div class="parent-icon"><i class="bi bi-lock-fill"></i>
                </div>
                <div class="menu-title">Logout</div>
              </a>
            </li>
            <li>
              <a href="?page=change-pass">
                <div class="parent-icon"><i class="bi bi-key-fill"></i>
                </div>
                <div class="menu-title">Change Password</div>
              </a>
            </li>
            <li>
              <a href="?page=reset-pass">
                <div class="parent-icon"><i class="bi bi-unlock-fill"></i>
                </div>
                <div class="menu-title">Reset Password</div>
              </a>
            </li>
           
          </ul>
          <!--end navigation-->
       </aside>
       <!--end sidebar -->

       <!--start content-->
          <main class="page-content">
 <!--breadcrumb-->
 <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
              <div class="breadcrumb-title pe-3">Vipani</div>
              <div class="ps-3">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="?page=home"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Stock Information</li>
                  </ol>
                </nav>
              </div>
              
            </div>
            <!--end breadcrumb-->



            <div class="row">
              <div class="col-12 col-lg-6 d-flex">
                <div class="card radius-10 w-100">
               
                  <div class="card-body">
                  <div class="d-flex align-items-center">
                      <div class="">
                        <p class="mb-1">Company Name</p>
                        <h4 class="mb-0 text-primary"> <?php echo $stockinfo['name']; ?> (<?php echo $stockinfo['code']; ?>)</h4>
                      </div>
                      
                    </div>
                </div>
              </div>
              </div>


              <div class="col-12 col-lg-6 d-flex">
                <div class="card radius-10 w-100">
                  <div class="card-body">
                  <div class="d-flex align-items-center">
                      <div class="">
                        <p class="mb-1">Share Price</p>
                        <h4 class="mb-0 text-primary">₹ <?php echo $stockinfo['price']; ?></h4>
                      </div>
                      
                    </div>
                </div>
              </div>
            </div><!--end row-->

          
            

            
              
              <div class="col">
                <div class="card radius-10">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="">
                        <p class="mb-1">Info</p>
                        <h4 class="mb-0 text-primary"><?php if($quantity = $virtualtrader->ShareQty($session['username'], $stockinfo['code']))
{
	$total = $quantity * $stockinfo['price'];

	if($quantity == 1) { echo "You have 1 " . $stockinfo['code'] . " share, which is currently worth ₹ {$total} <br/><br/>"; }
	else { echo "You have {$quantity} " . $stockinfo['code'] . " shares, which are currently worth ₹ {$total}<br/><br/>"; }
}
else
{
	echo "You have 0 " . $stockinfo['code'] . " shares<br/><br/>";
}
?></h4>
                      </div>
                      <div class="ms-auto">
                        <div id="chart7"></div>
                      </div>
                    </div>
                  </div>
                </div>
               </div>


              
            
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-xl-6 row-cols-xxl-6">
              
              <div class="col">
                <div class="card radius-10">
                  <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-light-primary text-primary">
                      <i class="bi bi-arrow-down-up"></i>
                    </div>
                    <h3>₹ <?php echo $stockinfo['diff']; ?></h3>
                     <p class="mb-0">Day Change</p>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card radius-10">
                  <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-light-primary text-primary">
                      <i class="bi bi-percent"></i>
                    </div>
                    <h3><?php echo $stockinfo['diff_perc']; ?> %</h3>
                     <p class="mb-0">Overall Change</p>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card radius-10">
                  <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-light-primary text-primary">
                      <i class="bi bi-archive-fill"></i>
                    </div>
                    <h3><?php echo $stockinfo['shares']; ?></h3>
                     <p class="mb-0">No. of Shares</p>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card radius-10">
                  <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-light-primary text-primary">
                      <i class="bi bi-chat-left-fill"></i>
                    </div>
                     <h3><?php echo $stockinfo['mktcap']; ?></h3>
                     <p class="mb-0">Market Cap</p>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card radius-10">
                  <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-light-primary text-primary">
                      <i class="bi bi-calculator-fill"></i>
                    </div>
                    <h3><?php echo $stockinfo['eps']; ?></h3>
                     <p class="mb-0">EPS</p>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card radius-10">
                  <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-light-primary text-primary">
                      <i class="bi bi-pie-chart-fill"></i>
                    </div>
                     <h3><?php echo $stockinfo['per']; ?></h3>
                     <p class="mb-0">PE Ratio</p>
                  </div>
                </div>
              </div>
            </div><!--end row-->




            <div class="row">
              <div class="col-12 col-lg-6 d-flex">
                <div class="card radius-10 w-100">
               
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                    <p class="mb-1">Buy / Sell</p>
                      
                     </div>
                     <h4 class="mb-0 text-primary">
                        <div class="table-responsive mt-3">
                     <table class="table align-middle">
                     
                        <form method="post" action="?page=stockinfo&code=<?php echo $stockinfo['code']; ?>">
                            <input name="action" type="hidden" value="1">
                            <tr>
                                <td>
                            
                            <div class="col-12 col-lg-4">
                            
                            <input name="quantity"  type="text" class="form-control"  maxlength="5" placeholder="Quantity">
                                  </div>
                            </td>
                            <td>
                            
                            <div class="col">
                        <button  type="submit" value="Buy" class="btn btn-outline-success px-5">Buy</button>
                      </div>
                            </td>
                            </tr>
                            </form>
                            
                            <form  method="post" action="?page=stockinfo&code=<?php echo $stockinfo['code']; ?>">
                            <input name="action" type="hidden" value="2">
                            <tr>
                            <td>
                            
                            <div class="col-12 col-lg-4">
                            
                                    <input name="quantity" class="form-control" type="text" maxlength="5" placeholder="Quantity">
                                  </div>
                            </td>
                            <td>
                            
                            <div class="col">
                        <button type="submit" value="Sell" class="btn btn-outline-danger px-5">Sell</button>
                      </div>
                            </td>
                            </form>



                    </table>
                   
                   </div>




                        </h4>
                     


                </div>
              </div>
              </div>


              <div class="col-12 col-lg-6 d-flex">
                <div class="card radius-10 w-100">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                    <p class="mb-1">Orders</p>
                       
                    </div>
                    <h4 class="mb-0 text-primary">
                        <?php

if(isset($auth->errormsg)) { echo "<span class=\"errormsg\">"; foreach ($auth->errormsg as $emsg) { echo "$emsg<br/>"; } echo "</span><br/>"; }
if(isset($auth->successmsg)) { echo "<span class=\"successmsg\">"; foreach ($auth->successmsg as $smsg) { echo "$smsg<br/>"; } echo "</span><br/>"; }  
if(isset($virtualtrader->errormsg)) { echo "<span class=\"errormsg\">"; foreach ($virtualtrader->errormsg as $vemsg) { echo "$vemsg<br/>"; } echo "</span><br/>"; }
if(isset($virtualtrader->successmsg)) { echo "<span class=\"successmsg\">"; foreach ($virtualtrader->successmsg as $vsmsg) { echo "$vsmsg<br/>"; } echo "</span><br/>"; }  
?>

                      </h4>
                </div>
              </div>
            </div><!--end row-->

            

              <div class="col">
                <div class="card radius-10">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="">
                        <p class="mb-1">News</p>
                        <h5 class="mb-0 text-primary">
                        <?php echo $stockinfo['news']; ?>
                      </h5>
                      </div>
                      
                    </div>
                  </div>
                </div>
               </div>
               

               



<?php if(isset($stockinfo))
{
?>

<?php } ?>



              
    
          </main>
       <!--end page main-->


       <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
       <!--end overlay-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        
        <!--start switcher-->
       <div class="switcher-body">
        <button class="btn btn-primary btn-switcher shadow-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-paint-bucket me-0"></i></button>
        <div class="offcanvas offcanvas-end shadow border-start-0 p-2" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling">
          <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Theme Customizer</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
          </div>
          <div class="offcanvas-body">
            <h6 class="mb-0">Theme Variation</h6>
            <hr>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="LightTheme" value="option1" checked>
              <label class="form-check-label" for="LightTheme">Light</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="DarkTheme" value="option2">
              <label class="form-check-label" for="DarkTheme">Dark</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="SemiDarkTheme" value="option3">
              <label class="form-check-label" for="SemiDarkTheme">Semi Dark</label>
            </div>
            <hr>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="MinimalTheme" value="option3">
              <label class="form-check-label" for="MinimalTheme">Minimal Theme</label>
            </div>
            <hr/>
            <h6 class="mb-0">Header Colors</h6>
            <hr/>
            <div class="header-colors-indigators">
              <div class="row row-cols-auto g-3">
                <div class="col">
                  <div class="indigator headercolor1" id="headercolor1"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor2" id="headercolor2"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor3" id="headercolor3"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor4" id="headercolor4"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor5" id="headercolor5"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor6" id="headercolor6"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor7" id="headercolor7"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor8" id="headercolor8"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
       </div>
       <!--end switcher-->

  </div>
  <!--end wrapper-->


  <!-- Bootstrap bundle JS -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <!--plugins-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
  <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <script src="assets/js/pace.min.js"></script>
  <!--app-->
  <script src="assets/js/app.js"></script>
  

</body>

</html>