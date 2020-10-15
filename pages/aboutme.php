


<div class="container-fluid content-block">
		<h1>Dominik Pavelka</h1>
		<hr>
		<!-- <a href="http://www.strejda-google.cz/#slowmotion+boobs+gif" target="_blank" ><img src="galerie/static_pictures/kozy.gif" alt="ženské poprsí, které hopsají" class="nice-img" /></a> -->
			<h2 class="text-danger">Programátorům rozumím, protože jsem jedním z nich. </h2>
			<p>Vítejte na mém prvním webu.</p>

			

		<h2>O mně</h2>
			<p>Jmenuji se Dominik Pavelka. <?php echo(getMyAge()); ?>. Chodím na Střední  školu v Brno-Bohunice na obor IT.</p>
		<h2>Dovednosti</h2>
			<p>V prváku jsem se ve škole začali učit s paní učitelkou <a href="http://m.me/xkatulka" target="_blank" >Gojovou</a> , která nás naučila <a href="http://rendy.mysystem.cz/Dom/HTML/prvni-web/bozp.html">BOZP</a>, které mi velmi pomohlo při učení se programovat.</p> <!--dodělat BOZP-->
			<p>HTML</p>
			<div class="skillContainer">
			<div class="skills html">75%</div>
			</div>

			<p>CSS</p>
			<div class="skillContainer">
			<div class="skills css">60%</div>
			</div>

			<p>JavaScript</p>
			<div class="skillContainer">
			<div class="skills js">50%</div>
			</div>

			<p>PHP</p>
			<div class="skillContainer">
			<div class="skills php">70%</div>
			</div>

			<p>Databáze</p>
			<div class="skillContainer">
			<div class="skills db">35%</div>
			</div>
		<h3>A ta nejdůležitější část!</h3>
			<p> <strong>( ͡° ͜ʖ ͡°)  ( ͡° ͜ʖ ͡°)  ( ͡° ͜ʖ ͡°)</strong> </p>
		<h4>Kontakt na mě</h4>
			<p>Kdyby jste měli nějaké vidky k mému úžasnému webu, tak na odkazu <a href="http://m.me/dom.dredalist"><strong>kontakt</strong></a> najdete podrobné informace o kontaktování.</p>
			<br><br><br>
		<h2>TO-DO</h2>
		<img src="galerie/static_pictures/121512806_633076417372769_9170919839811540213_n.jpg" class="img-fluid" alt="Responsive image">
</div>

<?php

function getMyAge()
{
    if ((int)Date("m") >= 10) {
        if ((int)Date("d") >=12) {
            $myAge = ("Je mi  ". ((int)date("Y")-2000));
        }else{
            $myAge = ("Je mi  ". ((int)date("Y")-2001));
        }
    }else{
        $myAge = ("Je mi  ". ((int)date("Y")-2001));
    }
    return $myAge;
}



?>
<style>
/* Make sure that padding behaves as expected */
* {box-sizing:border-box}

/* Container for skill bars */
.skillContainer {
  width: 100%; /* Full width */
  background-color: #ddd; /* Grey background */
  margin: 0px;
  padding: 0px;
}

.skills {
  text-align: right; /* Right-align text */
  padding-top: 10px; /* Add top padding */
  padding-bottom: 10px; /* Add bottom padding */
  color: white; /* White text color */
}

.html {width: 75%; background-color: #4CAF50;} /* Green */
.css {width: 60%; background-color: #2196F3;} /* Blue */
.js {width: 50%; background-color: #f44336;} /* Red */
.php {width: 70%; background-color: #808080;} /* Dark Grey */
.db {width: 35%; background-color: orange;} /* Purple */

</style>