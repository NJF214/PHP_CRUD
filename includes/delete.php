<?php
// Database connection details
require_once 'dbconn.php'; // This file is expected to contain the database connection details such as $dsn, $dbusername, and $dbpassword.

try {
    // Establish a connection to the database
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the 'id' parameter is set in the URL
    if (isset($_GET['id'])) {
        // Get the ID from the URL
        $id = intval($_GET['id']); // Ensure the ID is an integer to prevent SQL injection

        // Prepare the DELETE SQL statement
        $sql = "DELETE FROM myfirsttable WHERE id = :id";

        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind the ID parameter to the statement
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the index page after successful deletion
            header("Location: /CompTech224/Sample/index.php");
            exit();
        } else {
            // If the deletion fails, display an error message
            echo "Error deleting record.";
        }
    } else {
        // If the 'id' parameter is not set, display an error message
        echo "No ID specified.";
    }
} catch (PDOException $e) {
    // Handle any errors that occur during the database connection or query execution
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$pdo = null;
?>