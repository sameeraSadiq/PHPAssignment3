
<?php
require('../model/database.php');

$search = isset($_GET['search']) ? $_GET['search'] : '';

try {
    if (!empty($search)) {
      
        $stmt = $db->prepare("SELECT * FROM customers WHERE firstName LIKE :search OR lastName LIKE :search OR email LIKE :search");
        $searchParam = '%' . $search . '%';
        $stmt->bindParam(':search', $searchParam);
    } else {
        $stmt = $db->prepare("SELECT * FROM customers WHERE 1=0");
    }

    $stmt->execute();
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Search Customers</title>
</head>
<body>
    <h1>Search Customers</h1>

    <!-- Search Form -->
    <form method="GET" action="search_customer.php">
        <label for="search">Search Customers:</label>
        <input type="text" name="search" id="search" placeholder="Enter name or email" value="<?php echo htmlspecialchars($search); ?>" required>
        <button type="submit">Search</button>
    </form>

    <!-- Customer Table -->
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($customers) > 0): ?>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($customer['firstName']); ?></td>
                        <td><?php echo htmlspecialchars($customer['lastName']); ?></td>
                        <td><?php echo htmlspecialchars($customer['email']); ?></td>
                        <td>
                            <a href="edit_customer.php?customerID=<?php echo $customer['customerID']; ?>">Edit</a>
                            <a href="delete_customer.php?customerID=<?php echo $customer['customerID']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No customers found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>