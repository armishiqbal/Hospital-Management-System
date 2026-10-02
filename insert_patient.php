<?php
// insert_patient.php - Process Add New Patient
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $age = isset($_POST['age']) ? trim($_POST['age']) : '';
    $gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
    $contact = isset($_POST['contact']) ? trim($_POST['contact']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';

    $sql = "INSERT INTO `patient` (`name`, `age`, `gender`, `contact`, `address`) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("sisss", $name, $age, $gender, $contact, $address);
        if ($stmt->execute()) {
            $success = true;
            $msg = "Record successfully added to patient!";
        } else {
            $success = false;
            $msg = "Execution error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $success = false;
        $msg = "Preparation error: " . $conn->error;
    }
    $conn->close();
} else {
    header("Location: add_patient.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Patient Result</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #f4f6f9;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .modal-card {
            background: white;
            padding: 35px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            max-width: 480px;
            width: 90%;
            text-align: center;
        }
        .icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        h2 {
            margin-bottom: 10px;
            color: <?php echo $success ? '#28a745' : '#dc3545'; ?>;
        }
        p {
            color: #666;
            margin-bottom: 25px;
            line-height: 1.5;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            margin: 5px;
        }
        .btn-primary {
            background: #007bff;
            color: white;
        }
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
    </style>
</head>
<body>
    <div class="modal-card">
        <div class="icon"><?php echo $success ? '✅' : '❌'; ?></div>
        <h2><?php echo $success ? 'Success!' : 'Error'; ?></h2>
        <p><?php echo htmlspecialchars($msg); ?></p>
        <a href="add_patient.html" class="btn btn-primary">Add Another</a>
        <a href="index.html" class="btn btn-secondary">Dashboard</a>
    </div>
</body>
</html>
