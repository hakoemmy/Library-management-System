<?php

	include("databaseConnection.php");

	$query = "SELECT Id,FirstName,LastName,Mobile,Course FROM members";
	$returnD = mysqli_query($con,$query);
	$returnD1 = mysqli_query($con,$query);
	$result = mysqli_fetch_assoc($returnD);
	
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/styleTable.css">
	</head>
	<body>
		<div class="memberListTitle">Member List</div>
		<table>
			<tr>
				<th>Id</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Mobile</th>
				<th>Course</th>
				<th>Edit</th>
				<th>Delete</th>
				
			</tr>

			<?php
				while($result1 = mysqli_fetch_assoc($returnD1)){
				?>
				<tr>
					<td>
						<a href="home.php?activity=memberDetails&selectedMemberId=<?php echo $result1['Id']; ?>"> <?php echo $result1['Id']; ?> </a>
					</td>
					<td><?php echo ucfirst($result1['FirstName']); ?></td>
					<td><?php echo ucfirst($result1['LastName']); ?></td>
					<td><?php echo $result1['Mobile']; ?></td>
					<td><?php echo ucfirst($result1['Course']); ?></td>
					<td>
						<a href="home.php?activity=updateMember&uMemberId=<?php echo $result1['Id'];?>">Edit</a>
					</td>
					<td>
						<a href="home.php?activity=deleteMember&deleteMemberId=<?php echo $result1['Id']; ?>">Delete</a>
					</td>
				</tr>
				<?php
				}
			
			?>
		</table>
	</body>
</html>
