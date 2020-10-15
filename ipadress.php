<?php


$a= new IPAdress("192.168.0.105", 28);
echo"<br>";
/* echo $a->toMaskBin(); */
echo"<br>";
print_r($a->maskToDec()) ;
class IPAdress {
    private $ip = "";
    private $mask = "";


    public function __construct($ip,$mask)
    {
        $this->ip = $ip;
        $this->mask = $mask;
    }

    public function toString()
    {
        return "ip: " . $this->ip . " maska: " . $this->mask;
    }
    public function toMaskBin()
    {
        $a = $this->mask;
        $return = "";
        for ($i=0; $i < 32; $i++) { 
            if ($i == 8 || $i == 16 || $i == 24 || $i == 32) {
                $return .= ".";
            }
            if($i < $a){
                $return .= "1";
            }else {
                $return .= "0";
            }
        }   
        return $return;
    }
    public function maskToDec()
    {   
        $a = $this->toMaskBin();
        $ret = "";
        $o = explode(".",$a);
        foreach ($o as $octed) {
            $ret .= binDec($octed). ".";
        }
        $ret = substr($ret,0,-1);
        return  $ret;
        
    }
    













}
