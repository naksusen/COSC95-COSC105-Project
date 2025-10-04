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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <title>Users</title>
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

        .dropdown-content a {
            color: rgb(67 20 7);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

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
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform duration-300 ease-in-out -translate-x-full" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200 dark:bg-gray-800">
            <!-- Exit Button -->
            <div class="flex justify-end mb-2">
                <button id="sidebar-close" class="p-2 rounded-lg hover:bg-gray-200 transition-colors">
                    <i class="fas fa-times text-gray-600 text-lg"></i>
                </button>
            </div>
            
            <a href="adminDashboard.php" class="flex items-center py-6 ps-8 mb-5">
                <img src="images/G!.png" class="h-6 me-3 sm:h-7" alt="Flowbite Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">G! Arat Na</span>
            </a>
            <!-- Divider line -->
            <div class="border-b border-gray-300 mb-4"></div>
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="adminDashboard.php" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-white hover:bg-gradient-to-l from-red-100 to-sky-700 group">
                        <img src="images/bxs-home-alt-2.svg" alt="" />
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="adminEvents.php" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-white hover:bg-gradient-to-l from-red-100 to-sky-700 group">
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
                    <a href="addevent.php" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-white hover:bg-gradient-to-l from-red-100 to-sky-700 group">
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
            <h4 class="text-gray-900 text-md font-medium mb-4">
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
     <div class="py-8 px-10 transition-all duration-300 ease-in-out" id="main-content">
        <!-- Header -->
        <div class="flex w-full items-center justify-between pb-8 gap-5 max-md:max-w-full max-md:flex-wrap">
            <div class="flex items-center gap-4">
                <!-- Sidebar Toggle Button -->
                <button id="sidebar-toggle" class="p-2 rounded-lg hover:bg-gray-100 transition-colors hidden">
                    <i class="fas fa-bars text-gray-600 text-xl"></i>
                </button>
                <h1 class="text-[#10182c] text-6xl font-bold my-auto">
                Users
                </h1>
            </div>


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
                            <a href="login.php" class="text-sm hover:bg-gradient-to-l from-red-100 to-sky-700 hover:text-white text-gray-700 block px-4 py-2 transition-colors">Sign out</a>
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

<!-- Copyright Footer -->
<footer class="backdrop-blur-md py-4 text-center mt-16">
    <p class="text-gray-800 text-sm">
        &copy; 2025 G! Arat Na. All Rights Reserved.
    </p>
</footer>

<script src="table.js"></script>
<script>
  $(document).ready(function() {
    $('#getName').on("keyup", function() {
        var getName = $(this).val();
        $.ajax({
            method: 'POST',
            url: 'search_users.php', 
            data: {
                name: getName
            },
            success: function(response) {
                $("table").html(response);
            }
        });
    });
});

// QR Scanner functionality
let scanner = null;
let isScanning = false;

function toggleCamera() {
    const cameraIntro = document.getElementById('cameraIntro');
    const cameraPreview = document.getElementById('cameraPreview');
    const preview = document.getElementById('preview');
    
    if (!isScanning) {
        // Start camera
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner = new Instascan.Scanner({ 
                    video: preview,
                    scanPeriod: 5,
                    mirror: false 
                });
                
                scanner.addListener('scan', function (content) {
                    console.log('QR Code scanned:', content);
                    // Handle the scanned QR code content
                    handleQRScan(content);
                });
                
                scanner.start(cameras[0]).then(function () {
                    isScanning = true;
                    cameraIntro.classList.add('hidden');
                    cameraPreview.classList.remove('hidden');
                }).catch(function (e) {
                    console.error('Error starting camera:', e);
                    alert('Error starting camera. Please check permissions.');
                });
            } else {
                alert('No cameras found.');
            }
        }).catch(function (e) {
            console.error('Error accessing cameras:', e);
            alert('Error accessing cameras. Please check permissions.');
        });
    } else {
        // Stop camera
        if (scanner) {
            scanner.stop();
            scanner = null;
        }
        isScanning = false;
        cameraIntro.classList.remove('hidden');
        cameraPreview.classList.add('hidden');
    }
}

function handleQRScan(content) {
    // Parse the QR code content (assuming it contains registration ID)
    const registrationId = content.trim();
    
    if (registrationId) {
        // Search for the user with this registration ID
        $.ajax({
            method: 'POST',
            url: 'search_users.php', 
            data: {
                registration_id: registrationId
            },
            success: function(response) {
                if (response.trim() !== '') {
                    $("table").html(response);
                    // Show success message
                    alert('Registration found!');
                } else {
                    alert('No registration found with ID: ' + registrationId);
                }
            },
            error: function() {
                alert('Error searching for registration.');
            }
        });
    }
}
</script>

<!-- Sidebar Toggle JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('logo-sidebar');
        const mainContent = document.getElementById('main-content');
        const toggleButton = document.getElementById('sidebar-toggle');
        const closeButton = document.getElementById('sidebar-close');
        
        // Check if sidebar is collapsed from localStorage, default to closed
        const isCollapsed = localStorage.getItem('sidebar-collapsed') !== 'false';
        
        if (isCollapsed) {
            // Sidebar is closed
            sidebar.classList.add('-translate-x-full');
            mainContent.classList.remove('ml-64');
            toggleButton.classList.remove('hidden');
        } else {
            // Sidebar is open
            sidebar.classList.remove('-translate-x-full');
            mainContent.classList.add('ml-64');
            toggleButton.classList.add('hidden');
        }
        
        // Function to close sidebar
        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            mainContent.classList.remove('ml-64');
            toggleButton.classList.remove('hidden');
            localStorage.setItem('sidebar-collapsed', 'true');
        }
        
        // Function to open sidebar
        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            mainContent.classList.add('ml-64');
            toggleButton.classList.add('hidden');
            localStorage.setItem('sidebar-collapsed', 'false');
        }
        
        // Toggle button click handler
        toggleButton.addEventListener('click', function() {
            const isCurrentlyCollapsed = sidebar.classList.contains('-translate-x-full');
            
            if (isCurrentlyCollapsed) {
                openSidebar();
            } else {
                closeSidebar();
            }
        });
        
        // Close button click handler
        closeButton.addEventListener('click', function() {
            closeSidebar();
        });
    });
</script>
</div>
</body>
</html>