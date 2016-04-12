<?php header('Content-type: text/html; charset=utf-8'); ?>
<!-- Name: 	Sebastian Horoszkiewicz -->
<!-- Date: 	04.04.2014 -->
<!-- ID	 :	C00156243 -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../main.css">
    <title>Create Session</title>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
	<script src="createSession.js"></script>
</head>
<body>
<br>
<div data-role="page" style="text-align: center;">	
	<div data-role="header" data-theme="b" data-position="inline">
	<h1>Create Question</h1>
	</div>
	<div style="margin-right:7%; margin-left:7%; text-align:left;">
		<?php 
		include '../db.php';
		$MAX_NO_OF_ANS=10;//starting at 0
		session_start();
		$sessionId = $_SESSION['sesId'];//get session ID value
		?>
		<form action="createSession.php" method="post">
			<tr>
			<label><h1><center> Question ID: 
			<?php echo $sessionId; ?>
			</center></h1></label>
			<br>
			<label> Enter Event Password* (optional): </label>
			<input type="password" style="height: 44px;" name="password" id="password"/>
			<label> Enter Question:</label>
			<textarea id="question" name="question" value=""></textarea><!--Make sure there is no space between "...]></[..." -->
			<label> Enter Answer 1:</label> 
			<input type="text" id="ans1" name="ans1" style="height: 44px;" value=""/>
			<label> Enter Answer 2:</label> 
			<input type="text" id="ans2" name="ans2" style="height: 44px;" value=""/>
			<div id="addFieldForm" >			
				<input type="hidden" id="ans3" name="ans3" style="height: 44px;" value=""/>
				<input type="hidden" id="ans4" name="ans4" style="height: 44px;" value=""/>
				<input type="hidden" id="ans5" name="ans5" style="height: 44px;" value=""/>
				<input type="hidden" id="ans6" name="ans6" style="height: 44px;" value=""/>
				<input type="hidden" id="ans7" name="ans7" style="height: 44px;" value=""/>
				<input type="hidden" id="ans8" name="ans8" style="height: 44px;" value=""/>
				<input type="hidden" id="ans9" name="ans9" style="height: 44px;" value=""/>
				<input type="hidden" id="ans10" name="ans10" style="height: 44px;" value=""/>
			</div>
			<input data-theme="b" class="mybtn" type="button" value="Add Answer Field"  id="add" />
			<br>
			<input data-theme="b" class="mybtn" type="submit" name="sb" id="sbmBtn"  value="Create Question"/>
			<input data-theme="b" class="mybtn" type="button" name="sb" id="cancBtn" onclick="confFunct()"  value="Cancel" />
			</tr>
			<BR>
			<font size="2" color="gray">
			*You might want to keep your password simple as it will be used by students to access this Question Event also currently it's not encrypted in any way.
			</font>
			
		<?php
		$submitbutton = $_POST['sb'];
		//if create question button clicked insert values into DB or output warning message (if input incorrect)
		if("$submitbutton" == "Create Question")
		{
			if ($_POST['question']== "")
			{
				echo '<script type="text/javascript"> alert("Please Enter Question!") </script>';
				echo '<script type="text/javascript">window.location = "/createSession/createSession.php"</script>';//refresh page otherwise error with "add answer field" button
			}
			else if( $_POST['ans1']== "" )
			{
				echo '<script type="text/javascript"> alert("Please Enter Answer 1!") </script>';
				echo '<script type="text/javascript">window.location = "/createSession/createSession.php"</script>';
			}
			else if($_POST['ans2']== "")
			{
				echo '<script type="text/javascript"> alert("Please Enter Answer 2!") </script>';
				echo '<script type="text/javascript">window.location = "/createSession/createSession.php"</script>';
			}
			else 
			{
				//escape special characters (e.g. "don't" contain character:' which would break the code and output error when updating DB)
				$pasw = mysqli_real_escape_string($con, $_POST['password']);
				$pyt = mysqli_real_escape_string($con, $_POST['question']);
				$ans = array();
				for($i=0;$i!=$MAX_NO_OF_ANS;$i++)
				{
					$c=$i+1;
					$ans[$i] = mysqli_real_escape_string($con, $_POST['ans'.$c]);
				}
				//insert values where session ID from DB is equal to session ID in app
				$sql="UPDATE CRUD_QAndAnswer SET 
				  passwd = '".$pasw."',
				  question = '".$pyt."',
				  answer1 = '".$ans[0]."', answer2 = '".$ans[1]."',
				  answer3 = '".$ans[2]."', answer4 = '".$ans[3]."',
				  answer5 = '".$ans[4]."', answer6 = '".$ans[5]."',
				  answer7 = '".$ans[6]."', answer8 = '".$ans[7]."',
				  answer9 = '".$ans[8]."', answer10 = '".$ans[9]."'
				  WHERE sessionID = '$sessionId'";
				if (!mysqli_query($con,$sql))
				{
					die('Error: ' . mysqli_error($con));
				}		
				$_SESSION['ansArr'] = $ans;//send values
				$_SESSION['sesIdTC'] = $sessionId;
				$_SESSION['quest'] = $_POST['question'];
				echo '<script type="text/javascript">window.location = "/chart/chart.php"</script>';//go to next screen
			}
		}
		?>
		</form>
	</div>
</div>
</body>
</html>