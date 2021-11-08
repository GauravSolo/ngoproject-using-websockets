<?php

        include "config.php";
        session_start();
        if(!$_SESSION['id'])
        {
        include "config.php";
        header("Location: {$host}");
        }


            $sql = "DELETE FROM sitedata";
            if(mysqli_query($conn,$sql))
            echo "1";
            else
            echo "0";


?>