<?php
include_once "scripts/EXPORT_DATABASE.php";
include_once "class/Log.php";
if( $User->isAdmin() || (isset($_GET['hash']) && $_GET['hash']=="gh4D7g378gfa30J") ){
    DB::getConnection();
    $HOST="localhost:3307";
    $USER="database";
    $PASS="$37HP2a9_=Jt*%WR";
    EXPORT_DATABASE($HOST,$USER,$PASS,"autofarmer");
    EXPORT_DATABASE($HOST,$USER,$PASS,"motoblog"); 
    EXPORT_DATABASE($HOST,$USER,$PASS,"Nico");
    EXPORT_DATABASE($HOST,$USER,$PASS,"scf");
    //EXPORT_DATABASE($HOST,$USER,$PASS,"test"); 
    //EXPORT_DATABASE($HOST,$USER,$PASS,"test1"); 
    //EXPORT_DATABASE($HOST,$USER,$PASS,"test2"); 
    EXPORT_DATABASE($HOST,$USER,$PASS,"test3"); 
    


//sqlcheck($sql, "uspesne ulozeny backup");
log::add("databaze uložena  " . date("Y-m-d H:i:s") );




}else{
    echo"nemas opravneni, vypadni.";
    Log::add("někdo se snaží dostat do backup, ID uživatele: " . $_SESSION["id"]);
}

?>