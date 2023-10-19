<?php
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['fruit']) && isset($_POST['quantity']) && isset($_POST['date']) && isset($_POST['visit']) ) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $fruit = $_POST['fruit'];
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];
    $visit = $_POST['visit'];
   

    $conn = new mysqli('localhost', 'root', '', 'freshpics');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO mangotypes (name, email, fruit, quantity, date, visit) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die('Prepare failed: ' . $conn->error);
        }

        $stmt->bind_param("sssiss", $name, $email, $fruit, $quantity, $date, $visit);

        if ($stmt->execute()) {
            $successMessage = "<div style='background-color: #4CAF50; color: #fff; padding: 20px; border-radius: 5px; text-align: center;'>";
            $successMessage .= "<h2>Congratulations $name!</h2>";
            $successMessage .= "<h3>Your slot has been booked with $email mail-id</h3>";
            $successMessage .= "<h5>You can collect your $quantity dozens of $fruit on $date </h5>";
            $successMessage .= "</div>";
            echo $successMessage;
        } else {
            $errorMessage = "<div style='background-color: #f44336; color: #fff; padding: 20px; border-radius: 5px; text-align: center;'>";
            $errorMessage .= "Error: " . $stmt->error;
            $errorMessage .= "</div>";
            echo $errorMessage;
        }

        $stmt->close();
        $conn->close();
    }
} else {
    echo "Error: Form data is missing.";
    echo "<pre>";
    print_r($_POST); // Output the contents of $_POST for debugging purposes
    echo "</pre>";
}
?>
