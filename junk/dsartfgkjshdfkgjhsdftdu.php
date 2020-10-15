<?php 
//neuspesne ulozeni: Column count doesn't match value count at row 1neuspesne ulozeni: Unknown column 'url' in 'field list' Warning: mkdir(): File exists in /volume1/web/Dom/HTML/motoblog/pages/add.php on line 21 Call Stack: 0.0003 410048 1. {main}() /volume1/web/Dom/HTML/motoblog/index.php:0 0.0024 459336 2. include('/volume1/web/Dom/HTML/motoblog/pages/add.php') /volume1/web/Dom/HTML/motoblog/index.php:117 0.0029 459960 3. mkdir() /volume1/web/Dom/HTML/motoblog/pages/add.php:21 Variables in local scope (#2): $Clat = *uninitialized* $Clon = *uninitialized* $allowTypes = array (0 => 'jpg', 1 => 'png', 2 => 'jpeg', 3 => 'gif') $atributy = *uninitialized* $center_atributy = *uninitialized* $center_point = *uninitialized* $conn = class mysqli { public $affected_rows = -1; public $client_info = 'mysqlnd 5.0.12-dev - 20150407 - $Id: 7cc7cc96e675f6d72e5cf0f267f48e167c2abb23 $'; public $client_version = 50012; public $connect_errno = 0; public $connect_error = NULL; public $errno = 1054; public $error = 'Unknown column \'url\' in \'field list\''; public $error_list = array (0 => array (...)); public $field_count = 6; public $host_info = 'localhost:3307 via TCP/IP'; public $info = NULL; public $insert_id = 0; public $server_info = '5.5.5-10.3.11-MariaDB'; public $server_version = 100311; public $stat = 'Uptime: 5634286 Threads: 8 Questions: 107249 Slow queries: 0 Opens: 1732 Flush tables: 1 Open tables: 10 Queries per second avg: 0.019'; public $sqlstate = '00000'; public $protocol_version = 10; public $thread_id = 29366; public $warning_count = 0 } $content = 'zuretzurtzurtzurtzurt' $data = *uninitialized* $fileName = *uninitialized* $fileType = *uninitialized* $i = *uninitialized* $key = *uninitialized* $lat = *uninitialized* $lon = *uninitialized* $mapa = *uninitialized* $nazev = 'etzjhetrurtzurtzurt' $perex = 'urtzurtzurtzurtzurt' $points = *uninitialized* $postid = 0 $sql = 'INSERT INTO posts (nazev, perex, content, datum) VALUES (\'etzjhetrurtzurtzurt\', \'urtzurtzurtzurtzurt\', \'zuretzurtzurtzurtzurt\', \'\', NOW())' $target = 'galerie/posts/' $targetFilePath = *uninitialized* $user = class User { public $id = 1; public $login = 'administrator'; public $name = 'administrator'; public $firstName = 'administrator'; public $lastName = ''; public $email = ''; private $role = 'admin' } $val = *uninitialized* $xmldata = *uninitialized* $zaznam = *uninitialized* pbrazek nepodporuju Warning: simplexml_load_file(): I/O warning : failed to load external entity "./sample.xml" in /volume1/web/Dom/HTML/motoblog/pages/add.php on line 73 Call Stack: 0.0003 410048 1. {main}() /volume1/web/Dom/HTML/motoblog/index.php:0 0.0024 459336 2. include('/volume1/web/Dom/HTML/motoblog/pages/add.php') /volume1/web/Dom/HTML/motoblog/index.php:117 0.0408 460560 3. simplexml_load_file() /volume1/web/Dom/HTML/motoblog/pages/add.php:73 Variables in local scope (#2): $Clat = *uninitialized* $Clon = *uninitialized* $allowTypes = array (0 => 'xml') $atributy = *uninitialized* $center_atributy = *uninitialized* $center_point = *uninitialized* $conn = class mysqli { public $affected_rows = 1; public $client_info = 'mysqlnd 5.0.12-dev - 20150407 - $Id: 7cc7cc96e675f6d72e5cf0f267f48e167c2abb23 $'; public $client_version = 50012; public $connect_errno = 0; public $connect_error = NULL; public $errno = 0; public $error = ''; public $error_list = array (); public $field_count = 0; public $host_info = 'localhost:3307 via TCP/IP'; public $info = NULL; public $insert_id = 407; public $server_info = '5.5.5-10.3.11-MariaDB'; public $server_version = 100311; public $stat = 'Uptime: 5634286 Threads: 8 Questions: 107250 Slow queries: 0 Opens: 1732 Flush tables: 1 Open tables: 10 Queries per second avg: 0.019'; public $sqlstate = '00000'; public $protocol_version = 10; public $thread_id = 29366; public $warning_count = 0 } $content = 'zuretzurtzurtzurtzurt' $data = *uninitialized* $fileName = 'Cesta.xml' $fileType = 'xml' $i = *uninitialized* $key = 0 $lat = *uninitialized* $lon = *uninitialized* $mapa = *uninitialized* $nazev = 'etzjhetrurtzurtzurt' $perex = 'urtzurtzurtzurtzurt' $points = *uninitialized* $postid = 0 $sql = 'INSERT INTO posts (nazev, perex, content, datum) VALUES (\'etzjhetrurtzurtzurt\', \'urtzurtzurtzurtzurt\', \'zuretzurtzurtzurtzurt\', \'\', NOW())' $target = 'galerie/posts/' $targetFilePath = 'galerie/posts/0/Cesta.xml' $user = class User { public $id = 1; public $login = 'administrator'; public $name = 'administrator'; public $firstName = 'administrator'; public $lastName = ''; public $email = ''; private $role = 'admin' } $val = '' $xmldata = *uninitialized* $zaznam = *uninitialized* Failed to load

//        RL(kočka, pes)   >zvířata ->
//        OOP    (třídy, metody)>rodiče

//        Databaze(radek, uzivatel) -> pouze uložíště ->
//        OOP     (třídy, metody) 

// Abstrakce
// Zviře -> šelma -> kočka
// Živočich -> dravec -> kočka


class Zvire // vysoká abstrakce(zobecnění)
{
    public $zdravy;
    public $vek;
    public $zvuk;

    public function __construct($vek, $zvuk)
    {
        $this->zdravy = 100;
        $this->vek = $vek;
        $this->zvuk = $zvuk;
    }

    public function vydaZvuk() {
       echo $this->zvuk;
    }
}


class Kocka extends Zvire 
{
    public function __construct($vek)
    {
        parent::__construct($vek, "mňau");
    }
    
}




// třídy(class) -> objekt(instance)
// objecného    -> kokrétní 
$neco = new Zvire(12, 'chrochro'); // instance
$neco->vydaZvuk(); // chrochro


$kocka = new Kocka(12);

$kocka->vydaZvuk(); // mnau






?>
