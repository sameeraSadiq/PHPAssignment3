<?php
// Include the database connection
require('../model/database.php');

// Get form data
$productCode = filter_input(INPUT_POST, 'productCode', FILTER_SANITIZE_STRING);
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$version = filter_input(INPUT_POST, 'version', FILTER_SANITIZE_STRING);
$releaseDate = filter_input(INPUT_POST, 'releaseDate', FILTER_SANITIZE_STRING);

// Insert product into the database
if ($productCode && $name && $version && $releaseDate) {
    try {
        //code...
        $query = 'INSERT INTO products (productCode, name, version, releaseDate)
              VALUES (:productCode, :name, :version, :releaseDate)';
        $statement = $db->prepare($query);
        $statement->bindValue(':productCode', $productCode);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':version', $version);
        $statement->bindValue(':releaseDate', $releaseDate);
        $statement->execute();
        $statement->closeCursor();

        // Redirect to product list
        header('Location: product_list.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Please fill in all fields.";
}
?>