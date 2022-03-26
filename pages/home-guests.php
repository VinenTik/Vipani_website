<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Internkhoj">
    <link rel="shortcut icon" href="assets/images/favicon-32x32.jpg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>Vipani - Paper trading platform</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets1/css/fontawesome.css">
    <link rel="stylesheet" href="assets1/css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="assets1/css/owl.css">
    <link rel="stylesheet" href="assets1/css/lightbox.css">

  </head>

<body>

<!-- Sub Header -->
<div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-sm-8">
          <div class="left-content">
            <p>This <em>Stock Market Simulation</em> is only for Education purposes.</p>
          </div>
        </div>
        <div class="col-lg-4 col-sm-4">
          <div class="right-icons">
            <ul>
              <li><a href="https://instagram.com/vipani_official?utm_medium=copy_link"><i class="fa fa-instagram"></i></a></li>
              <li><a href="mailto:http://vipani.entremax.in/"><i class="fa fa-envelope" aria-hidden="true"></i></li>
              <li><a href="tel:"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <!-- ***** Logo Start ***** -->
                      <a href="?page=home" class="logo">
                        Vipani
                      </a>
                      <!-- ***** Logo End ***** -->
                      <!-- ***** Menu Start ***** -->
                      <ul class="nav">
                          <li class="scroll-to-section"><a href="#" class="active">Home</a></li>
                          <li><a href="?page=stocks">Stocks</a></li>
                          <li><a href="?page=login">Login</a></li>
                          

                      </ul>        
                      <a class='menu-trigger'>
                          <span>Menu</span>
                      </a>
                      <!-- ***** Menu End ***** -->
                  </nav>
              </div>
          </div>
      </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <!-- ***** Main Banner Area Start ***** -->
  <section class="section main-banner" id="top" data-section="section1">
      <video autoplay muted loop id="bg-video">
          <source src="assets1/images/course-video.mp4" type="video/mp4" />
      </video>

      <div class="video-overlay header-text">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="caption">
            
              <p style="font-size: 30px">Hey there!!👋🏻</p></br>
              <p style="font-size: 15px"><strong>Vipani</strong> has launched a Stock/Crypto Market Simulation Software for one to learn and experience stock or crypto currency market.</p>
              </br>
              <p style="font-size: 15px">We <strong>Inspire, Aspire, and Prospire</strong> young minds to adopt world of investment and trading to make themselves independent.</p>
              </br>
              <p style="font-size: 15px">Also we have newly introduced <strong>Crypto Market Simulation</strong> software to learn and participate in events created by colleges and institutes.</p>
              </br>
              <p style="font-size: 15px"><strong>LET THE BAZAAR OF TRADING BEGIN</strong></p>

              <div class="main-button-red">
                  <div>
                    <a href="?page=login">Login</a>
                  </div>
              </div>
          </div>
              </div>
            </div>
          </div>
      </div>
  </section>
  <!-- ***** Main Banner Area End ***** -->
  

  

<?php
if(isset($auth->errormsg)) { echo "<span class=\"errormsg\">"; foreach ($auth->errormsg as $emsg) { echo "$emsg<br/>"; } echo "</span><br/>"; }
if(isset($auth->successmsg)) { echo "<span class=\"successmsg\">"; foreach ($auth->successmsg as $smsg) { echo "$smsg<br/>"; } echo "</span><br/>"; }  
if(isset($virtualtrader->errormsg)) { echo "<span class=\"errormsg\">"; foreach ($virtualtrader->errormsg as $vemsg) { echo "$vemsg<br/>"; } echo "</span><br/>"; }
if(isset($virtualtrader->successmsg)) { echo "<span class=\"successmsg\">"; foreach ($virtualtrader->successmsg as $vsmsg) { echo "$vsmsg<br/>"; } echo "</span><br/>"; }  
?>


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets1/js/isotope.min.js"></script>
    <script src="assets1/js/owl-carousel.js"></script>
    <script src="assets1/js/lightbox.js"></script>
    <script src="assets1/js/tabs.js"></script>
    <script src="assets1/js/video.js"></script>
    <script src="assets1/js/slick-slider.js"></script>
    <script src="assets1/js/custom.js"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function (e) {
          e.preventDefault();
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>
</body>



</body>
</html>
</body>
</html>