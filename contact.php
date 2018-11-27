<!DOCTYPE html>
<html>

<head>
    <title> تواصل معنا </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- lobrary of icon  fa fa- --->


    <link rel='stylesheet' href='http://fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css' type='text/css' />
    <link rel='stylesheet' href='http://fonts.googleapis.com/earlyaccess/notokufiarabic.css' type='text/css' />
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">
    <link rel="stylesheet" href="css/layouts/custom.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/icon.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/bootstrapcontact.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="css/main-rtl.css">
    <link rel="stylesheet" href="css/logInRegister.css">


<!------ Include the above in your HEAD tag ---------->



    <link rel="shortcut icon" href="image/logo.ico" type="image/x-icon" />


    <!-------------------------------------------------------------------------->

</head>

<body>
    <div class="headerNav">
        <nav class="navbar navbar-inverse" data-offset-top="10">

            <div class="container-fluid" style="height: 56px">



                <ul class="topnav">
                    <li><a href="register.php">الإشتراك</a></li>
                    <li><a class="active" href="LogIn.php">تسجيل الدخول</a></li>
                    <li><a href="contact.php">تواصل معنا</a></li>
                    <li><a href="about.php">حولنا</a></li> >
                </ul>


            </div>
        </nav>
    </div>

    <!-- Body of register Page -->
    <div class="mainContent">
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panelTitle">تواصل معنا </h4>
                </div>
                <div class="panel-body">

                    <form action="php/contactUs.php" class="formDiv" method="post" autocomplete="on">

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                </div>
                                <input type="text" class="form-control" placeholder="اسمك" style="font-size: 15px;"required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                </div>
                                <input type="email" class="form-control" name="email" placeholder="ex: username@gmail.com"
                                     style="font-size: 15px;" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                                </div>
                                <textarea class="form-control" placeholder="أدخل نص رسالتك" style="height: 120px; font-size: 15px;" required></textarea>
                            </div>
                        </div>

                        <div class="text-center">
                            <input type="submit" value="إرسال" class="btn btn-nor-primary btn-lg enable-overlay"style="width: 125px;">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


    <!-- end of  register inputs -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/appjs/common.js"></script>

</body>

</html>
