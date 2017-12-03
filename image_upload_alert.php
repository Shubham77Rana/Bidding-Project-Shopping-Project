<?php
    session_start();
    if($_SESSION['upload']=="passed")
    {
        echo "1";
    }
    else 
    {
        echo "2";
    }
       