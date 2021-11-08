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
            
            $sql = "DELETE FROM videos WHERE video_id = {$id}";
            if(mysqli_query($conn,$sql))
            echo "1";
            else
            echo "0";
        }else
        {
            echo "0";
        }

?>