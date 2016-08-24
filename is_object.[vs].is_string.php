<?php

/**
 * is_object vs is_string
 *
 * @package    php-benchmark-scripts
 * @author     Repkit <repkit@gmail.com>
 * @copyright  2016 Repkit
 * @license    MIT <http://opensource.org/licenses/MIT>
 * @since      2016-08-24
 */
 
  /**
 * Result: if testing against object is_string wins but against strings is_object wins
 * Overall : is_string wins because the difference between testing objects and strings is smaller that for is_object
 */

$ar = [];
$br = [];
$obj = 0;
$str = 0;
// generate random objects
for($i = 0; $i< 10000; $i++){
    $nr = mt_rand(1,15);
    $a = range('a', 'z', $nr);
    $b = array_combine($a, range($nr, count($a)*$nr, $nr));
    $ar[$i] = new ArrayObject($b);
}

// generate random strings
for($i = 0; $i< 10000; $i++){
    $nr = mt_rand(1,15);
    $a = range('a', 'z', $nr);
    $br[$i] = implode('',$a);
}

for($j = 0; $j<2500; $j++){
    
    if($j%2 == 0){
        
        $r = [];
        $t = microtime(true);
        for($i = 0; $i< 10000; $i++){
            if(is_object($ar[$i])){
                $r[$i] = true;
            }
        }
        $o = (microtime(true) - $t);
        
        
        $r = [];
        $t = microtime(true);
        for($i = 0; $i< 10000; $i++){
            if(is_string($ar[$i])){
                $r[$i] = true;
            }
        }
        $s = (microtime(true) - $t);
    
        if($o<$s){
          $oc = 'green';
          $sc = 'red';
        } else{
            $sc = 'green';
            $oc = 'red';
        }
        
        echo $j.'.[object]';
        echo "<span style='background-color:$oc'>Elapsed(is_object): " . $o . "</span>\n";
        echo "<span style='background-color:$sc'>Elapsed(is_string): " . $s . "</span>\n";
        echo '<hr>';
    
    }else{
        
        $r = [];
        $t = microtime(true);
        for($i = 0; $i< 10000; $i++){
            if(is_object($br[$i])){
                $r[$i] = true;
            }
        }
        $o = (microtime(true) - $t);
        
        
        $r = [];
        $t = microtime(true);
        for($i = 0; $i< 10000; $i++){
            if(is_string($br[$i])){
                $r[$i] = true;
            }
        }
        $s = (microtime(true) - $t);
    
        if($o<$s){
          $oc = 'green';
          $sc = 'red';
        } else{
            $sc = 'green';
            $oc = 'red';
        }
        
        echo $j.'.[string]';
        echo "<span style='background-color:$oc'>Elapsed(is_object): " . $o . "</span>\n";
        echo "<span style='background-color:$sc'>Elapsed(is_string): " . $s . "</span>\n";
        echo '<hr>';
        
    }
    $obj += $o;
    $str += $s;
}

echo '<hr>';echo '<hr>';
echo "Total object: $obj\n";
echo "Total string: $str\n";
