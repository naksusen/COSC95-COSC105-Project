<?php
require 'conn.php';
session_start();


if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {

  if (isset($_POST["submit"])) {
    $program = $_POST['program'];
    $year = $_POST['year'];
    $sec = $_POST['sec'];
    $payment = $_POST['payment'];
    $note = $_POST['note'];

    $email = $_SESSION['email'];
    $sql = "Select * from users where email='$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $userid = $row['user-id'];

    $query = "INSERT INTO registrations (`user_id`,`event_id`,`program`,`yearlvl`,`section`,`payment_mode`,`addtl_data`) 
  VALUES ($userid,'20240001','$program','$year','$sec','$payment', '$note')";


    mysqli_query($conn, $query);
?><script type="text/javascript">
      alert("Keep in mind that your request is subject to assessment, and approval is not guaranteed.");



      window.location.href = "qrgenerator.php";
    </script><?php




              //header("location: formrequest.html");
            }
          } else {
            echo "
                <script>
                    alert('Login first before filling out the register form');
                    window.location.href = 'login.php';
                </script>
                ";
          }

              ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>𝐅𝐞𝐛-𝐈𝐛𝐢𝐠 2024</title>
  <link rel="icon" type="image/x-icon" href="images/G!.png" />
  <link href="/dist/output.css" rel="stylesheet" />
  <link rel="stylesheet" href="regFebibig.css">

</head>

<body class="min-h-screen relative bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200">
  <!-- Gradient Background -->
  <div class="blob w-full h-full rounded-[999px] absolute top-0 right-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200"></div>
  <div class="blob w-[1000px] h-[1000px] rounded-[999px] absolute bottom-0 left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-red-200 via-gray-100 to-blue-100"></div>
  <div class="blob w-[600px] h-[600px] rounded-[999px] absolute bottom-0 left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-slate-100 via-teal-100 to-blue-100"></div>
  <div class="blob w-[300px] h-[300px] rounded-[999px] absolute bottom-[10px] left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-green-200 via-cyan-200 to-fuchsia-300"></div>
  <!-- End of Gradient Background -->
  <div class="flex flex-col items-stretch pl-12 pr-12 max-md:px-5">
    <header>
      <nav class="flex w-full items-center justify-between gap-20 mt-10 max-md:max-w-full max-md:flex-wrap">
        <a href="index.php" class="flex items-stretch justify-between gap-5 my-auto max-md:max-w-full max-md:flex-wrap max-md:justify-center">
          <img src="images/G!.png" class="aspect-[4.09] object-contain object-center w-[200px] overflow-hidden shrink-0 max-w-full" alt="G! Arat Na" />
          <div class="justify-center self-start flex gap-10 my-auto mr-10 max-md:max-w-full max-md:flex-wrap max-md:justify-center">
            <a href="index.php" class="text-stone-900 text-center text-base font-medium leading-5">Home</a>
            <a href="events.php" class="text-black text-center text-base font-extrabold leading-5">Events</a>
            <a href="userAbout.php" class="text-stone-900 text-center text-base font-medium leading-5">About</a>
            <?php
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
              echo "<a href='logout.php' class='text-black text-center text-base font-medium leading-5'>Logout</a>";
            } else {
              echo "<a href='index.php' class='text-black text-center text-base font-medium leading-5'>Login</a>";
            }
            ?>
          </div>
        </a>
      </nav>
    </header>


    <div class="grid grid-cols-2 gap-16 mt-20">
      <div>
        <div class="px-20 ml-10">
          <h1 class="text-center text-[80px] pb-2">Feb-Ibig 2024</h1>
          <p class="text-justify pb-4 indent-8">
            Pagod ka na ba kakahintay sa chance na makasama mo ang crush mo? Finally, the prolonged wait is over!
          </p>
          <p class="text-justify pb-4 indent-8"> Get your partners and friends ready. Join us in 𝗠𝗮𝗿𝗰𝗵 𝟲, 𝟮𝟬𝟮𝟰 (𝗪𝗲𝗱𝗻𝗲𝘀𝗱𝗮𝘆) 𝟴:𝟬𝟬 𝗮𝗺 - 𝟱:𝟬𝟬 𝗽𝗺 for the much awaited 𝗡𝗮𝗸𝗮𝗸𝗮𝗽𝗮𝗴𝗽𝗮𝗯𝗮𝗴𝗮𝗯𝗮𝗴 𝗻𝗮 𝗙𝗲𝗯-𝗜𝗯𝗶𝗴 𝟮𝟬𝟮𝟰: 𝗨𝗻𝗲𝘅𝗽𝗲𝗰𝘁𝗲𝗱 𝗹𝗼𝘃𝗲 𝗰𝗼𝗺𝗲𝘀 𝗳𝗿𝗼𝗺 𝗨𝗻𝗲𝘅𝗽𝗲𝗰𝘁𝗲𝗱 𝗧𝗶𝗺𝗲 (𝗠𝗮𝗿𝗰𝗵 𝗘𝗱𝗶𝘁𝗶𝗼𝗻) at 𝗖𝗮𝘃𝗶𝘁𝗲 𝗦𝘁𝗮𝘁𝗲 𝗨𝗻𝗶𝘃𝗲𝗿𝘀𝗶𝘁𝘆 - 𝗕𝗮𝗰𝗼𝗼𝗿 𝗖𝗶𝘁𝘆 𝗖𝗮𝗺𝗽𝘂𝘀. 🏫🎊
          </p>
          <p class="text-justify pb-4 indent-8">

            Get excited because there will be a lot of bonding and exciting events, performances, and celebrations—you could say it's giving—and don't forget to stay connected.
          </p>
          <div class="formbold-event-details">
            <h5>Event Details</h5>
            <ul>
              <li>
                [Event Name]
              </li>
              <li>
                <img src="images/bx-calendar-alt.svg" alt="">
                February 14, 2024
              </li>
              <li>
                <img src="images/bx-time.svg" alt="">
                8:00 AM - 5:00 PM
              </li>
              <li>
                <img src="images/bx-map.svg" alt="">
                CvSU Bacoor Gym
              </li>
              <li>
                <img src="images/bx-group.svg" alt="">
                All Students
              </li>
              <li>
                <img src="images/bx-purchase-tag.svg" alt="">
                Php 15.00
              </li>
            </ul>
          </div>

        </div>
      </div>
      <div>
        <img src="images/febibig.jpg" alt="" class="h-[650px] w-[650px] ml-4 ">
      </div>
    </div>

    <!-- Registration Form -->

    <div>
      <form class="" method="post" autocomplete="off">
        <section>
          <div class="flex flex-col items-stretch px-10 pt-20">
            <h2 class="text-[46px] font-medium tracking-wider">Register Here</h2>
            <div class="bg-gradient-to-r from-sky-500/50 to-blue-500/50 justify-center items-stretch flex w-full flex-col -mr-5 mt-2 px-7 py-8 rounded-[10px] max-md:max-w-full max-md:mt-10 max-md:px-5">
              <!-- First Row Info -->
              <div class="justify-between max-md:max-w-full">
                <div class="gap-14 flex max-md:flex-col max-md:items-stretch max-md:gap-0">
                  <!-- Full Name -->
                  <div class="flex flex-col items-stretch w-[33%] max-md:w-full max-md:ml-0">
                    <div class="items-stretch flex grow flex-col max-md:mt-10">
                      <label for="fullname" class="text-[#401b1b] text-base font-bold leading-6 whitespace-nowrap">Full Name</label>
                      <input type="text" name="fullname" id="fullname" class="bg-[#eff0f2] mt-3 py-3 px-5 w-full border border-gray-300 p-3 focus:outline-none focus:ring-[#ab644d] focus:ring-1 rounded-[50px] max-md:pl-1" placeholder="Name" value="
                      <?php
                      if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                        $email = $_SESSION['email'];
                        $sql = "Select * from users where email='$email'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        echo $row['fullname'];
                      }
                      ?>
                      " required />
                    </div>
                  </div>

                  <!-- Student Number -->
                  <div class="flex flex-col items-stretch w-[33%] max-md:w-full max-md:ml-0">
                    <div class="items-stretch flex grow flex-col max-md:mt-10">
                      <label for="student_num" class="text-[#401b1b] text-base font-bold leading-6 whitespace-nowrap">Student Number</label>
                      <input type="text" name="student_num" id="student_num" class="bg-[#eff0f2] mt-3 py-3 px-5 w-full border border-gray-300 p-3 focus:outline-none focus:ring-[#ab644d] focus:ring-1 rounded-[50px] max-md:pl-1" placeholder="Student Number" value="
                      <?php
                      if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                        $email = $_SESSION['email'];
                        $sql = "Select * from users where email='$email'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        echo $row['studentNum'];
                      }
                      ?>
                      " required />
                    </div>
                  </div>
                  <!-- Email -->
                  <div class="flex flex-col items-stretch w-[33%] max-md:w-full max-md:ml-0">
                    <div class="items-stretch flex grow flex-col max-md:mt-10">
                      <label for="email" class="text-[#401b1b] text-base font-bold leading-6 whitespace-nowrap">Email</label>
                      <input type="text" name="email" id="email" class="bg-[#eff0f2] mt-3 py-3 px-5 w-full border border-gray-300 p-3 focus:outline-none focus:ring-[#ab644d] focus:ring-1 rounded-[50px] max-md:pl-1" placeholder="Email" value="
                      <?php
                      if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                        $email = $_SESSION['email'];
                        $sql = "Select * from users where email='$email'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        echo $row['email'];
                      }
                      ?>
                      " required />
                    </div>
                  </div>
                  <!-- End of Email -->
                </div>
              </div>
              <!-- End of First Row Info -->
              <!-- Second Row Info -->
              <div class="justify-between mt-10 max-md:max-w-full">
                <div class="gap-14 flex max-md:flex-col max-md:items-stretch max-md:gap-0">
                  <!-- Program -->
                  <div class="flex flex-col items-stretch w-[33%] max-md:w-full max-md:ml-0">
                    <div class="items-stretch flex grow flex-col max-md:mt-10">
                      <label for="program" class="text-[#401b1b] text-base font-bold leading-6 whitespace-nowrap">Program</label>
                      <input type="text" name="program" id="program" class="bg-[#eff0f2] mt-3 py-3 px-5 w-full border border-gray-300 p-3 focus:outline-none focus:ring-[#ab644d] focus:ring-1 rounded-[50px] max-md:pl-1" placeholder="Program" required />
                    </div>
                  </div>
                  <!-- Year -->
                  <div class="flex flex-col items-stretch w-[33%] max-md:w-full max-md:ml-0">
                    <div class="items-stretch flex grow flex-col max-md:mt-10">
                      <label for="year" class="text-[#401b1b] text-base font-bold leading-6 whitespace-nowrap">Year</label>
                      <input type="text" name="year" id="year" class="bg-[#eff0f2] mt-3 py-3 px-5 w-full border border-gray-300 p-3 focus:outline-none focus:ring-[#ab644d] focus:ring-1 rounded-[50px] max-md:pl-1" placeholder="Year" required />
                    </div>
                  </div>

                  <!-- Section -->
                  <div class="flex flex-col items-stretch w-[33%] max-md:w-full max-md:ml-0">
                    <div class="items-stretch flex grow flex-col max-md:mt-10">
                      <label for="sec" class="text-[#401b1b] text-base font-bold leading-6 whitespace-nowrap">Section</label>
                      <input type="text" name="sec" id="sec" class="bg-[#eff0f2] mt-3 py-3 px-5 w-full border border-gray-300 p-3 focus:outline-none focus:ring-[#ab644d] focus:ring-1 rounded-[50px] max-md:pl-1" placeholder="Section" required />
                    </div>
                  </div>
                  <!-- End of Section -->
                </div>
              </div>

              <!-- Third Row Info -->
              <div class="justify-between mt-10 max-md:max-w-full">
                <div class="gap-14 flex max-md:flex-col max-md:items-stretch max-md:gap-0">
                  <!-- Payment Option -->
                  <div class="flex flex-col items-stretch w-[32%] max-md:w-full max-md:ml-0">
                    <div class="items-stretch flex grow flex-col max-md:mt-10">
                      <label for="payment" class="text-[#401b1b] text-base font-bold leading-6 whitespace-nowrap">Payment Option</label>
                      <div class="w-88 relative">
                        <select type="text" name="payment" id="payment" placeholder="Payment Option" required class="bg-[#eff0f2] mt-3 py-3 px-5 w-full border border-gray-300 focus:outline-none focus:ring-[#ab644d] focus:ring-1 rounded-[50px] max-md:pl-1" autocomplete="off">
                          <option value=""></option>
                          <option value="Cash">Cash</option>
                          <option value="Online">Online</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- End of Payment Option -->
                  <!-- Note -->
                  <div class="flex flex-col items-stretch w-[68%] max-md:w-full max-md:ml-0">
                    <div class="items-stretch flex grow flex-col max-md:mt-10">
                      <label for="note" class="text-[#401b1b] text-base font-bold leading-6 whitespace-nowrap">Note</label>
                      <input type="text" name="note" id="note" class="bg-[#eff0f2] mt-3 py-3 px-5 w-full border border-gray-300 p-3 focus:outline-none focus:ring-[#ab644d] focus:ring-1 rounded-[50px] max-md:pl-1" placeholder="Add note here" />
                    </div>
                  </div>
                </div>
              </div>
              <!-- End of Third Row Info -->



            </div>
          </div>
        </section>
        <!-- End of Registration Form -->


        <!-- Submit Button -->
        <section class="mb-20">
          <div class="flex flex-col items-stretch px-16">
            <div class="justify-center items-stretch flex w-full flex-col -mr-5 px-7 mt-6 rounded-[30px] max-md:max-w-full max-md:mt-10 max-md:px-5">
              <button type="submit" name="submit" class="bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 justify-center items-center shadow-2xl flex w-[200px] max-w-full gap-2 mt-6 px-12 py-5 rounded-[40px] self-center max-md:mt-10 max-md:px-5">
                <h4 class="text-gray-200 text-center font-extrabold leading-6">Submit</h4>
              </button>
            </div>
          </div>
        </section>
      </form>
    </div>
  </div>

</body>
<script src="programs.js"></script>

</html>