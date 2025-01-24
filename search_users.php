<?php
include_once("conn.php");

if (isset($_POST['name'])) {
    $searchName = $_POST['name'];
    
   
    $userSql = "SELECT DISTINCT users.`user-id`, users.fullname, users.email, users.studentNum
    FROM users
    WHERE role='User'
    AND (fullname LIKE ? OR email LIKE ? OR studentNum LIKE ?)";
 $stmt = mysqli_prepare($conn, $userSql);
$searchTerm = "%$searchName%";

mysqli_stmt_bind_param($stmt, "sss", $searchTerm, $searchTerm, $searchTerm);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    // Use an array to track unique results
    $uniqueResults = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $uniqueKey = $row["user-id"];
        
        // Only add if not already in unique results
        if (!isset($uniqueResults[$uniqueKey])) {
            $uniqueResults[$uniqueKey] = $row;
        }
    }
    
    // Output unique results
    
    echo "<tr><th class='text-[#10182c] font-semibold leading-6'>User ID</th>
    <th class='text-[#10182c] font-semibold leading-6'>Full Name</th>
    <th class='text-[#10182c] font-semibold leading-6'>Email</th>
    <th class='text-[#10182c] font-semibold leading-6'>Student Number</th></tr>";
    foreach ($uniqueResults as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["user-id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["fullname"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["studentNum"]) . "</td>";
        echo "</tr>";
    }
    
    mysqli_stmt_close($stmt);
}
?>