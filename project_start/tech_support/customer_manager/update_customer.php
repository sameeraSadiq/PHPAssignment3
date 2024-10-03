<?php
require('../model/database.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $customerID = $_POST['customerID'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];
    $countryCode = $_POST['countryCode'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        
        if (!empty($password)) {
            $stmt = $db->prepare("UPDATE customers 
                                   SET firstName = :firstName, lastName = :lastName, address = :address, 
                                       city = :city, state = :state, postalCode = :postalCode, 
                                       countryCode = :countryCode, phone = :phone, email = :email, 
                                       password = :password 
                                   WHERE customerID = :customerID");

            $stmt->bindParam(':password', $password); 
        } else {
            
            $stmt = $db->prepare("UPDATE customers 
                                   SET firstName = :firstName, lastName = :lastName, address = :address, 
                                       city = :city, state = :state, postalCode = :postalCode, 
                                       countryCode = :countryCode, phone = :phone, email = :email 
                                   WHERE customerID = :customerID");
        }
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':postalCode', $postalCode);
        $stmt->bindParam(':countryCode', $countryCode);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':customerID', $customerID);
        $stmt->execute();
        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        error_log($error_message);
        include('../errors/database_error.php'); 
        exit();
    }
} else {
    echo "Invalid request method.";
}
?>