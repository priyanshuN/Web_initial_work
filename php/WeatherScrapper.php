<?php

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    $mess="";$succ="";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        function getplaintextintrofromhtml($url) {
        include ("simple_html_dom.php");

         $html = file_get_html($url);
        // point to the body, then get the innertext
        $data = $html->find('span[class=phrase]', 0)->plaintext;
        //$data=file_get_contents($url);
        return $data;
        }
        $place= test_input($_POST["city"]);
        $place = str_replace(' ', '', $place);
        $url='https://completewebdevelopercourse.com/locations/' . $place;
        $file_headers = @get_headers($url);
        if(($file_headers[0] == 'HTTP/1.1 404 Not Found')||($file_headers[0] == 'HTTP/1.0 404 Not Found')) {
             $mess = '<div class="alert alert-danger" role="alert"><p>There are no information available for the current city.</p></div>';
        }
        else {
             $mess = getplaintextintrofromhtml($url);
            $mess = '<div class="alert alert-success" role="alert">'.$mess .'</div>';
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
                <? echo $mess ?>
            </div>
        </form>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js">
        </script>
        
    </body>
</html>
      
