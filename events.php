<?php
require('conn.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>G! Arat Na - Events</title>
    <link rel="icon" type="image/x-icon" href="images/G!.png" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-50">
    <!-- Gradient Background -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="blob w-full h-full rounded-[999px] absolute top-0 right-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200"></div>
        <div class="blob w-[1000px] h-[1000px] rounded-[999px] absolute bottom-0 left-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-red-200 via-gray-100 to-blue-100"></div>
        <div class="blob w-[600px] h-[600px] rounded-[999px] absolute bottom-0 left-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-slate-100 via-teal-100 to-blue-100"></div>
        <div class="blob w-[300px] h-[300px] rounded-[999px] absolute bottom-[10px] left-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-green-200 via-cyan-200 to-fuchsia-300"></div>
    </div>

    <!-- Header with sticky navigation -->
    <header class="fixed top-0 w-full bg-white/80 backdrop-blur-md shadow-sm z-50">
       <!-- Gradient Background -->
   <div class="blob w-full h-full rounded-[999px] absolute top-0 right-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200"></div>
  <div class="blob w-[1000px] h-[1000px] rounded-[999px] absolute bottom-0 left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-red-200 via-gray-100 to-blue-100"></div>
  <div class="blob w-[600px] h-[600px] rounded-[999px] absolute bottom-0 left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-slate-100 via-teal-100 to-blue-100"></div>
  <div class="blob w-[300px] h-[300px] rounded-[999px] absolute bottom-[10px] left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-green-200 via-cyan-200 to-Fuchsia-300"></div>
  <!-- End of Gradient Background -->
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="index.php" class="flex items-center space-x-4">
                    <img src="images/G!.png" class="w-10 h-auto" alt="G! Arat Na" />
                    <span class="font-semibold text-xl">G! Arat Na</span>
                </a>
                
                <!-- Mobile menu button -->
                <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-bars text-gray-600 text-xl"></i>
                </button>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="text-gray-800 hover:text-blue-600 font-medium transition-colors">Home</a>
                    <a href="events.php" class="text-gray-800 hover:text-blue-600 font-bold transition-colors">Events</a>
                    <a href="userAbout.php" class="text-gray-800 hover:text-blue-600 font-medium transition-colors">About</a>
                    <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                        echo '<a href="logout.php" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">Logout</a>';
                    } else {
                        echo '<a href="login.php" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">Login</a>';
                    }
                    ?>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4">
                <div class="flex flex-col space-y-4">
                    <a href="index.php" class="text-gray-800 hover:text-blue-600 font-medium transition-colors">Home</a>
                    <a href="events.php" class="text-gray-800 hover:text-blue-600 font-medium transition-colors">Events</a>
                    <a href="events.php" class="text-gray-800 hover:text-blue-600 font-medium transition-colors">About</a>
                    <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                        echo '<a href="logout.php" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors text-center">Logout</a>';
                    } else {
                        echo '<a href="login.php" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-center">Login</a>';
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 pt-32 pb-16">
        <div class="max-w-7xl mx-auto">
            <!-- Page Title -->
            <div class="mb-12">
                <h1 class="text-5xl font-bold text-orange-950 mb-4">Upcoming Events</h1>
                <p class="text-gray-600 text-xl">Discover and register for exciting events happening at our campus</p>
            </div>

            <!-- Events Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                $sql = "SELECT * FROM events";
                $query = mysqli_query($conn, $sql);
                if ($query->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo '
                        <div class="group relative bg-white/60 backdrop-blur-md rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="absolute inset-0 bg-gradient-to-br from-transparent via-transparent to-orange-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <div class="relative p-6">
                                <div class="flex items-center space-x-3 mb-4">
                                    <div class="w-1 h-6 bg-blue-600 rounded-full"></div>
                                    <h2 class="text-2xl font-semibold text-gray-900 group-hover:text-orange-900 transition-colors">
                                        '.$row['title'].'
                                    </h2>
                                </div>
                                
                                <p class="text-gray-600 mb-6 line-clamp-3">
                                    '.$row['description'].'
                                </p>
                                
                                <div class="flex justify-between items-center">
                                
                                    <a href="regform.php?event_id='.$row['event-id'].'" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">
                                        <span>Register Now</span>
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>';
                    }
                }
                ?>
            </div>
        </div>
    </main>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>