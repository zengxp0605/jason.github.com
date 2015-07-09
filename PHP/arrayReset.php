<?php
    
    $arr = array(1,2,3,4,5);
    
    do{
        var_dump(current($arr));
        
    }while ( next($arr));
    
    reset($arr);
    echo '<hr />';   
    
    foreach ($arr as $k => $v){
        
        var_dump(current($arr));
        next($arr);
    }
    
    reset($arr);
    var_dump(current($arr));
?>
