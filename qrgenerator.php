
<?php
session_start();
include("conn.php");

// Fetch latest registration details
$sql = "SELECT r.*, e.*, u.* 
        FROM registrations r
        JOIN events e ON r.event_id = e.`event-id`
        JOIN users u ON r.user_id = u.`user-id`
        ORDER BY r.reg_id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$registration = mysqli_fetch_assoc($result);

if (!$registration) {
    header("Location: events.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $registration['title']; ?> - Registration Complete</title>
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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                <!-- Left Column - Registration Details -->
                <div class="space-y-8">
                    <div class="space-y-4">
                        <h1 class="text-5xl font-bold text-orange-950">Registration Successful!</h1>
                        <p class="text-lg text-gray-700">
                            You're all set! You've successfully registered for
                            <span class="font-bold"><?php echo $registration['title']; ?></span>.
                            Below is the summary of your registration.
                        </p>
                    </div>

                    <div class="bg-white/80 backdrop-blur-md rounded-xl p-6 space-y-6">
                        <h2 class="text-2xl font-semibold">Event Details</h2>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3">
                                <span class="font-medium">Event:</span>
                                <?php echo $registration['title']; ?>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="font-medium">Date:</span>
                                <?php echo date("F j, Y", strtotime($registration['date'])); ?>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="font-medium">Time:</span>
                                <?php echo date("g:i A", strtotime($registration['time'])); ?>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="font-medium">Venue:</span>
                                <?php echo $registration['location']; ?>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="font-medium">Fee:</span>
                                <?php echo $registration['price'] == 0.00 ? 'Free' : '₱' . number_format($registration['price'], 2); ?>
                            </li>
                        </ul>

                        <h2 class="text-2xl font-semibold pt-4">Registrant Details</h2>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3">
                                <span class="font-medium">Name:</span>
                                <?php echo $registration['fullname']; ?>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="font-medium">Student Number:</span>
                                <?php echo $registration['studentNum']; ?>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="font-medium">Program:</span>
                                <?php echo $registration['program']; ?>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="font-medium">Year & Section:</span>
                                <?php echo $registration['yearlvl'] . ' - ' . $registration['section']; ?>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="font-medium">Payment Mode:</span>
                                <?php echo $registration['payment_mode']; ?>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Right Column - QR Code -->
                <div class="space-y-8">
                    <div class="bg-white/80 backdrop-blur-md rounded-xl p-8 text-center space-y-6">
                        <h2 class="text-2xl font-semibold">Registration QR Code</h2>
                        <p class="text-gray-700">
                            Your <span class="font-bold">Registration ID</span> is encoded in this QR Code.
                            Please keep this confidential and present it during the event.
                        </p>

                        <div class="space-y-4">
                            <div class="flex items-center justify-center gap-4">
                                <input type="text" 
                                       value="<?php echo $registration['reg_id']; ?>" 
                                       id="qrText"
                                       class="px-4 py-2 rounded-lg border border-gray-300 text-center font-mono"
                                       readonly>
                                <button onclick="generateQR()" 
                                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    Generate QR
                                </button>
                            </div>

                            <div id="qrImageContainer" class="hidden">
                                <img src="" 
                                     id="qrImage"
                                     class="mx-auto rounded-lg border border-gray-300 p-4"
                                     alt="QR Code">
                                
                                <button onclick="downloadQR()"
                                        class="mt-4 px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                    Download QR
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function generateQR() {
            const qrText = document.getElementById("qrText");
            const qrImage = document.getElementById("qrImage");
            
            if (qrText.value.length > 0) {
                const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrText.value}`;
                fetch(qrUrl)
                    .then(response => response.blob())
                    .then(blob => {
                        qrImage.src = URL.createObjectURL(blob);
                        document.getElementById("qrImageContainer").classList.remove("hidden");
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

        function downloadQR() {
            const qrText = document.getElementById("qrText");
            const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrText.value}`;
            
            fetch(qrUrl)
                .then(response => response.blob())
                .then(blob => {
                    const link = document.createElement("a");
                    link.href = URL.createObjectURL(blob);
                    link.download = `Registration-${qrText.value}.png`;
                    link.click();
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>