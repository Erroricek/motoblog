<?php
if(isset($_SESSION["loged"]) && $_SESSION["loged"]==true && isset($_SESSION["id"]))
{
    $sql = "SELECT * FROM users WHERE id='".$_SESSION["id"]."'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $isLoged = true;
        $isAdmin = $user['role'] == "admin" ? TRUE : FALSE;
    } else {
        $user = null;
        $isLoged = FALSE;
        $isAdmin = FALSE;
    }
} else {
    $user = null;
    $isLoged = FALSE;
    $isAdmin = FALSE;
}
?> 