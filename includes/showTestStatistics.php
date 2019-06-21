<?php
include_once("bootstrap.php");
Session::startSession();
$_SESSION['test_id']=$_GET['q'];
?> <script>window.alert("<?php echo "Statistics of test ". $_SESSION['test_id']." by this user will load here"; ?>")</script>
<?php
///Functions::redirect("dashboard.php");
?>