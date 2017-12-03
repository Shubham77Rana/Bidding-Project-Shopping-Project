<html>
    <head>
        <title>Sign In</title>
       <link rel="stylesheet" href="../Bidding/bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css"/>

        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>  
       <link rel="stylesheet" type="text/css" href="css/mystyle.css">
       <link href="css/font-awesome.css" rel="stylesheet">
       <style>
            .glyphicon{
                color: black;
            }
            .form-container{
                border-radius: 10px;
                background-color: rgba(255,255,255,1);
            }
       </style>
       
       <script>
       		function validate()
       		{
				var name=document.getElementById('name').value;
				var password=document.getElementById('password').value;
				var confirm=document.getElementById('confirm').value;
				var email=document.getElementById('email').value;
				var username=document.getElementById('username').value;

				var xhr=new XMLHttpRequest();
           		xhr.open("POST","signup.php",false);
           		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
           		xhr.send("username="+username+"&email="+email+"&password="+password+"&confirm="+confirm+"&name="+name);
           	
          		this.response_status=xhr.responseText;
				document.getElementById('username_set').innerHTML="";
				document.getElementById('email_set').innerHTML="";
				document.getElementById('password_set').innerHTML="";
				if(response_status.indexOf("0")!=-1)
				{
					alert("No fields can be left empty");
				}
           		if(response_status.indexOf("1")!=-1)
           		{
               		document.getElementById('username_set').innerHTML="username already exist";
           		}
           		if(response_status.indexOf("2")!=-1)
           		{
           			document.getElementById('email_set').innerHTML="email already exist";
           		}
           		if(response_status.indexOf("3")!=-1)
           		{
           			document.getElementById('password_set').innerHTML="password doesn't match";
           		}
           		if(response_status=="4")
           		{
               		alert("Successfully Registered");
               		window.location="login_interface.php";
               	}		
				
       		}
       </script>
  
    </head>
     <body>
     
     	  <nav class="navbar" style="background-color: #4fbfa8; align-content: center">
        	 <div class="container-fluid">
         		<div class="navbar-header">
             		<h2 style="color: white;">BIDDING STORE</h2>
         		</div>
        	</div>
         </nav>  
     
		 <div class="container-fluid">
        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12"></div>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <form style="margin-top: 5vh;" class="form-container" method="POST">
                <h1 align="center">SIGNUP</h1><br>
                <div class="input-group form-group">
                   <span class="input-group-addon glyphicon glyphicon-user"></span>
                   <input type="text" class="form-control" id='name' name="name" placeholder="Full Name">
                </div>
                <div class="input-group form-group">
                   <span class="input-group-addon glyphicon glyphicon-user"></span>
                   <input type="text" class="form-control" id='username' name="username" placeholder="Username">
                </div><p id="username_set" style="color: red;"></p>
                <div class="input-group form-group">
                   <span class="input-group-addon glyphicon glyphicon-envelope"></span>
                   <input type="email" class="form-control" id='email' name="email" placeholder="Email">
                </div><p style="color: red;" id="email_set"></p>
                <div class="input-group form-group">
		   		   <span class="input-group-addon glyphicon glyphicon-lock"></span>
                   <input type="password" class="form-control" id='password' name="password" placeholder="Password">
                </div>
                <div class="input-group form-group">
                   <span class="input-group-addon glyphicon glyphicon-lock"></span>
                   <input type="password" class="form-control" id='confirm' name="confirm_password" placeholder="Confirm Password">
                </div><p style="color: red;" id='password_set'></p>
                <button type="button" onclick="validate();" class="btn btn-danger btn-block">Submit</button>
             </form>
           </div>
         <div class="col-md-4 col-sm-4 col-xs-12"></div>
       </div>
     </div>
		
	</body>
</html>