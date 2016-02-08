<?php
  /**********************************************************************
  *          Session set up
  **********************************************************************/

  /* error check */
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Corvallis Reuse and Repair Directory: Web Portal</title>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/customStylesheet.css" rel="stylesheet">
  <link href="css/media.css" rel="stylesheet">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Rubik:700' rel='stylesheet' type='text/css'>
<script>

  /************************************************************************
  *         Check Session on body load
  ************************************************************************/

function checkSession(){

    req = new XMLHttpRequest();
    req.onreadystatechange = function(){
     if(req.readyState == 4 && req.status == 200){

        if(req.responseText == 1){
          /* everything has passed! Yay! Go into your session */
          window.alert("You are not logged in! You will be redirected.");
          window.location.href = "http://web.engr.oregonstate.edu/~masseyta/testApi/loginPage.php";
        }
      }
    }

    /* send data to create table */
    req.open("POST","checkSession.php", true);
    req.send();
}

function newUser(){

  /* get values from form */
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  var type = "register";

  /* check for blanks in the form */
  if(name == null){
    document.getElementById("output2").innerHTML ="Error: Username cannot be blank";
    document.getElementById("newUser").reset();
    return;
  }
  if(password == null){
    document.getElementById("output2").innerHTML ="Error: Password cannot be blank";
    document.getElementById("newUser").reset();
    return;
  }
  else{
    req = new XMLHttpRequest();
    req.onreadystatechange = function(){
     if(req.readyState == 4 && req.status == 200){

      /* response was true, allow the user to continue */
     if(req.responseText == 1){
        /* redirect with updates */
        window.location.href = "http://web.engr.oregonstate.edu/~masseyta/testApi/main.php";
     }

     /* response was false, can't add to DB */
    if(req.responseText == 0){
      document.getElementById("output2").innerHTML = "Error: Username taken.";
      document.getElementById("newUser").reset(); 
    }

    /* horrible weirdness happened. Print it */
     else if(req.responseText != 1 && req.responseText != 0){
          document.getElementById("output2").innerHTML = req.responseText;
       }
    }
  }

      /* send data to create table */
      req.open("POST","index2.php", true);
      req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      var tableData = "type="+type+"&username="+username+"&password="+password;
        req.send(tableData);
    }
}
</script>
  </head>
  <!--<body onload="checkSession()"> -->
  <body>

  <!-- Main container -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-md-12">
        <br></br>
        <h3>Create an Account</h3>
        <hr></hr>

       <form id="newUser">
        <div class="form-group">
           <label>Username: </label>
           <input type ="text" class="form-control" Id="username" placeholder="Enter Username">
        </div> <!-- end formground-->
        <div class="form-group">
            <label>Password: </label>
            <input type ="password" class="form-control" Id ="password" placeholder="Enter Password">
        </div><!-- end formgroup -->
        <p align="center">
        </br>
          <!-- Send information to loginCheck function for error handling and ajax call if wrong -->
          <button Id ="submit" type ="submit" class="btn btn-primary" onclick="newUser(); return false" align="center">Register</button>
        </p>
        </form>
        <hr></hr>
        <!-- Hidden row for displaying login errors -->
        <div class="row">
          <div class="col-xs-12 cold-md-8" Id= "output2"></div>
        </div class="row"><!-- end inner row -->
  </div> <!-- end container-->

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  </body>
</html>