<?php
// insert_medical_record.php - Process Add Medical Record
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = isset($_POST['patient_id']) ? trim($_POST['patient_id']) : '';
    $diagnosis = isset($_POST['diagnosis']) ? trim($_POST['diagnosis']) : '';
    $treatment = isset($_POST['treatment']) ? trim($_POST['treatment']) : '';
    $record_date = isset($_POST['record_date']) ? trim($_POST['record_date']) : '';

    $sql = "INSERT INTO `medical_record` (`patient_id`, `diagnosis`, `treatment`, `record_date`) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("isss", $patient_id, $diagnosis, $treatment, $record_date);
        if ($stmt->execute()) {
            $success = true;
            $msg = "Record successfully added to medical_record!";
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
    header("Location: add_medical_records.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Medical Record Result</title>
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
        <a href="add_medical_records.html" class="btn btn-primary">Add Another</a>
        <a href="index.html" class="btn btn-secondary">Dashboard</a>
    </div>
</body>
</html>
