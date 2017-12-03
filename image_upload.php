<?php

    session_start();

    $_SESSION['upload']="failed";
    
    include("database_connection.php");
    
    $path = "uploads/";

	$formats = array("jpg", "png", "gif","jpeg");
    
	$upload_successful=1;
	
	$name = $_FILES['photoimg']['name'];
    $size = $_FILES['photoimg']['size'];
    
    list($file_name, $extension) = explode(".", $name);
    
    if(strlen($name)==0)
    {
        echo "<div>No image selected</div>";
        $upload_successful=0;
    }
    
	else if(!in_array($extension,$formats))
	{
	    $upload_successful=2;
	}
	
	else if($size>5242880 || $size<=0)
	{
	    $upload_successful=3;
	}
	
	else 
	{
	      $query=mysqli_query($connect,"select max(item_id) from items");
	      
	      if(mysqli_num_rows($query)>0)
	      {
	           $row=mysqli_fetch_array($query);
	           $row_id=$row[0];
	      }
	      else
	      {
	          $row_id="GEU-1";
	      }
	       
	      $image_name = $row_id.".".$extension ;
	      $tmp = $_FILES['photoimg']['tmp_name'];
	      
	      if(move_uploaded_file($tmp, $path.$image_name))
	      {
			  $_SESSION['upload']="passed";
			  mysqli_query($connect,"update items set image='$image_name' where item_id='$row_id'");
	      }
	      else
	      {
	          echo "<div>Unsuccessful ".$_FILES['photoimg']['size']." ".$row_id."</div>";
          }
	}
	
	if($upload_successful==2)
	{
	    echo "<div>Not an image or jpg, png, gif extension...</div>";
	}
	
	if($upload_successful==3)
	{
	    echo "<div>image size exceeds 2MB...</div>";
	}
	
	if($_SESSION['upload']=="failed" && isset($_SESSION['recent_item']) && $_SESSION['recent_item']==true)
	{
	    $query=mysqli_query($connect,"select max(item_id) from items");
	    
	    if(mysqli_num_rows($query)>0)
	    {
	        $row=mysqli_fetch_array($query);
	        $row_id=$row[0];
	    }
	    else
	    {
	        $row_id="GEU-1";
	    }
	    
	    $query=mysqli_query($connect,"delete from items where item_id='$row_id'") or die(mysqli_error($connect));
	  
		$_SESSION['recent_item']=false;
	}
							
?>