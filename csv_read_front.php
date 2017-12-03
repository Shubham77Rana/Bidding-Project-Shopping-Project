<?php
echo'<div class="box">
        <h1>Add From Comma Separated File</h1>
        <p class="alert alert-warning"> VALUES  IN  CSV  MUST  FOLLOW  BELOW  MENTIONED  RULES :
            <ul class="alert alert-warning">
                <li>1st column must have name of item and 2nd must have desciprtion of item</li>
                <li>3rd and 4th must have price and minimum bid increment on item resp.</li>
                <li>5th and 6th must have start date and time resp.</li>
                <li>7th and 8th must have end date and time resp.</li>
                <li>Date Format: yyyy-mm-dd  Time Format: hh:mm:ss </li>
                <li>9th column must specify a number denoting category
                    <ol>
                        <li> computer & electronics</li>
                        <li> camera</li>
                        <li> mobiles</li>
                        <li> house</li>
                        <li> fashion</li>
                        <li> toys</li>
                        <li> kitchen & dinning</li>
                        <li> others</li>
                    </ol>
                </li>
            </ul>
        </p>
     </div>
    
    <div class="col-sm-10 col-sm-offset-1">
        <div class="box">
            <form action="csv_read.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="csv">Add Csv File</label>
                    <input type="file" style="border: none;" id="csv" name="csv" class="form-control" required="">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btne"><i class="fa fa-plus"></i> Upload csv</button>
                </div>
            </form>
        </div>
    </div>';

?>