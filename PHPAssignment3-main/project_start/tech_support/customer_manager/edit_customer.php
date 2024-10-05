
<?php
require('../model/database.php'); 

$customer = null;

if (isset($_GET['customerID'])) {
    $customerID = intval($_GET['customerID']);

    try {
        $stmt = $db->prepare("SELECT * FROM customers WHERE customerID = :customerID");
        $stmt->bindParam(':customerID', $customerID);
        $stmt->execute();
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        $countriesStmt = $db->query("SELECT * FROM countries");
        $countries = $countriesStmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        error_log($error_message);
        include('../errors/database_error.php');
        exit();
    }
} else {
    echo "Invalid customer ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
</head>
<body>
    <h1>Edit Customer</h1>
    <form action="update_customer.php" method="POST">
        <input type="hidden" name="customerID" value="<?php echo htmlspecialchars($customer['customerID']); ?>">

        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" value="<?php echo htmlspecialchars($customer['firstName']); ?>" required><br>

        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" value="<?php echo htmlspecialchars($customer['lastName']); ?>" required><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($customer['address']); ?>" required><br>

        <label for="city">City:</label>
        <input type="text" name="city" value="<?php echo htmlspecialchars($customer['city']); ?>" required><br>

        <label for="state">State:</label>
        <input type="text" name="state" value="<?php echo htmlspecialchars($customer['state']); ?>" required><br>

        <label for="postalCode">Postal Code:</label>
        <input type="text" name="postalCode" value="<?php echo htmlspecialchars($customer['postalCode']); ?>" required><br>

        <label for="countryCode">Country:</label>
        <select name="countryCode" required>
            <?php foreach ($countries as $country): ?>
                <option value="<?php echo htmlspecialchars($country['countryCode']); ?>" 
                    <?php if ($country['countryCode'] == $customer['countryCode']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($country['countryName']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($customer['phone']); ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($customer['email']); ?>" required><br>

        <label for="password">Password:</label>
        <input type="text" name="password" value="<?php echo htmlspecialchars($customer['password']); ?>" placeholder="Enter new password or keep current"><br>

        <button type="submit">Update Customer</button>
    </form>

    <a href="search_customer.php">Search Customers</a>

</body>
</html>