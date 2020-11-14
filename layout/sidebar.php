<script>
    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('clock').innerHTML =
            "právě je: " + h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }; // add zero in front of numbers < 10
        return i;
    }
</script>
<?php

function getTodayHoliday()
{
    $dnesMaSvatek = "";
    $dnesniMesic = getdate()["mon"];
    $dnesniDen = getdate()["mday"];
    $svatekMaDnes = DB::query("SELECT svatek FROM svatky WHERE den=$dnesniDen AND mesic=$dnesniMesic");
    //$svatekMaDnes = DB::query("SELECT svatek FROM svatky WHERE den=24 AND mesic=12"); //TEST MORE INPUTS
    foreach ($svatekMaDnes as $dnesniSvatky) {
        foreach ($dnesniSvatky as $svatek) {
            $dnesMaSvatek .= "<h3>" . $svatek . "<h3>";
        }
    }
    return $dnesMaSvatek;
}

?>
<style>
    hr.style7 {
        border-top: 1px solid #8c8b8b;
        border-bottom: 1px solid #8c8b8b;
    }
</style>


<div class="col-md-3 col-lg-3 col-xl-2  bg-dark text-white">
    <div class="row">
        <div class="col-12 text-center ">
            <!-- dnes je -->
            <div class=" p-2 ">
                <h5 class="text-center">Dnes je:
                    <br>
                    <?php
                    function datum()
                    {
                        $aj = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                        $cz = array("ledna", "února", "března", "dubna", "května", "června", "července", "srpna", "září", "října", "listopadu", "prosince");
                        $datum = str_replace($aj, $cz, date("j.F Y"));
                        return $datum;
                    }
                    echo (datum());
                    ?>
                </h5>
            </div>




            <!-- rozdělovaci carecka -->
            <div class="col-12">
                <hr class="style7">
            </div>
            
            <!-- hodiny -->
            <div class="col-12 p-2"> 
                <p id ="clock"></p>
            </div>
            
            
            <!-- rozdělovaci carecka -->
            <div class="col-12">
                <hr class="style7">
            </div>
            
            <!-- svatek -->
            <div class="col-12 p-2 text-center ">
                <h5>Svátek má:</h5>
                <?php echo (getTodayHoliday()) ?>
            </div>
            
            <!-- rozdělovaci carecka -->
            <div class="col-12">
                <hr class="style7">
            </div>
            <?php
            
            
            if ($User) {
            ?>
                <!-- něco -->
                <div class="col-12 p-2 text-center">
                    <p>Přihlášený pod jménem:</p>
                    <h3><?php

                        //echo($_SESSION['login']);
                        echo ($User->login);

                        ?></h3>
                </div>
            <?php
            } else {
                $outline = true;
                include 'login_form.php';
            }
            ?>

        </div>
    </div>
</div>