<?php
$menu = [
    ["type" => "page", "text" => "Příspevky", "target" => "posts"],
    ["type" => "page", "text" => "O mě", "target" => "aboutme"],
    
    
    // ["type" => "sub", "text" => "prispevky", "pages" => [
    //     ["type" => "page", "text" => "Vše", "target" => "all"],
    //     ["type" => "page", "text" => "Leden", "target" => "leden"],
    //     ["type" => "page", "text" => "Únor", "target" => "unor"],
    //     ["type" => "page", "text" => "Březen", "target" => "brezen"],
    //     ["type" => "page", "text" => "Duben", "target" => "duben"],
    //     ["type" => "page", "text" => "Květen", "target" => "kveten"],
    //     ["type" => "page", "text" => "Červen", "target" => "cerven"],
    //     ["type" => "page", "text" => "Červenec", "target" => "cervenec"],
    //     ["type" => "page", "text" => "Srpen", "target" => "srpen"],
    //     ["type" => "page", "text" => "Září", "target" => "zari"],
    //     ["type" => "page", "text" => "Říjen", "target" => "rijen"],
    //     ["type" => "page", "text" => "Listopad", "target" => "listopad"],
    //     ["type" => "page", "text" => "Prosinec", "target" => "prosinec"],
    // ]],







]; //asociativni pole pro menu

if (!$user) {
    $menu[] = ["type" => "page", "text" => "registrace", "target" => "register"];
}
if ($user && $user->isAdmin()) {
    $menu[] = ["type" => "page", "text" => "Přidání příspěvku", "target" => "add"];
}




?>

<div>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">

    <div class="order-0  mx-auto">
        <a class="navbar-brand mx-auto px-3" href="index.php"> <strong>Motoblog</strong> </a>
        <button class="navbar-toggler my-2 border-0 p-0 custom-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <div class="navbar-toggler-icon"></div>
        </button>
    </div>

    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2 ">
            <ul class="navbar-nav mr-auto">
            <?php
            foreach ($menu as $item) {
                if ($item["type"] == "page") {
                    echo " <li class=\"nav-item active\">
                        <a class=\"nav-link\" href=\"?page=" . $item['target'] . "\">" . $item['text'] . "<span class=\"sr-only\">(current)</span></a>
                        </li>";
                } 

            }

            ?>

            </ul>

            <ul class="navbar-nav ml-auto">
                <!-- profilovka vpravo-->
                <li class="nav-item dropdown">
                    <a class="profile_picture nav-link dropdown-toggle m-0 p-0" href="#" id="navbarDropdownProfileLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                        
                            if($user && $img=$user->getProfileImage()){
                                echo("<img src='galerie/user_profile_picture/$img' class='img-fluid' alt='Profilová fotka'>");
                            }else if ($user) {
                                echo('<i class="fas fa-user fa-3x"></i>');

                            }else{
                                echo('<i class="far fa-user fa-3x"></i>');
                            }
                            



                        ?>    
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfileLink"> 
                        <?php
                        
                        if ($user) { ?>
                            <a class="btn btn-info d-block w-auto py-2 my-2" href="index.php?page=edit_profile">Účet</a>
                            <hr>
                            <form class="d-block w-auto" action="index.php?page=login" method="post">
                                <button name="logout" type="submit" class="btn btn-danger d-block w-80 m-auto">Odhlasit</button>
                            </form>

                        <?php 
                        } else { ?>

                            <a class="btn btn-success d-block w-auto py-2" href="?page=login">Přihlásit se</a>

                        <?php 
                        } ?>
                    </div>
                </li>
                <!-- provilovka vpravo-->
            </ul>
    </div>
</nav>
</div>