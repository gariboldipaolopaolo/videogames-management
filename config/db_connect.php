<?php

//connect to sql php db host,user,pass,db name
    $conn = mysqli_connect('localhost','paolo','1234567890','videogames_mgmt');

    //check connection
    if(!$conn){// if connected return true
        echo 'connection error: ' . mysqli_connect_error();
    }

?>