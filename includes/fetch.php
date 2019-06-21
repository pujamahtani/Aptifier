    <?php
        include_once("bootstrap.php");
    ?>
   <?php
    
    $test = new Test();
    
    $result = $test->getChapterBySubject($_POST['subject_id']);

    $result = mysqli_fetch_all($result);
    
    echo json_encode($result);


?>