<?php

if(isset($_POST["readfile"])){
    // echo "Read File";
    $dir = "../images/";
    $a = scandir($dir);
    echo json_encode($a);
}




?>