
<?php
$menu = [
    ["text" => "home", "target" => "domu", "type" => "page"],
    ["type" => "page", "text" => "prispevky", "target" => "posts"],
    ["type" => "sub", "text" => "prispevky", "pages" => [
        ["type" => "page", "text" => "Vše", "target" => "all"],
        ["type" => "page", "text" => "Leden", "target" => "leden"],
        ["type" => "page", "text" => "Únor", "target" => "unor"],
        ["type" => "page", "text" => "Březen", "target" => "brezen"],
        ["type" => "page", "text" => "Duben", "target" => "duben"],
        ["type" => "page", "text" => "Květen", "target" => "kveten"],
        ["type" => "page", "text" => "Červen", "target" => "cerven"],
        ["type" => "page", "text" => "Červenec", "target" => "cervenec"],
        ["type" => "page", "text" => "Srpen", "target" => "srpen"],
        ["type" => "page", "text" => "Září", "target" => "zari"],
        ["type" => "page", "text" => "Říjen", "target" => "rijen"],
        ["type" => "page", "text" => "Listopad", "target" => "listopad"],
        ["type" => "page", "text" => "Prosinec", "target" => "prosinec"],
    ]],
    ["type" => "page", "text" => "o mě", "target" => "about"],
]; //asociativni pole pro menu




?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">

    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="index.php"> <strong>Motoblog</strong> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2 ">
        <ul class="navbar-nav mr-auto">
            <?php
                foreach($menu as $item)
                {
                    if($item["type"] == "page")
                    {
                        echo " <li class=\"nav-item active\">
                        <a class=\"nav-link\" href=\"?page=" . $item['target'] . "\">" . $item['text'] . "<span class=\"sr-only\">(current)</span></a>
                        </li>";
                    }
                    elseif($item["type"] == "sub")
                    {
                        echo '
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ' . $item['text'] . '
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            ';
                        foreach($item['pages'] as $subitem)
                        {
                            echo '
                                <a class="dropdown-item" href="?page=' . $subitem['target'] . '">' . $subitem['text'] . '</a>
                                ';
                        }
                        
                        echo '
                            </div>
                        </li>
                        ';
                    }
                }

            ?>

            <!--
            <li class="nav-item active">
                    <a class="nav-link" href="?page=domu">Doma je Doma<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=domu">Domu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=info">info</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown link
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
        </ul>
    </div>
    
    
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2 ">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                    <a class="nav-link" href="?page=domu">Doma je Doma<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=domu">Domu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=info">info</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown link
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
        </ul>
    </div>
    -->
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                    <a class="nav-link h-100 align-middle" href="#">en</a>
            </li>
            <li class="nav-item dropdown  mr-2"> <!-- profilovka vpravo-->
                    <a class="nav-link dropdown-toggle nopadding profile-icon" href="#" id="navbarDropdownProfileLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="http://placehold.it/250x250" class="img-fluid" alt="Responsive image">                                
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfileLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <?php
                        if($isLoged){
                            ?>
                            <form action="index.php?page=login" method="post">
                                <button name="logout" type="submit" class="btn btn-link dropdown-item">Odhlasit</button>
                            </form>
                            <?php
                        }else{

                        ?>
                        <a class="dropdown-item" href="#">Log in</a>
                        <?php
                        }
                        ?>
                    </div>
            </li> <!-- provilovka vpravo-->
        </ul>
    </div>
</nav>
