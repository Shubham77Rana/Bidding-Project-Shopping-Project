<?php session_start(); ?>
<html>
    <head>
        <title>TheBidders</title>

        <!--<link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>-->

        <link href="css/font-awesome.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/animate.min.css" rel="stylesheet">
        <link href="css/owl.carousel.css" rel="stylesheet">
        <link href="css/owl.theme.css" rel="stylesheet">

        <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">

        <link href="css/custom.css" rel="stylesheet">

        <script src="js/respond.min.js"></script>

        
        

        <script type="text/javascript" src="scripts/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="scripts/jquery.form.js"></script>


        <script>

            function bid_winning()
            {
                var xhr=new XMLHttpRequest();
                xhr.open("GET","bid_end.php",false);
                xhr.send();
            }

            function bid_start()
            {
                var xhr=new XMLHttpRequest();
                xhr.open("GET","bid_start.php",false);
                xhr.send();
            }

            function load_items()
            {
                bid_winning();
                bid_start();
                var xhr=new XMLHttpRequest();
                xhr.open("GET","item_display.php",false);
                xhr.send();

                document.getElementById('detail_body').style.display="none";
                document.getElementById('main_body').style.display="block";
                document.getElementById('products').innerHTML=xhr.responseText;
            }

            function modal_open(item)
            {
                bid_winning();
                bid_start();
                document.getElementById('amount_set').style.display="none";
                document.getElementById('amount').value="0";
                document.getElementById('bid_on_item').value=item;
                $('#bid_btn').modal();
            }

            function place_bid()
            {
              var bid_item=document.getElementById('bid_on_item').value;
              var amount=document.getElementById('amount').value;
              var comments=document.getElementById('comments').value;

              var xhr=new XMLHttpRequest();
              xhr.open("POST","place_bid.php",false);
           		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xhr.send("item="+bid_item+"&amount="+amount+"&comments="+comments);

              this.response_status=xhr.responseText;

              if(response_status=="1")
              {
                  document.getElementById('amount_set').style.display="block";
                  document.getElementById('amount_set').innerHTML="amount cannot be negative";
              }
              else if(response_status=="2")
              {
                  document.getElementById('amount_set').style.display="block";
                  document.getElementById('amount_set').innerHTML="Increase your bid, check minimum bid increment";
              }
              else
              {
                  $('#bid_btn').modal("hide");
                  load_items();
                  alert("Bid Placed on item");
              }
            }

            function search()
            {
                bid_winning();
                bid_start();
                var search_string=document.getElementById('search_text').value;

                var xhr=new XMLHttpRequest();
                xhr.open("GET","search.php?search="+search_string,false);
                xhr.send();

                document.getElementById('main_body').style.display="block";
                document.getElementById('detail_body').style.display="none";
                document.getElementById('products').innerHTML=xhr.responseText;
            }

            function detail(item)
            {
                bid_winning();
                bid_start();
                var xhr=new XMLHttpRequest();
                xhr.open("GET","detail.php?item="+item,false);
                xhr.send();
                
                document.getElementById('main_body').style.display="none";
                document.getElementById('detail_body').style.display="block";
                document.getElementById('detail_body').innerHTML=xhr.responseText;
            }

            function sort_items()
            {
                bid_winning();
                bid_start();
                var sort=document.getElementById('sort').value;

                if(sort=="none")
                {
                    return load_items();
                }
                var xhr=new XMLHttpRequest();
                xhr.open("GET","sort_items.php?sort="+sort,false);
                xhr.send();
                
                document.getElementById('detail_body').style.display="none";
                document.getElementById('main_body').style.display="block";
                document.getElementById('products').innerHTML=xhr.responseText;
            }

            function bid_detail()
            {
                bid_winning();
                bid_start();
                var xhr=new XMLHttpRequest();
                xhr.open("GET","bid_detail.php",false);
                xhr.send();

                document.getElementById('main_body').style.display="none";
                document.getElementById('detail_body').style.display="block";
                document.getElementById('detail_body').innerHTML=xhr.responseText;
            }

            function purchased()
            {
                bid_winning();
                bid_start();
                var xhr=new XMLHttpRequest();
                xhr.open("GET","purchased.php",false);
                xhr.send();

                document.getElementById('main_body').style.display="none";
                document.getElementById('detail_body').style.display="block";
                document.getElementById('detail_body').innerHTML=xhr.responseText;
            }

            function sold()
            {
                bid_winning();
                bid_start();
                var xhr=new XMLHttpRequest();
                xhr.open("GET","sold.php",false);
                xhr.send();

                document.getElementById('main_body').style.display="none";
                document.getElementById('detail_body').style.display="block";
                document.getElementById('detail_body').innerHTML=xhr.responseText;
            }

            function review(email)
            {
                bid_winning();
                bid_start();
                var xhr=new XMLHttpRequest();
                xhr.open("GET","review.php?id="+email,false);
                xhr.send();

                document.getElementById('main_body').style.display="none";
                document.getElementById('detail_body').style.display="block";
                document.getElementById('detail_body').innerHTML=xhr.responseText;

                document.getElementById('review_name_set').style.display="none";
                document.getElementById('review_email_set').style.display="none";
            }

            function review_back()
            {
                bid_winning();
                bid_start();
                var username=document.getElementById("review_name").value;
                var email=document.getElementById("review_email").value;
                var review=document.getElementById("review_comment").value;
                var reviewer_name=document.getElementById("reviewer_username").value;

                if(username=="" || email=="" || review=="")
                {
                    alert("Fields cannnot be empty");
                }

                else
                {
                    document.getElementById('review_name_set').style.display="none";
                    document.getElementById('review_email_set').style.display="none";

                    var xhr=new XMLHttpRequest();
                    xhr.open("POST","review_back.php",false);
           		    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhr.send("username="+username+"&email="+email+"&review="+review+"&reviewer_name="+reviewer_name);

                    this.rs=xhr.responseText;
                    
                    if(rs=="1")
                    {
                        document.getElementById('review_email_set').style.display="block";    
                    }
                    else if(rs=="2")
                    {
                        document.getElementById('review_name_set').style.display="block";
                    }
                    else if(rs=="3")
                    {
                        load_items();
                        alert("Review submitted successfully");
                    }
                }
            }

            function seller_list()
            {
                bid_winning();
                bid_start();
                var xhr=new XMLHttpRequest();
                xhr.open("GET","seller_list.php",false);
                xhr.send();

                document.getElementById('main_body').style.display="none";
                document.getElementById('detail_body').style.display="block";
                document.getElementById('detail_body').innerHTML=xhr.responseText;
            }

            function buyer_list()
            {
                bid_winning();
                bid_start();
                var xhr=new XMLHttpRequest();
                xhr.open("GET","buyer_list.php",false);
                xhr.send();

                document.getElementById('main_body').style.display="none";
                document.getElementById('detail_body').style.display="block";
                document.getElementById('detail_body').innerHTML=xhr.responseText;
            }

            function add_items()
            {
                var xhr=new XMLHttpRequest();
                xhr.open("GET","add_items_front.php",false);
                xhr.send();

                document.getElementById('main_body').style.display="none";
                document.getElementById('detail_body').style.display="block";
                document.getElementById('detail_body').innerHTML=xhr.responseText;

                document.getElementById('item_set').style.display="none";
				document.getElementById('negative').style.display="none";
				document.getElementById('bid_date').style.display="none";
				document.getElementById('failed').style.display="none";
            }

            function add_item_validate()
			{
				var item=document.getElementById('item').value;
				var description=document.getElementById('description').value;
				var price=document.getElementById('price').value;
				var bid=document.getElementById('bid').value;
				var start_date=document.getElementById('start_date').value;
				var start_time=document.getElementById('start_time').value;
				var end_date=document.getElementById('end_date').value;
				var end_time=document.getElementById('end_time').value;
                var category=document.getElementById('category').value;

                var xhr=new XMLHttpRequest();
				xhr.open("POST","add_items.php",false);
           		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhr.send("item_name="+item+"&description="+description+"&start_price="+price+"&bid="+bid+"&start_date="+start_date+"&start_time="+start_time+"&end_date="+end_date+"&end_time="+end_time+"&category="+category);

				this.response_status=xhr.responseText;
				
				//document.write(response_status);

				document.getElementById('item_set').style.display="none";
				document.getElementById('negative').style.display="none";
				document.getElementById('bid_date').style.display="none";
				document.getElementById('failed').style.display="none";

				if(response_status.indexOf("1")!=-1)
				{
					alert("No fields can be left empty");
				}

				if(response_status.indexOf("2")!=-1)
				{
					document.getElementById('item_set').style.display="block";
					document.getElementById('item_set').innerHTML="Item name cannot start with number";
				}

				if(response_status.indexOf("3")!=-1)
				{
					document.getElementById('negative').style.display="block";
					document.getElementById('negative').innerHTML="Price and Bid cannot be negative<br>";
				}

				if(response_status.indexOf("4")!=-1)
				{
					document.getElementById('bid_date').style.display="block";
					document.getElementById('bid_date').innerHTML="Check your bid dates";
				}

				if(response_status=="5")
				{
					$("#imageform").ajaxForm({
						target: '#failed'
				    }).submit();
		
					setTimeout(test,200);
					
				}	
			}
			
		    function test()
		    {
			    var xhr=new XMLHttpRequest();
			    xhr.open("GET","image_upload_alert.php",false);
			    xhr.send();

			    this.res=xhr.responseText;
	
			    if(res=="1")
			    {
				    alert("successful");
				    window.location="bidding.php";
			    }

			    document.getElementById('failed').style.display="block";
		    }

            function category(category)
            {
                bid_winning();
                bid_start();

                var xhr=new XMLHttpRequest();
			    xhr.open("GET","category.php?category="+category,false);
			    xhr.send();

                document.getElementById('main_body').style.display="none";
                document.getElementById('detail_body').style.display="block";
                document.getElementById('detail_body').innerHTML=xhr.responseText;
            }

            function csv()
            {
                bid_winning();
                bid_start();

                var xhr=new XMLHttpRequest();
			    xhr.open("GET","csv_read_front.php",false);
			    xhr.send();

                document.getElementById('main_body').style.display="none";
                document.getElementById('detail_body').style.display="block";
                document.getElementById('detail_body').innerHTML=xhr.responseText;
            }

        </script>

    </head>

<body onload="load_items();">

    <!--shubham-->
    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container-fluid">
            <div class="navbar-header">

                <a class="navbar-brand home" href="bidding.php" data-animate-hover="bounce" style="font-size: 35px; padding-top: 20px;">TheBidders</a>
                <div class="navbar-buttons">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>                    
                    <a class="btn btn-default navbar-toggle" href="basket.html">
                        <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs">3 items in cart</span>
                    </a>
                </div>
            </div>

            <div class="navbar-collapse collapse" id="navigation">

                <ul class="nav navbar-nav navbar-left">
                    <li class="active"><a href="bidding.php">Home</a></li>
                    <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Category <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <h5>CATEGORY</h5>
                                            <ul>
                                                <li><a href="javascript:category(1);">Computer & Electronics</a>
                                                </li>
                                                <li><a href="javascript:category(2);">Camera</a>
                                                </li>
                                                <li><a href="javascript:category(3);">Mobiles</a>
                                                </li>
                                                <li><a href="javascript:category(4);">House</a>
                                                </li>
                                                <li><a href="javascript:category(5);">Fashion</a>
                                                </li>
                                                <li><a href="javascript:category(6);">Toys</a>
                                                </li>
                                                <li><a href="javascript:category(7);">Kitchen & Dinning</a>
                                                </li>
                                                <li><a href="javascript:category(8);">Others</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
                    <li>    

                        <form style="margin-left: 15px;" class="navbar-form" role="search" onsubmit="search();" action="#">
                            <div class="input-group">
                                <input type="text" id="search_text" size="40" class="form-control" placeholder="Search">
                                    <span class="input-group-btn">
                                        <button type="button" onclick="search();" style="height: 34px;" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </span>
                            </div>
                         </form>
                        
                    </li>
                  </ul>
            </div>

            <div class="navbar-buttons">
                <div class="navbar-collapse collapse right" id="basket-overview">
                    <a href="javascript:bid_detail();" class="btn btn-primary navbar-btn"><i class="fa fa-user"></i><span class="hidden-sm">Account(<?php echo $_SESSION['user'];?>)</span></a>
                    <a href="logout.php" class="btn btn-primary navbar-btn"><i class="fa fa-sign-out"></i><span class="hidden-sm">log_out</span></a>
                </div>
            </div>

        </div>

    </div>
        <!--rana-->


    <div id="all">

        <div id="content">
            <div class="container">
                <div class="col-md-3">
                    <div class="panel panel-default sidebar-menu">
                        <div class="panel-heading">
                            <h3 class="panel-title">TheBidders Menu</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked category-menu">
                                <li>
                                    <a href="javascript:add_items();">Add an Item <span class="pull-right"></span></a>
                                </li>
                                <li>
                                    <a href="javascript:csv();">Add Item From csv <span class="pull-right"></span></a>
                                </li>
                                <li>
                                    <a href="javascript:purchased();">Purchased Items  <span class="pull-right"></span></a>
                                </li>
                                <li>
                                    <a href="javascript:sold();">Sold Items  <span class="pull-right"></span></a>
                                </li>
                                <li>
                                    <a href="javascript:seller_list();">Review Sellers  <span class="pull-right"></span></a>
                                </li>
                                <li>
                                    <a href="javascript:buyer_list();">Review Buyers  <span class="pull-right"></span></a>
                                </li>
                                <li>
                                    <a href="purchased_pdf.php">Report of Purchased Items  <span class="pull-right"></span></a>
                                </li>
                                <li>
                                    <a href="sold_pdf.php">Report of Sold Items  <span class="pull-right"></span></a>
                                </li>
                            </ul>

                        </div>
                    </div>

                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">TheBidders Category </h3>
                        </div>

                        <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked category-menu">
                        <li>
                            <a href="javascript:category(1);">Computer & Electronics <span class="pull-right"></span></a>
                        </li>
                        <li>
                            <a href="javascript:category(2);">Camera  <span class="pull-right"></span></a>
                        </li>
                        <li>
                            <a href="javascript:category(3);">Mobiles  <span class="pull-right"></span></a>
                        </li>
                        <li>
                            <a href="javascript:category(4);">House  <span class="pull-right"></span></a>
                        </li>
                        <li>
                            <a href="javascript:category(5);">Fashion  <span class="pull-right"></span></a>
                        </li>
                        <li>
                            <a href="javascript:category(6);">Toys  <span class="pull-right"></span></a>
                        </li>
                        <li>
                            <a href="javascript:category(7);">Kitchen & Dinning  <span class="pull-right"></span></a>
                        </li>
                        <li>
                            <a href="javascript:category(8);">Others  <span class="pull-right"></span></a>
                        </li>

                    </ul>

                        </div>
                    </div>
                    
                    <!-- *** MENUS AND FILTERS END *** -->

                    <div class="banner">
                        <a href="">
                            <img src="img/banner.jpg" alt="sales 2014" class="img-responsive">
                        </a>
                    </div>
                </div>

                <!--shubham-->

                <div id="detail_body" class="col-md-9"></div>
                <div id="main_body" class="col-md-9">
                    <div class="box jumbotron">
                        <h1>TheBidders</h1>
                        <p>The higher you bid, the more is chance of owning an Precious Item</p>
                    </div>

                    <!--rana-->


                    <div class="box info-bar">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 products-showing">
                                Showing <strong>items</strong> for <strong>Bidding</strong>
                            </div>

                            <div class="col-sm-12 col-md-8  products-number-sort">
                                <div class="row">
                                    <form class="form-inline">
                                        <div class="col-md-6 col-sm-6">
                                          <!--<div class="products-number">
                                                <strong>Show</strong>  <a href="#" class="btn btn-default btn-sm btn-primary">12</a>  <a href="#" class="btn btn-default btn-sm">24</a>  <a href="#" class="btn btn-default btn-sm">All</a> products
                                            </div>-->
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="products-sort-by">
                                                <strong>Sort by</strong>
                                                <select id="sort" name="sort-by" class="form-control" onchange="sort_items();">
                                                    <option value="none">none</option>
                                                    <option value="lth">Price: low to high</option>
                                                    <option value="htl">Price: high to low</option>
                                                    <option value="name">Name</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--shubham-->
                    <div class="row products" id="products"></div>
                    <!--rana-->

                    <div class="pages">

                        <p class="loadMore">
                            <a href="#" class="btn btn-primary btn-lg"><i class="fa fa-chevron-up"></i>Go to Tops</a>
                        </p>

                        <!--<ul class="pagination">
                            <li><a href="#">&laquo;</a>
                            </li>
                            <li class="active"><a href="#">1</a>
                            </li>
                            <li><a href="#">2</a>
                            </li>
                            <li><a href="#">3</a>
                            </li>
                            <li><a href="#">4</a>
                            </li>
                            <li><a href="#">5</a>
                            </li>
                            <li><a href="#">&raquo;</a>
                            </li>
                        </ul>-->
                    </div>


                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

        <div class="modal fade" id="bid_btn" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h1><span class="fa fa-money"></span> TheBidders </h1>
                                </div>
                               <div class="modal-body">
                                    <form role="form" method="POST" >
                                        <div class="form-group">
                                            <label for="amount"><span class="fa fa-inr"></span> Bid Amount </label>
                                            <input type="number" class="form-control" id="amount" placeholder="Bid Amount">
                                            <div id="amount_set" class="alert alert-danger"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="comments"><span class="fa fa-comments"></span> Comments </label>
                                            <input type="text" class="form-control" id="comments" placeholder="Comments if any">
                                        </div>
                                        <input type="hidden" id="bid_on_item">
                                        <button type="button" onclick="place_bid();" class="btn btne btn-block">Place Bid
                                            <span class="fa fa-check-square-o"></span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
        <div id="copyright">
            <div class="container">
                <div class="col-md-6">
                    <p class="pull-left">&copy 2017-2018.</p>

                </div>
                <div class="col-md-6">
                    <p class="pull-right">Designed by <a>Shivani Ghughtyal</a> & <a>Shubham Rana</a>
                    </p>
                </div>
            </div>
        </div>


    </div>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>






</body>

</html>