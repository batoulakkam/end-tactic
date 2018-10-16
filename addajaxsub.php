<?php
require_once 'php/connectTosql.php';
$eventId = $_GET["eventId"];
//$subeEventId=$_GET["subeEventId"];// why subeEventId and why u add all of this page if u have any var useless you have to delete try to clean ur code

if ($eventId != "") {
 $query = mysqli_query($con, "SELECT subevent_ID, nameSubEvent FROM subevent WHERE event_ID =$eventId");

 $users_arr = array();
 while ($row = mysqli_fetch_array($query)) {
  $subeventId   = $row['subevent_ID'];
  $subEventName = $row['nameSubEvent'];

  $users_arr[] = array("subeventId" => $subeventId, "subEventName" => $subEventName);
 }
 echo json_encode($users_arr);
 exit;

} //end of
