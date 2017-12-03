<?php
    session_start();
    include("database_connection.php");
    
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    if($username=="" || $password=="")
    {
        echo "1";
    }
  
    $query=mysqli_query($connect,"select * from users where username='$username'") or die(mysqli_error($connect));
    
    if(mysqli_num_rows($query)<1 && $username!="")
    {
        echo "2";
    }
    else
    {
        $user_detail=mysqli_fetch_array($query);

        if($user_detail['password']==$password)
        {	    
            $_SESSION['user']=$username;
            echo "4";
        }
        else{
            echo "3";
        }
    }
?>
