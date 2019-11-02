<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="http://priyanshuntesthosting23-com.stackstaging.com/web/Twitter/style.css">
      
    <title>Hello, world!</title>
  </head>
    
  <body>
      
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="http://priyanshuntesthosting23-com.stackstaging.com/web/Twitter/">Twitter</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="?page=yourtimeline">Your Timeline</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=yourtweets">Your Tweets</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=publicProfiles">Public Profiles</a>
      </li>
    </ul>
    <div class="form-inline my-2 my-lg-0">
        
        <?php if(isset($_SESSION['value'])){ ?>
            <a class="btn btn-success-outline" href="index.php?status=logout">Logout</a>
        
        <?php } else{ ?>
        
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" data-toggle="modal" data-target="#my-modal">Login/SignUp</button>
        <?php } ?>
        
    </div>
  </div>
</nav>