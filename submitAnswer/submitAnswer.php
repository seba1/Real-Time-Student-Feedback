<?php header('Content-type: text/html; charset=utf-8'); ?>
<!-- Name: 	Sebastian Horoszkiewicz -->
<!-- Date: 	15.04.2014 -->
<!-- ID	 :	C00156243 -->
<!-- Purpose : submit answer from student to db -->
<?php
include '../db.php';
session_start();
$sessionId = $_SESSION['ssId']; //get session ID from previous page
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../main.css">
    <title>Submit Answer</title>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
	<script src="submitAnswer.js"></script>
</head>
<body>
<br>
<div data-role="page" style="text-align: center;">	
	<div style="white-space: normal !important;" data-role="header" data-theme="b">
	<h1>Answer the Question</h1>
    </div>
    <div style="margin-right:7%; margin-left:7%; text-align: left;">
        <form action="submitAnswer.php" method="post">	
		<tr>
			<?php 
			$sql="SELECT question, 
					answer1, answer2, answer3,
					answer4, answer5, answer6,
					answer7, answer8, answer9,
					answer10
				  FROM CRUD_QAndAnswer
				  WHERE sessionID = '$sessionId'"; //get needed data from DB
			$result=mysqli_query($con,$sql);
			if( ! $result = mysqli_query($con,$sql)) { //check for errors
				echo "Mysql error: " . mysqli_error($con);
			}
			$row = mysqli_fetch_array($result);
			$quest="";
			$quest= $row['question'];
			//store answers into array
			$ans=array(
			$row['answer1'], $row['answer2'],
			$row['answer3'], $row['answer4'],
			$row['answer5'], $row['answer6'],
			$row['answer7'], $row['answer8'],
			$row['answer9'], $row['answer10'], "");
			?>
			<center>
				<h1> Question ID: <?php echo $sessionId; ?></h1>
				<div id="divForWait"></div>
			</center>
			<div id="addRadioBtn" >
				<fieldset data-role="controlgroup" >	
				<legend><?php echo $quest; ?></legend>
				</fieldset>
			</div>
			<?php
			//output answers to radio buttuns while creating them
			for($i=0; $ans[$i]!=""; $i++) 
			{
				?>
					<script type="text/javascript">
					var radioBox = $("<input type=\"radio\" name=\"answer\" id=\"answer<?php echo $i; ?>\" value=\"<?php echo $i; ?>\"/>");
					var label = $("<label for=\"answer<?php echo $i; ?>\"><?php echo $ans[$i]; ?></label>");
					$("#addRadioBtn").append(radioBox);
					$("#addRadioBtn").append(label);
					</script>
				<?php
			}
			?>
			<br>
			<input data-theme="b" class="mybtn" name="sb" id="sbmBtn" type="submit" value="Submit Answer"/>
			<input data-theme="b" onclick="cofFunct()" class="mybtn" id="cancBtn" type="button" value="Cancel"/>
		</tr>
		<?php 
		$submitbutton = $_POST['sb']; //get value from button clicked
		if("$submitbutton" == "Submit Answer")
		{
			$_SESSION['ansArr'] = $ans; //pass values to next screen
			$_SESSION['sesIdTC'] = $sessionId;
			$_SESSION['quest'] = $quest;
			$cookieVal = $_COOKIE[$sessionId];//get cookie
			//if cookie exists, value in it will be equal to '1'
			//if cookie does not exist submit answer to DB
			if ($cookieVal != "1")
			{
				$answer = $_POST['answer'];//get chosen answer
				// if answer is not chosen value will be empty
				if ($answer!="") 
				{
					$answer++;
					$ansChosen = "ans".$answer;
				
					$sql="UPDATE Totals SET 
						  $ansChosen = $ansChosen + 1	  
						  WHERE sessionID = '$sessionId'";//update DB where session ID is equal to session ID from DB and add 1 to answer submitted by the user
					if (!mysqli_query($con,$sql)) { //if error during communication with DB will occur output error
						die('Error: ' . mysqli_error($con));
					}
					echo '<script type="text/javascript">window.location = "/chart/chart.php"</script>';
				}
				else 
				{	//if answer not selected prompt with error
					echo 
					'<script type="text/javascript"> 
						alert("Answer not selected!") 
						window.location = "/submitAnswer/submitAnswer.php"
					</script>';
				}
			}
			else
			{   //if answer was submitted then promt with information about it and send user back to chart
				echo '<script type="text/javascript"> alert("Answer already submitted!") 
					</script>';
				echo '<script type="text/javascript">window.location = "/chart/chart.php"</script>';
			}
		}
		if($quest=="")
		{	//if lecturer is still typing in the question and answers prompt appropriate message to students
			echo 
			'<script> 
			var wdiv = $("<div id=\"wait\"> <BR><BR> Please wait while Question being created...</div>");
			$("#divForWait").append(wdiv);
			</script>';
			sleep(5); //poor way of refreshing the page but time didn't allow me to use eg websocket/sse
			echo '<script> window.location = "/submitAnswer/submitAnswer.php" </script>';
		}
		?>
		</form>
    </div>
</div>
</body>
</html>
