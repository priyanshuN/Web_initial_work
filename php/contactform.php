<?php

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
display_errors = on;*/

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$error="";$successMessage = "";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if (empty($_POST["email"])) {
        $error .= "Email is required.<br>";
    } 
    else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "Invalid email format.<br>"; 
        }
    }
    if(empty($_POST["subj"])){
        $error .="Empty subject.<br>";
    }
    else{
        $sub=test_input($_POST["subj"]);
    }
    
    if ($error != "") {
            
     $error = '<div class="alert alert-danger" role="alert"><p>There were error(s) in your form:</p>' . $error . '</div>';
            
    }
    else {
            
            $emailTo = "richavinian@gmail.com";
            
            $subject = $_POST['subj'];
            
            $headers = "From: ".$_POST['email'];
            
            if (mail($emailTo, $subject, $headers)) {
                
                $successMessage = '<div class="alert alert-success" role="alert">Your message was sent, we\'ll get back to you ASAP!</div>';
                
                
            } else {
                
                $error = '<div class="alert alert-danger" role="alert"><p><strong>Your message couldn\'t be sent - please try again later</div>';
                
                
            }
            
    }
    
}

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    <div class="form-group px-5">
        <h1>Get in touch!</h1>
        <div id="error"><? echo $error.$successMessage; ?></div>
    </div>

    <div class="form-group px-5">
        <label for="mail">Email address</label>
        <input type="email" class="form-control" name="email" id="mail" placeholder="Enter email">
        <small id="mail" class="form-text text-muted">We'll never share your email with anyone else.</small>
        
    </div>
    
    <div class="form-group px-5">
    
        <label for="sub">Subject</label>
        <textarea class="form-control" id="sub" name="subj" rows="1"></textarea>
    
    </div>
    
    <div class="form-group px-5">
    
        <label for="sample">Content</label>
        <textarea class="form-control" id="sample" rows="3" name="content"></textarea>
    
    </div>
    
    <div class="form-group px-5">
    
        <input type="submit" value="Submit" class="btn btn-primary">
        
    </div>
    
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js">
</script>