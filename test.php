<?php
    session_start();
    include("database_connection.php");

    $username='shivani';

    $query=mysqli_query($connect,"select * from items where item_id in(select item_id from bid where username='$username')")
           or die(mysqli_error($connect));

    while($row=mysqli_fetch_array($query))
    {
     echo'<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 masonry-item"> 
                  <div class="box-masonry"><a href="detail.html" title="" class="box-masonry-image with-hover-overlay with-hover-icon"><img src="uploads/'.$row['image'].'" alt="" class="img-responsive"></a>
                    <div class="box-masonry-text">
                      <h4> <a href="detail.html">Name of the work 3</a></h4>
                      <div class="box-masonry-desription">
                        <p>Fifth abundantly made Give sixth hath Cattle creature i be dont them</p>
                      </div>
                    </div>
                    <div class="ribbon sale">
                    <div class="theribbon">BID PLACED</div>
                    <div class="ribbon-background"></div>
                </div>
                  </div>
                </div>
            </div>
         </div>';
    }
    
    $query=mysqli_query($connect,"select * from items where item_id not in(select item_id from bid where username='$username')")
     or die(mysqli_error($connect));

     while($row=mysqli_fetch_array($query))
     {
        echo'<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 masonry-item"> 
        <div class="box-masonry"><a href="detail.html" title="" class="box-masonry-image with-hover-overlay with-hover-icon"><img src="uploads/'.$row['image'].'" alt="" class="img-responsive"></a>
          <div class="box-masonry-text">
            <h4> <a href="detail.html">Name of the work 3</a></h4>
            <div class="box-masonry-desription">
              <p>Fifth abundantly made Give sixth hath Cattle creature i be dont them</p>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>';
}
?>