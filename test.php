<?php

/* $currentMonth = Date(); */
var_dump((int)Date("m"));
echo"<br>";

function getMyAge()
{
    if ((int)Date("m") >= 10) {
        if ((int)Date("d") >=12) {
            $myAge = ("Je mi:  ". ((int)date("Y")-2000));
        }else{
            $myAge = ("Je mi:  ". ((int)date("Y")-2001));
        }
    }else{
        $myAge = ("Je mi:  ". ((int)date("Y")-2001));
    }
    return $myAge;
}

echo(getMyAge());