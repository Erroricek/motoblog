<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();


$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "motoblog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

require_once("scripts/logincheck.php");

?>
<!-- https://via.placeholder.com/80x80.png?text=profilfotka -->
<!DOCTYPE html>
<html lang="cs">

<head>

    <meta charset="utf-8" />
    <meta name="description" content="Stručný popis stránky (SEO)" />
    <meta name="keywords" content="Klíčová slova stránky (SEO)" />

<?php
include "layout/header.php";
?>
 
</head>

<body>
    <!--action  navbar-->
<?php
include "layout/menu.php";
?>






<!--action bar-->

    <div class="container-fluid ">
        <div class="row text-break">
            <div class="col-md-9 col-lg-10 text-beak">
                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 'home';
                $lang = isset($_GET['lang']) ? $_GET['lang'] : 'cs';
                
				
				switch ($page) {
					//case "domu":
					//	include("home.php");
                    //	break;
                    case "login":
                        include("layout/login.php");
                        break;
                    case "form":
                        include("layout/posts/form.php");
                        break;
                    case "post":
                    case "posts":
						include("pages/posts.php");
						break;
					default:
						echo ("404");
				}
				

				?>
			</div>
            <?php
            include "layout/sidebar.php"; 
            ?>
        </div>
    </div>








    <!--bootstrap scripty-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>