<?php
   session_start();
   include ("database_connection.php");

   $username=$_SESSION['user'];

   $item_name=$_POST['item_name'];
   $description=$_POST['description'];
   $start_price=$_POST['start_price'];
   $bid=$_POST['bid'];
   $start_date=$_POST['start_date'];
   $start_time=$_POST['start_time'];
   $end_date=$_POST['end_date'];
   $end_time=$_POST['end_time'];
   $category=$_POST['category'];
   
   $flag=true;
   
   // echo $item_name." ".$description." ".$start_price." ".$bid." ".$start_date." ".$start_time." ".$end_date." ".$end_time;

   if($item_name=="" || $description=="" || $start_date=="" || $start_time==""
       || $end_date=="" || $end_time=="")
   {
       echo "1";
       $flag=false;
   }
   
   if(is_numeric(substr($item_name,0,1)))
   {
       echo "2";
       $flag=false;
   }
   
   if($start_price<0 || $bid<0)
   {
       echo "3";
       $flag=false;
   }
   
   if(strtotime($start_time)+strtotime($start_date)>=strtotime($end_date)+strtotime($end_time))
   {
       echo "4";
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

       $_SESSION['recent_item']=true;
       
       echo "5";
   }
   