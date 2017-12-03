<?php
    session_start();
    include("database_connection.php");

    $bid_item=$_POST['item'];
    $amount=$_POST['amount'];
    $comment=$_POST['comments'];
    //$username=$_SESSION['users'];

    $username=$_SESSION['user'];

    if($amount<0)
    {
        echo "1";
        exit;
    }

    $query=mysqli_query($connect,"select * from items where item_id='$bid_item'") 
        or die(mysqli_error($query));
    $row=mysqli_fetch_array($query);
    
    if($row['current_price']+$row['bid']>$amount)
    {
        echo "2";
        exit;
    }

    if(mysqli_num_rows(mysqli_query($connect,"select * from bid where item_id='$bid_item' and username='$username'"))>0)
    {
        $query=mysqli_query($connect,"update bid set bid=$amount , comments='$comment' where item_id='$bid_item' and username='$username'")
               or die(mysqli_error($query));
    }
    else
    {
        $query=mysqli_query($connect,"insert into bid (username,item_id,bid,comments) values('$username',
           '$bid_item',$amount,'$comment')") or die(mysqli_error($query));
    }

    $query=mysqli_query($connect,"update items set current_price=$amount where item_id='$bid_item'")
        or die(mysqli_error($query));

?>