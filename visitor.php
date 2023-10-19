<?php
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['date']) && isset($_POST['visit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $visit = $_POST['visit'];

    $conn = new mysqli('localhost', 'root', '', 'freshpics');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO visitor (name, email, date, visit) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            die('Prepare failed: ' . $conn->error);
        }

        $stmt->bind_param("ssss", $name, $email, $date, $visit);

        if ($stmt->execute()) {
            $successMessage = "<div style='background-color: #4CAF50; color: #fff; padding: 20px; border-radius: 5px; text-align: center;'>";
            $successMessage .= "<h2>Congratulations $name!</h2>";
            $successMessage .= "<h3>Your slot has been booked with $email mail-id</h3>";
            $successMessage .= "<h5>You can visit the farm on $date between $visit </h5>";
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
