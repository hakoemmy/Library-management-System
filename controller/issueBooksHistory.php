<?php
	
	include("databaseConnection.php");

	$query = "SELECT bookId,issueId,issueDate FROM borrow Where issueId > 0";
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
		<div class="issuedBookTitle">Issued-Book</div>
		<table>
			<tr>
				<th>Book-ID</th>
				<th>Issue-ID</th>
				<th>Issue-Date</th>
			</tr>
			
				<?php
					while($res1 = mysqli_fetch_assoc($returnD1)){
					?>
					<tr>
					<?php
					foreach ($res1 as $k => $v) {
						?>
							<td>
								<?php 
									if($k == 'bookId'){
										?>
										<a href="home.php?activity=bookDetails&selectedBookId=<?php echo $v; ?>"><?php echo $v; ?></a>
										<?php
									}
									elseif ($k == 'issueId') {
										?>
										<a href="home.php?activity=memberDetails&selectedMemberId=<?php echo $v; ?>"> <?php echo $v; ?></a>
										<?php
									}
									else{
										echo $v;
									}

								?>
							</td>
						<?php
					}
					?>
					</tr>
					<?php
				}
				?>
			</tr>
		</table>
	</body>
</html>