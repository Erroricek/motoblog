<?php
class Log{

    public static function add($log)
    {
        DB::query("INSERT INTO logs (log, date) VALUES ('$log', NOW())");
    }
    
}




?>