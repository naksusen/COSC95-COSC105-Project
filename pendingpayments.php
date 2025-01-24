<?php
session_start();
include("conn.php");
include("searchajax2.php");
//$columns = array('program');

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
//$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
/*$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

if (isset($_GET['progvalue'])) {
  $program = $_GET['progvalue'];
}

if (isset($_GET['yrsec'])) {
  $yrsec = $_GET['yrsec'];
}

roleConfirm($_SESSION['logged_in'], $_SESSION['email']);
*/
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

// Fetch data with LIMIT clause
$sql = "SELECT registrations.reg_id, registrations.user_id, registrations.event_id, registrations.program, registrations.yearlvl, registrations.section, registrations.payment_mode, registrations.payment_status, registrations.addtl_data, events.title, events.price, users.fullname, users.studentNum FROM registrations JOIN events ON registrations.event_id = events.`event-id` JOIN users ON registrations.user_id = users.`user-id` WHERE registrations.payment_status = 'Pending' LIMIT $limitStart, $rowsPerPage";
$query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@themesberg/flowbite@latest/dist/flowbite.bundle.js"></script>
    <title>Pending Payment</title>
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
                    <a href="pendingpayment.php" class="flex items-center p-2 text-gray-900 rounded-lg text-white hover:text-slate-50 hover:bg-gradient-to-l from-red-100 to-sky-700">
                        <img src="images/bxs-file.svg" alt="" />
                        <span class="flex-1 ms-3 whitespace-nowrap">Pending Payment</span>
                        <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-red-100">
                            <?php
                            $sql1 = "Select * from registrations where payment_status='Pending'";
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
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg text-white hover:text-slate-50 hover:bg-gradient-to-l from-red-100 to-sky-700 group">
                        <img src="images/bx-calendar-plus.svg" alt="" />
                        <span class="ms-3">Add Event</span>
                    </a>
                </li>
            </ul>

            <div class= "outer-container">
    <div class="container pt-10">
    <h1
                    class="text-orange-950 justify-center text-center text-md font-medium self-center whitespace-nowrap my-auto"
                  >
                    Scan Here
                  </h1>   
            <div class="row">
            
                <div class="col-md-5 pt-2">
                    <video id="preview"  style="  border-radius: 10px; width: 180px; height: 180px; padding: top 20px; object-fit: cover;"></video>
                </div>
                
            </div>
        </div>
    </div>
    <script>
            let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
            Instascan.Camera.getCameras().then(function(cameras){
                if (cameras.length > 0){
                    scanner.start(cameras[0]);
                } else {
                    alert('No cameras found');
                }
            }).catch(function(e){
                console.error(e);
            });

            scanner.addListener('scan',function(c){
                document.getElementById('getName').value=c;
                document.getElementById('getName').trigger('input');
            });
            
            
            video.style.objectFit = 'cover';
  </script>

        </div>

    </aside>
    <!-- End of Sidebar -->


    <!-- Content div -->
    <div class="py-8 px-10 sm:ml-64">
        <!-- Header -->
        <div class="flex w-full items-center justify-between pb-8 gap-5 max-md:max-w-full max-md:flex-wrap">
            <h1 class="text-[#10182c] text-6xl font-bold my-auto">
                Pending Payment
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
            <button class="flex justify-end">
                <a href="requests.php" class="bg-sky-900 text-slate-50 text-sm leading-5 font-medium rounded-full px-4 py-2 mr-2">Get Report</a>
            </button>
        </div>
        <!-- End of Search and Filter Section -->



        <!-- Table Section -->
        <section class="shadow-lg bg-sky-900 bg-opacity-10 flex flex-col mt-10 mb-20 rounded-3xl max-md:max-w-full max-md:mt-10">

            <div class="flex flex-col items-center ">
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
                            <!--SHOWDATA-->
                            <tbody id="showdata">
                                <?php
                                /*if (isset($_GET['order'])){
  $sql = "SELECT fullname, student_num, ctrl_num, yr_sec, program, reqtype from request ORDER BY reqtype $sort_order LIMIT $limitStart, $rowsPerPage";
}
else if (isset($_GET['progvalue'])){
  $sql = "SELECT fullname, student_num, ctrl_num, yr_sec, program, reqtype from request WHERE program = '$program' LIMIT $limitStart, $rowsPerPage";
}
else if (isset($_GET['yrsec'])){
  $sql = "SELECT fullname, student_num, ctrl_num, yr_sec, program, reqtype from request WHERE yr_sec = '$yrsec' LIMIT $limitStart, $rowsPerPage";
}
else if (isset($_GET['order']) && isset($_GET['progvalue'])) {
  $sql = "SELECT fullname, student_num, ctrl_num, yr_sec, program, reqtype from request WHERE program = '$program' ORDER BY reqtype $sort_order LIMIT $limitStart, $rowsPerPage";
}
else {
  $sql = "SELECT fullname, student_num, ctrl_num, yr_sec, program, reqtype from request LIMIT $limitStart, $rowsPerPage";
}

//$sql = "SELECT fullname, student_num, ctrl_num, yr_sec, program, reqtype from request";
*/

                                $result = $conn->query($sql);
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $row["reg_id"]; ?></td>
                                        <td><?php echo $row["title"]; ?></td>
                                        <td><?php echo $row["studentNum"]; ?></td>
                                        <td><?php echo $row["fullname"]; ?></td>
                                        <td><?php echo $row["program"] . " " . $row["yearlvl"] . "-" . $row["section"]; ?></td>
                                        <td><?php echo $row["payment_mode"]; ?></td>
                                        <td><?php echo $row["payment_status"]; ?></td>
                                        <td>
                                            <form action="actionbutton.php" method="POST">
                                                <button name="Pending" value="<?= $row['reg_id']; ?>" class='bg-sky-900 text-slate-50 text-sm leading-5 font-medium rounded-full px-2 py-2 mr-2'>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill: #f8fafc;transform: msFilter">
                                                        <path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path>
                                                    </svg></button>

                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                    </div>
                    </table>
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

                <script src="table.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#getName').on("keyup", function() {
                            var getName = $(this).val();
                            $.ajax({
                                method: 'POST',
                                url: 'searchajax2.php',
                                data: {
                                    name: getName
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
</body>

</html>