<?php
    session_start();
    include("database_connection.php");

    $result=mysqli_query($connect,"select item_id,start_date,bsbe from items");

    date_default_timezone_set('Asia/Kolkata');

    $current_time=date('Y-m-d H:i:s');

    while($row=mysqli_fetch_array($result))
    {
        $test_start_date=$row['start_date'];
        $item_id=$row['item_id'];
        if(strtotime($test_start_date)<=strtotime($current_time) && $row['bsbe']==1)
        {
            mysqli_query($connect,"update items set bsbe=0 where item_id='$item_id'") or die(mysqli_error($connect));
        }
    }

?>