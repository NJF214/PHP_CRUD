<?php 

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Assign form input values to variables
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$favouritepet = $_POST['favouritepet'];

	// Establish database connection
	try {
		// Include the database connection file
		include "dbconn.php";
		
		// Prepare the SQL query to insert data into the database
		$query = "INSERT INTO myfirsttable (firstname, lastname, favouritepet) VALUES (?, ?, ?)";

		// Prepare the statement
		$stmt = $pdo->prepare($query);

		// Execute the statement with the provided values
		$stmt->execute([$firstname, $lastname, $favouritepet]);
		
		// Redirect to the index page after successful insertion
		header("location: ../index.php");
		die();

	} catch (PDOException $e) {
		// Handle any database-related errors
		die("Query failed: " . $e->getMessage());	
	}

} else {
	// Redirect to the index page if the request method is not POST
	header("location: ../index.php");
}

?>