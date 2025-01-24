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
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Dashboard</title>
  <link rel="icon" type="image/x-icon" href="images/papsicon.png" />
  <link href="/dist/output.css" rel="stylesheet" />
  <script src="https://unpkg.com/@themesberg/flowbite@latest/dist/flowbite.bundle.js"></script>
</head>

<body>
  <!-- Gradient Background -->
  <div class="blob w-full h-full rounded-[999px] absolute top-0 right-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200"></div>
  <div class="blob w-[1000px] h-[1000px] rounded-[999px] absolute bottom-0 left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-red-200 via-gray-100 to-blue-100"></div>
  <div class="blob w-[600px] h-[600px] rounded-[999px] absolute bottom-0 left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-slate-100 via-teal-100 to-blue-100"></div>
  <div class="blob w-[300px] h-[300px] rounded-[999px] absolute bottom-[10px] left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-green-200 via-cyan-200 to-Fuchsia-300"></div>
  <!-- End of Gradient Background -->
  <div class="pr-12 max-md:pr-5 no-scrollbar">
    <section class="gap-5 flex max-md:flex-col max-md:items-stretch max-md:gap-0">
      <!--Sidebar-->
      <aside>
        <div class="bg-slate-300 h-full flex w-[240px] flex-col pt-6 max-md:pl-5">
          <img loading="lazy" srcset="
                https://cdn.builder.io/api/v1/image/assets/TEMP/e89eee81-b8cb-4838-b24c-009bba65d2d2?apiKey=00d7018a335e46bbabd3ad8844351700&width=100   100w,
                https://cdn.builder.io/api/v1/image/assets/TEMP/e89eee81-b8cb-4838-b24c-009bba65d2d2?apiKey=00d7018a335e46bbabd3ad8844351700&width=200   200w,
                https://cdn.builder.io/api/v1/image/assets/TEMP/e89eee81-b8cb-4838-b24c-009bba65d2d2?apiKey=00d7018a335e46bbabd3ad8844351700&width=400   400w,
                https://cdn.builder.io/api/v1/image/assets/TEMP/e89eee81-b8cb-4838-b24c-009bba65d2d2?apiKey=00d7018a335e46bbabd3ad8844351700&width=800   800w,
                https://cdn.builder.io/api/v1/image/assets/TEMP/e89eee81-b8cb-4838-b24c-009bba65d2d2?apiKey=00d7018a335e46bbabd3ad8844351700&width=1200 1200w,
                https://cdn.builder.io/api/v1/image/assets/TEMP/e89eee81-b8cb-4838-b24c-009bba65d2d2?apiKey=00d7018a335e46bbabd3ad8844351700&width=1600 1600w,
                https://cdn.builder.io/api/v1/image/assets/TEMP/e89eee81-b8cb-4838-b24c-009bba65d2d2?apiKey=00d7018a335e46bbabd3ad8844351700&width=2000 2000w,
                https://cdn.builder.io/api/v1/image/assets/TEMP/e89eee81-b8cb-4838-b24c-009bba65d2d2?apiKey=00d7018a335e46bbabd3ad8844351700&
              " class="-[aspect4.03] object-contain object-center w-[149px] overflow-hidden self-center max-w-full" />

          <nav class="items-start self-stretch flex flex-col w-full pl-7 mt-10 mb-96 pb-4 max-md:my-10">
            <a href="adminDashboard.php">
              <div class="items-start bg-[#e0e8ed] self-stretch flex w-full justify-between gap-5 pl-6 pr-16 py-4 rounded-[40px_0px_0px_40px] max-md:px-5">

                <!--Dashboard-->
                <img loading="lazy" src="images/dashboard.svg" class="aspect-square object-center self-stretch max-w-full" alt="Dashboard Icon" />

                <h1 class="text-orange-800 text-lg font-medium self-center whitespace-nowrap my-auto">
                  Dashboard
                </h1>
              </div>
            </a>
            <!--Student-->
            <a href="pendingpayment.php">
              <div class="items-start  self-stretch flex w-full justify-between gap-5 pl-6 pr-20 py-4 rounded-[40px_0px_0px_40px] max-md:px-5">

                <img loading="lazy" src="images/Students.svg" class="aspect-square object-center self-stretch max-w-full" alt="Students Icon" />

                <h1 class="text-orange-950 text-lg font-medium self-center whitespace-nowrap my-auto">
                  Pending </br> Payments
                </h1>
              </div>
            </a>

            <!--Enrollees-->
            <a href="Enrollees.php">
              <div class="items-start  self-stretch flex w-full justify-between gap-5 pl-6 pr-20 py-4 rounded-[40px_0px_0px_40px] max-md:px-5">
                <img loading="lazy" src="images/Enrollees.svg" class="aspect-square object-center self-stretch max-w-full" alt="Enrollees Icon" />

                <h1 class="text-orange-950 text-lg font-medium self-center whitespace-nowrap my-auto">
                  Enrollees
                </h1>
              </div>
            </a>

            <!--Events-->
            <a href="events.php">
              <div class="items-start  self-stretch flex w-full justify-between gap-5 pl-6 pr-20 py-4 rounded-[40px_0px_0px_40px] max-md:px-5">
                <img loading="lazy" src="images/Requests.svg" class="aspect-square object-center self-stretch max-w-full" alt="Requests Icon" />

                <h1 class="text-orange-950 text-lg font-medium self-center whitespace-nowrap my-auto">
                  Events
                </h1>
              </div>
            </a>



          </nav>

        </div>



      </aside>
      <main class="  w-[76%] ml-10 max-md:w-full max-md:ml-0">
        <header class="flex flex-col items-stretch mt-8 max-md:max-w-full max-md:mt-10">
          <div class="flex w-full items-center justify-between gap-5 max-md:max-w-full max-md:flex-wrap">
            <h1 class="text-orange-950 text-4xl font-bold my-auto">
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
                    $sql = "Select * from users where email='$email'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
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
            </div>

            <!--<div class="self-stretch flex items-center justify-between gap-4">
                <div class="text-orange-950 text-sm font-semibold my-auto">
                  ADMIN
                </div>
                <div
                  class="bg-violet-300 self-stretch flex w-[60px] shrink-0 h-[60px] flex-col rounded-[40px]"
                ></div>
              </div>
            -->
          </div>
        </header>


        <section class="shadow-lg bg-[#eeefea] flex flex-col mt-10 px-5 py-9 rounded-3xl max-md:max-w-full max-md:mt-10">
          <div class="flex w-[1-00px] max-w-full gap-2 mx-20 justify-between max-md:flex-wrap max-md:justify-center">

            <div class="flex items-stretch gap-5">
              <button onclick="location.href='Students_list.php'" class="aspect-square object-contain object-center w-[65px] overflow-hidden shrink-0 max-w-full">
                <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/361fa489-9c27-4e08-a35a-eb40e98cc4fe?apiKey=00d7018a335e46bbabd3ad8844351700&" />
              </button>
              <div class="self-center flex grow basis-[0%] flex-col items-stretch">
                <div class="text-orange-950 text-center text-lg">
                  <a href="Students_list.php">Users</a>
                </div>
                <div class="text-orange-800 text-center text-4xl font-bold">
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
              <button onclick="location.href='requests.php'" class="aspect-square object-contain object-center w-[65px] overflow-hidden shrink-0 max-w-full">
                <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/4c8dc0ae-1840-4118-ad1c-81efd1d6e2eb?apiKey=00d7018a335e46bbabd3ad8844351700&" />
              </button>
              <div class="self-center flex grow basis-[0%] flex-col items-stretch">
                <div class="text-orange-950 text-center text-lg whitespace-nowrap">
                  <a href="requests.php">Events</a>
                </div>
                <div class="text-orange-800 text-center text-4xl font-bold">
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
              <button onclick="location.href='requests.php'" class="aspect-square object-contain object-center w-[65px] overflow-hidden shrink-0 max-w-full">
                <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/4c8dc0ae-1840-4118-ad1c-81efd1d6e2eb?apiKey=00d7018a335e46bbabd3ad8844351700&" />
              </button>
              <div class="self-center flex grow basis-[0%] flex-col items-stretch">
                <div class="text-orange-950 text-center text-lg whitespace-nowrap">
                  <a href="requests.php">Pending</a>
                </div>
                <div class="text-orange-800 text-center text-4xl font-bold">
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



        <div>
          <section class="mt-10">
            <div class="gap-16 flex max-md:flex-col max-md:items-stretch max-md:gap-0">
              <?php
              $sql = "Select * from events";
              $query = mysqli_query($conn, $sql);
              if ($query->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                  echo '<div
                class="flex flex-col items-stretch w-[398px] h-[325px] max-md:w-full max-md:ml-0"
              >
              <div
                  class="bg-[#eeefea] shadow-md flex flex-col w-full mx-auto p-8 rounded-xl max-md:mt-10 max-md:px-5">
                  <h2
                    class="text-orange-950 text-center text-xl font-semibold leading-7 self-center max-w-[288px]"
                  >
                  <a href="event-table.php?event_id=' . urlencode($row['event-id']) . '">';
                  echo $row["title"];
                  echo '</a> </h2>
                  <p class="text-orange-950 text-base leading-5 self-stretch mt-8">';
                  echo $row["description"];

                  echo '</p>
                  <div class="text-orange-950 text-center text-4xl font-bold leading-10 mt-6">
                    
                  </div>
                </div>
              </div>';
                };
              };
              ?>


            </div>
          </section>

        </div>
        <div>
      </main>
    </section>
  </div>
</body>

</html>

</html>