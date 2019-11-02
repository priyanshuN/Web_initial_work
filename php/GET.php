<?php

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
display_errors = on;*/

//echo $_GET["prime"];

function primed ($n){
    if($n==1)
        return 1;
    for($i=2;$i<=$n/2;$i++){
        if($n%$i==0){
            return 1;
        }
    }
    return 0;
}

$n=$_GET["prime"];
$k=primed($n);
//echo $n;
if($k==1){
    echo "Not Prime!";
}
else{
    echo "Prime!";
}

?>

<form>

    <input type="text" name="prime" placeholder="enter the no">
    <input type="submit" value="Submit">
    
</form>