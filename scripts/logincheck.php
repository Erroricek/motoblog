<?php
if(isset($_SESSION["loged"]) && $_SESSION["loged"]==true && isset($_SESSION["id"]))
{
    $user = new User((int)$_SESSION["id"]);
    
    if($user->id == NULL){
        unset($_SESSION['id']);
        unset($_SESSION['loged']);
        $user = FALSE;
    }


} else {
    $user = null;
    $isLoged = FALSE;
    $isAdmin = FALSE;
}
?> 