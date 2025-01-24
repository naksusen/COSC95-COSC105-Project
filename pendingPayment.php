<?php
session_start();
include("conn.php");

// Get event ID from URL
$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : null;

if (!$event_id) {
    header('Location: adminEvents.php');
    exit();
}

// Get event details
$eventSql = "SELECT * FROM events WHERE `event-id` = ?";
$stmt = mysqli_prepare($conn, $eventSql);
mysqli_stmt_bind_param($stmt, "i", $event_id);
mysqli_stmt_execute($stmt);
$eventResult = mysqli_stmt_get_result($stmt);
$eventDetails = mysqli_fetch_assoc($eventResult);

if (!$eventDetails) {
    header('Location: adminEvents.php');
    exit();
}

// Number of rows per page
$rowsPerPage = 10;

// Current page, default to 1
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

// Calculate the limit for the SQL query
$limitStart = ($currentPage - 1) * $rowsPerPage;

// Fetch pending payments with LIMIT clause
$sql = "SELECT registrations.reg_id, registrations.user_id, registrations.event_id, 
        registrations.program, registrations.yearlvl, registrations.section, 
        registrations.payment_mode, registrations.payment_status, registrations.addtl_data, 
        events.title, events.price, users.fullname, users.studentNum 
        FROM registrations 
        JOIN events ON registrations.event_id = events.`event-id` 
        JOIN users ON registrations.user_id = users.`user-id` 
        WHERE registrations.payment_status = 'Pending' 
        AND registrations.event_id = ? 
        LIMIT ?, ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "iii", $event_id, $limitStart, $rowsPerPage);
mysqli_stmt_execute($stmt);
$query = mysqli_stmt_get_result($stmt);

// Fetch paid payments
$paidSql = "SELECT registrations.reg_id, registrations.user_id, registrations.event_id, 
            registrations.program, registrations.yearlvl, registrations.section, 
            registrations.payment_mode, registrations.payment_status, registrations.addtl_data, 
            events.title, events.price, users.fullname, users.studentNum 
            FROM registrations 
            JOIN events ON registrations.event_id = events.`event-id` 
            JOIN users ON registrations.user_id = users.`user-id` 
            WHERE registrations.payment_status = 'Paid' 
            AND registrations.event_id = ? 
            LIMIT ?, ?";

$stmt = mysqli_prepare($conn, $paidSql);
mysqli_stmt_bind_param($stmt, "iii", $event_id, $limitStart, $rowsPerPage);
mysqli_stmt_execute($stmt);
$paidQuery = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@themesberg/flowbite@latest/dist/flowbite.bundle.js"></script>
    <title>Pending Payments for <?php echo $eventDetails['title']; ?></title>
    <link rel="icon" type="image/x-icon" href="images/G!.png" />
    <link rel="stylesheet" href="table.css" type="text/css">
    <link href="/dist/output.css" rel="stylesheet" />
    <link rel="stylesheet" href="pendpay.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <style>
        #dropbtn #dropdown {
            position: absolute;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: rgb(229, 231, 235);
            min-width: 110px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: rgb(67 20 7);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #ddd;
        }

        /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
        .show {
            display: block;
        }
    </style>
</head>

<body>
    <!-- Gradient Background -->
    <div class="blob w-full h-full rounded-[999px] absolute top-0 right-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200"></div>
    <div class="blob w-[1000px] h-[1000px] rounded-[999px] absolute bottom-0 left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-red-200 via-gray-100 to-blue-100"></div>
    <div class="blob w-[600px] h-[600px] rounded-[999px] absolute bottom-0 left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-slate-100 via-teal-100 to-blue-100"></div>
    <div class="blob w-[300px] h-[300px] rounded-[999px] absolute bottom-[10px] left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-green-200 via-cyan-200 to-Fuchsia-300"></div>
    <!-- End of Gradient Background -->

    <!-- Sidebar -->
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <a href="adminDashboard.php" class="flex items-center py-6 ps-8 mb-5">
                <img src="images/G!.png" class="h-6 me-3 sm:h-7" alt="Flowbite Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">G! Arat Na</span>
            </a>
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="adminDashboard.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:text-slate-50 hover:bg-gradient-to-l from-red-100 to-sky-700 group">
                        <img src="images/bxs-home-alt-2.svg" alt="" />
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="adminEvents.php" class="flex items-center p-2 text-gray-900 rounded-lg bg-gradient-to-l from-red-100 to-sky-700 text-white hover:text-slate-50">
                        <img src="images/bxs-file.svg" alt="" />
                        <span class="flex-1 ms-3 whitespace-nowrap">Events</span>
                        <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-red-100">
                        <?php
                            $sql1 = "SELECT *  FROM events";
                            $result = mysqli_query($conn, $sql1);

                            if (isset($result)) {
                                $row = mysqli_num_rows($result);
                                echo $row;
                            }
                            ?>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="addevent.php" class="flex items-center p-2 text-gray-900 rounded-lg text-white hover:text-slate-50 hover:bg-gradient-to-l from-red-100 to-sky-700 group">
                        <img src="images/bx-calendar-plus.svg" alt="" />
                        <span class="ms-3">Add Event</span>
                    </a>
                </li>
            </ul>

            <!-- Bottom sidebar -->
            <div class="container pt-32">
    <div id="cameraContainer" class="text-center">
        <!-- Initial state with button and description -->
        <div id="cameraIntro">
            <button onclick="toggleCamera()" class="bg-sky-900 hover:bg-sky-800 text-white font-medium rounded-lg text-sm px-5 py-2.5 mb-3">
                Start QR Scanner
            </button>
            <p class="text-sm text-gray-600 px-4">
                Click to activate the QR code scanner. Use this to quickly look up registrant information by scanning their registration QR code.
            </p>
        </div>
        
        <!-- Camera preview (hidden initially) -->
        <div id="cameraPreview" class="hidden">
            <h4 class="text-red-100 text-md font-medium mb-4">
                Scan QR Code
            </h4>
            <div class="flex justify-center">
                <video id="preview" style="border-radius: 10px; width: 180px; height: 180px; object-fit: cover;"></video>
            </div>
            <button onclick="toggleCamera()" class="bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg text-sm px-4 py-2 mt-3">
                Stop Scanner
            </button>
        </div>
    </div>
</div>
        </div>
      

        </div>

    </aside>
    <!-- End of Sidebar -->


    <!-- Content div -->
    <div class="py-8 px-10 sm:ml-64">
        <!-- Header -->
        <div class="flex w-full items-center justify-between pb-8 gap-5 max-md:max-w-full max-md:flex-wrap">
            <h1 class="text-[#10182c] text-6xl font-bold my-auto">
            Pending Payments for <?php echo $eventDetails['title']; ?> 
            </h1>


            <!--Admin Dropdown-->
            <div class="max-w-lg">
                <button class="text-[#424242] bg-transparent hover:bg-transparent focus:ring-4 focus:ring-transparent font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center" type="button" data-dropdown-toggle="dropdown">
                    Account
                </button>

                <!-- Dropdown menu -->
                <div class="hidden bg-white text-base z-50 list-none divide-y divide-gray-100 rounded shadow my-4" id="dropdown">
                    <div class="px-4 py-3">
                        <?php
                        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                            $email = $_SESSION['email'];
                            $sql2 = "Select * from users where email='$email'";
                            $result2 = mysqli_query($conn, $sql2);
                            $row = mysqli_fetch_assoc($result2);
                            echo '<p>' . $row['fullname'] . '</p>';
                        }
                        ?>
                    </div>
                    <ul class="py-1" aria-labelledby="dropdown">

                        <li>
                            <a href="login.php" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Sign out</a>
                        </li>
                    </ul>
                </div>
                <!-- End of Dropdown menu -->
            </div>
            <!--End of Admin Dropdown-->
        </div>
        <!-- End of Header -->

        <!-- Search and Filter Section -->
        <div class="grid grid-flow-col">
            <form class="max-w-md " onsubmit="event.preventDefault()">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <input type="search" id="getName" name="name" class="block w-full px-4 py-3 ps-6 text-sm rounded-full bg-sky-900 bg-opacity-10 shadow-md placeholder-gray-400 text-whitefocus:ring-sky-800 focus:border-sky-800" placeholder="Search registrant" required />
                    <button class="text-slate-50  absolute end-2.5 bottom-[6.25px] hover:bg-gradient-to-tr from-sky-300 to-sky-700 focus:ring-4 focus:outline-none font-medium rounded-full text-sm px-4 py-2 dark:bg-sky-900 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </button>
                </div>
            </form>
            <!-- <button class="flex justify-end">
                <a href="requests.php" class="bg-sky-900 text-slate-50 text-sm leading-5 font-medium rounded-full px-4 py-2 mr-2">Get Report</a>
            </button> -->
        </div>
        <!-- End of Search and Filter Section -->



        <!-- Table Section -->
        <section class="shadow-lg bg-sky-900 bg-opacity-10 flex flex-col mt-10 mb-10 rounded-3xl max-md:max-w-full">
    <div class="flex flex-col items-center">
        <h2 class="text-2xl font-bold text-sky-900 my-6">Pending Payments</h2>
        <section class="bg-sky-900 bg-opacity-10 flex w-full max-w-full flex-col pb-8 rounded-3xl">
            <div class="self-center flex w-[100%] max-w-full max-md:flex-wrap justify-evenly mb-5">
                <table>
                    <tr>
                        <th class="text-[#10182c] font-semibold leading-6">Registration ID</th>
                        <th class="text-[#10182c] font-semibold leading-6">Event Name</th>
                        <th class="text-[#10182c] font-semibold leading-6">Student Number</th>
                        <th class="text-[#10182c] font-semibold leading-6">Registrant Name</th>
                        <th class="text-[#10182c] font-semibold leading-6">Year and Section</th>
                        <th class="text-[#10182c] font-semibold leading-6">Mode</th>
                        <th class="text-[#10182c] font-semibold leading-6">Status</th>
                        <th class="text-[#10182c] font-semibold leading-6">Action</th>
                    </tr>
                    <tbody id="showdata">
                        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                            <tr id="pending-row-<?php echo $row["reg_id"]; ?>">
                                <td><?php echo $row["reg_id"]; ?></td>
                                <td><?php echo $row["title"]; ?></td>
                                <td><?php echo $row["studentNum"]; ?></td>
                                <td><?php echo $row["fullname"]; ?></td>
                                <td><?php echo $row["program"] . " " . $row["yearlvl"] . "-" . $row["section"]; ?></td>
                                <td><?php echo $row["payment_mode"]; ?></td>
                                <td><?php echo $row["payment_status"]; ?></td>
                                <td>
    <button onclick="showDetailsDialog('<?php echo $row['reg_id']; ?>')" class='bg-sky-900 text-slate-50 text-sm leading-5 font-medium rounded-full px-2 py-2 mr-2'>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill: #f8fafc;transform: msFilter">
            <path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path>
        </svg>
    </button>
</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</section>

<!-- Add new section for Paid Payments -->
<section class="shadow-lg bg-sky-900 bg-opacity-10 flex flex-col mt-10 mb-20 rounded-3xl max-md:max-w-full">
    <div class="flex flex-col items-center">
        <h2 class="text-2xl font-bold text-sky-900 my-6">Paid Payments</h2>
        <section class="bg-sky-900 bg-opacity-10 flex w-full max-w-full flex-col pb-8 rounded-3xl">
            <div class="self-center flex w-[100%] max-w-full max-md:flex-wrap justify-evenly mb-5">
                <table>
                    <tr>
                        <th class="text-[#10182c] font-semibold leading-6">Registration ID</th>
                        <th class="text-[#10182c] font-semibold leading-6">Event Name</th>
                        <th class="text-[#10182c] font-semibold leading-6">Student Number</th>
                        <th class="text-[#10182c] font-semibold leading-6">Registrant Name</th>
                        <th class="text-[#10182c] font-semibold leading-6">Year and Section</th>
                        <th class="text-[#10182c] font-semibold leading-6">Mode</th>
                        <th class="text-[#10182c] font-semibold leading-6">Status</th>
                    </tr>
                    <tbody id="paid-data">
                        <?php while ($row = mysqli_fetch_assoc($paidQuery)) { ?>
                            <tr id="paid-row-<?php echo $row["reg_id"]; ?>">
                                <td><?php echo $row["reg_id"]; ?></td>
                                <td><?php echo $row["title"]; ?></td>
                                <td><?php echo $row["studentNum"]; ?></td>
                                <td><?php echo $row["fullname"]; ?></td>
                                <td><?php echo $row["program"] . " " . $row["yearlvl"] . "-" . $row["section"]; ?></td>
                                <td><?php echo $row["payment_mode"]; ?></td>
                                <td><?php echo $row["payment_status"]; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</section>

                <!--PREVIOUS & NEXT PAGE BUTTON-->
                <div class="flex justify-center mt-2 mb-2">
                    <?php
                    $resultnumrows = mysqli_query($conn, "SELECT * FROM registrations");
                    $totalRows = mysqli_num_rows($resultnumrows);
                    $totalPages = ceil($totalRows / $rowsPerPage);

                    if (isset($_GET['order'])) {
                        // Previous page button
                        if ($currentPage > 1) {
                            echo "<a href='requests.php?order=" . $sort_order . "&page=" . ($currentPage - 1) . "' class='mx-1 px-2 py-1 bg-sky-900 text-white rounded-full'>Previous</a>";
                        }

                        // Page numbers
                        for ($i = 1; $i <= $totalPages; $i++) {
                            echo "<a href='requests.php?order=" . $sort_order . "&page=$i' class='mx-1 px-2 py-1 bg-sky-900 text-slate-50 rounded-full'>$i</a>";
                        }

                        // Next page button
                        if ($currentPage < $totalPages) {
                            echo "<a href='requests.php?order=" . $sort_order . "&page=" . ($currentPage + 1) . "' class='mx-1 px-2 py-1 bg-sky-900 text-slate-50 rounded-full'>Next</a>";
                        }
                    } else if (isset($_GET['progvalue'])) {
                        // Previous page button
                        if ($currentPage > 1) {
                            echo "<a href='requests.php?progvalue=" . $program . "&page=" . ($currentPage - 1) . "' class='mx-1 px-2 py-1 bg-sky-900 text-slate-50 rounded-full'>Previous</a>";
                        }

                        // Page numbers
                        for ($i = 1; $i <= $totalPages; $i++) {
                            echo "<a href='requests.php?progvalue=" . $program . "&page=$i' class='mx-2 px-4 py-2bg-sky-900 text-slate-50 rounded-3xl'>$i</a>";
                        }

                        // Next page button
                        if ($currentPage < $totalPages) {
                            echo "<a href='requests.php?progvalue=" . $program . "&page=" . ($currentPage + 1) . "' class='mx-2 px-4 py-2 bg-sky-900 text-slate-50 rounded-3xl'>Next</a>";
                        }
                    } else {
                        // Previous page button
                        if ($currentPage > 1) {
                            echo "<a href='requests.php?page=" . ($currentPage - 1) . "' class='mx-2 px-4 py-2 bg-sky-900 text-slate-50 rounded-3xl'>Previous</a>";
                        }

                        // Page numbers
                        for ($i = 1; $i <= $totalPages; $i++) {
                            echo "<a href='requests.php?page=$i' class='mx-2 px-4 py-2 bg-sky-900 text-slate-50 rounded-3xl'>$i</a>";
                        }

                        // Next page button
                        if ($currentPage < $totalPages) {
                            echo "<a href='requests.php?page=" . ($currentPage + 1) . "' class='mx-2 px-4 py-2 bg-sky-900 text-slate-50   rounded-3xl'>Next</a>";
                        }
                    }
                    ?>
                </div>
                <!--PAGE BUTTON END-->
<!-- Modal Dialog -->
<div id="scanModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-sky-100">
                <svg class="h-6 w-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 text-center mt-4 mb-2">
                Registration Details
            </h3>
            <div class="mt-2" id="modalContent">
                <!-- Content will be dynamically inserted here -->
            </div>
            <div class="flex justify-center gap-4 mt-6">
                <button id="confirmBtn" class="px-4 py-2 bg-sky-900 text-white text-base font-medium rounded-md shadow-sm hover:bg-sky-800 focus:outline-none focus:ring-2 focus:ring-sky-700">
                    Confirm Payment
                </button>
                <button id="closeModal" class="px-4 py-2 bg-gray-200 text-gray-800 text-base font-medium rounded-md shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal Dialog -->

<script>
let scanner = null;
let currentRegId; 

function toggleCamera() {
    const cameraIntro = document.getElementById('cameraIntro');
    const cameraPreview = document.getElementById('cameraPreview');
    
    if (cameraPreview.classList.contains('hidden')) {
        // Start camera
        cameraIntro.classList.add('hidden');
        cameraPreview.classList.remove('hidden');
        
        scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });
        
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert('No cameras found');
            }
        }).catch(function(e) {
            console.error(e);
        });

        scanner.addListener('scan', function(content) {
            // When QR code is scanned, fetch registration details
            fetchRegistrationDetails(content);
        });
    } else {
        // Stop camera
        if (scanner) {
            scanner.stop();
        }
        cameraPreview.classList.add('hidden');
        cameraIntro.classList.remove('hidden');
    }
}

function fetchRegistrationDetails(regId) {
    // Make an AJAX call to fetch registration details
    $.ajax({
        method: 'POST',
        url: 'fetch_registration.php', // You'll need to create this PHP file
        data: { reg_id: regId },
        success: function(response) {
            try {
                const data = JSON.parse(response);
                if (data.success) {
                    showModal(data.registration);
                } else {
                    showModal({ error: "Registration not found" });
                }
            } catch (e) {
                showModal({ error: "Invalid QR Code" });
            }
        },
        error: function() {
            showModal({ error: "Error fetching registration details" });
        }
    });
}



// Add event listeners for modal buttons
document.getElementById('closeModal').onclick = function() {
    const modal = document.getElementById('scanModal');
    modal.classList.add('hidden'); // This should hide the modal
};

function showModal(data) {
    const modal = document.getElementById('scanModal');
    const content = document.getElementById('modalContent');
    const confirmBtn = document.getElementById('confirmBtn');

    // Clear previous content
    content.innerHTML = '';

    if (data.error) {
        content.innerHTML = `<div class="text-red-600 text-center">${data.error}</div>`;
        confirmBtn.style.display = 'none';
    } else {
        currentRegId = data.reg_id; // Set currentRegId here
        content.innerHTML = `
            <div class="space-y-3">
                <p><span class="font-semibold">Registration ID:</span> ${data.reg_id}</p>
                <p><span class="font-semibold">Event:</span> ${data.title}</p>
                <p><span class="font-semibold">Student:</span> ${data.fullname}</p>
                <p><span class="font-semibold">Student Number:</span> ${data.studentNum}</p>
                <p><span class="font-semibold">Program:</span> ${data.program} ${data.yearlvl}-${data.section}</p>
                <p><span class="font-semibold">Payment Mode:</span> ${data.payment_mode}</p>
                <p><span class="font-semibold">Status:</span> ${data.payment_status}</p>
            </div>
        `;
        confirmBtn.style.display = 'block';
    }

    // Show modal
    modal.classList.remove('hidden');
}



document.getElementById('confirmBtn').addEventListener('click', function() {
    // Handle payment confirmation
    $.ajax({
        method: 'POST',
        url: 'confirm_payment.php', // You'll need to create this PHP file
        data: { reg_id: currentRegId },
        success: function(response) {
            try {
                const data = JSON.parse(response);
                if (data.success) {
                    // Refresh the page or update the table
                    location.reload();
                } else {
                    alert('Error confirming payment: ' + data.message);
                }
            } catch (e) {
                alert('Error processing payment confirmation');
            }
        }
    });
});
</script>
<script>
// Update the confirm payment function in your existing script
function handlePaymentConfirmation(regId) {
    $.ajax({
        method: 'POST',
        url: 'confirm_payment.php',
        data: { reg_id: regId },
        success: function(response) {
            try {
                const data = JSON.parse(response);
                if (data.success) {
                    // Move the row from pending to paid table
                    const pendingRow = document.getElementById('pending-row-' + regId);
                    const paidTableBody = document.getElementById('paid-data');
                    
                    // Create new row for paid table (without action button)
                    const newRow = pendingRow.cloneNode(true);
                    newRow.id = 'paid-row-' + regId;
                    // Remove the action column
                    newRow.deleteCell(-1);
                    
                    // Add to paid table and remove from pending
                    paidTableBody.insertBefore(newRow, paidTableBody.firstChild);
                    pendingRow.remove();
                    
                    // Close the modal if it's open
                    document.getElementById('scanModal')?.classList.add('hidden');
                } else {
                    alert('Error confirming payment: ' + data.message);
                }
            } catch (e) {
                alert('Error processing payment confirmation');
            }
        }
    });
}

// Update the confirmBtn click handler in your existing modal script
document.getElementById('confirmBtn').addEventListener('click', function() {
    const regId = document.getElementById('modalContent').getAttribute('data-reg-id');
    handlePaymentConfirmation(regId);
});

// Update the showModal function to store the registration ID
function showModal(data) {
    const modal = document.getElementById('scanModal');
    const content = document.getElementById('modalContent');
    const confirmBtn = document.getElementById('confirmBtn');
    
    content.innerHTML = '';
    
    if (data.error) {
        content.innerHTML = `
            <div class="text-red-600 text-center">
                ${data.error}
            </div>
        `;
        confirmBtn.style.display = 'none';
    } else {
        // Store the registration ID as a data attribute
        content.setAttribute('data-reg-id', data.reg_id);
        
        content.innerHTML = `
            <div class="space-y-3">
                <p><span class="font-semibold">Registration ID:</span> ${data.reg_id}</p>
                <p><span class="font-semibold">Event:</span> ${data.title}</p>
                <p><span class="font-semibold">Student:</span> ${data.fullname}</p>
                <p><span class="font-semibold">Student Number:</span> ${data.studentNum}</p>
                <p><span class="font-semibold">Program:</span> ${data.program} ${data.yearlvl}-${data.section}</p>
                <p><span class="font-semibold">Payment Mode:</span> ${data.payment_mode}</p>
                <p><span class="font-semibold">Status:</span> ${data.payment_status}</p>
            </div>
        `;
        confirmBtn.style.display = 'block';
    }
    
    modal.classList.remove('hidden');
}
</script>
                <script src="table.js"></script>
                <script>
                    $(document).ready(function() {
    // Get the event ID from the page (assuming it's in the URL)
    var eventId = <?php echo $event_id; ?>;

    $('#getName').on("keyup", function() {
        var getName = $(this).val();
        $.ajax({
            method: 'POST',
            url: 'searchajax.php',
            data: {
                name: getName,
                event_id: eventId
            },
            success: function(response) {
                $("#showdata").html(response);
            }
        });
    });
});

                    function SORTdropdown() {
                        document.getElementById("sortDropdown").classList.toggle("show");
                    }

                    function YLdropdown() {
                        document.getElementById("ylDropdown").classList.toggle("show");
                    }

                    function PROGRAMdropdown() {
                        document.getElementById("programDropdown").classList.toggle("show");
                    }

                    // Close the dropdown menu if the user clicks outside of it
                    window.onclick = function(event) {
                        if (!event.target.matches('#dropbtn')) {
                            var dropdowns = document.getElementsByClassName("dropdown-content");
                            var i;
                            for (i = 0; i < dropdowns.length; i++) {
                                var openDropdown = dropdowns[i];
                                if (openDropdown.classList.contains('show')) {
                                    openDropdown.classList.remove('show');
                                }
                            }
                        }
                    }
                </script>
                <script>
function showDetailsDialog(regId) {
    // Fetch registration details
    $.ajax({
        method: 'POST',
        url: 'fetch_registration.php',
        data: { reg_id: regId },
        success: function(response) {
            try {
                const data = JSON.parse(response);
                if (data.success) {
                    showModal(data.registration);
                } else {
                    showModal({ error: "Registration not found" });
                }
            } catch (e) {
                showModal({ error: "Error fetching registration details" });
            }
        },
        error: function() {
            showModal({ error: "Error connecting to server" });
        }
    });
}

// Update the handlePaymentConfirmation function
function handlePaymentConfirmation(regId) {
    $.ajax({
        method: 'POST',
        url: 'confirm_payment.php',
        data: { reg_id: regId },
        success: function(response) {
            try {
                const data = JSON.parse(response);
                if (data.success) {
                    // Move the row from pending to paid table
                    const pendingRow = document.getElementById('pending-row-' + regId);
                    const paidTableBody = document.getElementById('paid-data');
                    
                    // Create new row for paid table (without action button)
                    const newRow = pendingRow.cloneNode(true);
                    newRow.id = 'paid-row-' + regId;
                    
                    // Remove the action column
                    newRow.deleteCell(-1);
                    
                    // Update the status cell to "Paid"
                    const statusCell = newRow.cells[newRow.cells.length - 1];
                    statusCell.textContent = 'Paid';
                    statusCell.classList.add('text-green-600', 'font-medium');
                    
                    // Add to paid table and remove from pending
                    paidTableBody.insertBefore(newRow, paidTableBody.firstChild);
                    pendingRow.remove();
                    
                    // Close the modal
                    document.getElementById('scanModal').classList.add('hidden');
                } else {
                    alert('Error confirming payment: ' + data.message);
                }
            } catch (e) {
                alert('Error processing payment confirmation');
            }
        }
    });
}

// Update the showModal function with better styling
function showModal(data) {
    const modal = document.getElementById('scanModal');
    const content = document.getElementById('modalContent');
    const confirmBtn = document.getElementById('confirmBtn');
    
    content.innerHTML = '';
    
    if (data.error) {
        content.innerHTML = `
            <div class="text-red-600 text-center">
                ${data.error}
            </div>
        `;
        confirmBtn.style.display = 'none';
    } else {
        // Store the registration ID as a data attribute
        content.setAttribute('data-reg-id', data.reg_id);
        
        content.innerHTML = `
            <div class="space-y-3">
                <div class="border-b pb-2">
                    <p><span class="font-semibold">Registration ID:</span> ${data.reg_id}</p>
                </div>
                <div class="border-b pb-2">
                    <p><span class="font-semibold">Event:</span> ${data.title}</p>
                </div>
                <div class="border-b pb-2">
                    <p><span class="font-semibold">Student:</span> ${data.fullname}</p>
                    <p><span class="font-semibold">Student Number:</span> ${data.studentNum}</p>
                </div>
                <div class="border-b pb-2">
                    <p><span class="font-semibold">Program:</span> ${data.program} ${data.yearlvl}-${data.section}</p>
                </div>
                <div class="border-b pb-2">
                    <p><span class="font-semibold">Payment Mode:</span> ${data.payment_mode}</p>
                    <p><span class="font-semibold">Status:</span> 
                        <span class="${data.payment_status === 'Paid' ? 'text-green-600' : 'text-yellow-600'} font-medium">
                            ${data.payment_status}
                        </span>
                    </p>
                </div>
            </div>
        `;
        
        // Only show confirm button if payment is still pending
        confirmBtn.style.display = data.payment_status === 'Pending' ? 'block' : 'none';
    }
    
    modal.classList.remove('hidden');
}
</script>
                
</body>

</html>