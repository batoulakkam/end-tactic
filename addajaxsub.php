<?php
require_once('php/connectTosql.php');
$Eventname=$_GET["Eventname"];
$subeEventId=$_GET["subeEventId"];

if ($Eventname!=""){
$query = mysqli_query($con, "SELECT subevent_ID, nameSubEvent FROM subevent WHERE event_ID =$Eventname");/////???
echo "<option value=' '  selected='selected' > اختيار</option>";
while ($row = mysqli_fetch_array($query))
{
    
    echo "<option value='".$row['subevent_ID']."'>";  echo $row["nameSubEvent"]  ; echo "</option>";

}



}//end of 

   


?>