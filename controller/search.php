<!DOCTYPE html>
<html>
	 <head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/styleAddValue.css">
		<link rel="stylesheet" type="text/css" href="../css/styleTable.css">
	 </head>
	<body>
		<div class="searchFormTitle">Search Book Or Member</div>
		<form action="home.php" class="searchForm">
			<div class="searchFormList">
				<select name="searchList" required autofocus>
					<option value="">Select an Option:</option>
					<option value="Book">Book</option>
					<option value="Member">Member</option>
				</select>
			</div>
       <div class="searchFormField"><input type="text" name="searchField" required autofocus placeholder="Enter Name and Press Enter..." value="<?php echo $_REQUEST['searchField']; ?>"></div>
		</form>
		<?php
		if($searchList == 'Book'){
		?>
		<div class="searchBookList">Book List</div>
		<table>
			<tr>
				<th>Book Id</th>
				<th>Title</th>
				<th>Author</th>
				<th>Price</th>
				<th>Available</th>
			</tr>

			<?php
			while($result1 = mysqli_fetch_assoc($returnD1)){
				//print_r($result1B);
				?>
				<tr>
				<?php
					foreach ($result1 as $k => $v) {	
						?>
							<td>
								<?php 
									if($k == 'bookId'){
										?>
										<a href="home.php?activity=bookDetails&selectedBookId=<?php echo $v; ?>"> <?php echo $v; ?> </a>
										<?php
									}
									elseif($k == 'available'){
										if($result1['available'] == 1){
											$v = 'Yes';
										}
										elseif($result1['available'] == 0){
											$v = 'No';
										}
										echo $v;
									}
									else{
										echo ucfirst($v);
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
		</table>
		<?php
		}
		elseif($searchList == 'Member'){
		?>

		<div class="searchMemberList">Member List</div>
		<table>
			<tr>
				<th>Id</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Mobile</th>
				<th>Email</th>
				<th>Course</th>
				
			</tr>

			<?php
			while($result1 = mysqli_fetch_assoc($returnD1)){
				?>
				<tr>
				<?php
					foreach ($result1 as $k => $v) {
						?>
							<td>
								<?php
									if($k=='Id'){
								?>
									<a href="home.php?activity=memberDetails&selectedMemberId=<?php echo $v; ?>"> <?php echo $v; ?></a>
								<?php
									}
									else{
										echo ucfirst($v);
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
		</table>
		<?php
		}
		?>
	</body>
</html>