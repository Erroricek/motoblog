<?php 
$style = isset($outline) ? "-outline" : "";
?>
<div class="col-12">
    <form action="index.php?page=login" method="post">
        <div class="form-group">
            <label for="exampleFormControlInput1">Přezdívka</label>
            <input name="login" type="text" class="form-control" id="exampleFormControlInput1" placeholder="login">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Heslo</label>
            <input name="password" type="password" class="form-control" id="exampleFormControlInput1" placeholder="heslo">
        </div>
        
        <div class="text-center">
            <button name="submit" type="submit" class="btn btn<?= $style ?>-success btn-block">Přihlásit se</button>
            
            <p class="m-0 p-0">Ještě nejsi registrovaný?</p>
            <a class="text-purple" href="index.php?page=register">Registruj se</a>
        </div>

    </form>
</div>