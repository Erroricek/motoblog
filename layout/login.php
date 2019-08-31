<?php
if(isset($_POST['submit'])){
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password = hash("sha256", $password);

    $sql = "SELECT * FROM users WHERE login='$login' AND heslo='$password'";
    $result = $conn->query($sql);


    if ($result->num_rows == 1) {
        echo "uspesne prihlasen";
        $_SESSION["loged"] = TRUE;
        $_SESSION["id"] = TRUE;
    }else{
        echo "neuspesne prihlasen";
        session_destroy();
    }
}elseif(isset($_POST['logout'])){
    session_destroy();
    $user = null;
    $isLoged = FALSE;
    $isAdmin = FALSE;
}

if(!$isLoged){
    
?>
<form action="index.php?page=login" method="post">
<div class="form-group">
    <label for="exampleFormControlInput1">Prihlaseni</label>
    <input name="login" type="text" class="form-control" id="exampleFormControlInput1" placeholder="log in">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Heslo</label>
    <input name="password" type="password" class="form-control" id="exampleFormControlInput1" placeholder="password">
</div>
<button name="submit" type="submit" class="btn btn-secondary btn-lg btn-block">Poslat</button>
</form>

<?php
}
?>

