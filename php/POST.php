<?php

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
display_errors = on;*/

//echo $_GET["prime"];

$name=array("daeng","cypher","outro");
$k=false;
for($i=0;$i<sizeof($name);++$i){
    if($name[$i]==$_POST["name"]){
        $k=true;
        break;
    }
}
if($k==true)
    echo "Daeng";
else
    echo "Fool"; 
?>

<form method="post">

    <input type="text" name="name" placeholder="enter the no">
    <input type="submit" value="Submit">
    
</form>