<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'trou_aux_biches_db');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$responses = [];

if (isset($_POST['name'], $_POST['email'], $_POST['message'] )) {
	// Process form data
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
    $message = htmlspecialchars($_POST['message'], ENT_QUOTES);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $responses[] = 'Email is not valid!';
    }
   
    if (!preg_match('/^[a-zA-Z]+$/', $name)) {
        $responses[] = 'First name must contain only characters!';
    }
   
    if(empty($responses)){
        
        $sql = "INSERT INTO contactus ( name, email, message) VALUES (?,?,?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_message );

            $param_name = $name;
            $param_email = $email;
            $param_message = $message;
        
            if(mysqli_stmt_execute($stmt)){
                header("location: contact.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
}

?>

<!doctype html>


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Trou Aux Biches</title>
    <link rel="shortcut icon" href="img/logo/logo.png">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS here -->
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
 
    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid p-0">
                    <div class="row align-items-center no-gutters">
                        <div class="col-xl-5 col-lg-6">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="index.html">home</a></li>
                                        <li><a href="booking.php">Booking</a></li>
                                        <li><a class="active"  href="contact.php">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo-img">
                                <a href="index.html">
                                    <img src="img/logo/logo.png" width="80" height="70" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-4 d-none d-lg-block">
                            <div class="book_room">
                                <div class="socail_links">
                                    <ul>
                                        <li>
                                            <a href="https://www.facebook.com/BeachcomberHotels">
                                                <i class="fa fa-facebook-square"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com/Beachcomber_">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                href="https://www.instagram.com/accounts/login/?next=/beachcomber_hotels/">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="book_btn d-none d-lg-block">
                                    <a href="booking.php">Book Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    <!-- bradcam_area_start -->
    <div class="bradcam_area breadcam_bg">
        <h3>Get in Touch</h3>
    </div>
    <!-- bradcam_area_end -->

    <!--contact section start -->
    <section class="contact-section">
        <div class="container">
            <div class="d-none d-sm-block mb-5 pb-4">
                <div class="mapouter">
                    <div class="mapouter">
                        <div class="gmap_canvas"><iframe width="900" height="500" id="gmap_canvas"
                                src="https://maps.google.com/maps?q=trou%20aux%20biches&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a
                                href="https://fmovies-online.net"></a><br>
                            <style>
                                .mapouter {
                                    position: relative;
                                    text-align: right;
                                    height: 500px;
                                    width: 900px;
                                }
                            </style><a href="https://www.embedgooglemap.net">how to embed google maps</a>
                            <style>
                                .gmap_canvas {
                                    overflow: hidden;
                                    background: none !important;
                                    height: 500px;
                                    width: 900px;
                                }
                            </style>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Get in Touch</h2>
                </div>
                <div class="col-lg-8">
                    <form action="contact.php" method="post">
                        <div class="elem-group">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" placeholder="John Doe"
                                pattern=[A-Z\sa-z]{3,20} required>
                        </div>
                        <div class="elem-group">
                            <label for="email">Your E-mail</label>
                            <input type="email" id="email" name="email" placeholder="john.doe@email.com"
                                required>
                        </div>

                        <div class="elem-group">
                            <label for="message">Write your message</label>
                            <textarea id="message" name="message" placeholder="Say whatever you want."
                                required></textarea>
                        </div>
                        <button type="submit">Send Message</button>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="fa fa-building"></i></span>
                        <div class="media-body">
                            <h3>Trou aux Biches, Mauritius.</h3>
                            <p>ROYAL ROAD, TRIOLET 22302</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="fa fa-phone-square"></i></span>
                        <div class="media-body">
                            <h3>(+230) 204 6800</h3>
                            <p>Mon to Sun 9am to 6pm</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="fa fa-envelope"></i></span>
                        <div class=" media-body">
                            <h3>trouauxbiches.com</h3>
                            <p>Send us your query anytime!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact section end -->

    <!-- footer -->
    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                address
                            </h3>
                            <p class="footer_text"> ROYAL ROAD - TROU AUX BICHES<br> TRIOLET 22302<br> MAURITIUS</p>
                            <a href="#" class="line-button">Get Direction</a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Reservation
                            </h3>
                            <p class="footer_text">(+230) 204 6800 <br>
                                trouauxbiches.com</p>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-2">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Navigation
                            </h3>
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li><a href="booking.php">Rooms</a></li>
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Newsletter
                            </h3>
                            <form action="#" class="newsletter_form">
                                <input type="text" placeholder="Enter your mail">
                                <button type="submit">Sign Up</button>
                            </form>
                            <p class="newsletter_text">Subscribe newsletter to get updates</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right_text">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">

                    <div class="col-xl-4 col-md-5 col-lg-3">
                        <div class="socail_links">
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/BeachcomberHotels">
                                        <i class="fa fa-facebook-square"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/Beachcomber_">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/accounts/login/?next=/beachcomber_hotels/">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer_end -->


    <!-- JS here -->

    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>

    <script src="js/main.js"></script>



</body>

</html>