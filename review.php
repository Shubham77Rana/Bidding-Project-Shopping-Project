
<?php
    session_start();
    include("database_connection.php");

    $username=$_SESSION['user'];

    $email=$_GET['id'];

    $query=mysqli_query($connect,"select username,name,email from users where email='$email'") or die(mysqli_error($connect));
    $row=mysqli_fetch_array($query);
    list($firstname,$lastname)=explode(' ',$row['name']);
    
    $query1=mysqli_query($connect,"select username,email from users where username='$username'") or die(mysqli_error($connect));
    $row1=mysqli_fetch_array($query1);

echo'<div class="box jumbotron">
        <h1>Review</h1>
        <p>Feel free to review anyone, let them know</p>
     </div>
<div class="col-sm-8">
    <div class="box">
        <form method="post" id="review_form">
            <div class="form-group">
                <label for="name">User Name</label>
                <input type="text" class="form-control" value='.$row1['username'].' id="review_name" required="">
            </div>
            <div id="review_name_set" class="alert alert-danger">username or email does not exist</div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="review_email" value='.$row1['email'].' required="">
            </div>
            <div id="review_email_set" class="alert alert-danger">Invalid email address</div>
            <div class="form-group">
                <label for="review">Review</label>
                <textarea style="height: 100px;" class="form-control" id="review_comment" required=""></textarea>
            </div>
            <input type="hidden" id="reviewer_username" value='.$row['username'].'>
            <div class="text-center">
                <button type="button" onclick="review_back();" class="btn btne"><i class="fa fa-star-half-o"></i> Review</button>
            </div>
        </form>
    </div>
  </div>
  <div class="col-sm-4" align="center">
    <div class="box">
        <h4>Name : '.ucfirst($firstname).' '.ucfirst($lastname).'</h4>
        <div class="square-box" align="center">
            <span class="fa fa-user fa-lg"></span>
        </div>
        <span class="fa fa-envelope"> Email<br><br> '.$email.'</span>
    </div>
  </div>';

  $seller_buyer=$row['username'];
  $query3=mysqli_query($connect,"select username,reviews from reviews where seller_buyer='$seller_buyer'")
                      or die(mysqli_error($connect));
  
  while($row3=mysqli_fetch_array($query3))
  {
  echo  '<div class="box col-xs-11">
            <div class="col-xs-2">
                    <p class="text-center"><b>'.$row3['username'].'</b><br><br>
                       <img src="img/review.jpeg" class="img-responsive" alt="reviews">
                    </p>
            </div>
            <div class="col-xs-10">
                    <p><br><br><b>Review : </b>'.$row3['reviews'].'</p>
            </div>
        </div>';
  }
?>