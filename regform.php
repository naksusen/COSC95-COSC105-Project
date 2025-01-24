<?php
require 'conn.php';
session_start();

// Check if event_id is provided in URL
if (!isset($_GET['event_id'])) {
    header("Location: events.php");
    exit();
}

$event_id = $_GET['event_id'];

// Fetch event details
$event_query = "SELECT * FROM events WHERE `event-id` = '$event_id'";
$event_result = mysqli_query($conn, $event_query);
$event = mysqli_fetch_assoc($event_result);

if (!$event) {
    header("Location: events.php");
    exit();
}

// Handle form submission
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    if (isset($_POST["submit"])) {
        $program = $_POST['program'];
        $year = $_POST['year'];
        $sec = $_POST['sec'];
        $payment = $_POST['payment'];
        $note = $_POST['note'];

        $email = $_SESSION['email'];
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $userid = $row['user-id'];

        $query = "INSERT INTO registrations (`user_id`, `event_id`, `program`, `yearlvl`, `section`, `payment_mode`, `addtl_data`) 
                 VALUES ($userid, '$event_id', '$program', '$year', '$sec', '$payment', '$note')";

        if (mysqli_query($conn, $query)) {
            echo "<script>
                    alert('Registration submitted successfully! Your request is subject to assessment.');
                    window.location.href = 'qrgenerator.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error submitting registration. Please try again.');
                  </script>";
        }
    }
} else {
    echo "<script>
            alert('Please login first before registering for an event.');
            window.location.href = 'login.php';
          </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $event['title']; ?> - Registration</title>
    <link rel="icon" type="image/x-icon" href="images/G!.png" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gray-50">
    <!-- Gradient Background -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="blob w-full h-full rounded-[999px] absolute top-0 right-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200"></div>
        <div class="blob w-[1000px] h-[1000px] rounded-[999px] absolute bottom-0 left-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-red-200 via-gray-100 to-blue-100"></div>
        <div class="blob w-[600px] h-[600px] rounded-[999px] absolute bottom-0 left-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-slate-100 via-teal-100 to-blue-100"></div>
        <div class="blob w-[300px] h-[300px] rounded-[999px] absolute bottom-[10px] left-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-green-200 via-cyan-200 to-fuchsia-300"></div>
    </div>

    <!-- Header -->
    <header class="fixed top-0 w-full bg-white/80 backdrop-blur-md shadow-sm z-50">
         <!-- Gradient Background -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="blob w-full h-full rounded-[999px] absolute top-0 right-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200"></div>
        <div class="blob w-[1000px] h-[1000px] rounded-[999px] absolute bottom-0 left-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-red-200 via-gray-100 to-blue-100"></div>
        <div class="blob w-[600px] h-[600px] rounded-[999px] absolute bottom-0 left-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-slate-100 via-teal-100 to-blue-100"></div>
        <div class="blob w-[300px] h-[300px] rounded-[999px] absolute bottom-[10px] left-0 blur-3xl bg-opacity-60 bg-gradient-to-r from-green-200 via-cyan-200 to-fuchsia-300"></div>
    </div>
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="index.php" class="flex items-center space-x-4">
                    <img src="images/G!.png" class="w-10 h-auto" alt="G! Arat Na" />
                    <span class="font-semibold text-xl">G! Arat Na</span>
                </a>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="text-gray-800 hover:text-blue-600 font-medium transition-colors">Home</a>
                    <a href="events.php" class="text-gray-800 hover:text-blue-600 font-bold transition-colors">Events</a>
                    <a href="userAbout.php" class="text-gray-800 hover:text-blue-600 font-medium transition-colors">About</a>
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true): ?>
                        <a href="logout.php" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">Logout</a>
                    <?php else: ?>
                        <a href="login.php" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 pt-32 pb-16">
        <div class="max-w-7xl mx-auto">
            <!-- Event Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 mb-12">
                <div class="space-y-6">
                    <h1 class="text-5xl font-bold text-orange-950"><?php echo $event['title']; ?></h1>
                    <div class="prose max-w-none">
                        <?php echo nl2br($event['addtl_info']); ?>
                    </div>
                    <div class="bg-white/80 backdrop-blur-md rounded-xl p-6 space-y-4">
                        <h3 class="text-xl font-semibold">Event Details</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2">
                                <span class="font-medium">Date:</span>
                                <?php echo date("F j, Y", strtotime($event['date'])); ?>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="font-medium">Time:</span>
                                <?php echo date("g:i A", strtotime($event['time'])); ?>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="font-medium">Venue:</span>
                                <?php echo $event['location']; ?>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="font-medium">Fee:</span>
                                <?php echo $event['price'] == 0.00 ? 'Free' : '₱ ' . number_format($event['price'], 2); ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php if (isset($event['image'])): 
                    $imagePath = 'uploads/' . ($event['image'] ? $event['image'] : 'default-event.jpg');
                    ?>
                <div class="aspect-square rounded-2xl overflow-hidden">
                    <img src="<?= htmlspecialchars($imagePath)?>" alt="<?php echo $event['title']; ?>" class="w-full h-full object-cover">
                </div>
                <?php endif; ?>
            </div>

            <!-- Registration Form -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-8 shadow-lg">
                <h2 class="text-3xl font-bold mb-8">Registration Form</h2>
                <form method="post" autocomplete="off" class="space-y-8">
                    <!-- User Details (Auto-filled) -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" value="<?php
                      if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                        $email = $_SESSION['email'];
                        $sql = "Select * from users where email='$email'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        echo $row['fullname'];
                      }
                      ?>" disabled
                                   class="w-full px-4 py-2 rounded-lg bg-gray-100 border border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Student Number</label>
                            <input type="text" value="<?php echo $row['studentNum']; ?>" disabled
                                   class="w-full px-4 py-2 rounded-lg bg-gray-100 border border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" value="<?php echo $row['email']; ?>" disabled
                                   class="w-full px-4 py-2 rounded-lg bg-gray-100 border border-gray-300">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div>
        <label for="program" class="block text-sm font-medium text-gray-700 mb-2">Program</label>
        <select name="program" id="program" required
                class="w-full px-4 py-2 pr-8 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 appearance-none bg-white bg-no-repeat bg-[right_0.5rem_center] bg-[length:1.5em_1.5em] bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2020%2020%22%3E%3Cpath%20d%3D%22M5.293%207.293a1%201%200%20011.414%200L10%2010.586l3.293-3.293a1%201%200%20111.414%201.414l-4%204a1%201%200%2001-1.414%200l-4-4a1%201%200%20010-1.414z%22%20fill%3D%22%236b7280%22%2F%3E%3C%2Fsvg%3E')]">
            <option value="">Select program</option>
            <option value="BS Business Administration">BS Business Administration</option>
            <option value="BS Computer Science">BS Computer Science</option>
            <option value="BS Criminology">BS Criminology</option>
            <option value="BS Hospitality Management">BS Hospitality Management</option>
            <option value="BS Information Technology">BS Information Technology</option>
            <option value="BS Psychology">BS Psychology</option>
            <option value="B Secondary Education">B Secondary Education</option>
        </select>
    </div>
    <div>
        <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Year Level</label>
        <select name="year" id="year" required
                class="w-full px-4 py-2 pr-8 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 appearance-none bg-white bg-no-repeat bg-[right_0.5rem_center] bg-[length:1.5em_1.5em] bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2020%2020%22%3E%3Cpath%20d%3D%22M5.293%207.293a1%201%200%20011.414%200L10%2010.586l3.293-3.293a1%201%200%20111.414%201.414l-4%204a1%201%200%2001-1.414%200l-4-4a1%201%200%20010-1.414z%22%20fill%3D%22%236b7280%22%2F%3E%3C%2Fsvg%3E')]">
            <option value="">Select year level</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>
    </div>
    <div>
        <label for="sec" class="block text-sm font-medium text-gray-700 mb-2">Section</label>
        <select name="sec" id="sec" required
                class="w-full px-4 py-2 pr-8 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 appearance-none bg-white bg-no-repeat bg-[right_0.5rem_center] bg-[length:1.5em_1.5em] bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2020%2020%22%3E%3Cpath%20d%3D%22M5.293%207.293a1%201%200%20011.414%200L10%2010.586l3.293-3.293a1%201%200%20111.414%201.414l-4%204a1%201%200%2001-1.414%200l-4-4a1%201%200%20010-1.414z%22%20fill%3D%22%236b7280%22%2F%3E%3C%2Fsvg%3E')]">
            <option value="">Select section</option>
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div>
        <label for="payment" class="block text-sm font-medium text-gray-700 mb-2">Payment Mode</label>
        <select name="payment" id="payment" required
                class="w-full px-4 py-2 pr-8 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 appearance-none bg-white bg-no-repeat bg-[right_0.5rem_center] bg-[length:1.5em_1.5em] bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2020%2020%22%3E%3Cpath%20d%3D%22M5.293%207.293a1%201%200%20011.414%200L10%2010.586l3.293-3.293a1%201%200%20111.414%201.414l-4%204a1%201%200%2001-1.414%200l-4-4a1%201%200%20010-1.414z%22%20fill%3D%22%236b7280%22%2F%3E%3C%2Fsvg%3E')]">
            <option value="">Select payment mode</option>
            <option value="Cash">Cash</option>
            <option value="Online">Online</option>
        </select>
    </div>
    <div class="md:col-span-2">
        <label for="note" class="block text-sm font-medium text-gray-700 mb-2">Additional Notes</label>
        <input type="text" name="note" id="note"
               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500"
               placeholder="Any additional information...">
    </div>
</div>

                    <div class="flex justify-center">
                        <button type="submit" name="submit"
                                class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors
                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Submit Registration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>