<!DOCTYPE html>
<html lang="en">
    
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        
        <link rel="stylesheet" type="text/css" href="style.css">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js">
        </script>
    </head>
    <body>
    
        <div class="container" id="wrap">
            
            <h1>Secret Diary</h1>
            <p><strong>Store your thoughts permanently and securely.</strong></p>
            <p id="note">Interested? Sign up now.</p>
            <div class="alert alert-danger" role ="alert" id ="loginAlert" style="display: none;"></div>
            <div class="form-group">
            
                <input class="form-control" id="email" type="email" name="email" placeholder="Your Email">
                
            </div>
            <div class="form-group">
            
                <input class="form-control" id="password" type="password" name="password" placeholder="Password">
                
            </div>
            
            <buttton type="submit" id="submit" class="btn btn-success">Sign Up!</buttton>
            
            <p><a href="#" id="loginToggle" value="1">Log in</a></p>
            
        </div>
        
        <script type="text/javascript">
        
            $("#loginToggle").click(function(){
                
               if($(this).attr('value')==1){
                   
                   $(this).attr("value","0");
                   $(this).html("Sign Up");
                   $("#submit").html("Login");
                   $("#note").html("Log in using your username and password.");
                   
               }
                else{
                    
                   $(this).attr("value","1");
                   $(this).html("Login");
                   $("#submit").html("Sign Up!");
                   $("#note").html("Interested? Sign up now.");
                }
                
            });
            
            $("#submit").click(function(){
                
               $.ajax({
                   
                   type :"POST",
                   url:"http://priyanshuntesthosting23-com.stackstaging.com/web/mysql/secretdiary/functions.php?action=loginSignup",
                   data: "email="+$("#email").val()+ "&password="+$("#password").val()+"&loginStatus="+$("#loginToggle").attr('value'),
                   success:function(result){
                       
                       //alert(result);
                       $("#loginAlert").html(result);
                       if(result != ""){
                           
                           $("#loginAlert").show();
                       }
                       else{
                           
                           $("#loginAlert").hide();
                       }
                   }
                   
               })
                
            });
        
        </script>
        
    </body>
</html>