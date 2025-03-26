<!-- FETCHING DATA FROM DATABASE AND DISPLAYING IT IN A TABLE -->
<?php
// Include the database connection file
require_once('includes/dbconn.php');

// SQL query to fetch all records from the table
$query = "SELECT * FROM myfirsttable";

// Prepare the SQL statement
$stmt = $pdo->prepare($query);

// Execute the prepared statement
$stmt->execute();

// Fetch all the results sdjfklsdjfklsjdfklsjdfklsjfklsjfklsjdfklj

// another comment to another
// another comment
// 2nd comment

$result = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>

<style type="text/css">
    /* Center the main content and set its width */
    main {
        margin: 0 auto;
        width: 50%;
        text-align: center;
    }

    /* Style for labels */
    label {
        display: block;
    }

    /* Style for table, table headers, and table cells */
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 10px;
        margin: 0 auto;
        text-align: center;
    }

    /* Style for table headers */
    table th {
        background-color: rgb(153, 167, 246);
        font-size: 20px;
        color: black;
        text-transform: uppercase;
    }

    /* Style for table rows */
    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table tr:nth-child(odd) {
        background-color: rgb(255, 255, 255);
    }

    /* Add hover effect for table rows */
    table tr:hover {
        background-color: #ddd;
        cursor: pointer;
    }

    /* Style for table cells */
    table td {
        font-size: 16px;
        color: #333;
    }

    /* Set font family for the body */
    body {
        font-family: Consolas, sans-serif;
    }

    /* Add spacing between table and other elements */
    table {
        margin-top: 20px;
    }
</style>


<body>
    <main>
        <!-- Form for submitting data -->
        <form action="includes/formhandler.php" method="post" autocomplete="off">
            <table>
                <tr>
                    <!-- Input for Firstname -->
                    <th><label for="firstname">Firstname</label></th>
                    <td><input required id="firstname" type="text" name="firstname" placeholder="Firstname..."></td>
                </tr>
                <tr>
                    <!-- Input for Lastname -->
                    <th><label for="lastname">Lastname</label></th>
                    <td><input required id="lastname" type="text" name="lastname" placeholder="Lastname..."></td>
                </tr>
                <tr>
                    <!-- Dropdown for Favourite Pet -->
                    <th><label for="favouritepet">Favourite Pet</label></th>
                    <td>
                        <select id="favouritepet" name="favouritepet">
                            <option value="none">None</option>
                            <option value="dog">Dog</option>
                            <option value="cat">Cat</option>
                            <option value="bird">Bird</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <!-- Submit Button -->
                    <td colspan="2" style="text-align: center;">
                        <button type="submit">Submit</button>
                    </td>
                </tr>
            </table>
        </form>
    </main>
    <br><br><br><br><br>

    <!-- TABLE TO DISPLAY RECORDS -->
    <h2 style="text-align: center;">VIEW RECORD</h2>
    <table>
        <tr>
            <!-- Table Headers -->
            <th>ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Favourite Pet</th>
            <th>Action</th>
        </tr>

        <tr>
            <!-- Loop through the fetched results and display each record -->
            <?php
            foreach ($result as $row) {
            ?>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['firstname'] ?></td>
                <td><?php echo $row['lastname'] ?></td>
                <td><?php echo $row['favouritepet'] ?></td>
                <td>
                    <!-- Links for deleting and updating records -->
                    <a href="includes/delete.php?id=<?php echo $row['id'] ?>">Delete</a> |
                    <a href="includes/update.php?id=<?php echo $row['id'] ?>">Update</a>
                </td>
        </tr>

    <?php
            }
    ?>
    </table>

</body>

</html>