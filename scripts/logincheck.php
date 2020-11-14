<?php
if(isset($_SESSION["loged"]) && $_SESSION["loged"]==true && isset($_SESSION["id"]))
{
    $User = new User((int)$_SESSION["id"]);
    
    if($User->id == NULL){
        unset($_SESSION['id']);
        unset($_SESSION['loged']);
        $User = FALSE;
    }


} else {
    $User = null;
    $isLoged = FALSE;
    $isAdmin = FALSE;
}
?> 