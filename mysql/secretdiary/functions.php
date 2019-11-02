<?php

    $link= mysqli_connect("shareddb-m.hosting.stackcp.net",	"secretdiary-313031a082","lfftxfw3s5","secretdiary-313031a082");
    
    if(mysqli_connect_errno()){
       print_r(mysqli_connect_error());
        exit();
    }


    if($_GET['action']=="loginSignup"){
        
       $error="";
        
        if($_POST['email']==""){
            
            $error ="Email is required!";
        }
        
        else if(filter_var($_POST['email'],                 FILTER_VALIDATE_EMAIL)==false){
            
            $error ="Email is not valid!";
        }  
        
        else if($_POST['password']==""){
            
            $error ="Password is required!";
        }
        
        if($error != ""){
            echo $error;
            exit();
        }
        
        if($_POST['loginStatus']==1){
            
             $query = "SELECT * FROM users WHERE email ='".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
            
            $result =mysqli_query($link,$query);
            
            if(mysqli_num_rows($result)>0){
                
                $error = "Email Already exists!";
            }
            else{
                
                $query = "INSERT INTO users(email,password) VALUES('".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['password'])."')";
            
                $result =mysqli_query($link,$query);
                
                if($result){
                    
                    echo 1;
                }
                else{
                    
                    $error = "Couldnt signup.";
                } 
                    
            }
            
            
        }
        else{
            
             $query = "SELECT * FROM users WHERE email ='".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
            
            $result =mysqli_query($link,$query);
            
            if(mysqli_num_rows($result)>0){
                
                $row = mysqli_fetch_assoc($result);
                
                if($row['password'] != $_POST['password']){
                    
                    $error = "Email or Password did not match!";
                }
                else{
                    echo 1;
                }
            }
            
        }
        if($error != ""){
            echo $error;
            exit();
        }
        
    }

?>