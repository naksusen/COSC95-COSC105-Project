<?php
include("conn.php");

if (isset($_POST['reg_id'])) {
    $reg_id = mysqli_real_escape_string($conn, $_POST['reg_id']);
    
    $sql = "SELECT registrations.*, events.title, users.fullname, users.studentNum 
            FROM registrations 
            JOIN events ON registrations.event_id = events.`event-id` 
            JOIN users ON registrations.user_id = users.`user-id` 
            WHERE registrations.reg_id = '$reg_id'";
    
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $registration = mysqli_fetch_assoc($result);
        echo json_encode(['success' => true, 'registration' => $registration]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Registration not found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
