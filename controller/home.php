<?php
    session_start();
    error_reporting(0);  
    include("databaseConnection.php");
    $username = $_SESSION['username'];

    if($_REQUEST['activity'] == 'logout'){
        $username = null;
        $username ="";
        unset($username);
        
        $_SESSION['username'] = null;
        $_SESSION['username'] ="";
        unset($_SESSION['username']);
        
        session_destroy();
    }

    if(empty($username)){
        header("location: ../Index.php");
    }

?>

<html>
    <head>
    	<title></title>
    	<link rel="stylesheet" type="text/css" href="../css/styleHome.css">
        <link rel="stylesheet" type="text/css" href="../css/styleUpdate.css">
        <link rel="stylesheet" type="text/css" href="../css/styleAddValue.css">
    </head>
    <body>
      <!--CONTAINER AREA  SECTION-->
        <div class="containerHome">
        <!--HEAD  SECTION-->
          <div class="headSection">

            <?php include("headSection.php"); ?>

          </div>
        <!--HEAD  SECTION-->

          <div class="navSection">
                <div class="welcomeTitle"><?php echo "Welcome : ".$username; ?></div>
                <div class="tooltip">Contact Us
                    <span class="tooltiptext">
                        <b>Address:</b>Kigali,Rwanda<br>
                        <b>Phone:</b> 0788 469 314

                    </span>
                </div>
                <div class="logoutLink"><a href="home.php?activity=logout">Logout</a></div>
          </div>

        <!--LEFT BAR  SECTION-->
          <div class="leftSection">
            
            <?php include("leftSection.php");?>

          </div>
        <!--LEFT BAR  SECTION-->

        <!--CONTENT AREA  SECTION-->
        <div class="contentSection">
          
            <?php     
             // CODE FOR PERFORMMING ACTIVITY..

                        $activity = $_REQUEST['activity'];

                        if($activity) {
                            if($activity == 'addMember'){
                                include("addMember.php");
                            }

                            if($activity == 'dashboard'){
                                include("dashboard.php");
                            }
                               
                            if($activity == 'issueBooks'){
                                include("issueBooks.php");
                            }
                              
                            if($activity == 'returnBooks'){
                                include("returnBooks.php");
                            }   

                            if($activity == 'issueBooksHisory'){
                                include("issueBooksHistory.php");
                            }

                            if($activity == 'returnBooksHisory'){
                                include("returnBooksHisory.php");
                            }

                            if($activity == 'search'){
                                include("search.php");
                            }

                            if($activity == 'allRegisteredStudent'){
                                include("allRegisteredStudent.php");
                            }

                            if($activity == 'addBook'){
                                include("addBook.php");
                            }

                            if($activity == 'listAllBooks'){
                                include("listAllBooks.php");
                            }

                            if($activity == 'bookDetails'){
                                include("bookDetails.php");
                            }

                            if($activity == 'memberDetails'){
                                include("memberDetails.php");
                            }

                            if($activity == 'updateBook'){

                                $uBookId = $_REQUEST['uBookId'];

								$query="SELECT bookId From borrow Where bookId = '$uBookId'";
								$query_run=mysqli_query($con,$query);
								$return = mysqli_num_rows($query_run);
								

                                if(empty($return))
								{
        
                                    $query ="SELECT bookId,title,author,price,publisher From books Where bookId = '$uBookId'";
									$query_run=mysqli_query($con,$query);
									$result = mysqli_fetch_assoc($query_run);

                                    ?>
                                    <div class="updateBookTitle">Update Book</div>
                                    <div class="updatearea">
                                        <form action="home.php" class="updateForm">
                                            <input type="text" name="bookId" size="50" value=<?php echo $uBookId ?> readonly><br>
                                            <input type="text" name="bookName" required autofocus pattern="[A-Z a-z]{3,}" size="50" value=<?php  echo $result['title']; ?>><br>
                                            <input type="text" name="authorName" required autofocus pattern="[A-Z a-z]{3,}{.}" size="50" value=<?php echo $result['author']; ?>><br>
                                            <input type="text" name="bookPrice" required autofocus pattern="[A-Z a-z]{3,}{.}" size="50" value=<?php echo $result['price']; ?>><br>
                                            <input type="text" name="bookPublisher" required autofocus pattern="[A-Z a-z]{3,}" size="50" value=<?php echo $result['publisher']; ?>><br>

                                            <input type="submit" name="updateBookBtn" value="Update"><br>
                                        </form>
                                    </div>
                                    <?php
                                }
                                else
								{
                                    $errorMsg = "This Book is issued and can't be edit.";
                                    header("location: home.php?activity=listAllBooks");
                                    
                                }
                            }

                            if($activity == 'updateMember'){

                                $uMemberId = $_REQUEST['uMemberId'];
    
                                $query ="SELECT * From `members` WHERE `Id` = '$uMemberId'";
                                $query_run = mysqli_query($con,$query);
								$result = mysqli_fetch_assoc($query_run);
                                
                                ?>
                                <div class="updateMemberTitle">Update Member</div>
                                <div class="updatearea">
                            <form action="home.php" class="updateForm">
                        <input type="text" name="memberId" value=<?php echo $uMemberId; ?> readonly><br>
                                        <input type="text" name="firstName" required autofocus pattern="[A-Z a-z]{3,}" 
                                        value=<?php echo $result['FirstName']; ?>><br>
                                        <input type="text" name="lastName" value=<?php echo $result['LastName']; ?>><br>

                                        <div class="updateFormList" required autofocus>
                                            <select name="Position">
                                            <option value="">Select</option>
                                            <option value="student" 
                                            <?php if($result['Position'] == "student")
                                            { ?> selected 
                                            <?php }?>>Student</option>
                                                <option value="faculty" 
                                                <?php if($result['Position'] == "faculty"){ ?> selected <?php }?>>
                                            Faculty</option>
                                            </select>
                                        </div> <br>

                                        <input type="text" name="mobile" value=<?php echo $result['Mobile']; ?>><br>
                                        <input type="email" name="email" value=<?php echo $result['Email']; ?>><br>
                                        <input type="text" name="course" value=<?php echo $result['Course']; ?>><br>

                                        <input type="submit" name="updateMemberBtn" value="Update"><br>
                                    </form>
                                </div>
                               
                                <?php
                                
                            }    

                            if($activity == 'deleteBook'){

                                $deleteBookId = $_REQUEST['deleteBookId'];

                                $result ="SELECT bookId FROM borrow Where bookId = '$deleteBookId'";
                                $query_run = mysqli_query($con,$query);
								$return = mysqli_num_rows($query_run);
							   
                                if(empty($return)){
                                $deleteResult = mysql_query("Delete From books Where bookId = '$deleteBookId'");

                                }
                                header("location: home.php?activity=listAllBooks");
                            }

                            if($activity == 'deleteMember'){

                                $deleteMemberId = $_REQUEST['deleteMemberId'];

                                $result =("SELECT issueId FROM borrow Where issueId = '$deleteMemberId'");
                                $query_run=mysqli_query($con,$query);
								$return = mysqli_num_rows($query_run);
							   
                                if(empty($return)){
                                    $deleteResult =("Delete From members Where Id = '$deleteMemberId'");
									mysqli_query($con,$deleteResult );
                                }else{
                                    echo '<p>
                                           <script type="text/javascript">

                                            alert("Member ca not be deleted, he borrowed some books.");
                                           </script>
                                    </p>';
                                }

                                header("location: home.php?activity=allRegisteredStudent");
                            }

                            if($activity == 'deleteReturnedBooksHistory'){

                                $deleteReturnId = $_REQUEST['deleteReturnId'];
                                $deleteReturnDate = $_REQUEST['deleteReturnDate'];

                                $deleteResult =("Delete From borrow Where returnId = '$deleteReturnId' && returnDate = '$deleteReturnDate'");
								$query_run=mysqli_query($con,$deleteResult );
								
                                    if($query_run){
                                        header("location: home.php?activity=returnBooksHisory");
                                    }
                            }

                        }
                        else{
                            //include("dashboard.php");
                        }
                    
                        
                    ?>

                    <?php
                    // CODE FOR UPDATE BOOK...

                        if(isset($_REQUEST['updateBookBtn'])){

                            $bookId = $_REQUEST['bookId'];
                            $bookName = $_REQUEST['bookName'];
                            $authorName = $_REQUEST['authorName'];
                            $bookPrice = $_REQUEST['bookPrice'];
                            $bookPublisher = $_REQUEST['bookPublisher'];

                            $query1 = ("UPDATE books Set title='$bookName', author='$authorName', price='$bookPrice', publisher='$bookPublisher' Where bookId = '$bookId'");
							$query_run=mysqli_query($con,$query1);
                                if($query_run){
                                    //$errorMsg = "Book Updation is successfully done.";
                                    header("location: home.php?activity=listAllBooks");
                                }
                        }
                    ?>

                    <?php
                    // CODE FOR UPDATE MEMBER...

                        if(isset($_REQUEST['updateMemberBtn'])){

                            $memberId = $_REQUEST['memberId'];
                            $firstName = $_REQUEST['firstName'];
                            $lastName = $_REQUEST['lastName'];
                            $position = $_REQUEST['position'];
                            //$rollNo = $_REQUEST['rollNo'];
                            $mobile = $_REQUEST['mobile'];
                            $email = $_REQUEST['email'];
                            $course = $_REQUEST['course'];

                            $query1 =("UPDATE members Set FirstName='$firstName', LastName='$lastName', Position='$position', Mobile='$mobile', Email='$email', Course='$course' Where Id = '$memberId'");
							$query_run=mysqli_query($con,$query1);
							
                            if($query_run){
                                //$errorMsg = "Book Updation is successfully done.";
                                header("location: home.php?activity=allRegisteredStudent");
                            }
                        }    
                    ?>

                    <?php
                    //CODE TO SEARCH BOOK OR STUDENT USING THEIR ID..No error...

                        $searchList = $_REQUEST['searchList'];//SESSION['searchListValue'];
                        //echo $searchList;
                        if(isset($searchList)){

                            if($searchList == 'Book'){

                                $searchField = $_REQUEST['searchField'];

                                if($searchField){

                                    $query = "SELECT bookId,title,author,price,available FROM books Where title LIKE '%$searchField%'";
                                    $returnD = mysqli_query($con,$query);
                                    $returnD1 = mysqli_query($con,$query);
                                    $result = mysqli_fetch_assoc($returnD);

                                    if(empty($result)){
                                        $errorMsg = $searchField." Book Name or title is not found.";
                                    }

                                }
                                else{
                                    $errorMsg = "Field can't be Empty...";
                                }

                            }
                            elseif($searchList == 'Member'){

                                $searchField = $_REQUEST['searchField'];

                                if(!empty($searchField)){

                                    $query = "SELECT Id,FirstName,LastName,Mobile,Email,Course FROM Members Where FirstName LIKE '%$searchField%' || LastName LIKE '%$searchField%'";
                                    $returnD = mysqli_query($con,$query);
                                    $returnD1 = mysqli_query($con,$query);
                                    $result = mysqli_fetch_assoc($returnD);

                                    if(empty($result)){
                                        $errorMsg = $searchField." Customer Name is not found.";
                                    }

                                }
                                else{
                                    $errorMsg = "Field can't be Empty...";
                                }
                            }

                            include("search.php");
                        }
                    ?>

                    <?php
                    //CODE TO ISSUE BOOKS.. NO error..

                            if(isset($_REQUEST['issueBtn'])){ 
                            //if click on issue button..

                            $issueBookId = $_REQUEST['issueBookId'];
                            $issuerId = $_REQUEST['issuerId'];

                            if(!empty($issueBookId) && !empty($issuerId)){ 
                            //checks that both fields is not empty..

                             $query1 = "SELECT * From books Where bookId = '$issueBookId'";
                                $returnD1 = mysqli_query($con,$query1);
                                $result1 = mysqli_fetch_assoc($returnD1);

                                $query2 = "Select Id From members Where Id = '$issuerId'";
                                $returnD2 = mysqli_query($con,$query2);
                                $result2 = mysqli_fetch_assoc($returnD2);

                                if($issueBookId == $result1['bookId'] && $issuerId == $result2['Id']){ //checks that book or issuer id exists or not..

                                    $query3 = "Select bookId,issueId From borrow Where bookId = '$issueBookId'";
                                    $returnD3 = mysqli_query($con,$query3);
                                    $result3 = mysqli_fetch_assoc($returnD3);


                                    if($issueBookId != $result3['bookId']){
                                    //checks that book is already issued or not..

                                        date_default_timezone_set('Africa/Kigali');
                                        $dt = date("y/m/d h:i:s");

                                        
                                        $query = "INSERT INTO `borrow`(bookId,issueId,issueDate) Values('$issueBookId','$issuerId','$dt')";        
                                        $returnD = mysqli_query($con,$query);

                                        $queryForUnavailableBook =("Update books Set available = 0 Where bookId = '$issueBookId'");
										mysqli_query($con,$queryForUnavailableBook);
                                        if($returnD){
                                            $errorMsg = "Book has been successfully issued.";
                                        }
                                        else{
                                            $errorMsg = "Problem in issueing this book.";
                                        }
                                    }
                                    else{
                                        //Write a query to find borrower name basing on
                                    //Issue id to give accurate sms to Librarian
                                        $issueId = $result3['issueId'];

                                         $query4 = "SELECT * From `members` Where `Id` = '$issueId'";
                                    $returnD4 = mysqli_query($con,$query4);
                                    $result4 = mysqli_fetch_assoc($returnD4);
                                        $errorMsg = 
                                        $result1['title']." is already borrowed by ".$result4['FirstName']." ".$result4['LastName']." With ".$issueId. " issue id";
                                    }

                                }
                                elseif($issueBookId != $result1['bookId']){
                                    $errorMsg = "Please! Enter valid Book-Id.";
                                }
                                elseif($issuerId != $result2['Id']){
                                    $errorMsg = "Please! Enter valid Issuer-Id.";
                                }
                            }
                            else{
                                $errorMsg = "Both fields can't be Empty.";
                            }

                            include("issueBooks.php");
                        }
                    ?>

                    <?php
                    // CODE TO RETURN BOOKS.. No error..

                        if(isset($_REQUEST['returnBtn'])){//checks that return button is clicked or not...

                            $returnId = $_REQUEST['returnId'];
                            $returnBookId = $_REQUEST['returnBookId'];

                            if(!empty($returnId) && !empty($returnBookId)){ //checks that both fields are filled or not...

                                $query1 = "Select bookId,issueId,returnId From borrow Where bookId = '$returnBookId' && issueId = '$returnId'";
                                $returnD1 = mysqli_query($con,$query1);
                                $result1 = mysqli_fetch_assoc($returnD1);

                                if($returnId == $result1['issueId'] && $returnBookId == $result1['bookId']){ //checks that book is issued or not or student id exists or not...

                                    date_default_timezone_set('Africa/Kigali');
                                    $dt = date("y/m/d h:i:s");

                             $query2 = "UPDATE `borrow` 
                             Set `returnBookId` = '$returnBookId',
                             `bookId` = 0, `returnId` = '$returnId', 
                             `issueId` = 0 , `returnDate` = '$dt' Where `bookId` = '$returnBookId' AND `issueId` = '$returnId'";
                                    $returnD2 = mysqli_query($con,$query2);
                                    if($returnD2){ 
                                        //set book to available for borrow
                                        $queryForAvailableBook =("Update books Set available = 1 Where bookId = '$returnBookId'");
                                    mysqli_query($con,$queryForAvailableBook );
                                    //checks that book is returned or not..
                                        $errorMsg = "Book has been successfully returned.";
                                    }
                                    else{
                        $errorMsg = "Problem in issueing book.";
                                    }

                                }
                                else{
                                    $errorMsg = "Book-Id or Issued-Id does not Exists or may not be issued.";
                                }
                            }
                            else{
                                $errorMsg = "Both fields must be filled.";
                            }

                            include("returnBooks.php");
                        }   
                    ?>

                    <?php 
                    //CODE T0 ADD BOOK.. No error..

                        $query = "Select Max(bookId) From books";
                        $returnD = mysqli_query($con,$query);
                        $result = mysqli_fetch_assoc($returnD);
                        $maxRows = $result['Max(bookId)'];
                        if(empty($maxRows)){
                            $lastRow = $maxRows = 1001;      
                        }else{
                            $lastRow = $maxRows + 1 ;
                        }

                        if(isset($_REQUEST['addBookBtn'])){

                            $bookId = $_REQUEST['bookId'];
                            $bookName = $_REQUEST['bookName'];
                            $authorName = $_REQUEST['authorName'];
                            $bookPrice = $_REQUEST['bookPrice'];
                            $bookPublisher = $_REQUEST['bookPublisher'];

                        if(!empty($bookId) && !empty($bookName) && !empty($authorName)&&!empty($bookPublisher)){

                                if($maxRows){

                                    $query = "INSERT INTO `books`(bookId,title,author,price,publisher,available) Values('$bookId','$bookName','$authorName','$bookPrice','$bookPublisher',1)";
                                    mysqli_query($con,$query);
                                    $errorMsg = "Book Sucessfully Added to Library, you can also add another one.";

                                    $query = "Select Max(bookId) From books";
                                    $returnD = mysqli_query($con,$query);
                                    $result = mysqli_fetch_assoc($returnD);
                                    $maxRows = $result['Max(bookId)'];
                                    if(empty($maxRows)){
                                        $lastRow = $maxRows = 1001;      
                                    }else{
                                        $lastRow = $maxRows + 1 ;
                                    }
                                }
                                else{
                                    $errorMsg = "Table is Empty.";
                                }

                            }else{
                                $errorMsg = "Please! Enter in Empty Field.";
                            }

                            include("addBook.php");
                        }
                    ?>

                    <?php 
                    // CODE TO ADD MEMBER.. No error..

                        $query = "Select Max(Id) From members";
                        $returnD = mysqli_query($con,$query);
                        $result = mysqli_fetch_assoc($returnD);
                        $maxRows = $result['Max(Id)'];
                        if(empty($maxRows)){
                            $lastRow = $maxRows = 1;      
                        }else{
                            $lastRow = $maxRows + 1 ;
                        }

                        if(isset($_REQUEST['addMemberBtn'])){

                            $memberId = $_REQUEST['memberId'];
                            $firstName = $_REQUEST['firstName'];
                            $lastName = $_REQUEST['lastName'];
                            $position = $_REQUEST['position'];
                            //$rollNo = $_REQUEST['rollNo'];
                            $mobile = $_REQUEST['mobile'];
                            $email = $_REQUEST['email'];
                            $course = $_REQUEST['course'];


                            if(!empty($memberId) && !empty($firstName) && !empty($lastName) && !empty($mobile)){

                                if($maxRows){

                                        $query = "Insert Into members(Id,FirstName,LastName,Position,Mobile,Email,Course) Values('$memberId','$firstName','$lastName','$position','$mobile','$email','$course')";
                                        mysqli_query($con,$query);
                                        $errorMsg = "Member Sucessfully Added.";

                                        $query = "Select Max(Id) From members";
                                        $returnD = mysqli_query($query);
                                        $result = mysqli_fetch_assoc($returnD);
                                        $maxRows = $result['Max(Id)'];
                                        if(empty($maxRows)){
                                            $lastRow = $maxRows = 1;      
                                        }else{
                                            $lastRow = $maxRows + 1 ;
                                        }

                                }
                                else{
                                    $errorMsg = "Table is Empty.";
                                }

                            }
                            else{
                                $errorMsg = "Please! Enter in Empty Field.";
                            }

                            include("addMember.php");
                        }
                    ?>

                <?php
                if(isset($errorMsg)){
                    ?>
                <div class="errorMsg"><?php echo $errorMsg; ?></div>
                    <?php
                    }
                ?>

        </div>
        <!--CONTENT AREA  SECTION-->

        <!--RIGHT AREA  SECTION-->
          <div class="rightSection">
            
          <?php include("rightSection.php");?>

          </div>
        <!--RIGHT AREA  SECTION-->

        </div>
        <!--CONTAINER AREA  SECTION-->
    </body>
</html>
