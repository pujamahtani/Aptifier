<?php
include_once('../classes/User.php');
include_once('../classes/Functions.php');
$obj=new User();
$obj->user_logout();
Functions::redirect('login.php');
?>