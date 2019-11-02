<?php

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    $weather="";$error="";
    if($_SERVER["REQUEST_METHOD"]=="POST" && $_POST["city"]){
        
        $url = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_POST["city"])."&appid=4b6cbadba309b7554491c5dc66401886");
        
        $weatherarray = json_decode($url,true);
        
       //print_r($weatherarray);
        
        if($weatherarray['cod']==200){
        
            $weather .= "The weather in ".$_POST["city"]." is ".$weatherarray['weather'][0]["description"].".";

            $weather .= "Temperature is ".intval($weatherarray['main']['temp'] - 273)."&deg;C.";
        }
        else{
            
            $error="City couldn't be found.";
            
        }
    
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        
        <style type="text/css">
             html,body { 
              background: url(bg.jpg) no-repeat center center fixed; !important;
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
            }
            #main{
                margin-top: 100px;
            }
            #weather{
                text-align: center;
            }
            #text{
                width:400px;
                margin:auto;
            }
            #but{
                margin-top:30px;
            }
            #dig{
                width:400px;
                margin:auto;
            }
        </style>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="weather">
            <div class="form-group" id="main">
                <h1>What's The Weather?</h1>
                <p>Enter the name of the city.</p>
            </div>
            <div class="form-group" id="text">
                <input type="text" name="city" placeholder="City" class="form-control">
            </div>
            <div class="form-group" id="but">
                <input type="submit" value="Submit" class="btn btn-primary">
            </div>
            <div class="form-group" id="dig">
                <?php
                
                    if($error==""){
                        
                        $weather = '<div class="alert alert-success" role="alert">'.$weather .'</div>';
                        echo $weather;
                    }
                    else{
                        
                        $error = '<div class="alert alert-danger" role="alert">'.$error .'</div>';
                        echo $error;
                    }
                
                ?>
            </div>
        </form>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js">
        </script>
        
    </body>
</html>
      
