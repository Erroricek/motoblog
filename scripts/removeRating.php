<?php   

    function __autoload($class_name) {
        $file = "../class/$class_name.php";
        require_once $file;
    }
    if (isset($_SESSION["id"]) && $_SESSION['id'] == $_GET['user']){

    
        if (isset($_GET['user']) && isset($_GET['post']))
        {
            $user =  $_GET['user'];
            $post =  $_GET['post'];

            $sql = "DELETE FROM ratings WHERE user='$user' AND post='$post' ";
            DB::query($sql);

            header("location:../index.php?page=post&post=$post");
            die();
        }
    }
    echo('
        <div class="alert alert-danger alert-dismissable">'.
            '<h1>Ty nezbedníku!</h1>'.
        '</div>');
    header("Refresh:1; url=../index.php");
    


?>