<?php
    session_start();
    include("database_connection.php");

    $query=mysqli_query($connect,"select name,email from users where username in(select winner from bid_won)") 
                        or die(mysqli_error($connect));
    if(mysqli_num_rows($query)<1)
    {
        echo '<div class="box jumbotron">
                <h1>Buyers</h1>
                <p>No buyer yet, the site has just started</p>
              </div>';
    }
    else
    {
       echo '<div class="box jumbotron">
                <h1>Buyers</h1>
                <p>Review the buyers you want to, let them know</p>
            </div>';
      while($row=mysqli_fetch_array($query))
      {
        list($firstname,$lastname)=explode(' ',$row['name']);
        echo '<div class="col-md-3 col-sm-4 col-xs-6">
                    <div class="product mason-shadow ">
                        <img src="img/buyer.jpeg" alt="BUYER" class="img-responsive">
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