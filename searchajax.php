<?php
include("conn.php");

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $event_id = isset($_POST['event_id']) ? intval($_POST['event_id']) : 0;

    $sql = "SELECT registrations.reg_id, events.title, users.studentNum, users.fullname, 
            registrations.program, registrations.yearlvl, registrations.section,
            registrations.payment_mode, registrations.payment_status,
            registrations.user_id, registrations.event_id
            FROM registrations 
            JOIN events ON registrations.event_id = events.`event-id` 
            JOIN users ON registrations.user_id = users.`user-id` 
            WHERE (registrations.reg_id LIKE ? 
            OR events.title LIKE ? 
            OR users.studentNum LIKE ? 
            OR users.fullname LIKE ? 
            OR CONCAT(registrations.program, ' ', registrations.yearlvl, '-', registrations.section) LIKE ?
            OR registrations.payment_mode LIKE ?)
            AND registrations.payment_status = 'Pending' 
            AND registrations.event_id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    $searchTerm = '%' . $name . '%';
    mysqli_stmt_bind_param($stmt, "ssssssi", 
        $searchTerm, $searchTerm, $searchTerm, 
        $searchTerm, $searchTerm, $searchTerm, $event_id);
    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);

    $data = '';
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data .= "<tr id='pending-row-" . $row["reg_id"] . "'>
                <td>" . $row["reg_id"] . "</td>
                <td>" . $row["title"] . "</td>
                <td>" . $row["studentNum"] . "</td>
                <td>" . $row["fullname"] . "</td>
                <td>" . $row["program"] . " " . $row["yearlvl"] . "-" . $row["section"] . "</td>
                <td>" . $row["payment_mode"] . "</td>
                <td>" . $row["payment_status"] . "</td>
                <td>
                    <button onclick=\"showDetailsDialog('" . $row['reg_id'] . "')\" class='bg-sky-900 text-slate-50 text-sm leading-5 font-medium rounded-full px-2 py-2 mr-2'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' style='fill: #f8fafc;transform: msFilter'>
                            <path d='m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z'></path>
                        </svg>
                    </button>
                </td>
            </tr>";
        }
        echo $data;
    } else {
        echo "<tr><td colspan='8' class='text-center'>No match found</td></tr>";
    }
}
?>