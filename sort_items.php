<?php
    session_start();
    include("database_connection.php");

    $username=$_SESSION['user'];
    $sort=$_GET['sort'];

    if($sort=="lth")
    {
        $query=mysqli_query($connect,"select * from items where bsbe=0 order by current_price")
           or die(mysqli_error($connect));
    }
    else if($sort=="htl")
    {
        $query=mysqli_query($connect,"select * from items where bsbe=0 order by current_price desc")
           or die(mysqli_error($connect));
    }
    else if($sort=="name")
    {
        $query=mysqli_query($connect,"select * from items where bsbe=0 order by item_name")
           or die(mysqli_error($connect));
    }

    while($row=mysqli_fetch_array($query))
    {
     echo '<div class="col-md-4 col-sm-6">
             <div class="product mason-shadow">
                <a href="javascript:detail(\''.$row['item_id'].'\');">
                    <img src="uploads/'.$row['image'].'" alt="" class="img-responsive same-size">
                </a>';
        $item_id=$row['item_id'];
        if(mysqli_num_rows(mysqli_query($connect,"select item_id from bid where item_id='$item_id' and username='$username'"))>0)
        {    
            echo '<div class="ribbon sale">
                    <div class="theribbon">BID PLACED</div>
                    <div class="ribbon-background"></div>
                </div>';
        }            
        echo   '<div class="text">
                    <h3><a href="javascript:detail(\''.$row['item_id'].'\');" style="text-transform: capitalize;">'.$row['item_name'].'</a></h3>
                    <p class="price"><b>Price</b> : <i class="fa fa-inr"></i> '.$row['current_price'].'<p>
                    <p class="price"><b>Min-Bid Inc</b> : <i class="fa fa-inr"></i> '.$row['bid'].'<p>
                    <p class="buttons">
                        <a href="javascript:detail(\''.$row['item_id'].'\');" class="btn btn-default">View detail</a>';
        if(mysqli_num_rows(mysqli_query($connect,"select item_id from bid where item_id='$item_id' and username='$username'"))>0)
        {    
                  echo '<button onclick="modal_open(\''.$row['item_id'].'\');" class="btn btne">Bid Again</button><br><br>';
        }         
        else
        {              
                 echo  '<button onclick="modal_open(\''.$row['item_id'].'\');" class="btn btne">Bid on Item</button><br><br>';
        }
                echo '</p>
                </div>
             </div>
           </div>';
    }
?>