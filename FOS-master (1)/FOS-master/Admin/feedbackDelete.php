<?php
    include "../Database/database.php";

    $proId = $_GET['proId'];


        $sql="delete from feedback where fid='$proId'";
        $conn->query($sql);
    
        header("location:./feedback.php");


?>