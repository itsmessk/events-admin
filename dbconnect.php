<?php
    $servername='localhost';
    $username='root';
    $password='';
    $dbname='alumni_portal';
    $con=mysqli_connect($servername,$username,$password,$dbname);
    if(!$con){
        die('Could not Connect to MySql'.mysqli_connect_error());
    }
    return $con;
?>