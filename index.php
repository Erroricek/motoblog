<?php
//session_save_path(realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
//echo session_save_path() . "\n";
session_start();


//phpinfo();
include "config/_main.php";
function __autoload($class_name)
{
    $file = "class/$class_name.php";
    require_once $file;
}


$conn = DB::getConnection();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION["success"])) {
    $_SESSION["success"] = [];
}

function display_errors($errors){
    foreach ((array)$errors as $error) { ?>
        <div class="alert alert-danger alert-dismissible fade show nice-shadow my-3" role="alert">
            <?php echo($error) ?>  
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
    }
}

require_once("scripts/logincheck.php");

function sqlcheck($sql, $comment = ""){
    global $conn;
    if ($conn->query($sql)) {
        echo $comment;
    } else {
        echo "neuspesne ulozeni: " . $conn->error;
    }
}


?>
<!— https://via.placeholder.com/80x80.png?text=profilfotka —>
<!DOCTYPE html>
<html lang="cs">

    <head>
        <?php include "layout/header.php"; ?>
    </head>

    <body onload="startTime()">
        <!—action navbar—>
        
            <?php

            $urlNow = $_SERVER['REQUEST_URI'];
            $wordToFind = "?page=";
            if(strpos($urlNow, $wordToFind) === false){
                include "layout/menu.php";
            }
            if(isset($_GET["page"]) && $_GET["page"] != "comments-ajax"){
                include "layout/menu.php"; 
            }
            
            
            ?>
            <!—action bar—>



                <div class="container-fluid main">
                    <div class="row text-break h-100">
                        <div class="col-md-9 col-lg-9 col-xl-10  p-4">
                            <?php
                            $page = isset($_GET['page']) ? $_GET['page'] : 'home';
                            $lang = isset($_GET['lang']) ? $_GET['lang'] : 'cs';

                            if (!empty($_SESSION["success"])) {
                                $pocetZaznamu = count($_SESSION["success"]);
                                echo ('<div class="alert alert-success">');
                                foreach ($_SESSION["success"] as $key => $value) {
                                    echo ($value);
                                    if ($pocetZaznamu - 1 != $key)
                                        echo ("<br>");
                                }
                                //echo($_SESSION["success"] );
                                echo ('</div>');
                                $_SESSION["success"] = [];
                            }



                            




                            switch ($page) {
                                    //case "domu":
                                    //	include("home.php");
                                    //	break;
                                case "login":
                                    include("layout/login.php");
                                    break;
                                case "register":
                                    include("pages/register.php");
                                    break;
                                case "edit":
                                    include("layout/post_edit.php");
                                    break;
                                case "post":
                                    include("pages/post.php");
                                    break;
                                case "posts":
                                    include("pages/posts.php");
                                    break;
                                case "add":
                                    include("pages/add.php");
                                    break;
                                case "delete":
                                    include("layout/delete_post.php");
                                    break;
                                case "aboutme":
                                    include("pages/aboutme.php");
                                    break;
                                case "phpinfo":
                                    include("pages/phpinfo.php");
                                    break;
                                case "backup_sql":
                                    include("pages/backup_sql.php");
                                    break;
                                case "edit_profile":
                                    include("pages/edit_profile.php");
                                    break;
                                case "test":
                                    include("test.php");
                                    break;
                                case "komentar":
                                    include("pages/komentar.php");
                                    break;
                                case "editRemoveComment":
                                    include("scripts/editRemoveComment.php");
                                    break;
                                case "comments-ajax":
                                case "comments":
                                    include("layout/comments.php");
                                    break;
                                default:
                                $_GET["page"] = "aboutme";
                                    include("pages/aboutme.php");
                                    
                                }  //konec switche

                            if (isset($_SESSION['id'])) {
                                if($User && $User->isAdmin()){
                                    display_errors(["Jsi přihlášen jako ADMIN! Buď opatrný!"]);
                                }
                            }
                        
                        ?>
                        </div>
                        <?php
                            include "layout/sidebar.php";
                        ?>
                    </div>
                </div>

        <?php
            include "scripts/bootstrap.php"; //bootsrap scripty
            DB::closeConnection();
        ?>
        
        <footer class="footer p-2 py-3 bg-white"> <!-- p-2 py-3  -->
            <div class="container bg-white">
                <span class="text-muted" id="yearNow"></span>
            </div>
        </footer>
    </body>

</html>
<script>
    document.getElementById("yearNow").innerHTML = "Copyright © Dominik Pavelka 2016 - " + new Date().getFullYear();
</script>