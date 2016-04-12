<?php header('Content-type: text/html; charset=utf-8'); ?>
<!-- Name: 	Sebastian Horoszkiewicz -->
<!-- Date: 	08.04.2014 -->
<!-- ID	 :	C00156243 -->
<?php
include 'db.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>	
	<title>Real Time Student Feedback</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="main.css">
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
	</head>
<body>
<br>
<div data-role="page" style="text-align: center;">
	<div data-role="header" data-theme="b"><h1>Real Time Student Feedback</h1></div>
	<br>
	<div style="font-size:22px; ">
		<b>Create Question</b>
	</div>
    <div style="margin-right:7%; margin-left:7%; text-align: left;">
	<form action="index.php" method="post">	
		<button class="mybtn" name="sb" id="crSess" value="Create_New_Session" data-theme="b">Create New Question</button>
	</form>	
	<form action="index.php" method="post">
		<tr>
			<div style="font-size:22px; margin-bottom: 8px;">
				<center><b>Join Question Event</b></center>
			</div>
			<label> Enter Existing Question ID </label>
			<input type="text" value="" id="sssid" name="sssid" style="height: 44px;"/>
			<label> Enter Event Password </label>
			<input type="password" value="" style="height: 44px;" name="passwrd" id="passwrd"/>
			<button class="mybtn" name="sb" id="joinSess" value="Join Session" data-theme="b">Join</button>
			
			<div style="font-size:22px;">
				<center><b>How Does It work ?</b></center>
			</div>
		</tr>	
		<?php
		session_start();
		$sessionId="";
		$submitbutton = $_POST['sb'];//get value from clicked button 
		//funct. below  http://www.botskool.com/geeks/how-create-random-alphanumeric-password-php
		//creates ID using alphabetic and numeric values
		function generate_random_ID() 
		{
			$length = 4;
			$alphabets = range('A','Z');
			$numbers = range('0','9');
			$final_array = array_merge($alphabets,$numbers);
				
			$sessionId = '';
			while($length--) {
				$key = array_rand($final_array);
				$sessionId .= $final_array[$key];
			}
			return $sessionId;
		}
		//now, compare value from clicked button, depending on which button was clicked perform adequate action
		if("$submitbutton" == "Create_New_Session")
		{
			$sessionId = generate_random_ID();//generate random ID
			//session id must be unique for each user, therefore:
			$sql="SELECT sessionID FROM CRUD_QAndAnswer";//select session ID's from Database
			$result=mysqli_query($con,$sql);
			if( ! $result = mysqli_query($con,$sql)) {
				echo "Mysql error: " . mysqli_error($con);
			}
			if(!mysqli_num_rows($result))
			{   //if DB is empty add any ID 
				$sql="INSERT INTO CRUD_QAndAnswer (sessionID)
					  VALUES ('$sessionId')";//insert session ID into database
				if (!mysqli_query($con,$sql))
				{
					die('Error: ' . mysqli_error($con));//output error if it occurs
				}
				$sql="INSERT INTO Totals (sessionID)
						  VALUES ('$sessionId')";//also insert session ID into  Totals table
				if (!mysqli_query($con,$sql))
				{
					die('Error: ' . mysqli_error($con));
				}
				$_SESSION['sesId'] = $sessionId;//store session ID into $_SESSION['sesId'] then go to createSession.php
				?>
				<script type="text/javascript">window.location = "/createSession/createSession.php"</script>
				<?php
				exit;//make sure that no more code will be executed in this page
			} 
			else 
			{	//if Database contains some ID's then..
				$quit = false;
				$insert=false;
				while($quit==false)//loop and generate new ID, do that until session ID will not match any of the ID's in the DB
				{
					$quit = true;
					$insert=true;
					while($row = mysqli_fetch_array($result))//go through values from DB and compare it to generated ID
					{
						$iid = $row['sessionID'];
						if($iid == $sessionId) 
						{
							$insert = false;
							$quit = false;
						}
					}//end inner while
					if($insert == true)
					{
						$sql="INSERT INTO CRUD_QAndAnswer (sessionID)
							  VALUES ('$sessionId')";
						if (!mysqli_query($con,$sql))
						{
							die('Error: ' . mysqli_error($con));
						}
						$sql="INSERT INTO Totals (sessionID)
						  VALUES ('$sessionId')";
						if (!mysqli_query($con,$sql))
						{
							die('Error: ' . mysqli_error($con));
						}
						$_SESSION['sesId'] = $sessionId;
						?>
						<script type="text/javascript">window.location = "/createSession/createSession.php"</script>
						<?php
						exit;
					}
					else
					{	//generate new ID and loop again
						$sessionId = generate_random_ID();
						$quit=false;
						$insert=false;
					}
				}//close outer while
			}//close else
		}
		elseif("$submitbutton" == "Join Session")
		{	//when user wants to join to th session then...
			$sesid= $_POST['sssid'];//get inputted ID
			$sesid = strtoupper($sesid);//convert it to upercase
			$sesPaswd = $_POST['passwrd'];//get password

			//look for entered ID
			$sql="SELECT * FROM CRUD_QAndAnswer";
			$result=mysqli_query($con,$sql);
			if( ! $result = mysqli_query($con,$sql)) {
				echo "Mysql error: " . mysqli_error($con);
			}
			$exist = false;
			$goodPsw = false;
			while($row = mysqli_fetch_array($result))//go through values from DB and compare it to inputted ID
			{
				$iid = $row['sessionID'];
				$pswd = $row['passwd'];
				if($iid == $sesid) 
				{
					$exist = true; //if the ID exist set to true
					if($pswd == $sesPaswd) 
					{
						$goodPsw = true; //if the password is equal to one from the DB set to true
					}	
				}		
			}
			//output corresponding error or continue to next page
			if($exist == true && $goodPsw == true)
			{
				$_SESSION['ssId'] = $sesid; // set $_SESSION['sesId']
			?>
			<script type="text/javascript">window.location = "/submitAnswer/submitAnswer.php"</script>
			<?php
				exit;
			}
			elseif($sesid=="")
			{
				echo '<script type="text/javascript"> alert("ERROR: Enter Session ID!") </script>';
			}
			elseif($exist == false)
			{
				echo '<script type="text/javascript"> alert("ERROR: Entered ID does not exist!") </script>';
			}
			elseif($exist == true && $goodPsw == false)
			{
				echo '<script type="text/javascript"> alert("ERROR: Incorrect Password!") </script>';
			}
		}
		elseif("$submitbutton" == "tut")
		{
			?>
			<script type="text/javascript">window.location = "/tutorial/tutorial.php"</script>
			<?php
		}
		elseif("$submitbutton" == "about")
		{
			?>
			<script type="text/javascript">window.location = "/info.php"</script>
			<?php
		}
		
		?>
		</form>
		<form action="index.php" method="post">
		<button class="mybtn" name="sb" id="tut" value="tut" data-theme="b">Watch Tutorial</button>
		</form>
		<form action="index.php" method="post">
		<button class="mybtn" name="sb" id="about" value="about" data-theme="b">About Real Time Student Feedback</button>
		</form>
	</div>
</div>
</body>
</html>
