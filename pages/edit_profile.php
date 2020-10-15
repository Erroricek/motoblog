<?php
if($user->getProfileImage())
{
    $img = "galerie/user_profile_picture/" . $user->getProfileImage();
    
}else {
    $img = "galerie/static_pictures/insert-here.jpg";
}
$errorMessage = FALSE;

//name login email password password_check
if (isset($_POST['reset'])) {
    header("Refresh:0; url=index.php?page=register");
}

if (isset($_POST['updateFotky']))
{
    $result = $user->updateFotky($_POST);
    if(is_array($result)){
        echo("NEuspesne ulozena fotka");
        $errorMessage = $result;
    }
    else 
    {
        $_SESSION['success'][] = "Fotka úspěšně uložena.";
        header("Refresh:0");
        //header("Refresh:0; url=index.php?page=edit_profile");
    }
        

}

if (isset($_POST['update'])) 
{
    $result = $user->update($_POST);
    if(is_array($result)){
        $errorMessage = [];
        $errorMessage[] = "NEuspesne ulozene zmeny";
        display_errors($errorMessage);
        $errorMessage = $result;
    }
    else 
        $_SESSION["success"] = [];
        $_SESSION["success"][] = "uspesne ulozene zmeny";
}


if ($user) {
    //name login email password
    //name login email password password_check
?>





    <div class="container">
        <h1>Edit Profilu</h1>
        <hr>
        <div class="row">
            <!-- left column -->
            <div class="col-md-3">
                <div class="text-center">
                    

                    <img src='<?=$img?>' class='img-fluid' alt='avatar'>

                    
                    <h6>Vložit profilovou fotku...</h6>
                    <form action="index.php?page=edit_profile" method="post" enctype="multipart/form-data">
                        <input type="file" name="fotka" class="form-control">
                        <input name="updateFotky" type="submit" class="btn btn-outline-success"  value="Update fotky">
                    </form>
                </div>
            </div>

            <!-- edit form column -->
            <div class="col-md-9 personal-info">
                <div class="alert alert-info alert-dismissable">
                    <a class="panel-close close" data-dismiss="alert">×</a>
                    <i class="fas fa-exclamation-triangle"></i>
                    Prosím uživatele, aby vyplnili <strong>všechny</strong> políčka.
                </div>
                <?php
                
                    if($errorMessage){
                        foreach($errorMessage as $error)
                        { ?>
                            <div class="alert alert-danger alert-dismissable">
                                <a class="panel-close close" data-dismiss="alert">×</a>
                                <i class="fas fa-exclamation-triangle"></i>
                                <?= $error;?>
                            </div> 
                        <?php
                        }
                    }
                
                ?>
                <h3>Osobní informace</h3>

                
                <form class="form-horizontal" action="index.php?page=edit_profile" role="form" method="post">
                    <!-- firstName -->
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Jméno:</label>
                        <div class="col-lg-8">
                            <input class="form-control" name="firstName" type="text" value="<?= $user->firstName ?>">
                        </div>
                    </div>
                    <!-- lastName -->
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Příjmení:</label>
                        <div class="col-lg-8">
                            <input class="form-control" name="lastName" type="text" value="<?= $user->lastName ?>">
                        </div>
                    </div>
                    <!-- email -->
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Email:</label>
                        <div class="col-lg-8">
                            <input class="form-control" name="email" type="text" value="<?= $user->email ?>">
                        </div>
                    </div>
                    <!-- heslo -->
                    <div class="form-group">
                        <label class="col-md-3 control-label">heslo:</label>
                        <div class="col-md-8">
                            <input class="form-control" name="password" type="password" placeholder="vase heslo">
                        </div>
                    </div>
                    <!-- potvrzujici heslo -->
                    <div class="form-group">
                        <label class="col-md-3 control-label">potvrzující heslo:</label>
                        <div class="col-md-8">
                            <input class="form-control" name="confirm_password" type="password" placeholder="kontrola hesla">
                        </div>
                    </div>
                    <!-- tlacitka -->
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                            <input name="update" type="submit" class="btn btn-outline-success" value="Uložit změny">
                            <input name="reset" type="reset" class="btn btn-outline-danger" value="Zrušit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
<?php
}
?>