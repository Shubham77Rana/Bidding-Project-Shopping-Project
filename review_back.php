<?php
    session_start();
    include("database_connection.php");

    $username=$_POST['username'];
    $email=$_POST["email"];
    $review=$_POST['review'];
    $reviewer_name=$_POST['reviewer_name'];
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "1";
    }

    else if(mysqli_num_rows(mysqli_query($connect,"select username from users where username='$username' and email='$email'"))<1)
    {
        echo "2";
    }
    
    else
    {
        mysqli_query($connect,"insert into reviews (username,email,reviews,seller_buyer) values('$username','$email','$review','$reviewer_name')")
           or die(mysqli_error($connect));
        echo "3";
    }

?>