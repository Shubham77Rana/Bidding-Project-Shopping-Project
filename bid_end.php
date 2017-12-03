<?php
    session_start();
    include("database_connection.php");

    $result=mysqli_query($connect,"select item_id,end_date,bsbe from items");

    date_default_timezone_set('Asia/Kolkata');

    $current_time=date('Y-m-d H:i:s');

    while($row=mysqli_fetch_array($result))
    {
        $test_end_date=$row['end_date'];
        $item_id=$row['item_id'];
        if(strtotime($test_end_date)<=strtotime($current_time) && $row['bsbe']==0)
        {
            mysqli_query($connect,"update items set bsbe=2 where item_id='$item_id'") or die(mysqli_error($connect));
            $query=mysqli_query($connect,"select max(bid) from bid where item_id='$item_id'") or die(mysqli_error($connect));
            $row1=mysqli_fetch_array($query);
            $max_bid=$row1[0];
            $query=mysqli_query($connect,"select username from bid where item_id='$item_id' and bid=$max_bid") or die(mysqli_error($connect));
            $row1=mysqli_fetch_array($query);
            $winner=$row1['username'];
            mysqli_query($connect,"insert into bid_won (winner,item_id,price) values('$winner','$item_id',$max_bid)") or die(mysqli_error($connect));
        }
    }

?>