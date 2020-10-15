<html>


</html>
<!-- /* https://svatky.adresa.info/json?date=0101&lang=cs */ -->

<?php


/* -----------------number counter ------------------ */
function numberCounter($number)
{
    for ($dateNumber=0; $dateNumber < $number; $dateNumber++) { 
        
        $allNumbers = [];
        
        $allNumbers[$dateNumber] = $dateNumber;
        
        
        echo '<pre>';
        print_r($allNumbers);
        echo '</pre>'; //die;
        
    }
}
/* -----------------number counter ------------------ */

/* ----------------date and month generator----------------------------- */

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



function generateDateAndMonth()
{
    $myfile = fopen(generateRandomString(10) . ".json", "w") or die("Unable to open file!");
    $data = [];
    $checker = true;
    $d=0;
    $m=4;
    while ($checker) {
        if($d!=31){
            $d++;
        }else {
            $m++;
            $d=1;
        }
        if($d==31 && $m==12){
            $checker = false;
        }

        $ddmm = pridejNulu($d) . pridejNulu($m);
        $url = "https://svatky.adresa.info/json?date=" . $ddmm . "&lang=cs";

        $cash = file_get_contents($url);
        $cash .= "\n";

        $data .= $cash;
        
    }
    fwrite($myfile, $data);
fclose($myfile);
echo($data);
}
/* ----------------date and month generator----------------------------- */


function getContentFromUrl($input)
{
    return file_get_contents($input);
}


function pridejNulu($cislo) {
    return ($cislo < 10 ? '0' : '') . $cislo;
}

function generateWebsiteWithAllLinks()
{
    $mesicTed = (date("m"));
    $denTed = (date("d"));
    echo($mesicTed);
    echo('<br>');
    echo('<br>');
    echo($denTed);
}






/* ---------------------need to be done --------------------- */



function generateDataFromFile()
{
    $svatky=file("svatky.json");
    //$betterSvatky[] = "";
    //$betterSvatky = preg_split("/((\r?\n)|(\r\n?))/", $svatky);
    
    
    $encodedBetterSvatky = json_encode($betterSvatky);
    
    
    echo '<pre>';
    //print_r($svatky);
    echo '</pre>'; //die;
    foreach ($svatky as $dny) {
        $dny = json_decode($dny); 
        
        foreach($dny as $svatek) {
            $datum = $svatek->date;
            $den = substr($datum, 0, 2);
            $mesic = substr($datum, 2, 3);
            $svatekString = $svatek->name;
            echo "(" . $den . "," . $mesic . ",\"" . $svatekString . "\"),";
            echo('<br>');
        }
        
    }
}
















//generateDateAndMonth();
/* generateWebsiteWithAllLinks();
echo('<br>');
 */

//numberCounter(366);

?>



<!-- DATABASE 
id(pk)
day int(2)
month int(2)
varchar(50) -->

<script>
    function pridejNulu(d) {
        return (d < 10 ? '0' : '') + d;
    }

    window.onload = function() {
        var dnes = new Date();
        var ddmm = pridejNulu(dnes.getDate()) + pridejNulu(dnes.getMonth() + 1);
        

        $.ajax({
            type: 'GET',
            crossDomain: true,
            dataType: 'json',
            /* url:'https://svatky.adresa.info/json?date=0101&lang=cs', */
            url: 'https://svatky.adresa.info/json?date=' + ddmm + '&lang=cs',

            success: function(data) {
            
                document.getElementById('svatek').innerText = data[0].name
            }
        })
    }
</script>