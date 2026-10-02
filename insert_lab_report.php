<?php
// insert_lab_report.php - Process Add Lab Report
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = isset($_POST['patient_id']) ? trim($_POST['patient_id']) : '';
    $test_name = isset($_POST['test_name']) ? trim($_POST['test_name']) : '';
    $report_result = isset($_POST['report_result']) ? trim($_POST['report_result']) : '';
    $report_date = isset($_POST['report_date']) ? trim($_POST['report_date']) : '';

    $sql = "INSERT INTO `lab_report` (`patient_id`, `test_name`, `report_result`, `report_date`) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("isss", $patient_id, $test_name, $report_result, $report_date);
        if ($stmt->execute()) {
            $success = true;
            $msg = "Record successfully added to lab_report!";
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
    header("Location: add_lab_report.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Lab Report Result</title>
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
        <a href="add_lab_report.html" class="btn btn-primary">Add Another</a>
        <a href="index.html" class="btn btn-secondary">Dashboard</a>
    </div>
</body>
</html>
