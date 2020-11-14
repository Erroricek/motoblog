<?php


//fisrName lastName login email password password_check
if (isset($_POST['submit'])) {
    $errorMessage = [];

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_check = $_POST['confirm_password'];

    if ($password != $password_check) {
        $errorMessage[] = "Hesla se neshodují.";
    }

    
    $data = [
        "firstName" => $firstName,
        "lastName" => $lastName,
        "login" => $login,
        "email" => $email,
        "password" => $password
    ];
    if (empty($errorMessage)) {
        $User = User::register($data);
        header("Refresh:1; url=index.php?page=posts");
        $_SESSION["success"][] = "Úspěšně registrován a  přihlášen.";

    } else {
        display_errors($errorMessage); 
        Log::add("Neuspesne registrovany. jmeno: ". $firstName . " " . $lastName . " Login: " . $login . "email: " . $email );
    }
}


if (!$isLoged) {
?>

<div class="container-fluid content-block">
    <h3>Registrace</h3>
    <hr/>
    <form action="index.php?page=register" method="post">
        <!-- Jmeno -->
        <div class="form-group">
            <label for="exampleFormControlInput1">Jméno</label>
            <input name="firstName" type="text" class="form-control" placeholder="jméno" required>
        </div>
        <!-- příjmení -->
        <div class="form-group">
            <label for="exampleFormControlInput1">Příjmení</label>
            <input name="lastName" type="text" class="form-control" placeholder="Příjmení" required>
        </div>
        <!-- Login -->
        <div class="form-group">
            <label for="exampleFormControlInput1">Přezdívka (přihlašovací)</label>
            <input name="login" type="text" class="form-control" placeholder="Login" required>
        </div>
        <!-- Email -->
        <div class="form-group">
            <label for="exampleFormControlInput1">Email</label>
            <input name="email" type="email" class="form-control" placeholder="Email" required>
        </div>
        <!-- Heslo -->
        <div class="form-group">
            <label for="exampleFormControlInput1">Heslo</label>
            <input name="password" type="password" class="form-control" placeholder="Heslo" required>
        </div>
        <!-- Heslo repate -->
        <div class="form-group">
            <label for="exampleFormControlInput1">Heslo znovu</label>
            <input name="confirm_password" type="password" class="form-control" placeholder="Opakovat heslo" required>
        </div>
        <!-- submit tlacitko -->
        <div class="text-center">
            <button name="submit" type="submit" class="btn btn-success">Registrovat</button>
            <p>Už jsi uživatel? <br> <a class="text-purple" href="index.php?page=login">Přihlaš se</a></p>
        </div>
    </form>
</div>
<?php
}
?>