<?php
session_start();
$salt = "%@5fTB^";  //add some complication to password hash
$no_email_warning = ""; // initialize with no alert
require 'reading_from_file.php';

//compare cookie with existing users in external file

if(isset($_POST['submit'])){
  if(strlen($_POST['email']) != 0 && strlen($_POST['pass']) != 0){
    $hash_password = md5($salt.$_POST['pass']);
      $_SESSION["user"] = $_POST["email"];
    if($_POST['remember'] == 'on' ){
      setcookie('email' , $_POST['email'] , time() + 30);
      setcookie('pass' , $hash_password , time() + 30);
      setData($_POST['email'], $hash_password );
      redirect("site.php");
      exit();
    }else {
      setData($_POST['email'], $hash_password);
      redirect("site.php");
      exit();
    }
  }else $no_email_warning = '<div class="alert alert-danger" role="alert">
  Could not sign in in. User or Password field empty!
  </div>';
  // show alert if no user or password written
}

function redirect($site){
  header("Location: $site");
}
 ?>
<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <style media="screen">
      .container{
        width: 0 auto;
        margin-left: 20px;
        margin-right: 20px;
        margin-top: 100px;
      }
      #sign-in{
        margin-left: 20px;

      }
    </style>
    <title>Sign in</title>
  </head>
  <body>
    <?php include("header_template.php") ?>
    <div class="container">
        <div class="warnings">
          <?php echo $no_email_warning ?>
        </div>
        <form method="post" >
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <!-- change input type!! -->
            <input type="text" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group form-check">
            <input type="checkbox" name = "remember" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Remember me!</label>
          </div>
          <button type="submit" name="submit" class="btn btn-primary" id="log-in">Sign in</button>
        </form>
    </div>
    <?php include 'footer_template.php'; ?>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    </script>
  </body>
</html>
