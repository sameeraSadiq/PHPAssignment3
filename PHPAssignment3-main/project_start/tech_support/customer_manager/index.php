
<?php
require('../model/database.php');

try {
    $countriesStmt = $db->query("SELECT * FROM countries");
    $countries = $countriesStmt->fetchAll(PDO::FETCH_ASSOC);

    $customersStmt = $db->query("
        SELECT c.*, co.countryName 
        FROM customers c 
        JOIN countries co ON c.countryCode = co.countryCode
    ");
    $customers = $customersStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    error_log($error_message);
    include('../errors/database_error.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
</head>
<body>
    <h1>Customer List</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Postal Code</th>
                <th>Country</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?php echo htmlspecialchars($customer['customerID']); ?></td>
                    <td><?php echo htmlspecialchars($customer['firstName']); ?></td>
                    <td><?php echo htmlspecialchars($customer['lastName']); ?></td>
                    <td><?php echo htmlspecialchars($customer['address']); ?></td>
                    <td><?php echo htmlspecialchars($customer['city']); ?></td>
                    <td><?php echo htmlspecialchars($customer['state']); ?></td>
                    <td><?php echo htmlspecialchars($customer['postalCode']); ?></td>
                    <td><?php echo htmlspecialchars($customer['countryName']); ?></td>
                    <td><?php echo htmlspecialchars($customer['phone']); ?></td>
                    <td><?php echo htmlspecialchars($customer['email']); ?></td>
                    <td><?php echo htmlspecialchars($customer['password']); ?></td>
                    <td>
                        <a href="edit_customer.php?customerID=<?php echo $customer['customerID']; ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
