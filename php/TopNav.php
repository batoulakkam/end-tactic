<?php
include('connectTosql.php');?>
<div class ="headerNav">
               <nav class="navbar navbar-inverse"  data-offset-top="10" >
                
                <div class="container-fluid">
       
                 
                  <ul class="nav navbar-nav"   >
                    <li ><a style ="color:white" href="Logout.php" ><?php if(isset($_SESSION["OrgName"])){echo '<span class="glyphicon glyphicon-log-out"></span>    ';
						echo 'تسجيل الخروج';}
					 ?></a></li>
                       <?php if(isset($_SESSION["OrgName"])) 
                    echo '<li class="dropdown" ><a style ="color:white" href="LogIn.php" style="text-align: right" class="dropdown-toggle" data-toggle="dropdown" >'; ?>&nbsp;  <span class="caret"> </span>
					  <?php
						echo  $_SESSION["OrgName"]; ?>
					  &nbsp; <?php
					  echo '<span class=" fa fa-user"></span></a>
                      <ul class="dropdown-menu">
                        <li><a style="text-align: right" href="resetPassword.php">تعديل كلمة المرور  <span class="fa fa-lock" style="padding-left: 15px"></span> </a></li>
                        <li> <a href="#">تعديل المعلومات الشخصية <span class=" fa fa-user" style="padding-left: 10px"></span> </a></li>
                        
                      </ul>
                    </li>'; ?>
                  </ul>
                  <div class="navbar-header navbar-right  " >
                      <button class="navbar-brand titleNav fa fa-bars btn" onclick="toggleMenu()" style ="color:white"></button>
                      <a class="navbar-brand titleNav" href="#" style ="color:cornflowerblue">تكتيك</a>
                    </div>
                </div>
              </nav>
    
    
    </div>
<div>