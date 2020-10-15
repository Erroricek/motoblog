<?php 

function addlog($log)
{
    global $conn;
    $sql = "INSERT INTO logs (log, date) VALUES ('$log', NOW())";
    
    $conn->query($sql);
}


?>