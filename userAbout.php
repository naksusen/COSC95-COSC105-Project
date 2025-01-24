<?php
require('conn.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About - G! Arat Na</title>
    <link rel="icon" type="image/x-icon" href="images/G!.png" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen relative bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200">
    <!-- Gradient Background -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="blob w-full h-full rounded-[999px] absolute top-0 right-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200"></div>
        <div class="blob w-[1000px] h-[1000px] rounded-[999px] absolute bottom-0 left-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-red-200 via-gray-100 to-blue-100"></div>
        <div class="blob w-[600px] h-[600px] rounded-[999px] absolute bottom-0 left-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-slate-100 via-teal-100 to-blue-100"></div>
        <div class="blob w-[300px] h-[300px] rounded-[999px] absolute bottom-[10px] left-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-green-200 via-cyan-200 to-fuchsia-300"></div>
    </div>

    <!-- Navigation -->
    <header class="fixed top-0 w-full bg-white/80 backdrop-blur-md shadow-sm z-50">
      <!-- Gradient Background -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="blob w-full h-full rounded-[999px] absolute top-0 right-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200"></div>
        <div class="blob w-[1000px] h-[1000px] rounded-[999px] absolute bottom-0 left-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-red-200 via-gray-100 to-blue-100"></div>
        <div class="blob w-[600px] h-[600px] rounded-[999px] absolute bottom-0 left-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-slate-100 via-teal-100 to-blue-100"></div>
        <div class="blob w-[300px] h-[300px] rounded-[999px] absolute bottom-[10px] left-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-green-200 via-cyan-200 to-fuchsia-300"></div>
    </div>
        <nav class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <a href="index.php" class="flex items-center space-x-4">
                    <img src="images/G!.png" class="w-12 h-auto" alt="G! Arat Na" />
                    <span class="text-xl font-semibold">G! Arat Na</span>
                </a>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="text-gray-800 hover:text-blue-600 font-medium transition-colors">Home</a>
                    <a href="events.php" class="text-gray-800 hover:text-blue-600 font-medium transition-colors">Events</a>
                    <a href="userAbout.php" class="text-gray-800 hover:text-blue-600 font-bold transition-colors">About</a>
                    <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                        echo '<a href="logout.php" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">Logout</a>';
                    } else {
                        echo '<a href="login.php" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">Login</a>';
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-20 pt-32 pb-16">
        <!-- University Section -->
        <section class="mb-20">
            <h3 class="text-xl md:text-3xl lg:text-5xl font-bold text-orange-950 text-center mb-16">
                Cavite State University - Bacoor Campus
            </h3>
            
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="prose prose-lg">
                    <p class="text-orange-950 text-lg leading-relaxed indent-8">
                        Cavite State University - Bacoor Campus is dedicated to providing high-quality education across various disciplines. Located in the vibrant city of Bacoor, this campus offers a range of undergraduate and graduate programs designed to meet the educational needs of the local community. Equipped with modern facilities, the Bacoor Campus supports a conducive learning environment and fosters academic excellence, research, and community engagement. As a public institution, it emphasizes accessibility and affordability, making higher education attainable for a diverse student population.
                    </p>
                </div>
                <div class="rounded-2xl overflow-hidden shadow-xl">
                    <img src="images/Bacoor-Campus-scaled.jpg" alt="CvSU Bacoor Campus" class="w-full h-auto object-cover">
                </div>
            </div>
        </section>

        <!-- Mission & Vision -->
        <section class="grid md:grid-cols-2 gap-20 mb-20">
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-16 shadow-lg">
                <h2 class="text-4xl font-bold text-orange-950 text-center mb-6">Mission</h2>
                <p class="text-orange-950 text-lg leading-relaxed indent-8">
                    Cavite State University shall provide excellent, equitable and relevant educational opportunities in the arts, sciences and technology through quality instruction and responsive research and development activities. It shall produce professional, skilled and morally upright individuals for global competitiveness.
                </p>
            </div>
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-16 shadow-lg">
                <h2 class="text-4xl font-bold text-orange-950 text-center mb-6">Vision</h2>
                <p class="text-orange-950 text-lg leading-relaxed indent-8">
                    The premier university in historic Cavite globally recognized for excellence in character development, academics, research, innovation and sustainable community engagement.
                </p>
            </div>
        </section>

        <!-- G! Arat Na Section -->
        <section>
            <h2 class="text-5xl md:text-6xl lg:text-7xl font-bold text-orange-950 text-center mb-16">
                G! ARAT NA
            </h2>
            
            <div class="grid md:grid-cols-2 gap-12 mb-12">
                <div class="space-y-6">
                    <p class="text-orange-950 text-lg leading-relaxed indent-8">
                        Welcome to G! Arat Na, where efficiency meets accessibility in event management! Whether you're a student at Cavite State University - Bacoor Campus, we're excited to introduce you to our web-based event registration system tailored just for you. Say goodbye to manual methods and hello to a seamless event experience designed with students in mind.
                    </p>
                    <p class="text-orange-950 text-lg leading-relaxed indent-8">
                        Join us as we revolutionize the way events are organized and attended on campus. With our intuitive system, student organizers can effortlessly create, manage, and report on events with ease. You, as students, will enjoy the convenience of online registration forms and real-time updates on event availability, making attending events a breeze.
                    </p>
                </div>
                <div class="space-y-6">
                    <p class="text-orange-950 text-lg leading-relaxed indent-8">
                        Administrators, prepare to simplify your workflow and gain valuable insights into student participation. Our system offers reporting capabilities, ensuring you have the data you need to make informed decisions. Welcome to a new era of event management, where efficiency and accessibility reign supreme. Let's make every event at CvSU Bacoor Campus a memorable experience together.
                    </p>
                    <p class="text-orange-950 text-lg leading-relaxed indent-8">
                        At G! Arat Na, we're committed to continuous improvement and innovation. Your feedback is invaluable to us as we strive to enhance our system and provide an unparalleled event management experience for students. Together, let's shape the future of event organization at Cavite State University - Bacoor Campus.
                    </p>
                </div>
            </div>
            
            <div class="flex justify-center">
                <img src="images/arats.png" alt="G! Arat Na" class="max-w-full h-auto object-contain">
            </div>
        </section>
    </main>
</body>
</html>