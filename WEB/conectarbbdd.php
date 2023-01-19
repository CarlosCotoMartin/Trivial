<?php
    $db = new mysqli("localhost", "root", "1234", "trivial");
    if($db->connect_errno){
        die('Error');
    }
?>