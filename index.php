<?php
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
        if (array_key_exists('email', $_POST) OR array_key_exists('password', $_POST)) {
        
            if(empty($_POST["email"])){
                echo "<p>Email is required!</p>";
            }
            else if(empty($_POST["password"])){
                echo '<p>Password is required!</p>';
            }
            else{

                $link = mysqli_connect("shareddb-j.hosting.stackcp.net","priyanshu-39358667","f2tv7mkux3","priyanshu-39358667");

                if (mysqli_connect_error()) {

                    die ("There was an error connecting to the database");

                } 

                $query = "SELECT id FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST["email"])."'";

                $result = mysqli_query($link, $query);
                //echo mysqli_num_rows($result);
                if(mysqli_num_rows($result) > 0){
                    echo "Logged in successfully!";
                    if(isset($_POST["login"])){
                        session_start();
                        $_SESSION["email"]=$_POST["email"];
                        
                        echo "<p>Remembered</p>";
                    }
                }
                else{
                    echo "Not valid email!";
                }

            }
            
        }
        
        if (array_key_exists('email1', $_POST) OR array_key_exists('password1', $_POST)) {
        
        
            if(empty($_POST["email1"])){
                echo "<p>Email is required!</p>";
            }
            else if(empty($_POST["password1"])){
                echo '<p>Password is required!</p>';
            }
            else{

                $link = mysqli_connect("shareddb-j.hosting.stackcp.net","priyanshu-39358667","f2tv7mkux3","priyanshu-39358667");

                if (mysqli_connect_error()) {

                    die ("There was an error connecting to the database");

                } 

                $query = "SELECT id FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST["email1"])."'";

                $result = mysqli_query($link, $query);
                //echo mysqli_num_rows($result);
                if(mysqli_num_rows($result) > 0){
                    echo "Already registered!";
                }
                else{
                    $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email1'])."', '".mysqli_real_escape_string($link, $_POST['password1'])."')";

                    if(mysqli_query($link,$query)){
                        echo "Successfully registered!";
                        if(isset($_POST["signup"])){
                            session_start();
                            echo "<p>Remembered</p>";
                        }
                    }
                    else{
                        echo "Try again!";
                    }
                }

            }
            
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
        
            .con{
                margin-left: 10px;
                margin-top:30px;
            }
        
        </style>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        
        <div class="con">
        
            <form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
            
                <div class="form-group row">
                    <label for="mail" class="col-form-label col-2">Email</label>
                    <input type="email" class="form-control col-6" name="email" placeholder="abc@domain.com" id="mail"> 
                </div>
                <div class="form-group row">
                    <label for="pass" class="col-form-label col-2">Password</label>
                    <input type="password" class="form-control col-6" name="password" id="pass"> 
                </div>
                <input type="checkbox" name="login" value="loged" >
                <button type="submit" class="btn btn-primary">Login</button>
            
            </form>
            
        </div>
        
        <div class="con">
        
            <form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
            
                <div class="form-group row">
                    <label for="mail1" class="col-form-label col-2">Email</label>
                    <input type="email" class="form-control col-6" name="email1" placeholder="abc@domain.com" id="mail1"> 
                </div>
                <div class="form-group row">
                    <label for="pass1" class="col-form-label col-2">Password</label>
                    <input type="password" class="form-control col-6" name="password1" id="pass1"> 
                </div>
                <input type="checkbox" name="signup" value="signedup" >
                <button type="submit" class="btn btn-primary">Sign Up</button>
            
            </form>
            
        </div>
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js">
        </script>
        
    </body>
</html>