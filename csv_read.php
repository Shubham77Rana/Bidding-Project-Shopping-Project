<?php
    session_start();
    include ("database_connection.php");
    
    $name = $_FILES['csv']['name'];
    $size = $_FILES['csv']['size'];
    $path = "csv/";
    
    list($file_name, $extension) = explode(".", $name);
    
    if(strlen($name)==0)
    {
        echo "<script>alert('No file selected'); window.location='bidding.php'</script>";
        $upload_successful=0;
    }
    
	else if($extension!="csv")
	{
        echo "<script>alert('Not a csv file'); window.location='bidding.php'</script>";
	    $upload_successful=2;
	}
	
	else if($size>5242880 || $size<=0)
	{
        "<script>alert('size is too large'); window.location='bidding.php'</script>";
	    $upload_successful=3;
	}
	
	else 
	{
	      $tmp = $_FILES['csv']['tmp_name'];
          
	      if(move_uploaded_file($tmp, $path.$name))
	      {
                $file = fopen("shubham.csv","r");
            
                while(! feof($file))
                {
                    $line=fgetcsv($file);
                    $username=$_SESSION['user'];
                    
                    $item_name=$line[0];
                    $description=$line[1];
                    $start_price=$line[2];
                    $bid=$line[3];
                    $start_date=$line[4];
                    $start_time=$line[5];
                    $end_date=$line[6];
                    $end_time=$line[7];
                    $category=$line[8];
            
            
                    $flag=true;
               
                    // echo $item_name." ".$description." ".$start_price." ".$bid." ".$start_date." ".$start_time." ".$end_date." ".$end_time;
            
                    if($item_name=="" || $description=="" || $start_date=="" || $start_time==""
                        || $end_date=="" || $end_time=="")
                    {
                        $flag=false;
                    }
               
                    if(is_numeric(substr($item_name,0,1)))
                    {
                        $flag=false;
                    }
               
                    if($start_price<0 || $bid<0)
                    {
                        $flag=false;
                    }
               
                    if(strtotime($start_time)+strtotime($start_date)>=strtotime($end_date)+strtotime($end_time))
                    {
                        $flag=false;
                    }
               
                     if($flag==true)
                    {
                        $query=mysqli_query($connect,"select max(item_id) from items");
                   
                        if(mysqli_num_rows($query)>0)
                        {
                            $row=mysqli_fetch_array($query);
                            $row_id=$row[0];
                            $row_filter_id=explode('-',$row_id,2);
                            $id=$row_filter_id[1];
                            $id++;
                        }
                   
                        else
                        {
                            $id=1;
                        }
                   
                   
                        $start_date=$start_date." ".$start_time;
                        $end_date=$end_date." ".$end_time;
            
                        $id="GEU-".$id;
                 
                        $query=mysqli_query($connect,"insert into items (item_id,item_name,description,initial_price,current_price,bid,start_date,end_date,seller,category)
                                values('$id','$item_name','$description',$start_price,$start_price,$bid,'$start_date','$end_date','$username',$category)")
                                    or die(mysqli_error($query));   
                    }
                }
                
                fclose($file); 

                echo "<script>alert('Successful'); window.location='bidding.php'</script>";
                
	      }
	      else
	      {
	          echo "<script>alert('unsuccessful'); window.location='bidding.php'</script>";
          }
	}

?>