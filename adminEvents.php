<?php
session_start();
include("conn.php");

// Handle removal request
if (isset($_GET['remove_event_id'])) {
    $event_id = $_GET['remove_event_id'];

    // Delete the event from the database
    $sql = "DELETE FROM events WHERE `event-id` = '$event_id'";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: adminEvents.php?success=Event removed successfully");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Fetch all events from database
$sql = "SELECT * FROM events ORDER BY date DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@themesberg/flowbite@latest/dist/flowbite.bundle.js"></script>
    <title>Events</title>
    <link rel="stylesheet" href="gen.css">
    <link rel="icon" type="image/x-icon" href="images/G!.png" />
</head>
<body>
    <!-- Gradient Background -->
    <div class="blob w-full h-full rounded-[999px] absolute top-0 right-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200"></div>
    <div class="blob w-[1000px] h-[1000px] rounded-[999px] absolute bottom-0 left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-red-200 via-gray-100 to-blue-100"></div>

    <!-- Sidebar -->
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <a href="adminDashboard.php" class="flex items-center py-6 ps-8 mb-5">
                <img src="images/G!.png" class="h-6 me-3 sm:h-7" alt="Flowbite Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">G! Arat Na</span>
            </a>
            <ul class="space-y-2 font-medium">
                <li><a href="adminDashboard.php" class="flex items-center p-2 text-gray-900 rounded-lg text-white hover:text-slate-50 hover:bg-sky-900 group"><img src="images/bxs-home-alt-2.svg" alt="" /><span class="ms-3">Dashboard</span></a></li>
                <li><a href="adminEvents.php" class="flex items-center p-2 text-gray-900 rounded-lg bg-gradient-to-l from-red-100 to-sky-700 text-white hover:text-slate-50 hover:bg-gradient-to-l from-red-100 to-sky-700"><img src="images/bxs-file.svg" alt="" /><span class="flex-1 ms-3 whitespace-nowrap">Events</span><span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-red-100">
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
                <li><a href="addevent.php" class="flex items-center p-2 text-gray-900 rounded-lg text-white hover:text-slate-50 hover:bg-gradient-to-l from-red-100 to-sky-700 group"><img src="images/bx-calendar-plus.svg" alt="" /><span class="ms-3">Add Event</span></a></li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="py-8 px-10 sm:ml-64">
        <!-- Header -->
        <div class="flex w-full items-center justify-between pb-8 gap-5 max-md:max-w-full max-md:flex-wrap">
            <h1 class="text-[#10182c] text-6xl font-bold my-auto">Events</h1>

            <!-- Admin Dropdown -->
            <div class="max-w-lg">
                <button class="text-[#424242] bg-transparent hover:bg-transparent focus:ring-transparent font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center" type="button" data-dropdown-toggle="dropdown">Account</button>
                <div class="hidden bg-white text-base z-50 list-none divide-y divide-gray-100 rounded shadow my-4" id="dropdown">
                    <div class="px-4 py-3">
                        <?php
                        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                            $email = $_SESSION['email'];
                            $sql2 = "SELECT * FROM users WHERE email='$email'";
                            $result2 = mysqli_query($conn, $sql2);
                            $row = mysqli_fetch_assoc($result2);
                            echo '<p>' . $row['fullname'] . '</p>';
                        }
                        ?>
                    </div>
                    <ul class="py-1" aria-labelledby="dropdown">
                        <li><a href="login.php" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Sign out</a></li>
                    </ul>
                </div>
            </div>
            <!-- End of Admin Dropdown -->
        </div>

        <!-- Events List -->
        <ul class="space-y-6">
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <li class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 p-6 flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div class="mb-4 md:mb-0 md:w-2/3">
                        <h3 class="text-xl font-semibold text-sky-900"><?php echo $row['title']; ?></h3>
                        <p class="text-gray-600"><?php echo substr($row['description'], 0, 150) . '...'; ?></p>
                    </div>
                    <div class="flex flex-wrap gap-1 md:gap-2 w-full md:w-auto">
                        <a href="#" onclick='editEvent(<?php echo $row["event-id"]; ?>)' class='bg-yellow-500 text-white px-[10px] py-[8px] rounded'>Edit</a>
                        <a href="#" onclick='removeEvent(<?php echo $row["event-id"]; ?>)' class='bg-red-500 text-white px-[10px] py-[8px] rounded'>Remove</a>
                        <a href='pendingPayment.php?event_id=<?php echo $row["event-id"]; ?>' 
                           class='bg-sky-900 text-white px-[10px] py-[8px] rounded'>View Registrations</a>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-xl shadow-2xl p-8 w-96 transform transition-all duration-300 scale-100">
          <h2 class="text-2xl font-bold mb-4 text-sky-900">Confirm Deletion</h2>
          <p class="text-gray-600 mb-6">Are you sure you want to remove this event? This action cannot be undone.</p>
          <div class="flex justify-end space-x-3">
              <button id="cancelButton" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold px-5 py-2 rounded-lg transition duration-200">
            Cancel
              </button>
              <button id="removeButton" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-5 py-2 rounded-lg transition duration-200">
            Remove
              </button>
          </div>
            </div>
        </div>

       <!-- JavaScript for Edit and Remove functionalities -->
<script>
let currentEventId;

function editEvent(eventId) {
window.location.href = 'editEvent.php?event_id=' + eventId;
}

function removeEvent(eventId) {
currentEventId = eventId; // Store the current event ID
document.getElementById('confirmationModal').classList.remove('hidden'); // Show the modal
}

document.getElementById('cancelButton').onclick = function() {
document.getElementById('confirmationModal').classList.add('hidden'); // Hide the modal
};

document.getElementById('removeButton').onclick = function() {
if (currentEventId) {
window.location.href = 'adminEvents.php?remove_event_id=' + currentEventId; // Redirect to remove script
}
};
</script>

    </div>
</body>
</html>
