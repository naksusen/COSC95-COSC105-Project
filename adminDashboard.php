<!-- @format -->
<?php
session_start();
include_once("conn.php");

roleConfirm($_SESSION['logged_in'], $_SESSION['email']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="icon" type="image/x-icon" href="images/G!.png" />
  <link href="/dist/output.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@themesberg/flowbite@latest/dist/flowbite.bundle.js"></script>
  <link rel="stylesheet" href="gen.css">
</head>

<body>
  <!-- Gradient Background -->
  <div class="blob w-full h-full rounded-[999px] absolute top-0 right-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200"></div>
  <div class="blob w-[1000px] h-[1000px] rounded-[999px] absolute bottom-0 left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-red-200 via-gray-100 to-blue-100"></div>
  <div class="blob w-[600px] h-[600px] rounded-[999px] absolute bottom-0 left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-slate-100 via-teal-100 to-blue-100"></div>
  <div class="blob w-[300px] h-[300px] rounded-[999px] absolute bottom-[10px] left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-green-200 via-cyan-200 to-Fuchsia-300"></div>
  <!-- End of Gradient Background -->

  <!-- <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"></button> -->

  <!-- Sidebar -->
  <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
      <a href="adminDashboard.php" class="flex items-center py-6 ps-8 mb-5">
        <img src="images/G!.png" class="h-6 me-3 sm:h-7" alt="Flowbite Logo" />
        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">G! Arat Na</span>
      </a>
      <ul class="space-y-2 font-medium">
        <li>
          <a href="adminDashboard.php" class="flex items-center p-2 text-gray-900 rounded-lg bg-gradient-to-l from-red-100 to-sky-700 text-white hover:text-slate-50 hover:bg-sky-900 group">
            <img src="images/bxs-home-alt-2.svg" alt="" />
            <span class="ms-3">Dashboard</span>
          </a>
        </li>

        <li>
        <a href="adminEvents.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:text-slate-50 hover:bg-gradient-to-l from-red-100 to-sky-700">
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

    </div>

  </aside>
  <!-- End of Sidebar -->

  <!-- Content div -->
  <div class="py-8 px-10 sm:ml-64">
    <!-- Header -->
    <div class="flex w-full items-center justify-between pb-8 gap-5 max-md:max-w-full max-md:flex-wrap">
      <h1 class="text-[#10182c] text-6xl font-bold my-auto">
        Dashboard
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

    <!-- Upper Part -->
    <section class="shadow-lg bg-gray-800 bg-opacity-20 flex flex-col mb-12 px-5 py-9 rounded-3xl max-md:max-w-full max-md:mt-10">
      <div class="flex w-[1-00px] max-w-full gap-2 mx-20 justify-between max-md:flex-wrap max-md:justify-center">

        <div class="flex items-stretch gap-5">
          <button onclick="location.href='adminUsers.php'"class="aspect-square object-contain object-center w-[65px] overflow-hidden shrink-0 max-w-full" style="cursor: pointer;" >
            <div class="w-16 h-16 rounded-full bg-gradient-to-tr from-sky-300 to-sky-700 flex items-center justify-center">
              <img class="w-8 h-8" src="images/bx-group outline.svg" alt="">
            </div>
          </button>
          <div class="self-center flex grow basis-[0%] flex-col items-stretch">
            <div class="text-[#10182c] font-medium text-center text-xl">
              <a>Users</a>
            </div>
            <div class="text-[#10182c] text-center text-4xl font-bold">
              <?php
              $sql = "Select * from users";
              $result = mysqli_query($conn, $sql);
              if (isset($result)) {
                $row = mysqli_num_rows($result);
                echo $row;
              }
              ?>
            </div>
          </div>
        </div>


        <div class="flex items-stretch gap-5">
          <button onclick="location.href='adminEvents.php'" class="aspect-square object-contain object-center w-[65px] overflow-hidden shrink-0 max-w-full">
            <div class="w-16 h-16 rounded-full bg-gradient-to-tr from-sky-300 to-sky-700 flex items-center justify-center">
              <img class="w-8 h-8" src="images/bx-calendar-event-ool.svg" alt="">
            </div>
          </button>
          <div class="self-center flex grow basis-[0%] flex-col items-stretch">
            <div class="text-[#10182c] font-medium text-center text-xl">
              <a href="adminEvents.php">Events</a>
            </div>
            <div class="text-[#10182c] text-center text-4xl font-bold">
              <?php
              $sql = "Select * from events";
              $result = mysqli_query($conn, $sql);

              if (isset($result)) {
                $row = mysqli_num_rows($result);
                echo $row;
              }
              ?>
            </div>
          </div>
        </div>

        <!--Registratiions-->
        <div class="flex items-stretch gap-5">
          <button onclick="location.href='adminDashboard.php'" class="aspect-square object-contain object-center w-[65px] overflow-hidden shrink-0 max-w-full">
            <div class="w-16 h-16 rounded-full bg-gradient-to-tr from-sky-300 to-sky-700 flex items-center justify-center">
              <img class="w-8 h-8" src="images/bx-file-ol.svg" alt="">
            </div>
          </button>
          <div class="self-center flex grow basis-[0%] flex-col items-stretch">
            <div class="text-[#10182c] font-medium text-center text-xl">
              <a>Pending</a>
            </div>
            <div class="text-[#10182c] text-center text-4xl font-bold">
              <?php
              $sql = "Select * from registrations where payment_status='Pending'";
              $result = mysqli_query($conn, $sql);

              if (isset($result)) {
                $row = mysqli_num_rows($result);
                echo $row;
              }
              ?>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- End of Upper Part -->

    <!-- Events -->
    <div class="grid grid-cols-3 gap-8 mb-4">

      <?php
      $sql = "Select * from events";
      $query = mysqli_query($conn, $sql);
      if ($query->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
          echo '
                    <div
                  class="flex flex-col items-stretch"
                >
                <div
                    class=" bg-gray-800 bg-opacity-10 shadow-md flex flex-col w-full mx-auto p-8 rounded-xl max-md:mt-10 max-md:px-5">
                    <h2
                      class="text-[#10182c]  text-center text-xl font-semibold leading-7 self-center max-w-[288px]"
                    >
                    <a href="event-table.php?event_id=' . urlencode($row['event-id']) . '">';
          echo $row["title"];
          echo '</a> </h2>
                    <p class="text-[#10182c]  text-base leading-5 self-stretch mt-8">';
          echo $row["description"];

          echo '</p>
                    <div class="text-[#10182c]  text-center text-4xl font-bold leading-10 mt-6">
                      
                    </div>
                  </div>
                </div>';
        };
      };
      ?>
    </div>

    <!-- End of Events -->

  </div>
</body>

</html>