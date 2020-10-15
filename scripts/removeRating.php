<?php   

    function __autoload($class_name) {
        $file = "../class/$class_name.php";
        require_once $file;
    }
    
    if (isset($_GET['user']) && isset($_GET['post']))
    {
        $user =  $_GET['user'];
        $post =  $_GET['post'];

        $sql = "DELETE FROM ratings WHERE user='$user' AND post='$post' ";
        DB::query($sql);

        header("location:../index.php?page=post&post=$post");
        die();
    }
    
    header("location:../index.php?page=posts");

?>