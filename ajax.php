<?php
require_once('php/connectTosql.php');
$Eventname=$_GET["Eventname"];
$subeEventId=$_GET["subeEventId"];

if ($Eventname!=""){
$query = mysqli_query($con, "SELECT subevent_ID, nameSubEvent FROM subevent WHERE event_ID =$Eventname");/////???

while ($row = mysqli_fetch_array($query))
{
    if ($subeEventId  ==""){
        echo "<option value=' '  selected='selected' > اختيار</option>";}
    }else{

    if ($subeEventId  == $row['subevent_ID'] ) {
                   
        echo "<option value='" . $row['subevent_ID'] . "'  selected='selected' >"; echo $row["nameSubEvent"]  ; echo "</option>";}

    echo "<option value='".$row['subevent_ID']."'>";  echo $row["nameSubEvent"]  ; echo "</option>";

}// end else
}



}//end of 

   


?>