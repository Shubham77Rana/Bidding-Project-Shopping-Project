<?php
    include("database_connection.php");
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $name=$_POST['name'];
    $confirm=$_POST['confirm'];
    
    $user_unique=mysqli_num_rows(mysqli_query($connect,"select * from users where username='$username'"));
    $email_unique=mysqli_num_rows(mysqli_query($connect,"select * from users where email='$email'"));
    
    $flag=0;
    
    if($name=='' || $password=='' || $confirm=='' || $email=='' || $username=='')
    {
            echo "0";
            $flag=1;
    }
    
    if($user_unique > 0)
    {
        echo "1";
    }
    
    if($email_unique > 0)
    {
        echo "2";
    }
       
    if($password!=$confirm)
    {
        echo "3";
    }
     
    else if($user_unique==0 && $email_unique==0 && $flag==0)
    {
        $query=mysqli_query($connect,"insert into users (name,username,password,email) values('$name','$username','$password','$email')")
                     or die(mysqli_error($query));
        echo "4";
    }