<?php
    function __autoload($class_name) {
        $file = "../class/$class_name.php";
        require_once $file;
    }
    
    $conn = DB::getConnection();


    print_r($_GET);
    echo('<br>');
    $user = $_GET["user"];
    $post = $_GET["post"];
    $raiting = $_GET["raiting"]*2;

    $sql = "INSERT INTO ratings (user, post, rating) VALUES ($user,$post,$raiting)";
    DB::query($sql);
    //$conn->query($sql);
    Log::add("Uživatel " . $user->login . " Přidal hodnocení.");
    header("location:../index.php?page=post&post=$post");

?>