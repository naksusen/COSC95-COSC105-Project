<?php
session_start();
include_once("conn.php");
//include("searchajax2.php");
//$columns = array('program');

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
//$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
/*$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

if (isset($_GET['progvalue'])) {
  $program = $_GET['progvalue'];
}

if (isset($_GET['yrsec'])) {
  $yrsec = $_GET['yrsec'];
}
*/
roleConfirm($_SESSION['logged_in'], $_SESSION['email']);

// Number of rows per page
$rowsPerPage = 10;

// Current page, default to 1
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
  $currentPage = $_GET['page'];
} else {
  $currentPage = 1;
}

// Calculate the limit for the SQL query
$limitStart = ($currentPage - 1) * $rowsPerPage;

// Fetch data with LIMIT clause
$sql = "SELECT registrations.reg_id, registrations.user_id, registrations.event_id, registrations.program, registrations.yearlvl, registrations.section, registrations.payment_mode, registrations.payment_status, registrations.addtl_data, events.title, events.price, users.fullname, users.studentNum FROM registrations JOIN events ON registrations.event_id = events.`event-id` JOIN users ON registrations.user_id = users.`user-id` WHERE registrations.payment_status = 'Pending' LIMIT $limitStart, $rowsPerPage";
$query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@themesberg/flowbite@latest/dist/flowbite.bundle.js"></script>
  <title>Requests</title>
  <link rel="icon" type="image/x-icon" href="images/papsicon.png" />
  <link rel="stylesheet" href="table.css" type="text/css">
  <link href="/dist/output.css" rel="stylesheet" />
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

<body class="bg-fixed bg-no-repeat bg-cover bg-center bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-[#f3f4f5] via-[#e0e8ed] to-[#d0dde6]">

  <div>
    <section class="shadow-inner gap-5 flex max-md:flex-col max-md:items-stretch max-md:gap-0">
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
              <div class="items-start self-stretch flex w-full justify-between gap-5 pl-6 pr-16 py-4 rounded-[40px_0px_0px_40px] max-md:px-5">
                <img loading="lazy" src="images/dashboard1.svg" class="aspect-square object-center self-stretch max-w-full" alt="Dashboard Icon" />

                <h1 class="text-orange-950 text-lg font-medium self-center whitespace-nowrap my-auto">
                  Dashboard
                </h1>
              </div>
            </a>
            <a href="Students_list.php">
              <div class="items-start  self-stretch flex w-full justify-between gap-5 pl-6 pr-20 py-4 rounded-[40px_0px_0px_40px] max-md:px-5">
                <img loading="lazy" src="images/Students.svg" class="aspect-square object-center self-stretch max-w-full" alt="Students Icon" />

                <h1 class="text-orange-950 text-lg font-medium self-center whitespace-nowrap my-auto">
                  Students
                </h1>
              </div>
            </a>
            <a href="Enrollees.php">
              <div class="items-start self-stretch flex w-full justify-between gap-5 pl-6 pr-16 py-4 rounded-[40px_0px_0px_40px] max-md:px-5">
                <img loading="lazy" src="images/Enrollees.svg" class="aspect-square object-center self-stretch max-w-full" alt="Enrollees Icon" />

                <h1 class="text-orange-950 text-lg font-medium self-center whitespace-nowrap my-auto">
                  Enrollees
                </h1>
              </div>
            </a>
            <a href="requests.php">
              <div class="items-start bg-[#e0e8ed] self-stretch flex w-full justify-between gap-5 pl-6 pr-20 py-4 rounded-[40px_0px_0px_40px] max-md:px-5">
                <img loading="lazy" src="images/requests1.svg" class="aspect-square object-center self-stretch max-w-full" alt="Requests Icon" />

                <h1 class="text-orange-800 text-lg font-medium self-center whitespace-nowrap my-auto">
                  Requests
                </h1>
              </div>
            </a>



            <div class="outer-container">
              <div class="container pt-10">
                <h1 class="text-orange-950 justify-center text-center text-md font-medium self-center whitespace-nowrap my-auto">
                  Scan Here
                </h1>
                <div class="row">

                  <div class="col-md-5 pt-2">
                    <video id="preview" style="  border-radius: 10px; width: 180px; height: 180px; padding: top 20px; object-fit: cover;"></video>
                  </div>

                </div>
              </div>
            </div>
            <!--script>
            let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
            Instascan.Camera.getCameras().then(function(cameras){
                if (cameras.length > 0){
                    scanner.start(cameras[0]);
                } else {
                    alert('No cameras found');
                }
            }).catch(function(e){
                console.error(e);
            });

            scanner.addListener('scan',function(c){
                document.getElementById('getName').value=c;
                document.getElementById('getName').trigger('input');

            });
            
            
            video.style.objectFit = 'cover';
  </script-->


          </nav>
        </div>
      </aside>
      <main class="flex flex-col items-stretch w-[76%] ml-10 max-md:w-full max-md:ml-0">
        <header class="flex flex-col items-stretch mt-8 mb-10 max-md:max-w-full max-md:mt-10">
          <div class="flex w-full items-center justify-between gap-5 max-md:max-w-full max-md:flex-wrap">
            <h1 class="text-orange-950 text-4xl font-bold my-auto">
              Requests
            </h1>
            <div class="max-w-lg">
              <button class="text-[#424242] bg-transparent hover:bg-transparent focus:ring-4 focus:ring-transparent font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center" type="button" data-dropdown-toggle="dropdown">
                <?php
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                  $email = $_SESSION['email'];
                  $accquery = "Select * from users where email='$email'";
                  $result = mysqli_query($conn, $accquery);
                  $row = mysqli_fetch_assoc($result);
                  echo '<p>' . $row['fullname'] . '</p>';
                } else {
                  echo 'Not logged in';
                }
                ?>
              </button>
              <div class="hidden bg-white text-base z-50 list-none divide-y divide-gray-100 rounded shadow my-4" id="dropdown">

              </div>
        </header>

        <div class="flex items-stretch justify-between gap-5">
          <div class="bg-zinc-100 rounded-[40px] w-[300px] h-[40px] shadow-md">
            <div class="items-stretch flex gap-4 rounded-3xl">
              <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/75453035-f6ab-4cc0-b8e2-9e687ed98ce1?apiKey=949dc02d5acc420a9a54e7e811a36e3e&" class="aspect-square object-contain object-center w-8 overflow-hidden shrink-0-w-full ml-3 pl-2" alt="Search Icon" />

              <div class="text-stone-500  text-lg leading-7 self-center whitespace-nowrap mt-2 mb-1">
                <input type="search" class="bg-zinc-100" id="getName" placeholder="Search here..." autocomplete="off">
                <!--script>/*$('#getName').on('input', function() {
                      $('#getName').trigger('keydown');
                    })*/
                    const event = new Event('keydown');
                    getName.dispatchEvent(event);

                    $(document).ready(function(){
                      /*$('#getName').autocomplete({
                        sou
                      })*/
                      $('#getName').on('input change focus keyup', function() {
                        $('#getName').trigger('keydown');
                    })
                    })
                    </script-->
              </div>

            </div>
          </div>
          <div class="flex gap-3 px-5">
            <!--PROGRAM SECTION-->
            <!--a href="#" class="justify-center items-center w-[160px] h-[40px] flex px-5 py-2 rounded-[40px] 
                border-2 border-solid border-stone-500">
              <div class="justify-center items-center flex w-[127px] max-w-full gap-4">
                <div class="text-stone-500 text-lg leading-7 my-auto">Program</div>
                <img loading="lazy"
                  src="https://cdn.builder.io/api/v1/image/assets/TEMP/e2da229c-57b4-4c99-8c1d-dc4f7553e83c?apiKey=949dc02d5acc420a9a54e7e811a36e3e&"
                  class="aspect-square object-contain object-center w-8 overflow-hidden self-stretch shrink-0 max-w-full"
                  alt="Program Icon" />
              </div>
            </a-->
            <!--form action="request.php" method="get"-->
            <div name="program" id="dropdown" class="items-center w-[160px] h-[40px] flex px-5 py-0.5 rounded-[40px] 
                border-2 border-solid border-stone-500">
              <div class="justify-center items-center flex w-[127px] max-w-full gap-4">
                <div class="text-stone-500 text-lg leading-7 my-auto">Program</div>
                <button onclick="PROGRAMdropdown()" id="dropbtn" style="background-image: url('https://cdn.builder.io/api/v1/image/assets/TEMP/b1f4b831-70b4-4724-832d-ea63cec558e5?apiKey=949dc02d5acc420a9a54e7e811a36e3e&')" class="aspect-square object-contain object-center w-full overflow-hidden shrink-0 flex-1"></button>
              </div>
              <div id="programDropdown" class="dropdown-content">
                <!--a href="request.php?column=program&value=">Link</a>
                <a href="request.php?column=program&value=">Link</a>
                <a href="request.php?column=program&value=">Link</a-->
                <!--?php 
          
          $sql = "SELECT DISTINCT program from request";
          $result = $conn-> query($sql);

          if ($result-> num_rows > 0) {
              while ($row =  $result-> fetch_assoc()){
                //$program = $row['program'];
                echo "<a href='requests.php?column=program&progvalue=". $row["program"]."'>". $row["program"]."</a>";
                //echo "<option value= '". $row["program"]."'>". $row["program"]."</a>";
              }
          }
          else{
              echo "0 results";
          }

          //$conn-> close();
          ?-->
              </div>
            </div>
            <!--/form-->

            <!--Year Level SECTION-->
            <!--a href="#" class="justify-center items-center w-[175px] h-[40px] flex px-5 py-2 rounded-[40px] 
                border-2 border-solid border-stone-500">
              <div class="justify-center items-center flex gap-4">
                <div class="text-stone-500 text-lg leading-7 my-auto">Year Level</div>
                <img loading="lazy"
                  src="https://cdn.builder.io/api/v1/image/assets/TEMP/69ecaa31-fac5-449a-96e9-1a4b375c531a?apiKey=949dc02d5acc420a9a54e7e811a36e3e&"
                  class="aspect-square object-contain object-center w-8 overflow-hidden self-stretch shrink-0 max-w-full"
                  alt="Year Level Icon" />
              </div>
            </a-->

            <div id="dropdown" class="items-center w-[175px] h-[40px] flex px-5 py-0.5 rounded-[40px]  
                border-2 border-solid border-stone-500">
              <div class="justify-center items-center flex w-[127px] max-w-full gap-4">
                <div class="text-stone-500 text-lg leading-7 my-auto">Year Level</div>
                <button onclick="YLdropdown()" id="dropbtn" style="background-image: url('https://cdn.builder.io/api/v1/image/assets/TEMP/b1f4b831-70b4-4724-832d-ea63cec558e5?apiKey=949dc02d5acc420a9a54e7e811a36e3e&')" class="aspect-square object-contain object-center w-full overflow-hidden shrink-0 flex-1"></button>
              </div>
              <div id="ylDropdown" class="dropdown-content">
                <!--?php 
          
          $sql = "SELECT DISTINCT yr_sec from request";
          $result = $conn-> query($sql);

          if ($result-> num_rows > 0) {
              while ($row =  $result-> fetch_assoc()){
                //$program = $row['program'];
                echo "<a href='requests.php?column=yr_sec&yrsec=". $row["yr_sec"]."'>". $row["yr_sec"]."</a>";
                //echo "<option value= '". $row["program"]."'>". $row["program"]."</a>";
              }
          }
          else{
              echo "0 results";
          }
          ?-->
              </div>
            </div>

            <!--SORT SECTION-->
            <!--a href="#" class="justify-center items-center w-[125px] h-[40px] flex px-5 py-2 rounded-[40px] 
                border-2 border-solid border-stone-500">
                  <div class="justify-center items-center flex w-[84px] max-w-full gap-4">
                    <div class="text-stone-500 text-lg leading-7 my-auto">Sort</div>
                    <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/b1f4b831-70b4-4724-832d-ea63cec558e5?apiKey=949dc02d5acc420a9a54e7e811a36e3e&" 
                    class="aspect-square object-contain object-center w-full overflow-hidden shrink-0 flex-1" 
                    alt="Sort Icon" />
                  </div>
                </a-->

            <div id="dropdown" class="items-center w-[125px] h-[40px] flex px-5 py-0.5 rounded-[40px] 
                border-2 border-solid border-stone-500">
              <div class="justify-center items-center flex w-[84px] max-w-full gap-4">
                <div class="text-stone-500 text-lg leading-7 my-auto">Sort</div>
                <button onclick="SORTdropdown()" id="dropbtn" style="background-image: url('https://cdn.builder.io/api/v1/image/assets/TEMP/b1f4b831-70b4-4724-832d-ea63cec558e5?apiKey=949dc02d5acc420a9a54e7e811a36e3e&')" class="aspect-square object-contain object-center w-full overflow-hidden shrink-0 flex-1"></button>
              </div>
              <div id="sortDropdown" class="dropdown-content">
                <a href="requests.php?column=reqtype&order=asc">Ascending</a>
                <a href="requests.php?column=reqtype&order=desc">Descending</a>
                <a href="requests.php">Default</a>
              </div>
            </div>
          </div>
        </div>
        <section class="shadow-lg bg-[#eeefea] flex flex-col mt-10 mb-20 rounded-3xl max-md:max-w-full max-md:mt-10">

          <div class="flex flex-col items-center">
            <section class="bg-gray-200 flex w-full max-w-full flex-col pb-8 
            rounded-3xl">
              <div class="self-center flex w-[100%] max-w-full max-md:flex-wrap justify-evenly mb-5">
                <table>

                  <tr>
                    <th class="text-orange-950 font-semibold leading-6">Registration ID</th>
                    <th class="text-orange-950 font-semibold leading-6">Event Name</th>
                    <th class="text-orange-950 font-semibold leading-6">Student Number</th>
                    <th class="text-orange-950 font-semibold leading-6">Registrant Name</th>
                    <th class="text-orange-950 font-semibold leading-6">Year and Section</th>
                    <th class="text-orange-950 font-semibold leading-6">Mode</th>
                    <th class="text-orange-950 font-semibold leading-6">Status</th>
                    <th class="text-orange-950 font-semibold leading-6">Action</th>
                  </tr>
                  <!--SHOWDATA-->
                  <tbody id="showdata">
                    <?php
                    /*if (isset($_GET['order'])){
            $sql = "SELECT fullname, student_num, ctrl_num, yr_sec, program, reqtype from request ORDER BY reqtype $sort_order LIMIT $limitStart, $rowsPerPage";
          }
          else if (isset($_GET['progvalue'])){
            $sql = "SELECT fullname, student_num, ctrl_num, yr_sec, program, reqtype from request WHERE program = '$program' LIMIT $limitStart, $rowsPerPage";
          }
          else if (isset($_GET['yrsec'])){
            $sql = "SELECT fullname, student_num, ctrl_num, yr_sec, program, reqtype from request WHERE yr_sec = '$yrsec' LIMIT $limitStart, $rowsPerPage";
          }
          else if (isset($_GET['order']) && isset($_GET['progvalue'])) {
            $sql = "SELECT fullname, student_num, ctrl_num, yr_sec, program, reqtype from request WHERE program = '$program' ORDER BY reqtype $sort_order LIMIT $limitStart, $rowsPerPage";
          }
          else {
            $sql = "SELECT fullname, student_num, ctrl_num, yr_sec, program, reqtype from request LIMIT $limitStart, $rowsPerPage";
          }
          
          //$sql = "SELECT fullname, student_num, ctrl_num, yr_sec, program, reqtype from request";
          */

                    $result = $conn->query($sql);
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                      <tr>
                        <td><?php echo $row["reg_id"]; ?></td>
                        <td><?php echo $row["title"]; ?></td>
                        <td><?php echo $row["user_id"]; ?></td>
                        <td><?php echo $row["fullname"]; ?></td>
                        <td><?php echo $row["program"] . " " . $row["yearlvl"] . "-" . $row["section"]; ?></td>
                        <td><?php echo $row["payment_mode"]; ?></td>
                        <td><?php echo $row["payment_status"]; ?></td>
                        <td>
                          <form action="actionbutton.php" method="POST">
                            <button name="completed" value="<?= $row['reg_id']; ?>" class='bg-stone-500 text-white text-sm leading-5 font-medium rounded-full px-2 py-2 mr-2'>
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill: #ffffff;transform: msFilter">
                                <path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path>
                              </svg></button>

                            <button name="miss" value="<?= $row['reg_id']; ?>" class='bg-stone-500 text-white text-sm leading-5 font-medium rounded-3xl px-2 py-2 mr-2'>
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill: #ffffff;transform: msFilter">
                                <path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path>
                              </svg>
                            </button>
                          </form>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
              </div>
              </table>
            </section>

            <!--PREVIOUS & NEXT PAGE BUTTON-->
            <div class="flex justify-center mt-2 mb-2">
              <?php
              $resultnumrows = mysqli_query($conn, "SELECT * FROM registrations");
              $totalRows = mysqli_num_rows($resultnumrows);
              $totalPages = ceil($totalRows / $rowsPerPage);

              if (isset($_GET['order'])) {
                // Previous page button
                if ($currentPage > 1) {
                  echo "<a href='requests.php?order=" . $sort_order . "&page=" . ($currentPage - 1) . "' class='mx-1 px-2 py-1 bg-stone-500 text-white rounded-full'>Previous</a>";
                }

                // Page numbers
                for ($i = 1; $i <= $totalPages; $i++) {
                  echo "<a href='requests.php?order=" . $sort_order . "&page=$i' class='mx-1 px-2 py-1 bg-stone-500 text-white rounded-full'>$i</a>";
                }

                // Next page button
                if ($currentPage < $totalPages) {
                  echo "<a href='requests.php?order=" . $sort_order . "&page=" . ($currentPage + 1) . "' class='mx-1 px-2 py-1 bg-stone-500 text-white rounded-full'>Next</a>";
                }
              } else if (isset($_GET['progvalue'])) {
                // Previous page button
                if ($currentPage > 1) {
                  echo "<a href='requests.php?progvalue=" . $program . "&page=" . ($currentPage - 1) . "' class='mx-1 px-2 py-1 bg-stone-500 text-white rounded-full'>Previous</a>";
                }

                // Page numbers
                for ($i = 1; $i <= $totalPages; $i++) {
                  echo "<a href='requests.php?progvalue=" . $program . "&page=$i' class='mx-2 px-4 py-2 bg-stone-500 text-white rounded-3xl'>$i</a>";
                }

                // Next page button
                if ($currentPage < $totalPages) {
                  echo "<a href='requests.php?progvalue=" . $program . "&page=" . ($currentPage + 1) . "' class='mx-2 px-4 py-2 bg-stone-500 text-white rounded-3xl'>Next</a>";
                }
              } else {
                // Previous page button
                if ($currentPage > 1) {
                  echo "<a href='requests.php?page=" . ($currentPage - 1) . "' class='mx-2 px-4 py-2 bg-stone-500 text-white rounded-3xl'>Previous</a>";
                }

                // Page numbers
                for ($i = 1; $i <= $totalPages; $i++) {
                  echo "<a href='requests.php?page=$i' class='mx-2 px-4 py-2 bg-stone-500 text-white rounded-3xl'>$i</a>";
                }

                // Next page button
                if ($currentPage < $totalPages) {
                  echo "<a href='requests.php?page=" . ($currentPage + 1) . "' class='mx-2 px-4 py-2 bg-stone-500 text-white rounded-3xl'>Next</a>";
                }
              }
              ?>
            </div>
            <!--PAGE BUTTON END-->

            <script src="table.js"></script>
            <script>
              $(document).ready(function() {
                $('#getName').on("keyup", function() {
                  var getName = $(this).val();
                  $.ajax({
                    method: 'POST',
                    url: 'searchajax.php',
                    data: {
                      name: getName
                    },
                    success: function(response) {
                      $("#showdata").html(response);
                    }
                  });
                });
              });

              function SORTdropdown() {
                document.getElementById("sortDropdown").classList.toggle("show");
              }

              function YLdropdown() {
                document.getElementById("ylDropdown").classList.toggle("show");
              }

              function PROGRAMdropdown() {
                document.getElementById("programDropdown").classList.toggle("show");
              }

              // Close the dropdown menu if the user clicks outside of it
              window.onclick = function(event) {
                if (!event.target.matches('#dropbtn')) {
                  var dropdowns = document.getElementsByClassName("dropdown-content");
                  var i;
                  for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                      openDropdown.classList.remove('show');
                    }
                  }
                }
              }
            </script>
</body>

</html>