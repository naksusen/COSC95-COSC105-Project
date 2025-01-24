<?php
session_start();
include_once("conn.php");

roleConfirm($_SESSION['logged_in'], $_SESSION['email']);
// Add this at the top of the file, near other database queries
$userSql = "SELECT users.`user-id`, users.fullname, users.email, users.studentNum
            FROM users 
            WHERE role='User'";
$userQuery = mysqli_query($conn, $userSql);
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
                    <a href="adminEvents.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:text-slate-50 hover:bg-gradient-to-l from-red-100 to-sky-700 group">
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
            Users
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

<!-- Add this section in your HTML, replacing the existing table or adding a new section -->
<section class="shadow-lg bg-sky-900 bg-opacity-10 flex flex-col mt-10 mb-20 rounded-3xl max-md:max-w-full">
    <div class="flex flex-col items-center">
        <h2 class="text-2xl font-bold text-sky-900 my-6">User List</h2>
        <section class="bg-sky-900 bg-opacity-10 flex w-full max-w-full flex-col pb-8 rounded-3xl">
            <div class="self-center flex w-[100%] max-w-full max-md:flex-wrap justify-evenly mb-5">
                <table>
                    <tr>
                        <th class="text-[#10182c] font-semibold leading-6">User ID</th>
                        <th class="text-[#10182c] font-semibold leading-6">Full Name</th>
                        <th class="text-[#10182c] font-semibold leading-6">Email</th>
                        <th class="text-[#10182c] font-semibold leading-6">Student Number</th>
                        <!-- <th class="text-[#10182c] font-semibold leading-6">Program</th>
                        <th class="text-[#10182c] font-semibold leading-6">Year Level</th> -->
                    </tr>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($userQuery)) { ?>
                            <tr>
                                <td><?php echo $row["user-id"]; ?></td>
                                <td><?php echo $row["fullname"]; ?></td>
                                <td><?php echo $row["email"]; ?></td>
                                <td><?php echo $row["studentNum"]; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</section>
<script src="table.js"></script>
                <script>
                  $(document).ready(function() {
    $('#getName').on("keyup", function() {
        var getName = $(this).val();
        $.ajax({
            method: 'POST',
            url: 'search_users.php', // Create this new PHP file
            data: {
                name: getName
            },
            success: function(response) {
                $("table").html(response);
            }
        });
    });
});
                </script>