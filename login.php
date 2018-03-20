<html>

<head>
	<title></title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/loginSignup.css">
	<script src = "js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>

</head>
<body>
	<div class="jumbotron">
		<h1 class="text-center">Lost-Found</h1>
	</div>
	<div class="container">
		<div class="row">

			<!--SignUp Start-->
			<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" id="SignUp">
					<h1 class="text-center">Sign Up</h1>
				    <p>Please fill in this form to create an account.</p>
                    <hr>

                    <form action="login.php" method="post" onSubmit="return check();" name="form1">

                        <label for="name"><b>Name</b></label>
                        </br>
                        <input type="text" placeholder="Enter Name" name="name" required>
                        </br>

				    <label for="email"><b>Email</b></label>
					</br>
				    <input type="text" placeholder="Enter Email" name="email" required>
				    </br>
				    <label for="psw1"><b>Password</b></label>
				    </br>
				    <input type="password" placeholder="Enter Password" name="psw1" required>
				    </br>
				    <label for="psw2"><b>Repeat Password</b></label>
				    </br>
				    <input type="password" placeholder="Repeat Password" name="psw2" required>
				    </br>
				    <label>
				      <input type="checkbox" checked="checked" name="remember" style="width: auto;"> Remember me
				    </label>
				    </br>
				    
				    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
				    </br>

				    <div class="clearfix">
				      <button type="button" class="cancelbtn">Cancel</button>
				      <button type="submit" name="signup" class="signupbtn">Sign Up</button>
				    </div>
				</form>
			</div>

			<!--SignUp End-->
			<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
					<h1 class="text-center">Log In </h1>
					<p>Enter your login details below.</p>
                <form action="login.php" method="post" onSubmit="return check();" name="form2">
                <hr>
					<label for="email"><b>Username or Email</b></label>
					</br>
				    <input type="email" placeholder="Enter Username" name="email" required>
				    </br>
				    <label for="psw"><b>Password</b></label>
				    </br>
				    <input type="password" placeholder="Enter Password" name="psw" required>
				    </br>
				    </br>
				    <label>
				      <input type="checkbox" checked="checked" name="remember" style="width: auto;"> Remember me
				    </label>
				    <div class="clearfix">
				      <button type="submit" name="login" class="loginbtn">LogIn</button>
				      <button type="button" class="cancelbtn">Cancel</button>
				      
				    </div>
				    
				</form>
			</div>

		</div>
	</div>
</body>
</html>

<?php

include('dbcon.php');
extract($_POST);

if(isset($_POST['signup']))
{
    include('dbcon.php');

    $name= $_POST['name'];
    $email=$_POST['email'];
    $psw= $_POST['psw2'];

    $qry = "INSERT INTO `login`(`name`, `email`, `password`) VALUES ('$name','$email','$psw')";
    $run = mysqli_query($con,$qry);


    if($run == true)
    {
        ?>
        <script>alert('Data Inserted Successfully');</script>
        header('location: login.php');
        <?php
        echo "<script type='text/javascript'>window.location.href = 'login.php';</script>";
        header('location:login.php');
    }
    else
    {
        echo (mysqli_error($con));
    }

}


?>


<?php
include('dbcon.php');

if(isset($_POST['login']))
{
    $email= $_POST['email'];
    $psw= $_POST['psw'];

    $qry= "SELECT * FROM `login` WHERE `email`='$email' AND `password`='$psw'";

    $run = mysqli_query($con,$qry);

    $row = mysqli_num_rows($run);

    if($row<1)
    {
        ?>
        <script>
            alert("Invalid Username or Password");
        </script>
        <?php
    }

    else
    {
        $data = mysqli_fetch_assoc($run);
        $userno = $data['uid'];

        session_start();
        $_SESSION['uid']=$userno;
        echo "<script type='text/javascript'>window.location.href = 'userdash.php';</script>";
        header('Location:userdash.php');
        exit();

    }
}


?>

