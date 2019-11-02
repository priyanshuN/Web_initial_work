<?php

	include("functions.php");

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
        
        if($_POST['loginActive']==0){
            
            $query = "SELECT * FROM users WHERE email ='".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
            
            $result=mysqli_query($link,$query);
            
            if(mysqli_num_rows($result)>0){
                $error = "Email already exits!";
            }
            else{
                
                $query="INSERT INTO users(email,password) VALUES('".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['password'])."')";
                
                if(mysqli_query($link,$query)){
                    
                    $_SESSION['value']=mysqli_insert_id($link);
                    
                    $query="UPDATE users SET password='".md5(md5($_SESSION['value']).$_POST['password'])."' WHERE id = '".$_SESSION['value']."' LIMIT 1";
                    
                    mysqli_query($link,$query);
                    
                    echo 1;
                }
                else{
                    $error ="Couldn't signup.Please try again later!";
                }
            }
            
        }
        else{
            
            $query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
            
            $result=mysqli_query($link,$query);
            
            $row=mysqli_fetch_assoc($result);
            
            if($row['password']==md5(md5($row['id']).$_POST['password'])){
                
                echo 1;
                $_SESSION['value'] = $row['id'];
                
            }
            else{
                
                $error="Couldn't find email/password!";
            }
        }
        
         if($error != ""){
                echo $error;
                exit();
         }
    }

    if($_GET['action']=="toggleFollow"){
        
        //print_r($_POST);
        $query = "SELECT * FROM isFollowing WHERE follower = '".mysqli_real_escape_string($link,$_SESSION['value'])."' AND isFollowing  = '".mysqli_real_escape_string($link,$_POST['userId'])."' LIMIT 1";
        
        $result=mysqli_query($link,$query);
        
        if(mysqli_num_rows($result)>0){
            
            $row = mysqli_fetch_assoc($result);
            
            mysqli_query($link,"DELETE FROM isFollowing WHERE id= '".mysqli_real_escape_string($link,$row['id'])."' LIMIT 1");
            
            echo "1";
            
        }
        else{
            
            mysqli_query($link,"INSERT INTO isFollowing(follower,isFollowing) VALUES('".mysqli_real_escape_string($link,$_SESSION['value'])."','".mysqli_real_escape_string($link,$_POST['userId'])."') ");
            
            echo "2";
            
        }
        
    }

    if($_GET['action']=="postTweet"){
        
        //echo $_POST['tweetContent'];
        
        if($_POST['tweetContent']!=""){
        
            $query = "INSERT INTO tweets(userid, tweet) VALUES ('".mysqli_real_escape_string($link,$_SESSION['value'])."','".mysqli_real_escape_string($link,$_POST['tweetContent'])."')";

            $result = mysqli_query($link,$query);

            if($result){

                echo "1";
            }
            else{

                echo "2";
            }
        }
        else{
            echo "2";
        }
        
    }

?>