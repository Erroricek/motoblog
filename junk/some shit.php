<?php
include "config/_main.php";
function __autoload($class_name) {
    $file = "class/$class_name.php";
    require_once $file;
}


$conn = DB::getConnection();
$picovinka = $conn->query("SELECT * FROM uzivatele");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/default.css">
</head>
<body>

<form action="indexx.php" method="POST">
	jméno: <input type="text" name="jmeno" placeholder="napiš jmeno, hajzle">
    <input type="submit" value="odeslat">
</form>





<?php
$p1 = new Person("Petr", 20);
$p2 = new Person("Katerina", 22);
$p3 = new Person("Lucie", 17);
echo $p1->sayHello($p2);
echo"<br>";
echo $p1->sayHello($p3);
echo"<br>";
echo $p2->sayHello($p3);

for ($i=0; $i < 7; $i++) { 
	echo"<br>";
}

?><pre> <?php

$conn = DB::getConnection();
$sql = "SELECT * FROM uzivatele";

$stmt = $conn->prepare($sql);
$stmt->execute();

$uzivatele = $stmt->fetch();
echo("<br>");
foreach ($uzivatele AS $uzivatel) {
	print_r($uzivatel["name"]);
	echo("<br>");
}

echo("napis jméno pro debug 56. řádku." . "</br>");
echo(" Jméno je: " . $_POST["jmeno"] ); 
?></pre> 






</body>
</html>
<script>
        // JAVA,C (int a = 9, double b = 3,21 ... String )

        // PHP, Javscript ($a = "ahoj" = 9 = [1,3,2]; var b = [3.333,2, "asjs"])

        // PHP class ObjektNeco{  public $hp; public function ahoj(){echo 'ahoj';} ; $neco = new ObjektNeco("ddd") }
        // Třída --> objekt(instance)
        // Javascript

        <?php
        
        $pole = [
            "ahoj" => 5,
            "neco" => 5
        ] // Associativní pole
        
        ?>

        var pole = {
            ahoj: 5,
            neco: 4
        } // Instance objektu

        var neco = {
            hp: 5,
            jmeno: "Bltiček",
            ahoj: function() {
                console.log('ahoj ' + this.hp)
            }
        }

        neco.ahoj(); 

        

        function zavolej_funkci_a_posli_do_ni(funkce_k_zavolani, co_do_ni_poslat) {

            funkce_k_zavolani(co_do_ni_poslat); // 
            
        }


        function vypis_jmeno(obj) {
            console.log(obj.jmeno)
        }

        vypis_jmeno({
            jmeno: "pavel",
            age: 22
        });
        zavolej_funkci_a_posli_do_ni(vypis_jmeno, neco)

        $.ajax() // poslání formůláře za chodu stránky bez reloadu (v php vydíme jako $_GET nebo $_POST)


        // Bez třídy (rovnou instance)
    </script>
