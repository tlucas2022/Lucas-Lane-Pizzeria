<?php

 //Start Session
    ob_start();
    session_start();

        //connect to database          
        $conn = new mysqli("lucas-lane.c2nbqnphldvm.us-east-1.rds.amazonaws.com","admin","LucasLane2022!","lucas_lane");
        if($conn->connect_error){
                die("Connection Failed!".$conn->connect_error);
        }

?>
