<?php

if(isset($_POST['submit'])){
    $login = $_POST['login'];
    $password = $_POST['password']; 
    $User = User::login($login, $password);
    if($User){
        
        Log::add("přihlásil se uživatel ID: " . $User->id . " jméno, příjmení: " .  $User->firstName . " " . $User->lastName .  " login: " . $User->login);
        $_SESSION["loged"] = TRUE;
        $_SESSION["id"] = $User->id;
        $_SESSION["success"][] = "Úspěšně přihlášen";
        
        header("Refresh:0; url=index.php?page=posts");
    }else{
        $errorMessage = [];
        $errorMessage[] = "Neuspesne prihlasen";
        display_errors($errorMessage);
        session_destroy();
    }
    /*
    $password = hash("sha256", $password); 

    $sql = "SELECT * FROM users WHERE login='$login' AND password='$password'";
    $result = $conn->query($sql);


    if ($result->num_rows == 1) {
        echo "uspesne prihlasen";

        
        $_SESSION["loged"] = TRUE;
        $_SESSION["id"] = $result->fetch_assoc()["id"];
        header("Refresh:0; url=index.php?page=posts");

    }else{
        echo "neuspesne prihlasen";
        session_destroy();
    }
    */

}elseif(isset($_POST['logout'])){
    session_destroy();
    $User = null;
    $isLoged = FALSE;
    $isAdmin = FALSE;
    header("Refresh:0; url=index.php");
    
}


if(!$User){ 

?>


<div class="container-fluid content-block">
    <div class="row">
        <div class="col-12">
            <h3 class="my-2">Přihlášení</h3>
            <hr/>
        </div>
        <?php include 'login_form.php' ?>
    </div>
</div>


<?php
}
?>

