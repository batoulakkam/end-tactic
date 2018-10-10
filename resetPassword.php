  <?php
   $masg="";
    if(isset($_GET['sent'] )){
	if ($_GET['sent'] = true)
       $masg= " <div class='alert alert-success alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> تم </strong>  تم ارسال رسالة على بريدك الالكتروني لتغير كلمة المرور
       </div> ";
   else    
	   $masg= " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> فشل</strong>  يرجى التحقق من البريد الالكتروني
       </div> ";}
    
                
    
      ?>
<!DOCTYPE html>
<html>
<head>
<title> استعادة كلمة المرور </title>	
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
  <link rel="stylesheet" href="css/main-rtl.css">

  <link rel="shortcut icon" href="image/logo.ico" type="image/x-icon" />


  <!-------------------------------------------------------------------------->

</head>

<body>
<div class ="headerNav">
               <nav class="navbar navbar-inverse"  data-offset-top="10">
                
                <div class="container-fluid">
       
                 
              
                      <ul class="topnav">
					<a class="navbar-brand titleNav" href="#" style ="color:cornflowerblue;float:right;">تكتيك</a>
                    <li><a  href="register.php" >الإشتراك</a></li>
                    <li><a class="active" href="LogIn.php">تسجيل الدخول</a></li>
                    <li><a href="#contact">تواصل معنا</a></li>
                    <li><a href="#about">حولنا</a></li> >         
                          </ul>
						  

                </div>
              </nav>
    </div>

	 <!-- Body of register Page -->
 <div class="mainContent">
    <div class="container">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h4 class="panelTitle">استعادة كلمة المرور  </h4>
        </div>
        <div class="panel-body">

          <form action="php/resetPassword.php" class="formDiv" method="post"autocomplete="on">     
            
            <?php  if ($masg !="") echo $masg."<br>"; ?>
           <div class="col-md-12">
              <div class="form-group form-group-lg">
                <label class="control-label">  البريد الإلكتروني: </label><label style="color:red">*&nbsp; </label>
  				<input type="email" class="form-control" id="email" name="Email" placeholder="أدخل بريدك الإلكتروني" autocomplete="on"  required >
 	 </div>
      </div>
			   <input type="submit" value="استعادة" name="submit_email" class="btn btn-nor-primary btn-lg enable-overlay">
               
        
       
        </form>

      </div>
    </div>
  </div>
  </div>
 

  <!-- end of  register inputs -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/appjs/event.js"></script>
  <script src="js/appjs/common.js"></script>

</body>

</html>
