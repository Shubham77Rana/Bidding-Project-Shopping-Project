<?php

echo '<div class="box jumbotron">
        <h1>Add Items</h1>
        <p>The more you add, the more you get for yourself</p>
      </div>
      <div class="col-sm-10 col-sm-offset-1">
        <div class="box">
            <form id="imageform" action="image_upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="item_name">Item Name</label>
                    <input type="text" class="form-control" id="item" name="item_name" placeholder="Item Name" required="">
                    <div id="item_set" class="alert alert-danger"></div>
                </div>
                <div class="form-group">
                    <label for="photoimg">Add Image</label>
                    <input type="file" style="border: none;" id="photoimg" name="photoimg" class="form-control" required="">
                </div>
                <div class="alert alert-danger" id="failed"></div>
                <div class="form-group">
                    <label for="category">Choose Category</label>
                    <select id="category" name="category" class="form-control">
                        <option value=1>Computer & Electronics</option>
                        <option value=2>Camera</option>
                        <option value=3>Mobiles</option>
                        <option value=4>House</option>
                        <option value=5>Fashion</option>
                        <option value=6>Toys</option>
                        <option value=7>Kitchen & Dinning</option>
                        <option value=8>Others</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" style="height: 90px;" name="description" placeholder="Brief Description of your Item" required=""></textarea>
                </div>
                <div class="form-group">
                    <label for="starting_price">Starting Price</label>
                    <input id="price" type="number" value="0" name="starting_price" placeholder="Starting price" class="form-control" required="">
                </div>
                <div style="padding-left: 85px;" class="alert alert-danger" id="negative"></div>
                <div class="form-group">
                    <label for="minimum_bid">Minimum Bid</label>
                    <input type="number" id="bid" value="5" name="minimum_bid" placeholder="Minimum Bid" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label for="start_date">Bid Start Date</label>
                    <div class="col-sm-12">
                        <div class="col-sm-6"><input type="date" id="start_date" name="start_date" value='.date('Y-m-d').' class="form-control" required=""></div>
                        <div class="col-sm-6"><input type="time" id="start_time" name="start_time" value='.date('H:i:').'00'.' class="form-control" required=""></div>
                    </div>
                </div><br><br>
                <div id="bid_date" class="alert alert-danger"></div>
                <div class="form-group">
                    <label for="end_date">Bid End Date</label>
                    <div class="col-sm-12">
                        <div class="col-sm-6"><input type="date" id="end_date" name="end_date" value='.date('Y-m-d',strtotime(date('d-m-Y').' + 3 days')).' class="form-control" required=""></div>
                        <div class="col-sm-6"><input type="time" id="end_time" name="end_time" value='.date('H:i:').'00'.' class="form-control" required=""></div>
                    </div>
                </div><br><br>
                <div class="text-center">
                    <button onclick="add_item_validate();" class="btn btne"><i class="fa fa-plus"></i> Add Item</button>
                </div>
            </form>
        </div>
    </div>';

?>