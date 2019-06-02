<?php
	
	include("databaseConnection.php");

	$query = "Select Max(bookId) From books";
	$returnD = mysqli_query($con,$query);
	$result = mysqli_fetch_assoc($returnD);
	$maxRows = $result['Max(bookId)'];
	if(empty($maxRows)){
        $lastRow = $maxRows = 1001;      
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
		<div class="addBookTitle">Add-Book</div>
		<div class="addBookForm">
			<form action="home.php">
				<input type="text" name="bookId" required autofocus placeholder="Book-ID" value=<?php echo $lastRow; ?> readonly ><br>
				<input type="text" name="bookName" required autofocus placeholder="Book-Name" pattern="[A-Z a-z]{3,}" title="Name must contain atleast 3 letters."><br>
				<input type="text" name="authorName" required autofocus placeholder="Author-Name" pattern="[A-Z a-z]{3,}{.}" title="Author name must contain atleast 3 letters."><br>
				<input type="text" name="bookPrice" required autofocus placeholder="Price" pattern="[0-9]{3,}{.}"><br>
				<input type="text" name="bookPublisher" required autofocus placeholder="Publisher" pattern="[A-Z a-z]{3,}" title="Publisher name must contain 3 letters."><br>
				<input type="submit" name="addBookBtn" value="Add Book"><br>
			</form>
		</div>
	</body>
</html>