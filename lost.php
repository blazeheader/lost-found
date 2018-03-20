<!DOCTYPE html>
<html>
<head>
    <title>Report Lost Items</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <script src = "js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <style type="text/css">
        body,html{
            background-image: url("images/lost.png");
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
            background-size: cover;
            background-size: 100% 100%;
        }
        #drop{
            font-size: 16px;
            color: white;
            padding-left: 15%;
            padding-top: 10%;
            margin-bottom: 15px;

        }
        #select{
            background-color: #0dc1b5;
            box-shadow: 0px 0px 12px #EFEFEF;
        }
        #detail{
            padding-left: 16%;

        }
        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: white;
            opacity: 1; /* Firefox */
        }
    </style>
    <style>
        #autocomplete {
            width: 100%;
            color: black;
            height: 30px;
            padding-left: 10px;
            border-radius: 4px;
            border: 1px solid rgb(186, 178, 178);
            box-shadow: 0px 0px 12px #EFEFEF;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&language=en"></script>
</head>
<body>
<form action="lost.php" method="post" onSubmit="return check();" name="form1">

    <div class="container">
        <div class="row" id="drop">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="location">Enter item location</label>
                    </br>
                    <input type="text" name="location" id=""/>
                    <script>
                        var input = document.getElementById('autocomplete');
                        var autocomplete = new google.maps.places.Autocomplete(input);
                    </script>

                </div>
                <div class="form-group">
                    <label for="">Contact no.</label>
                    <input type="contact" name="contact" class="form-control" id="contact">
                </div>

                <h3>Select found items category</h3>
                <select id="select" name="category">
                    <option value="">Select Option</option>
                    <option value="watch">Watch</option>
                    <option value="wallet">Wallet</option>
                    <option value="bag">Bag/Trolly</option>
                    <option value="document">Documents</option>
                    <option value="assoceroies">Associries</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
        <div class="row" id="detail">
            <textarea rows="4" cols="50" name="description" placeholder="Description " style="width: 100%;max-width: 400px;border-radius: 2.25%; background-color: transparent; border-color: white;"></textarea>
        </div>
        <div class="clearfix">
            <button type="submit" name="submit" class="form-control">Submit Lost Item</button>

        </div>
    </div>
</form>


</body>
</html>


<?php

include('dbcon.php');
extract($_POST);

session_start();

if(isset($_POST['submit']))
{
    include('dbcon.php');

    $uid=$_SESSION['uid'];
    $location= $_POST['location'];
    $contact=$_POST['contact'];
    $category=$_POST['category'];
    $description= $_POST['description'];
    $status = 0;


    $qry = "INSERT INTO `lostfound` (`uid`, `liid`, `location`, `contact`, `category`, `description`,`status`) VALUES ('$uid', NULL, '$location', '$contact', '$category', '$description','$status')";
    $run = mysqli_query($con,$qry);


    if($run == true)
    {
        ?>
        <script>alert('Data Inserted Successfully');</script>
        header('location: index.php');
        <?php
        echo "<script type='text/javascript'>window.location.href = 'login.php';</script>";
        header('location:index.php');
    }
    else
    {
        echo (mysqli_error($con));
    }

}

?>
