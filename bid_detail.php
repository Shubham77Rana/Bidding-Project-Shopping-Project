<?php

session_start();
include("database_connection.php");

$username=$_SESSION['user'];

$query=mysqli_query($connect,"select * from bid where username='$username'") or die(mysqli_error($connect));

if(mysqli_num_rows($query)<1)
{
    echo   '<div class="box">
                <h1>Bid Placed</h1>
                <p>No Bid Placed Yet, Start Bidding before you lose a precious item</p>
            </div>';
}
else
{
    echo '<div class="box">
                        <h1>Bid Placed</h1>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Bid Date</th>
                                        <th>Bid Amount</th>
                                        <th>Seller</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>';
                while($row=mysqli_fetch_array($query))
                {
                           $item_id=$row['item_id'];
                           $query1=mysqli_query($connect,"select item_name,seller from items where item_id='$item_id'") or die(mysqli_error($connect));
                           $row1=mysqli_fetch_array($query1);
                           $date=explode(' ',$row['bid_date']);
                           echo    '<tr>
                                        <th># '.$row1['item_name'].'</th>
                                        <td>'.$date[0].'</td>
                                        <td class="fa fa-inr">'.$row['bid'].'</td>
                                        <td><span style="font-size: 19px" class="label label-default">'.$row1['seller'].'</span>
                                        </td>
                                        <td><a href="javascript:detail(\''.$row['item_id'].'\');" class="btn btn-primary btn-sm">View Detail</a>
                                        </td>
                                    </tr>';
                }                   
                        echo   '</tbody>
                            </table>
                        </div>
                    </div>';
}

?>