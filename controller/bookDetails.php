<?php
	include("databaseConnection.php");

	$selectedBookId = $_REQUEST['selectedBookId'];

	$query = ("Select bookId,title,author,price,publisher From books Where bookId = '$selectedBookId'");
	$query_run=mysqli_query($con,$query);
	$result = mysqli_fetch_assoc($query_run);

	$query1 = ("Select issueId From borrow Where bookId = '$selectedBookId'");
	$query_run1=mysqli_query($con,$query1);
	$result2 = mysqli_fetch_assoc($query_run1);

	$issueId = $result1['issueId'];

	if($issueId){
		$query2 =("Select FirstName,LastName From members Where Id = '$issueId'");
		$query_run2=mysqli_query($con,$query2);
		$result2= mysqli_fetch_assoc($query_run2);
		//print_r($result2);
	}


?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/styleBookInfo.css">
	</head>
	<body>
		<div class="bookInfoTitle">Book Information</div>
		<div class="infoContainer">
			<div class="bookName">
				<?php echo ucfirst($result['title']); ?>[<?php echo $selectedBookId; ?>]
			</div>
			<?php
			if($issueId){
			?>
			<div class="issuingInfo">
				<?php
					
					if($result2['FirstName'] && $result2['LastName']){
						?>
						Sorry! This book is already issued to 
						<a href="home.php?activity=memberDetails&selectedMemberId=<?php echo $issueId; ?>"><?php echo ucfirst($result2['FirstName'])." ".ucfirst($result2['LastName']); ?>.
						</a>
						<?php
					}
				?>
			</div>
			<?php
			}
			?>
			<div class="bookInfo">
				<hr>
				<div class="authorLabel">Author</div>
				<div class="authorName"><?php echo ucfirst($result['author']); ?></div>
				<hr>
				<div class="priceLabel">Price</div>
				<div class="price"><?php echo $result['price']; ?></div>
				<hr>
				<div class="publisherLabel">Publisher</div>
				<div class="publisher"><?php echo ucfirst($result['publisher']); ?></div>
			</div>

			<div class="issuedBookDetails">
				<div class="issuedBookTitle">
					
				</div>
			</div>
		</div>
	</body>
</html>  