<?php
    session_start();
    include("database_connection.php");

    $item=$_GET['item'];

    $query=mysqli_query($connect,"select * from items where item_id='$item'") or die(mysqli_error($connect));
    $row=mysqli_fetch_array($query);

    $query1=mysqli_query($connect,"select max(bid),count(bid) from bid where item_id='$item'") or die(mysqli_error($connect));
    $row1=mysqli_fetch_array($query1);

    $username=$_SESSION['user'];

    if(mysqli_num_rows(mysqli_query($connect,"select item_id from bid where username='$username' and item_id='$item'"))<1)
    {
        $flag=false;
    }
    else
    {
        $flag=true;
    }

    echo       '<div class="row" id="productMain">
                   <div class="col-sm-6">
                       <img src="uploads/'.$row['image'].'" alt="" class="img-responsive">';

    if($flag==true)
    {          echo    '<div class="ribbon sale">
                            <div class="theribbon">BID PLACED</div>
                            <div class="ribbon-background"></div>
                        </div>';
    }
    
    echo           '</div>
                    <div class="col-sm-6">
                      <div class="box">
                        <h1 class="text-center" style="text-transform: capitalize;">'.$row['item_name'].'</h1>
                        <p class="goToDescription"><a href="#details" class="scroll-to">Scroll to product details, & other details</a></p>
                        <p class="price"><b>Price</b> : <i class="fa fa-inr"></i>'.$row['current_price'].'<p>
                        <p class="text-center buttons">';
    if($row['bsbe']==0)
    {
        if($flag==true)
        {   
                      echo '<button onclick="modal_open(\''.$row['item_id'].'\');" class="btn btne">Bid Again</button>';
        }
        else
        {
                      echo '<button onclick="modal_open(\''.$row['item_id'].'\');" class="btn btne">Bid on Item</button>';
        }
    }
    
    echo                    '</p>
                    </div>
                </div>
           </div>
           <div class="box container-fluid" id="details">
                <p>
                    <div class="col-sm-5"><h4><u>Item Description</u></h4>
                    <p style="padding-left: 40px;"class="fa fa-check">'.$row['description'].'</p></div>
                    <div class="col-sm-6"><h4><u>Bidding Information</u></h4>
                    <ul>
                        <li class="fa fa-check"> Initial Price : '.$row['initial_price'].'</li><br>
                        <li class="fa fa-check"> Current Price : '.$row['current_price'].'</li><br>
                        <li class="fa fa-check"> Minimum Bid Increment : '.$row['bid'].'</li><br>
                    </ul></div>
                    <div class="col-sm-5"><h4><u>Date Information</u></h4>
                    <ul>
                        <li class="fa fa-check">Start Date : '.$row['start_date']." ".$row['start_time'].'</li><br>
                        <li class="fa fa-check">End Date : '.$row['end_date']." ".$row['end_time'].'</li><br>
                    </ul></div>
                    <div class="col-sm-6"><h4><u>Bidders</u></h4>
                    <ul>
                        <li class="fa fa-check">Highest Bidder : '.$row1[0].'</li><br>
                        <li class="fa fa-check">Total Bidders : '.$row1[1].'</li><br>
                    </ul></div>
            </div>';
?>