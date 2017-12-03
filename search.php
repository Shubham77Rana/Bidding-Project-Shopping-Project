<?php
    session_start();
    include("database_connection.php");

    $search=$_GET['search'];
    $username=$_SESSION['user'];

    $query=mysqli_query($connect,"select * from items where (item_name like '%$search%' or description
                         like '%$search') and item_id in (select item_id from bid where username='$username' ) and bsbe=0")
                         or die(mysqli_error($connect));
    
    while($row=mysqli_fetch_array($query))
    {
        echo'<div class="col-md-4 col-sm-6">
        <div class="product mason-shadow">
            <a href="javascript:detail(\''.$row['item_id'].'\');">
                <img src="uploads/'.$row['image'].'" alt="" class="img-responsive same-size">
            </a>
        
            <div class="text">
                <h3><a href="javascript:detail(\''.$row['item_id'].'\');" style="text-transform: capitalize;">'.$row['item_name'].'</a></h3>
                <p class="price"><b>Price</b> : <i class="fa fa-inr"></i> '.$row['current_price'].'<p>
                <p class="price"><b>Min-Bid Inc</b> : <i class="fa fa-inr"></i> '.$row['bid'].'<p>
                <p class="buttons">
                    <a href="javascript:detail(\''.$row['item_id'].'\');" class="btn btn-default">View detail</a>
                    <button onclick="modal_open(\''.$row['item_id'].'\');" class="btn btne">Bid Again</button><br><br>
                </p>
            </div>
        
            <div class="ribbon sale">
                <div class="theribbon">BID PLACED</div>
                <div class="ribbon-background"></div>
            </div>
        </div>
     </div>';   
    }

    $query=mysqli_query($connect,"select * from items where (item_name like '%$search%' or description
                        like '%$search') and item_id not in (select item_id from bid where username='$username') and bsbe=0")
                        or die(mysqli_error($connect));

    while($row=mysqli_fetch_array($query))
    {
        echo'<div class="col-md-4 col-sm-6">
        <div class="product mason-shadow">
            <a href="javascript:detail(\''.$row['item_id'].'\');">
                <img src="uploads/'.$row['image'].'" alt="" class="img-responsive same-size">
            </a>
        
            <div class="text">
                <h3><a href="javascript:detail(\''.$row['item_id'].'\');" style="text-transform: capitalize;">'.$row['item_name'].'</a></h3>
                <p class="price"><b>Price</b> : <i class="fa fa-inr"></i> '.$row['current_price'].'<p>
                <p class="price"><b>Min-Bid Inc</b> : <i class="fa fa-inr"></i> '.$row['bid'].'<p>
                <p class="buttons">
                    <a href="javascript:detail(\''.$row['item_id'].'\');" class="btn btn-default">View detail</a>
                    <button onclick="modal_open(\''.$row['item_id'].'\');" class="btn btne">Bid on Item</button><br><br>
                </p>
            </div>
        </div>
     </div>';
    }

?>