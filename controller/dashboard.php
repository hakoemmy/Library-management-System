<?php

	include("databaseConnection.php");

	$query =("Select count(Id) From members Where position = 'student'");
	$query_run=mysqli_query($con,$query);
	$result = mysqli_fetch_assoc($query_run);

	$query1 =("Select count(bookId) From books");
	$query_run1=mysqli_query($con,$query1);
	$result1 = mysqli_fetch_assoc($query_run1);

	$query2 = ("Select count(Id) From members Where position = 'faculty'");
	$query_run2=mysqli_query($con,$query2);
	$result2 = mysqli_fetch_assoc($query_run2);

	$query3 =("Select count(publisher) From books Group By publisher");
	$query_run3=mysqli_query($con,$query3);
	$result3 = mysqli_num_rows($query_run3);
	
	$query4 =("Select sum(price) From books");
	$query_run4=mysqli_query($con,$query4);
	$result4 = mysqli_fetch_assoc($query_run4);

	$query5 =("Select count(bookId) From books Where available = 1");
	$query_run5=mysqli_query($con,$query5);
	$result5 = mysqli_fetch_assoc($query_run5);
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/styleDashboard.css">
	</head>
	<body>
		<div class="containerDashboard">

			<div class="totalStudents">Total Students : <br> <?php echo $result['count(Id)'];?></div>

			<div class="totalBooks">Total Books : <br> <?php echo $result1['count(bookId)']; ?></div>

			<div class="totalFaculty">Total Faculties : <br> <?php echo $result2['count(Id)']?></div>			

			<div class="totalPublisher">Total Publishers: <br> <?php echo $result3; ?></div>

			<div class="bookPrice">Price of all books: <br> <?php echo $result4['sum(price)']; ?></div>

			<div class="bookInLibrary">Books in library: <br> <?php echo $result5['count(bookId)']; ?></div>

		</div>
	</body>
</html>