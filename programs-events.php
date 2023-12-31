    <?php
    include_once"dbconnect.php";
    session_start();
    $_SESSION["logged_in"]=TRUE;
    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
   <link rel="icon" href="favicon.ico" type="image/ico" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/animate.css" />
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" href="css/meanmenu.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <script src="js/libs/modernizr.custom.js"></script>
    <title>Program Event</title>
    

</head>
<body>
<div class="main-wrapper page">
    <!--Begin header ưrapper-->
    <div class="header-wrapper">
        <header id="header" class="container-header type1">
            <div class="top-nav">
                <div class="container">
                    <div class="row">
                        <div class="top-left col-sm-6 hidden-xs">
                            <ul class="list-inline">
                                <li>
                                    <a href="mailto:alumni@sayidan.edu">
                                        <span class="icon mail-icon"></span>
                                        <span class="text">alumni@sayidan.edu</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="icon phone-icon"></span>
                                        <span class="text">+1 087 222 9</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="top-right col-sm-6 col-xs-12">
                            <ul class="list-inline">
                                <li class="top-search">
                                    <form class="navbar-form search no-margin no-padding">
                                        <input type="text" name="q" class="form-control input-search" placeholder="search..." autocomplete="off">
                                        <button type="submit" class="lnr lnr-magnifier"></button>
                                    </form>
                                </li>
                                <li class="login">
                                    <a href="./login-page.html">Log In</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle">
                <div class="container">
                    <div class="logo hidden-sm hidden-xs">
                        <a href="./homepage-1.html"> <img src="images/logo.png" alt="logo"></a>
                    </div>
                    <div class="menu">
                        <nav>
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="./about-us.html">ABOUT US</a>
                                </li>
                                <li class="current">
                                    <a href="./programs-events.php">PROGRAM &amp; EVENTS</a>
                                </li>

                                <li>
                                   <a href="./alumni-story.html">ALUMNI STORY</a>
                                </li>
                                <li>
                                    <a href="./career-opportunity.html">CAREER OPPORTUNITY</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="area-mobile-content visible-sm visible-xs">
                        <div class="logo-mobile">
                            <a href="./homepage-1.html"> <img src="images/logo-small.png" alt="logo"></a>
                        </div>
                        <div class="mobile-menu ">
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <!--End header wrapper-->

    <!--Begin content wrapper-->
    <div class="content-wrapper">

        <!--begin upcoming event-->
        <div class="program-upcoming-event" style="padding:30px;":>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="area-img">
                            <img class="img-responsive animate zoomIn" src="images/programs-events-img.jpg" alt="">
                            <div id="time-event" class="animated fadeIn"></div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                    <?php
                    $sql = "SELECT * FROM events ORDER BY e_date ASC LIMIT 1";
                    $result = $con->query($sql);

                        while ($row = $result->fetch_assoc()) {
                            $e_date = $row["e_date"];
                            
                            // Convert e_date to month in words, date, and year format
                            $formatted_date = date("d F Y", strtotime($e_date));
                            $url = $row["e_url"];
                            
                        
                    
                        echo"<div class='area-content'>
                            <div class='area-top'>
                                <div class='top-section animated lightSpeedIn'>
                                    <h5 class='heading-light' style='color:black;'>UPCOMING EVENT</h5>
                                    <span class='dates text-white text-uppercase' style='color:black;'>" . $formatted_date . "</span>
                                </div>
                                <h2 class='heading-bold animated rollIn' style='color:black;'>".$row["e_name"]."</h2>
                            <span class='animated fadeIn'>
                                <span class='icon map-icon'></span>
                                <span class='text-place text-white' style='color:black;'>".$row["e_venue"]."</span>
                            </span>
                            </div>
                            <div class='area-bottom animated zoomInLeft'>
                                <a href='$url' class='bnt bnt-theme join-now'>Register</a>
                            </div>
                        </div>";
                        }
                    
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <!--end upcoming event-->

        <!--begin event calendar-->
        <div class="event-calendar">
            <div class="container">
                <div class="top-section text-center">
                    <h4>All Alumni Events</h4>
                </div>
                
                <?php
	                $sql2 = "SELECT * FROM events ORDER BY e_date, e_time";
	                $result2 = $con->query($sql2);

                    if($result2==true){
                        while($row =$result2->fetch_assoc()){
                            $date = $row["e_date"]; 
                            $timestamp = strtotime($date);
                            $day = date('l', $timestamp);
                            $datetime = new DateTime($date);
                            $interval = new DateInterval('P0D'); 
                            $datetime->sub($interval);
                            $url = $row["e_url"];

                
                        echo"<div class='event-list-content' style='border: 1px solid #dedbd5;'>
                    <div style='border: 5px solid black;' class='event-list-item' >
                    
                        <div class='date-item'>
                            <span class='day text-bold color-theme'>".$datetime->format('d')."</span>
                            <span styleclass='month text-gray text-uppercase'>".$datetime->format('F')."</span>
                            <span styleclass='year text-gray text-uppercase'>".$datetime->format('Y')."</span><br>
                            <span class='day text-bold color-theme'>".$datetime->format('D')."</span>
                            <span class=' text-gray '>@</span>
                            <span class='time text-gray '>".$row["e_time"]."</span>
                        </div>
                        <div class='date-desc-wrapper'>
                            <div class='date-desc'>
                                <div class='date-title'><h4 class='heading-regular'><a href='#'>".$row["e_name"]."</a></h4></div>
                                <div class='date-excerpt'>
                                    <p>".$row["e_desc"]."</p>
                                    <p>Person Incharge: ".$row["e_pic"]."<p/>
                                </div>
                                <div class='place'>
                                    <span class='icon map-icon'></span>
                                    <span class='text-place'>".$row["e_venue"]."</span>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class='date-links register text-center'>
                            <a href='$url' class='text-regular'>REGISTER</a>
                        </div>
                        </div>
                        </div>";
                    }
                }
                else
                {
                echo "<p>No events</p>";	
                }
            ?>
                
            </div>
        </div>
        <!--end event calendar-->

        <!--begin newsletter-->
        <div class="newsletter newsletter-parallax">
            <div class="container">
                <div class="newsletter-wrapper text-center">
                    <div class="newsletter-title">
                        <h2 class="heading-light">Keep Up and Join Our Newsletter</h2>
                        <p class="text-white">Duis autem vel eum iriure dolor in hendrerit in vulputate.</p>
                    </div>
                    <form name="subscribe-form" target="_blank" class="form-inline">
                        <input type="text" class="form-control text-center form-text-light" name="EMAIL" value="" placeholder="E-mail Address" >
                        <button type="submit" class="button bnt-theme">subscribe</button>
                    </form>
                </div>
            </div>
        </div>
        <!--end newsletter-->

    </div>
    <!--End content wrapper-->
    <!--Begin footer wrapper-->
    <div class="footer-wrapper type2">
        <footer class="foooter-container">
            <div class="container">
                <div class="footer-middle">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12 animated footer-col">
                            <div class="contact-footer">
                                <div class="logo-footer">
                                    <a href="./homepage-1.html"><img src="images/logo-footer.png" alt=""></a>
                                </div>
                                <div class="contact-desc">
                                    <p class="text-light">Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare.</p>
                                </div>
                                <div class="contact-phone-email">
                                    <span class="contact-phone"><a href="#">+10872229</a> | <a href="#">+10872228 </a> </span>
                                    <span class="contact-email"><a href="#">alumni@sayidan.edu</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-12  col-xs-12 animated footer-col">
                            <div class="links-footer">
                                <div class="row">
                                    <div class="col-sm-4 col-xs-12">
                                        <h6 class="heading-bold">DASHBOARD</h6>
                                        <ul class="list-unstyled no-margin">
                                            <li><a href="./register-page.html">REGISTER</a></li>
                                            <li><a href="./career-opportunity.html">CAREER</a></li>
                                            <li><a href="./alumni-story.html">STORY</a></li>
                                            <li><a href="./alumni-directory.html">DIRECTORY</a></li>
                                        </ul>
                                    </div>
                                    
                                    <div class="col-sm-4 col-xs-12">
                                        <h6 class="heading-bold">ABOUT US</h6>
                                        <ul class="list-unstyled no-margin">
                                            <li><a href="./event-single.html">EVENTS</a></li>
                                            <li><a href="./galery.html">GALLERY</a></li>
                                            <li><a href="./homepage-1.html">HOMEPAGE V1</a></li>
                                            <li><a href="./homepage-2.html">HOMEPAGE V2</a></li>
                                        </ul>
                                    </div>
                                    
                                    <div class="col-sm-4 col-xs-12">
                                        <h6 class="heading-bold">SUPPORT</h6>
                                        <ul class="list-unstyled no-margin">
                                            <li><a href="./job-detail.html">FAQ</a></li>
                                            <li><a href="./about-us.html#contacts">CONTACT US</a></li>
                                            <li><a href="./blog.html">ORGANIZER</a></li>
                                            <li><a href="./blog-single-fullwith.html">SOCIAL</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 animated footer-col">
                            <div class="links-social">
                                <div class="login-dashboard">
                                    <a href="./login-page.html" class="bg-color-theme text-center text-regular">Login Dashboard</a>
                                </div>
                                <ul class="list-inline text-center">
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom text-center">
                    <p class="copyright text-light">©2016 Alumni Association of the University of Sayidan</p>
                </div>
            </div>
        </footer>
    </div>
    <!--End footer wrapper-->
</div>

<script src="js/libs/jquery-2.2.4.min.js"></script>
<script src="js/libs/bootstrap.min.js"></script>
<script src="js/libs/owl.carousel.min.js"></script>
<script src="js/libs/jquery.meanmenu.js"></script>
<script src="js/libs/jquery.syotimer.js"></script>
<script src="js/libs/parallax.min.js"></script>
<script src="js/libs/jquery.waypoints.min.js"></script>
<script src="js/custom/main.js"></script>
<script>
    jQuery(document).ready(function () {
        $('#time-event').syotimer({
            year: 2016,
            month: 12,
            day: 7,
            hour: 7,
            minute: 7,
        });
        });
</script>
</body>
</html>