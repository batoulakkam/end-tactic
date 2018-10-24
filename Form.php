<?php
include('php/connectTosql.php');
if (isset($_GET['token'])) {
    $token      = $_GET['token'];
    $query      = mysqli_query($con, "SELECT * FROM registration_form WHERE token = '$token'");
    $field[]    = "";
    $choied[]   = "";
    $requierd[] = "";
    $index      = 0;
    $eventID    = "";
    $masg       = "";
    while ($row = mysqli_fetch_array($query)) {
        $eventID          = $row['event_ID'];
        $field[$index]    = $row['name_of_field'];
        $choied[$index]   = $row['selected_field'];
        $requierd[$index] = $row['required_field'];
        $Optional[$index] = $row['optional'];
        $index++;
    } //$row = mysqli_fetch_array($query)
    $length    = count($field);
    $query2    = mysqli_query($con, "SELECT name_Event ,descrption_Event  FROM event WHERE event_ID = '$eventID'");
    $row2      = mysqli_fetch_array($query2);
    $eventName = $row2['name_Event'];
    $eventDis  = $row2['descrption_Event'];
} //isset($_GET['token'])
$name        = "";
$email       = "";
$phone       = "";
$age         = "";
$gender      = "";
$ID          = "";
$job         = "";
$edu         = "";
$VIP         = "";
$nationality = "";
$optional    = "";
if (isset($_POST['register'])) {
    $name  = $_POST['nameAttendee'];
    $email = $_POST['emailAttendee'];
    $sql = mysqli_query($con, "SELECT Attendee_ID FROM attendee WHERE email_Att ='$email' ") or die(mysqli_error($con));
    if (mysqli_num_rows($sql) > 0) {
        $masg = " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> حدث خطأ </strong> البريد الالكتروني الذي تحاول التسجيل به موجود مسبقا
       </div> ";
    } //mysqli_num_rows($sql) > 0
    else {
        if (isset($_POST['phoneAttendee']))
            $phone = $_POST['phoneAttendee'];
        if (isset($_POST['ageAttendee']))
            $age = $_POST['ageAttendee'];
        if (isset($_POST['gender_Att']))
            $gender = $_POST['gender_Att'];
        if (isset($_POST['IDAttendee']))
            $ID = $_POST['IDAttendee'];
        if (isset($_POST['jobAttendee']))
            $job = $_POST['jobAttendee'];
        if (isset($_POST['eduAttendee']))
            $edu = $_POST['eduAttendee'];
        if (isset($_POST['VIPAttendee']))
            $VIP = $_POST['VIPAttendee'];
        if (isset($_POST['natiAttendee']))
            $natiAttendee = $_POST['natiAttendee'];
        if (isset($_POST['optional']))
            $optional = $_POST['optional'];
        $sql = mysqli_query($con, "SELECT VIPCode FROM event WHERE event_ID = '$eventID' ") or die(mysqli_error($con));
        $rows = mysqli_fetch_array($sql);
        if ($VIP != $rows['VIPCode'] && $VIP != '') {
            $masg = " <div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
         <strong> حدث خطأ </strong> كود الاشخاص المهمين الذي أدخلته غير صحيح 
       </div> ";
        } //$VIP != $rows['VIPCode'] && $VIP != ''
        else {
            if ($VIP == $rows['VIPCode'] || $VIP == "") {
                $sql = mysqli_query($con, "INSERT INTO attendee (Attendee_ID,email_Att, name_Att,phone_Att, DOB_Att ,gender_Att,eductional_Level,career_Att,nationality_Att,national_ID_Att,VIP_code,optional,form,    event_ID) VALUES ('','$email','$name','$phone','$age','$gender','$edu','$job','$natiAttendee','$ID','$VIP','$optional','$token','$eventID' )") or die(mysqli_error($con));
                if ($sql) {
                    $query3 = mysqli_query($con, "SELECT MAX(Attendee_ID) FROM attendee") or die(mysqli_error($con));
                    $rowID      = mysqli_fetch_array($query3);
                    $attendeeID = $rowID['0'];
                    header("location:confirmRegisterEvent.php?attendeeID=$attendeeID");
                } //$sql
            } //$VIP == $rows['VIPCode'] || $VIP == ""
        }
    }
} //isset($_POST['register'])
?>
<!DOCTYPE html>
<html lang="ar">
   <head>
      <title>نموذج التسجيل  </title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href='http://fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css' rel='stylesheet' type='text/css' />
      <link href='http://fonts.googleapis.com/earlyaccess/notokufiarabic.css' rel='stylesheet' type='text/css' />
      <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">
      <link rel="stylesheet" href="css/layouts/custom.css">
      <link rel="stylesheet" href="css/font-awesome.min.css">
      <link rel="stylesheet" href="css/icon.css">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/main-rtl.css">
      <link rel="shortcut icon" href="image/logo.ico" type="image/x-icon" />
   </head>
   <body>
      <div class="mainContent">
      <div class="container">
      <div class="panel panel-primary">
      <div class="panel-heading">
         <h4 class="panelTitle"> التسجيل في <?php echo $eventName; ?> </h4>
      </div>
      <div class="panel-body">
      <h4><?php echo $eventDis; ?></h4>
      <form action=""  id="formDiv" method="post">
      <?php  if ($masg !="") echo $masg."<br>"; ?>
      <div class="col-md-12">
         <div class="form-group form-group-lg">
            <label  class="control-label"> الاسم</label><label style="color:red">*&nbsp; </label>
            <input type="text" class="form-control" id="nameAttende" name="nameAttendee"  >
         </div>
      </div>
      <div class="col-md-12">
         <div class="form-group form-group-lg">
            <label  class="control-label"> البريد الالكتروني</label><label style="color:red">*&nbsp; </label>
            <input type="email" id="emailAttende" name="emailAttendee" class="form-control" >
         </div>
      </div>
			<?php
				  for ($x = 2; $x < $length; $x++) {
					if ($field[$x] == 'الهاتف' && $requierd[$x] == 1) {
						echo '<div class="col-md-12">
												<div class="form-group form-group-lg">
												<label  class="control-label"> رقم الهاتف</label><label style="color:red">*&nbsp; </label>
												<input type="text" class="form-control" id="phoneAttende"  name="phoneAttendee">
												</div>
												</div>';
					} //$field[$x] == 'الهاتف' && $requierd[$x] == 1
					else {
						if ($field[$x] == 'الهاتف') {
							echo '<div class="col-md-12">
													<div class="form-group form-group-lg">
													<label  class="control-label"> رقم الهاتف</label>
													<input type="text" class="form-control" id="txtPhone"  name="phoneAttendee">
													</div>
													</div>';
						} //$field[$x] == 'الهاتف'
					} //end else 
					if ($field[$x] == 'العمر' && $requierd[$x] == 1) {
						echo '<div class="col-md-12">
													<div class="form-group form-group-lg">
													<label  class="control-label"> العمر</label><label style="color:red">*&nbsp; </label>
													<input type="date" required class="form-control" id="ageAttende"  name="ageAttendee" 
													value="1995-12-29"  >
														</div>
															</div>';
						break;
					} //$field[$x] == 'العمر' && $requierd[$x] == 1
					else {
						if ($field[$x] == 'العمر') {
							echo '<div class="col-md-12">
														<div class="form-group form-group-lg">
														<label for="eventName" class="control-label"> العمر</label>
														<input type="date" class="form-control" id="txtage"  name="ageAttendee" value="1995-12-29">
														</div>
														</div>';
						} //$field[$x] == 'العمر'
					} //end else 
					if ($field[$x] == 'الجنس' && $requierd[$x] == 1) {
						echo '<div class="col-md-12">
												<div class="form-group form-group-lg ">
												<label class="control-label form-check" >الجنس :</label><label style="color:red">*&nbsp; </label>
												<section class="form-control" style="height:70px" >
												<div class="form-check">
												<input class="form-check-input" type="radio" name="gender_Att" id="gender_At" value="انثى" >
												<label class="form-check-label" for="gridRadios1">
													انثى
												</label>    
												</div>
												<div class="form-check">
												<input class="form-check-input" type="radio" name="gender_Att" id="gender_At" value="ذكر" >
												<label class="form-check-label" for="gridRadios1">
													ذكر
												</label>
												</div>
												</section>
														</div>
														</div>';
					} //$field[$x] == 'الجنس' && $requierd[$x] == 1
					else {
						if ($field[$x] == 'الجنس') {
							echo '<div class="col-md-12">
								  <div class="form-group form-group-lg ">
									<label class="control-label form-check" >الجنس :</label>
									<section class="form-control" style="height:70px" >
									<div class="form-check">
								   <input class="form-check-input" type="radio" name="gender_Att" id="inlineRadio3" value="انثى" checked>
								  <label class="form-check-label" for="gridRadios1">انثى</label>    
								  </div>
								  <div class="form-check">
								  <input class="form-check-input" type="radio" name="gender_Att" id="inlineRadio3" value="ذكر" >
								  <label class="form-check-label" for="gridRadios1">    ذكر</label>
								   </div>
								  </section>
								   </div>
								  </div>';
						} //$field[$x] == 'الجنس'
					} //end else 
					if ($field[$x] == 'التعليم' && $requierd[$x] == 1) {
						echo '
							<div class="col-md-12">
								<div class="form-group form-group-lg">
									<label class="control-label"> مستوى التعليم</label><label style="color:red">*&nbsp; </label>
										<select id="eduAttende" name="eduAttendee" class="form-control" oninvalid="this.setCustomValidity("هذا الحقل مطلوب يرجى اختيار مستوى التعليم")>
										<option value= "غير متعلم" >غير متعلم</option>
										<option value="ثانوي" >ثانوي</option>
										<option value="بكالوريوس" >بكالوريوس</option>
										<option value="ماستر" >ماستر</option>
										<option value="دكتواه" >دكتواه</option>

										</select>
									</div>
									</div>';
					} //$field[$x] == 'التعليم' && $requierd[$x] == 1
					else {
						if ($field[$x] == 'التعليم') {
							echo '
									 <div class="col-md-12">
									<div class="form-group form-group-lg">
									<label  class="control-label"> مستوى التعليم</label>
									<select id="education" name="eduAttendee" class="form-control">
										<option value= "غير متعلم" >غير متعلم</option>
										<option value="ثانوي" >ثانوي</option>
										<option value="بكالوريوس" >بكالوريوس</option>
										<option value="ماستر" >ماستر</option>
										<option value="دكتواه" >دكتواه</option>

									</select>
									</div>
									</div>';
						} //$field[$x] == 'التعليم'
					} //end else 
					if ($field[$x] == 'المهنة' && $requierd[$x] == 1) {
						echo '
							  <div class="col-md-12">
							<div class="form-group form-group-lg">
							 <label class="control-label"> المهنة</label> <label style="color:red">*&nbsp; </label>
							 <input type="text" class="form-control" id="jobAttende"  name="jobAttendee"
								  >
							  </div>
							</div>';
					} //$field[$x] == 'المهنة' && $requierd[$x] == 1
					else {
						if ($field[$x] == 'المهنة') {
							echo '
							  <div class="col-md-12">
							<div class="form-group form-group-lg">
							 <label  class="control-label"> المهنة</label>
							 <input type="text" class="form-control" id="txtjob"  name="jobAttendee">
							  </div>
							</div>';
						} //$field[$x] == 'المهنة'
					} //end else 
					if ($field[$x] == 'الجنسية') {
						echo '<div class="col-md-12">
							<div class="form-group form-group-lg">  
							<label class="control-label">الجنسية</label>
						   <select id="natiAttende" name="natiAttendee" class="form-control">
									<option value="AW">آروبا</option>
									<option value="AZ">أذربيجان</option>
									<option value="AM">أرمينيا</option>
									<option value="ES">أسبانيا</option>
									<option value="AU">أستراليا</option>
									<option value="AF">أفغانستان</option>
									<option value="AL">ألبانيا</option>
									<option value="DE">ألمانيا</option>
									<option value="AG">أنتيجوا وبربودا</option>
									<option value="AO">أنجولا</option>
									<option value="AI">أنجويلا</option>
									<option value="AD">أندورا</option>
									<option value="UY">أورجواي</option>
									<option value="UZ">أوزبكستان</option>
									<option value="UG">أوغندا</option>
									<option value="UA">أوكرانيا</option>
									<option value="IE">أيرلندا</option>
									<option value="IS">أيسلندا</option>
									<option value="ET">اثيوبيا</option>
									<option value="ER">اريتريا</option>
									<option value="EE">استونيا</option>
									<option value="IL">اسرائيل</option>
									<option value="AR">الأرجنتين</option>
									<option value="JO">الأردن</option>
									<option value="EC">الاكوادور</option>
									<option value="AE">الامارات العربية المتحدة</option>
									<option value="BS">الباهاما</option>
									<option value="BH">البحرين</option>
									<option value="BR">البرازيل</option>
									<option value="PT">البرتغال</option>
									<option value="BA">البوسنة والهرسك</option>
									<option value="GA">الجابون</option>
									<option value="ME">الجبل الأسود</option>
									<option value="DZ">الجزائر</option>
									<option value="DK">الدانمرك</option>
									<option value="CV">الرأس الأخضر</option>
									<option value="SV">السلفادور</option>
									<option value="SN">السنغال</option>
									<option value="SD">السودان</option>
									<option value="SE">السويد</option>
									<option value="EH">الصحراء الغربية</option>
									<option value="SO">الصومال</option>
									<option value="CN">الصين</option>
									<option value="IQ">العراق</option>
									<option value="VA">الفاتيكان</option>
									<option value="PH">الفيلبين</option>
									<option value="AQ">القطب الجنوبي</option>
									<option value="CM">الكاميرون</option>
									<option value="CG">الكونغو - برازافيل</option>
									<option value="KW">الكويت</option>
									<option value="HU">المجر</option>
									<option value="IO">المحيط الهندي البريطاني</option>
									<option value="MA">المغرب</option>
									<option value="TF">المقاطعات الجنوبية الفرنسية</option>
									<option value="MX">المكسيك</option>
									<option value="SA">المملكة العربية السعودية</option>
									<option value="GB">المملكة المتحدة</option>
									<option value="NO">النرويج</option>
									<option value="AT">النمسا</option>
									<option value="NE">النيجر</option>
									<option value="IN">الهند</option>
									<option value="US">الولايات المتحدة الأمريكية</option>
									<option value="JP">اليابان</option>
									<option value="YE">اليمن</option>
									<option value="GR">اليونان</option>
									<option value="ID">اندونيسيا</option>
									<option value="IR">ايران</option>
									<option value="IT">ايطاليا</option>
									<option value="PG">بابوا غينيا الجديدة</option>
									<option value="PY">باراجواي</option>
									<option value="PK">باكستان</option>
									<option value="PW">بالاو</option>
									<option value="BW">بتسوانا</option>
									<option value="PN">بتكايرن</option>
									<option value="BB">بربادوس</option>
									<option value="BM">برمودا</option>
									<option value="BN">بروناي</option>
									<option value="BE">بلجيكا</option>
									<option value="BG">بلغاريا</option>
									<option value="BZ">بليز</option>
									<option value="BD">بنجلاديش</option>
									<option value="PA">بنما</option>
									<option value="BJ">بنين</option>
									<option value="BT">بوتان</option>
									<option value="PR">بورتوريكو</option>
									<option value="BF">بوركينا فاسو</option>
									<option value="BI">بوروندي</option>
									<option value="PL">بولندا</option>
									<option value="BO">بوليفيا</option>
									<option value="PF">بولينيزيا الفرنسية</option>
									<option value="PE">بيرو</option>
									<option value="TZ">تانزانيا</option>
									<option value="TH">تايلند</option>
									<option value="TW">تايوان</option>
									<option value="TM">تركمانستان</option>
									<option value="TR">تركيا</option>
									<option value="TT">ترينيداد وتوباغو</option>
									<option value="TD">تشاد</option>
									<option value="TG">توجو</option>
									<option value="TV">توفالو</option>
									<option value="TK">توكيلو</option>
									<option value="TO">تونجا</option>
									<option value="TN">تونس</option>
									<option value="TL">تيمور الشرقية</option>
									<option value="JM">جامايكا</option>
									<option value="GI">جبل طارق</option>
									<option value="GD">جرينادا</option>
									<option value="GL">جرينلاند</option>
									<option value="AX">جزر أولان</option>
									<option value="AN">جزر الأنتيل الهولندية</option>
									<option value="TC">جزر الترك وجايكوس</option>
									<option value="KM">جزر القمر</option>
									<option value="KY">جزر الكايمن</option>
									<option value="MH">جزر المارشال</option>
									<option value="MV">جزر الملديف</option>
									<option value="UM">جزر الولايات المتحدة البعيدة الصغيرة</option>
									<option value="SB">جزر سليمان</option>
									<option value="FO">جزر فارو</option>
									<option value="VI">جزر فرجين الأمريكية</option>
									<option value="VG">جزر فرجين البريطانية</option>
									<option value="FK">جزر فوكلاند</option>
									<option value="CK">جزر كوك</option>
									<option value="CC">جزر كوكوس</option>
									<option value="MP">جزر ماريانا الشمالية</option>
									<option value="WF">جزر والس وفوتونا</option>
									<option value="CX">جزيرة الكريسماس</option>
									<option value="BV">جزيرة بوفيه</option>
									<option value="IM">جزيرة مان</option>
									<option value="NF">جزيرة نورفوك</option>
									<option value="HM">جزيرة هيرد وماكدونالد</option>
									<option value="CF">جمهورية افريقيا الوسطى</option>
									<option value="CZ">جمهورية التشيك</option>
									<option value="DO">جمهورية الدومينيك</option>
									<option value="CD">جمهورية الكونغو الديمقراطية</option>
									<option value="ZA">جمهورية جنوب افريقيا</option>
									<option value="GT">جواتيمالا</option>
									<option value="GP">جوادلوب</option>
									<option value="GU">جوام</option>
									<option value="GE">جورجيا</option>
									<option value="GS">جورجيا الجنوبية وجزر ساندويتش الجنوبية</option>
									<option value="DJ">جيبوتي</option>
									<option value="JE">جيرسي</option>
									<option value="DM">دومينيكا</option>
									<option value="RW">رواندا</option>
									<option value="RU">روسيا</option>
									<option value="BY">روسيا البيضاء</option>
									<option value="RO">رومانيا</option>
									<option value="RE">روينيون</option>
									<option value="ZM">زامبيا</option>
									<option value="ZW">زيمبابوي</option>
									<option value="CI">ساحل العاج</option>
									<option value="WS">ساموا</option>
									<option value="AS">ساموا الأمريكية</option>
									<option value="SM">سان مارينو</option>
									<option value="PM">سانت بيير وميكولون</option>
									<option value="VC">سانت فنسنت وغرنادين</option>
									<option value="KN">سانت كيتس ونيفيس</option>
									<option value="LC">سانت لوسيا</option>
									<option value="MF">سانت مارتين</option>
									<option value="SH">سانت هيلنا</option>
									<option value="ST">ساو تومي وبرينسيبي</option>
									<option value="LK">سريلانكا</option>
									<option value="SJ">سفالبارد وجان مايان</option>
									<option value="SK">سلوفاكيا</option>
									<option value="SI">سلوفينيا</option>
									<option value="SG">سنغافورة</option>
									<option value="SZ">سوازيلاند</option>
									<option value="SY">سوريا</option>
									<option value="SR">سورينام</option>
									<option value="CH">سويسرا</option>
									<option value="SL">سيراليون</option>
									<option value="SC">سيشل</option>
									<option value="CL">شيلي</option>
									<option value="RS">صربيا</option>
									<option value="CS">صربيا والجبل الأسود</option>
									<option value="TJ">طاجكستان</option>
									<option value="OM">عمان</option>
									<option value="GM">غامبيا</option>
									<option value="GH">غانا</option>
									<option value="GF">غويانا</option>
									<option value="GY">غيانا</option>
									<option value="GN">غينيا</option>
									<option value="GQ">غينيا الاستوائية</option>
									<option value="GW">غينيا بيساو</option>
									<option value="VU">فانواتو</option>
									<option value="FR">فرنسا</option>
									<option value="PS">فلسطين</option>
									<option value="VE">فنزويلا</option>
									<option value="FI">فنلندا</option>
									<option value="VN">فيتنام</option>
									<option value="FJ">فيجي</option>
									<option value="CY">قبرص</option>
									<option value="KG">قرغيزستان</option>
									<option value="QA">قطر</option>
									<option value="KZ">كازاخستان</option>
									<option value="NC">كاليدونيا الجديدة</option>
									<option value="HR">كرواتيا</option>
									<option value="KH">كمبوديا</option>
									<option value="CA">كندا</option>
									<option value="CU">كوبا</option>
									<option value="KR">كوريا الجنوبية</option>
									<option value="KP">كوريا الشمالية</option>
									<option value="CR">كوستاريكا</option>
									<option value="CO">كولومبيا</option>
									<option value="KI">كيريباتي</option>
									<option value="KE">كينيا</option>
									<option value="LV">لاتفيا</option>
									<option value="LA">لاوس</option>
									<option value="LB">لبنان</option>
									<option value="LU">لوكسمبورج</option>
									<option value="LY">ليبيا</option>
									<option value="LR">ليبيريا</option>
									<option value="LT">ليتوانيا</option>
									<option value="LI">ليختنشتاين</option>
									<option value="LS">ليسوتو</option>
									<option value="MQ">مارتينيك</option>
									<option value="MO">ماكاو الصينية</option>
									<option value="MT">مالطا</option>
									<option value="ML">مالي</option>
									<option value="MY">ماليزيا</option>
									<option value="YT">مايوت</option>
									<option value="MG">مدغشقر</option>
									<option value="EG">مصر</option>
									<option value="MK">مقدونيا</option>
									<option value="MW">ملاوي</option>
									<option value="ZZ">منطقة غير معرفة</option>
									<option value="MN">منغوليا</option>
									<option value="MR">موريتانيا</option>
									<option value="MU">موريشيوس</option>
									<option value="MZ">موزمبيق</option>
									<option value="MD">مولدافيا</option>
									<option value="MC">موناكو</option>
									<option value="MS">مونتسرات</option>
									<option value="MM">ميانمار</option>
									<option value="FM">ميكرونيزيا</option>
									<option value="NA">ناميبيا</option>
									<option value="NR">نورو</option>
									<option value="NP">نيبال</option>
									<option value="NG">نيجيريا</option>
									<option value="NI">نيكاراجوا</option>
									<option value="NZ">نيوزيلاندا</option>
									<option value="NU">نيوي</option>
									<option value="HT">هايتي</option>
									<option value="HN">هندوراس</option>
									<option value="NL">هولندا</option>
									<option value="HK">هونج كونج الصينية</option>
							 </select>
							 </div>
							</div>';
					} //$field[$x] == 'الجنسية'
					//حطيت الطول لان بدي شوف اخر عنصر اذا ريكوايرد لو 
					if ($field[$x] == 'الهوية' && $requierd[$length - 1] == 1) {
						echo '
								<div class="col-md-12">
								<div class="form-group form-group-lg">
								 <label class="control-label">رقم الهوية</label> <label style="color:red">*&nbsp; </label>
								 <input type="text" class="form-control" id="IDAttende"  name="IDAttendee"
									 >
								  </div>
								</div>';
					} //$field[$x] == 'الهوية' && $requierd[$length - 1] == 1
					else {
						if ($field[$x] == 'الهوية') {
							echo '
									<div class="col-md-12">
									<div class="form-group form-group-lg">
									 <label class="control-label">رقم الهوية</label>
									 <input type="text" class="form-control"   name="IDAttendee">
									  </div>
									</div>';
						} //$field[$x] == 'الهوية'
					} //end else 
					if ($field[$x] == 'الاشخاص المهمة' && $requierd[$x] == 1) {
						echo '
							<div class="col-md-12">
							<div class="form-group form-group-lg">
							 <label class="control-label">كود الاشخاص المهمين</label><label style="color:red">*&nbsp; </label>
							 <input type="text" class="form-control" id="txtVIPAttendee"  name="VIPAttendee">
							  </div>
							</div>';
					} //$field[$x] == 'الاشخاص المهمة' && $requierd[$x] == 1
					else {
						if ($field[$x] == 'الاشخاص المهمة') {
							echo '
							<div class="col-md-12">
							<div class="form-group form-group-lg">
							 <label  class="control-label">كود الاشخاص المهمين</label>
							 <input type="text" class="form-control"   name="VIPAttendee"
								  >
							  </div>
							</div>';
						} //$field[$x] == 'الاشخاص المهمة'
					} //end else 
					if ($Optional[$x] == 1 && $requierd[$x] == 1) {
						echo '
										<div class="col-md-12">
										<div class="form-group form-group-lg">
										<label for="eventName" class="control-label">' . $field[$x] . '</label><label style="color:red">*&nbsp; </label>
										<input type="text" class="form-control" id="optional"  name="optional">
										</div>
										</div>';
					} //$Optional[$x] == 1 && $requierd[$x] == 1
					else {
						if ($Optional[$x] == 1)
							echo '
										<div class="col-md-12">
										<div class="form-group form-group-lg">
										<label for="eventName" class="control-label">' . $field[$x] . '</label>
										<input type="text" class="form-control" id="optional"  name="optional">
										</div>
										</div>';
					}
				} // end for
			 ?>
 <input type="submit" value="التسجيل" name="register" class="btn btn-nor-primary btn-lg enable-overlay">
                  </form>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>