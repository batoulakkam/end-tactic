<?php

require_once('connectTosql.php');
 unset( $_SESSION['organizerID']);
unset( $_SESSION['OrgName']);
unset( $_SESSION['orgEmail']);
unset( $_SESSION['password']);
unset( $_SESSION['emailconfirm']);

header("Location: ../login.php");
?>
