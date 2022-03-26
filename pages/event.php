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
								<li class="breadcrumb-item"><a href="?pages=home"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">About</li>
							</ol>
						</nav>
					</div>
					
				</div>
				<!--end breadcrumb-->
				<div class="">
					<div class="">
						<div class="container py-2">
							<h2 class="font-weight-light text-center text-muted py-3">Timeline Example 1</h2>
							<!-- timeline item 1 -->
							<div class="row">
								<!-- timeline item 1 left dot -->
								<div class="col-auto text-center flex-column d-none d-sm-flex">
									<div class="row h-50">
										<div class="col">&nbsp;</div>
										<div class="col">&nbsp;</div>
									</div>
									<h5 class="m-2">
									<span class="badge rounded-pill bg-light border">&nbsp;</span>
								</h5>
									<div class="row h-50">
										<div class="col border-end">&nbsp;</div>
										<div class="col">&nbsp;</div>
									</div>
								</div>
								<!-- timeline item 1 event content -->
								<div class="col py-2">
									<div class="card radius-15">
										<div class="card-body">
											<div class="float-end text-muted">Mon, Jan 9th 2020 7:00 AM</div>
											<h4 class="card-title text-muted">Day 1 Orientation</h4>
											<p class="card-text">Welcome to the campus, introduction and get started with the tour.</p>
										</div>
									</div>
								</div>
							</div>
							<!--/row-->
							<!-- timeline item 2 -->
							<div class="row">
								<div class="col-auto text-center flex-column d-none d-sm-flex">
									<div class="row h-50">
										<div class="col border-end">&nbsp;</div>
										<div class="col">&nbsp;</div>
									</div>
									<h5 class="m-2">
									<span class="badge rounded-pill bg-primary">&nbsp;</span>
								</h5>
									<div class="row h-50">
										<div class="col border-end">&nbsp;</div>
										<div class="col">&nbsp;</div>
									</div>
								</div>
								<div class="col py-2">
									<div class="card border-primary shadow radius-15">
										<div class="card-body">
											<div class="float-end text-primary">Tue, Jan 10th 2019 8:30 AM</div>
											<h4 class="card-title text-primary">Day 2 Sessions</h4>
											<p class="card-text">Sign-up for the lessons and speakers that coincide with your course syllabus. Meet and greet with instructors.</p>
											<button class="btn btn-sm btn-outline-secondary" type="button" data-bs-target="#t2_details" data-bs-toggle="collapse">Show Details ▼</button>
											<div class="collapse border" id="t2_details">
												<div class="p-2 text-monospace">
													<div>08:30 - 09:00 Breakfast in CR 2A</div>
													<div>09:00 - 10:30 Live sessions in CR 3</div>
													<div>10:30 - 10:45 Break</div>
													<div>10:45 - 12:00 Live sessions in CR 3</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--/row-->
							<!-- timeline item 3 -->
							<div class="row">
								<div class="col-auto text-center flex-column d-none d-sm-flex">
									<div class="row h-50">
										<div class="col border-end">&nbsp;</div>
										<div class="col">&nbsp;</div>
									</div>
									<h5 class="m-2">
									<span class="badge rounded-pill bg-light border">&nbsp;</span>
								</h5>
									<div class="row h-50">
										<div class="col border-end">&nbsp;</div>
										<div class="col">&nbsp;</div>
									</div>
								</div>
								<div class="col py-2">
									<div class="card radius-15">
										<div class="card-body">
											<div class="float-end text-muted">Wed, Jan 11th 2019 8:30 AM</div>
											<h4 class="card-title">Day 3 Sessions</h4>
											<p>Shoreditch vegan artisan Helvetica. Tattooed Codeply Echo Park Godard kogi, next level irony ennui twee squid fap selvage. Meggings flannel Brooklyn literally small batch, mumblecore PBR try-hard kale chips. Brooklyn vinyl lumbersexual bicycle rights, viral fap cronut leggings squid chillwave pickled gentrify mustache. 3 wolf moon hashtag church-key Odd Future. Austin messenger bag normcore, Helvetica Williamsburg sartorial tote bag distillery Portland before they sold out gastropub taxidermy Vice.</p>
										</div>
									</div>
								</div>
							</div>
							<!--/row-->
							<!-- timeline item 4 -->
							<div class="row">
								<div class="col-auto text-center flex-column d-none d-sm-flex">
									<div class="row h-50">
										<div class="col border-end">&nbsp;</div>
										<div class="col">&nbsp;</div>
									</div>
									<h5 class="m-2">
									<span class="badge rounded-pill bg-light border">&nbsp;</span>
								</h5>
									<div class="row h-50">
										<div class="col">&nbsp;</div>
										<div class="col">&nbsp;</div>
									</div>
								</div>
								<div class="col py-2">
									<div class="card radius-15">
										<div class="card-body">
											<div class="float-end text-muted">Thu, Jan 12th 2019 11:30 AM</div>
											<h4 class="card-title">Day 4 Wrap-up</h4>
											<p>Join us for lunch in Bootsy's cafe across from the Campus Center.</p>
										</div>
									</div>
								</div>
							</div>
							<!--/row-->
						</div>
						<!--container-->
						<hr>
						<div class="container py-2">
							<h2 class="font-weight-light text-center text-muted py-3">Timeline Example 2</h2>
							<!-- timeline item 1 -->
							<div class="row g-0">
								<div class="col-sm">
									<!--spacer-->
								</div>
								<!-- timeline item 1 center dot -->
								<div class="col-sm-1 text-center flex-column d-none d-sm-flex">
									<div class="row h-50">
										<div class="col">&nbsp;</div>
										<div class="col">&nbsp;</div>
									</div>
									<h5 class="m-2">
									<span class="badge rounded-pill bg-light border">&nbsp;</span>
								</h5>
									<div class="row h-50">
										<div class="col border-end">&nbsp;</div>
										<div class="col">&nbsp;</div>
									</div>
								</div>
								<!-- timeline item 1 event content -->
								<div class="col-sm py-2">
									<div class="card radius-15">
										<div class="card-body">
											<div class="float-end text-muted small">Jan 9th 2019 7:00 AM</div>
											<h4 class="card-title text-muted">Day 1 Orientation</h4>
											<p class="card-text">Welcome to the campus, introduction and get started with the tour.</p>
										</div>
									</div>
								</div>
							</div>
							<!--/row-->
							<!-- timeline item 2 -->
							<div class="row g-0">
								<div class="col-sm py-2">
									<div class="card border-primary shadow radius-15">
										<div class="card-body">
											<div class="float-end text-primary small">Jan 10th 2019 8:30 AM</div>
											<h4 class="card-title text-primary">Day 2 Sessions</h4>
											<p class="card-text">Sign-up for the lessons and speakers that coincide with your course syllabus. Meet and greet with instructors.</p>
											<button class="btn btn-sm btn-outline-secondary" type="button" data-bs-target="#t22_details" data-bs-toggle="collapse">Show Details ▼</button>
											<div class="collapse border" id="t22_details">
												<div class="p-2 text-monospace">
													<div>08:30 - 09:00 Breakfast in CR 2A</div>
													<div>09:00 - 10:30 Live sessions in CR 3</div>
													<div>10:30 - 10:45 Break</div>
													<div>10:45 - 12:00 Live sessions in CR 3</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-1 text-center flex-column d-none d-sm-flex">
									<div class="row h-50">
										<div class="col border-end">&nbsp;</div>
										<div class="col">&nbsp;</div>
									</div>
									<h5 class="m-2">
									<span class="badge rounded-pill bg-primary">&nbsp;</span>
								</h5>
									<div class="row h-50">
										<div class="col border-end">&nbsp;</div>
										<div class="col">&nbsp;</div>
									</div>
								</div>
								<div class="col-sm">
									<!--spacer-->
								</div>
							</div>
							<!--/row-->
							<!-- timeline item 3 -->
							<div class="row g-0">
								<div class="col-sm">
									<!--spacer-->
								</div>
								<div class="col-sm-1 text-center flex-column d-none d-sm-flex">
									<div class="row h-50">
										<div class="col border-end">&nbsp;</div>
										<div class="col">&nbsp;</div>
									</div>
									<h5 class="m-2">
										<span class="badge rounded-pill bg-light border">&nbsp;</span>
									</h5>
									<div class="row h-50">
										<div class="col border-end">&nbsp;</div>
										<div class="col">&nbsp;</div>
									</div>
								</div>
								<div class="col-sm py-2">
									<div class="card radius-15">
										<div class="card-body">
											<div class="float-end text-muted small">Jan 11th 2019 8:30 AM</div>
											<h4 class="card-title">Day 3 Sessions</h4>
											<p>Shoreditch vegan artisan Helvetica. Tattooed Codeply Echo Park Godard kogi, next level irony ennui twee squid fap selvage. Meggings flannel Brooklyn literally small batch, mumblecore PBR try-hard kale chips. Brooklyn vinyl lumbersexual bicycle rights, viral fap cronut leggings squid chillwave pickled gentrify mustache.</p>
										</div>
									</div>
								</div>
							</div>
							<!--/row-->
							<!-- timeline item 4 -->
							<div class="row g-0">
								<div class="col-sm py-2">
									<div class="card radius-15">
										<div class="card-body">
											<div class="float-end text-muted small">Jan 12th 2019 11:30 AM</div>
											<h4 class="card-title">Day 4 Wrap-up</h4>
											<p>Join us for lunch in Bootsy's cafe across from the Campus Center.</p>
										</div>
									</div>
								</div>
								<div class="col-sm-1 text-center flex-column d-none d-sm-flex">
									<div class="row h-50">
										<div class="col border-end">&nbsp;</div>
										<div class="col">&nbsp;</div>
									</div>
									<h5 class="m-2">
										<span class="badge rounded-pill bg-light border">&nbsp;</span>
									</h5>
									<div class="row h-50">
										<div class="col">&nbsp;</div>
										<div class="col">&nbsp;</div>
									</div>
								</div>
								<div class="col-sm">
									<!--spacer-->
								</div>
							</div>
							<!--/row-->
						</div>
					</div>
				</div>
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