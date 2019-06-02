<?php

include("databaseConnection.php");

	$query = "Select Max(Id) From members";
	$returnD = mysqli_query($con,$query);
	$result = mysqli_fetch_assoc($returnD);
	$maxRows = $result['Max(Id)'];
	if(empty($maxRows)){
        $lastRow = $maxRows = 1;      
    }else{
		$lastRow = $maxRows + 1 ;
    }

?>


<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/styleAddValue.css">
	</head>
	<body>
		<div class="addMemberTitle">Add-Member</div>
		<div class="addMemberForm">
			<form action="home.php">
				<input type="text" name="memberId" required autofocus placeholder="Member-ID" value=<?php if(!empty($lastRow)){ echo $lastRow; }?> readonly><br>

				<input type="text" name="firstName" required autofocus placeholder="First-Name" pattern="[A-Za-z]{3,}" title="First name must contain atleast 3 letters."><br>

				<input type="text" name="lastName" required autofocus placeholder="Last-Name" pattern="[A-Za-z]{3,}" title="Last name must contain atleast 3 letters."><br>

				<div class="addMemberFormList">
					<select name="position" required autofocus>
						<option value="">Select</option>
						<option value="student">Student</option>
						<option value="faculty">Faculty</option>
					</select>
				</div><br>

				<input type="text" name="mobile" required autofocus placeholder="Mobile" pattern="[0-9]{10}"><br>

				<input type="email" name="email" required autofocus placeholder="Email" title="example.example1@gmail.com"><br>

				<input type="text" name="course" required autofocus placeholder="Course/Teaches" pattern="[A-Za-z ]{3,}" title="Course must contain atleast 3 letters."><br>

				<input type="submit" name="addMemberBtn" value="Add Member">
			</form>
		</div>
	</body>
</html>