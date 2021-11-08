<?php

    include "config.php";
    session_start();
    if(!$_SESSION['id'])
    {
    include "config.php";
    header("Location: {$host}");
    }


    if(isset($_POST['ctd']))
    {
        $id = $_POST['ctd'];
        $sql1 = "SELECT image FROM carousel WHERE user_id = {$id}";
        $result  = mysqli_query($conn,$sql1);
        $row = mysqli_fetch_assoc($result);
    
        unlink("../upload/{$row['carousel']}");

        $sql = "DELETE FROM carousel WHERE carousel_id = {$id}";
        if(mysqli_query($conn,$sql))
            echo "1";
        else
            echo "0";
    }else
    {
        echo "0";
    }

?>