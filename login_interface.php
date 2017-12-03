<html>
  <head>
    <title>Login User</title>

      <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
      <link rel="stylesheet" href="css/bootstrap.css" type="text/css"/>

      <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="css/login.css" type="text/css">

      <script>
          function hide()
          {
            document.getElementById('username_set').style.display="none";
            document.getElementById('password_set').style.display="none";
          }

          function authentication()
          {
              document.getElementById('username_set').style.display="none";
              document.getElementById('password_set').style.display="none";

              var username=document.getElementById('username').value;
              var password=document.getElementById('password').value;

              var xhr=new XMLHttpRequest();
              xhr.open("POST","login.php",false);
           		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xhr.send("username="+username+"&password="+password);

              this.response_status=xhr.responseText;

              if(response_status.indexOf("1")!=-1)
              {
                alert("No field can be left empty");
              }
              if(response_status.indexOf("2")!=-1)
              {
                 document.getElementById('username_set').style.display="block";
                 document.getElementById('username_set').innerHTML="No such Username found";
              }
              if(response_status.indexOf("3")!=-1)
              {
                 document.getElementById('password_set').style.display="block";
                 document.getElementById('password_set').innerHTML="Password is wrong";
              }
              if(response_status=="4")
              {
                 window.location="bidding.php";
              }
          }

      </script>

  </head>
  <body onload="hide();">
    
    <nav class="navbar" style="align-content: center; background-color: #4fbfa8">
        <div class="container-fluid">
         <div class="navbar-header">
             <h2 style="color: white;">BIDDING STORE</h2>
         </div>
        </div>
    </nav>
    
    <div class="wrapper">
      <div id="formContent">
        <h2 class="active"> Log In </h2>

        <div>
          <img src="img/login.png" id="icon" alt="User Icon" />
        </div>

        <form method="POST">
          <input type="text" id="username" name="login" placeholder="username">
          <div id="username_set" class="alert alert-danger" style="width: 300px; margin-left: 100px;"></div>
          <input type="password" id="password" name="login" placeholder="password">
          <div id="password_set" style="width: 300px; margin-left: 100px;" class="alert alert-danger"></div>
          <input style="background-color: #4fbfa8;" type="button" onclick="authentication();" value="Log In">
        </form>

        <div id="formFooter">
          Not a member? 
          <a href="signup_interface.php">Register</a>
        </div>

      </div>
    </div>
  </body>
</html>