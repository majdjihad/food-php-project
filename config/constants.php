<?php
    session_start();
    const serverName = "localhost";
    const userName = "root";
    const password = "";
    const db = "food_app";
    $server = new mysqli(serverName,userName,password,db);
?>