<?php
	
	include("databaseConnection.php");

	$query = "SELECT returnBookId,returnId,returnDate FROM borrow Where returnId > 0";
	$returnD = mysqli_query($con,$query);
	$returnD1 = mysqli_query($con,$query);
	$res = mysqli_fetch_assoc($returnD);
?>

<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/styleTable.css">
	</head>
	<body>
		<div class="returnedBookTitle">Returned-Book</div>
		<table>
			<tr>
				<th>Book-ID</th>
				<th>Return-ID</th>
				<th>Return-Date</th>
				<th>Delete</th>
			</tr>
			
				<?php
					while($res1 = mysqli_fetch_assoc($returnD1)){
					?>
					<tr>

						<td>
							<a href="home.php?activity=bookDetails&selectedBookId=<?php echo $res1['returnBookId'] ; ?>"><?php echo $res1['returnBookId'] ; ?>	
							</a>
						</td>
						<td>
							<a href="home.php?activity=memberDetails&selectedMemberId=<?php echo $res1['returnId'] ; ?>"> <?php echo $res1['returnId']; ?>
							</a>
						</td>
						<td><?php echo $res1['returnDate']; ?></td>
						<td>
							<a href="home.php?activity=deleteReturnedBooksHistory&deleteReturnId=<?php echo $res1['returnId']; ?> & deleteReturnDate=<?php echo $res1['returnDate']; ?>">Delete</a>
						</td>
					</tr>
					<?php
				}
				?>
		</table>
	</body>
</html>