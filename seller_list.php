<?php
    session_start();
    include("database_connection.php");

    $query=mysqli_query($connect,"select name,email from users where username in(select seller from items where item_id in(select item_id from bid_won))") 
                        or die(mysqli_error($connect));
    if(mysqli_num_rows($query)<1)
    {
        echo '<div class="box jumbotron">
                <h1>Sellers</h1>
                <p>No sellers yet, the site has just started</p>
              </div>';
    }
    else
    {
      while($row=mysqli_fetch_array($query))
      {
        list($firstname,$lastname)=explode(' ',$row['name']);
        echo ' <div class="box jumbotron">
                  <h1>Sellers</h1>
                    <p>Review the sellers you want to, let them know</p>
               </div>
               <div class="col-md-3 col-sm-4 col-xs-6">
                    <div class="product mason-shadow ">
                        <img src="img/seller.jpeg" alt="SELLER" class="img-responsive">
                        <div class="text">
                            <p class="price"><i class="fa fa-envelope"></i> '.ucfirst($firstname).' '.ucfirst($lastname).'
                            <p class="buttons">
                                <button onclick="review(\''.$row['email'].'\')" class="btn btne"><i class="fa fa-star"></i>Review</button><br><br>
                            </p>
                        </div>
                    </div>
               </div>'; 
      }
    }

?>