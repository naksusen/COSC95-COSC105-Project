<?php
include("conn.php");

if (isset($_POST['reg_id'])) {
    $reg_id = mysqli_real_escape_string($conn, $_POST['reg_id']);
    
    $sql = "UPDATE registrations SET payment_status = 'Paid' WHERE reg_id = '$reg_id'";
    
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>