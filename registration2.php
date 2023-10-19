<?php
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
   

    $conn = new mysqli('localhost', 'root', '', 'freshpics');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO registration2 (name, email, phone) VALUES (?, ?, ?)");
        if (!$stmt) {
            die('Prepare failed: ' . $conn->error);
        }

        $stmt->bind_param("ssi", $name, $email, $phone);

        if ($stmt->execute()) {
            $successMessage = "<div style='background-color: #4CAF50; color: #fff; padding: 20px; border-radius: 5px; text-align: center;'>";
            $successMessage .= "<h2>Congratulations $name!</h2>";
            $successMessage .= "<h3>Your slot has been booked with $email mail-id</h3>";
            $successMessage .= "<h5>your registered number is $phone </h5>";
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
