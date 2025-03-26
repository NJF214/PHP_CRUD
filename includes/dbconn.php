<!--
 * Database Connection Script
 * 
 * This script establishes a connection to a MySQL database using PDO (PHP Data Objects).
 * 
 * Variables:
 * - $dsn: The Data Source Name, which contains the information required to connect to the database.
 * - $dbusername: The username for the database connection.
 * - $dbpassword: The password for the database connection.
 * 
 * Functionality:
 * - Attempts to create a new PDO instance to connect to the database.
 * - If the connection fails, a PDOException is caught, and an error message is displayed.
 * 
 * Usage:
 * - Include this file in your PHP scripts to use the $pdo object for database operations.
 * 
 * Note:
 * - Ensure that the database credentials and host are correctly configured.
 * - For production environments, avoid displaying detailed error messages to users.
-->
<?php 

$dsn = "mysql:host=localhost; dbname=myfirstdatabase";
$dbusername = "root";
$dbpassword = "";

try {
	$pdo = new PDO($dsn, $dbusername, $dbpassword);
	
} catch (PDOException $e) {
	echo "Connection failed!" . $e->getMessage();	
}

?>