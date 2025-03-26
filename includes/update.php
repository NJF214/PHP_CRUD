<?php
// Include database connection code
require_once 'dbconn.php'; // This file is expected to contain the database connection details such as $dsn, $dbusername, and $dbpassword.

// Establish a connection to the database using PDO
try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword); // Create a new PDO instance
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception for better error handling
} catch (PDOException $e) {
    die("Connection failed! " . $e->getMessage()); // Terminate the script if the connection fails
}

// Check if ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id']; // Retrieve the ID from the URL

    // Fetch the existing record from the database
    $query = "SELECT * FROM myfirsttable WHERE id = :id"; // SQL query to fetch the record by ID
    $stmt = $pdo->prepare($query); // Prepare the query
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Bind the ID parameter to the query
    $stmt->execute(); // Execute the query
    $record = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the record as an associative array


    if (!$record) {
        die("Record not found."); // Terminate the script if the record is not found
    }
} else {
    die("Invalid request."); // Terminate the script if the ID is not provided or is empty
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $favouritepet = $_POST['favouritepet'];

    // Validate input
    if (!empty($firstname) && !empty($lastname) && !empty($favouritepet)) {
        try {
            // Update the record in the database
            $sql = "UPDATE myfirsttable SET firstname = :firstname, lastname = :lastname, favouritepet = :favouritepet WHERE id = :id"; // SQL query to update the record
            $stmt = $pdo->prepare($sql); // Prepare the query
            $stmt->bindParam(':firstname', $firstname); // Bind the firstname parameter
            $stmt->bindParam(':lastname', $lastname); // Bind the lastname parameter
            $stmt->bindParam(':favouritepet', $favouritepet); // Bind the favouritepet parameter
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Bind the ID parameter

            if ($stmt->execute()) { // Execute the query
                echo "Record updated successfully."; // Display success message
                header("Location: ../index.php"); // Redirect to the index.php page
                exit; // Terminate the script after redirection
            } else {
                echo "Error updating record."; // Display error message if the update fails
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // Display the error message if an exception occurs
        }
    } else {
        echo "All fields are required."; // Display error message if any field is empty
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record</title>
</head>
<body>
    <!-- Form for updating the record inside a styled table -->
    <form method="POST">
        <table style="border-collapse: collapse; width: 40%; margin: auto; font-family: Arial, sans-serif;">
            <tr>
                <td style="padding: 10px; text-align: right; font-weight: bold;">
                    <label for="firstname">Firstname:</label>
                </td>
                <td style="padding: 10px;">
                    <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($record['firstname']); ?>" required style="width: 100%; padding: 5px;">
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; text-align: right; font-weight: bold;">
                    <label for="lastname">Lastname:</label>
                </td>
                <td style="padding: 10px;">
                    <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($record['lastname']); ?>" required style="width: 100%; padding: 5px;">
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; text-align: right; font-weight: bold;">
                    <label for="favouritepet">Favourite Pet:</label>
                </td>
                <td style="padding: 10px;">
                    <select id="favouritepet" name="favouritepet" required style="width: 100%; padding: 5px;">
                        <option value="none" <?php echo $record['favouritepet'] == 'none' ? 'selected' : ''; ?>>None</option>
                        <option value="dog" <?php echo $record['favouritepet'] == 'dog' ? 'selected' : ''; ?>>Dog</option>
                        <option value="cat" <?php echo $record['favouritepet'] == 'cat' ? 'selected' : ''; ?>>Cat</option>
                        <option value="bird" <?php echo $record['favouritepet'] == 'bird' ? 'selected' : ''; ?>>Bird</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 10px; text-align: center;">
                    <button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">Update</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>