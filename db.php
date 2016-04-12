<!-- Name: 	Sebastian Horoszkiewicz -->
<!-- Date: 	04.04.2013 -->
<!-- ID	 :	C00156243 -->
<?php 
	//conect to DB
	$con=mysqli_connect("localhost","everyt32_user","password","everyt32_mainDatabase");
	// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
?>