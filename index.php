<?php
require_once 'php/connectTosql.php';
// this section for get the event name fro DB
$date = date('Y-m-d');

$sql   = "SELECT * FROM event  where (eventLink !=''  and endDate_Event >= '$date')  ORDER by sartDate_Event  DESC LIMIT 10  ";
$query = mysqli_query($con, $sql) or die(mysqli_error());
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <title>تكتيك</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Conference project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="styles/responsive.css">
</head>

<body>

    <div class="super_container">

        <!-- Home -->

        <div class="home">
            <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="imagesIndex/index.jpg" data-speed="0.8"></div>

            <!-- Header -->

            <header class="header" id="header">
                <div>
                    <div class="header_top">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="header_top_content d-flex flex-row align-items-center justify-content-start">
                                        <div>
                                            <a href="#">
                                                <div class="logo_container d-flex flex-row align-items-start justify-content-start">
                                                    <div class="logo_image">
                                                        <div><img src="imagesIndex/logo.png" alt=""></div>
                                                    </div>
                                                    <div class="logo_content">
                                                        <div id="logo_text" class="logo_text ">تكتيك</div>
                                                        <div class="logo_sub">2018 - لتنظيم الفعاليات</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="header_social ml-autoright">
                                            <ul>
                                                <li><a href="LogIn.php"><i  aria-hidden="true"></i>تسجيل الدخول</a></li>
                                                <li><a href="register.php"><i aria-hidden="true"></i>الإشتراك</a></li>
                                            </ul>
                                        </div>
                                        <div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header_nav" id="header_nav_pin">
                        <div class="header_nav_inner">
                            <div class="header_nav_container">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <div class="header_nav_content d-flex flex-row align-items-center justify-content-start">
                                                <nav class="main_nav">
                                                    <ul>
                                                        <li class="active"><a href="index.html">الرئيسية</a></li>
                                                        <li><a href="aboutUs.php">حولنا</a></li>
                                                        <li><a href="contactUs.php">تواصل معنا</a></li>
                                                    </ul>
                                                </nav>
                                                <div class="header_extra ml-auto">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </header>

            <div class="home_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content">
                                <div class="home_date">2018</div>
                                <div class="home_title">تكتيك لتنظيم الفعاليات</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Intro -->

        <div class="intro">
            <div class="intro_content d-flex flex-row flex-wrap align-items-start justify-content-between"style="width:600px;height: 300px">

                <!-- Intro Item -->

							<?php
while ($row = mysqli_fetch_array($query)) {
 $eventId = $row['event_ID'];
 $badgeID = "";
 $sqBadge = mysqli_query($con, "SELECT badge_ID FROM badge  WHERE  event_ID = '$eventId' ") or die(mysqli_error($con));
 $rows    = mysqli_fetch_array($sqBadge);
 $badgeID = $rows['badge_ID'];
 if ($badgeID != "") {
  echo "<div class='intro_item'>
	                    <div class='intro_image'><img width='301px' height='200px' src=" . $row["templateLocation"] . " alt=''></div>
	                    <div class='intro_body'>
	                        <div class='intro_title'><a href=" . $row[7] . ">" . $row["name_Event"] . "</a></div>
                            <div class='intro_subtitle'>" . $row["endDate_Event"] . ' تاريخ نهاية الحدث ' . "</div>
                            <div class='intro_subtitle'>" . $row["sartDate_Event"] . ' تاريخ بداية الحدث ' . "</div>

                            </div>
                    </div>";
 }
}
?>

                    </div>
                </div>


    </div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="styles/bootstrap4/popper.js"></script>
    <script src="styles/bootstrap4/bootstrap.min.js"></script>
    <script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="plugins/easing/easing.js"></script>
    <script src="plugins/parallax-js-master/parallax.min.js"></script>
    <script src="js/appjs/customIndex.js"></script>
</body>

</html>