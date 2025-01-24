<?php
require('conn.php');
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>G! Arat Na</title>
  <link rel="icon" type="image/x-icon" href="images/G!.png" />
  <link rel="stylesheet" href="style.css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <!-- Header -->
  <header>
    <nav class="flex w-full items-center justify-between gap-20 mt-10 max-md:max-w-full max-md:flex-wrap">
      <a href="index.php" class="flex items-stretch justify-between gap-5 my-auto max-md:max-w-full max-md:flex-wrap max-md:justify-center">
        <img src="images/G!.png" class="aspect-[4.09] object-contain object-center w-[200px] overflow-hidden shrink-0 max-w-full" alt="G! Arat Na" />
        <div class="justify-center self-start flex my-auto max-md:max-w-full max-md:flex-wrap max-md:justify-center">
          <a href="index.php" class="text-stone-900 text-center text-base font-extrabold leading-5">Home</a>
          <a href="events.php" class="text-black text-center text-base font-medium leading-5">Events</a>
          <a href="events.php" class="text-black text-center text-base font-medium leading-5">About</a>
          <?php
          if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            echo "<a href='logout.php' class='text-black text-center text-base font-medium leading-5'>Logout</a>";
          } else {
            echo "<a href='login.php' class='text-black text-center text-base font-medium leading-5'>Login</a>";
          }
          ?>
        </div>
      </a>
    </nav>
  </header>
  <!-- Carousel -->
  <div class="carousel">
    <!-- list items -->
    <div class="list">
      <div class="item">
        <img src="images/febibig.jpg" alt="Feb-Ibig 2024" />
        <div class="content">
          <div class="contentContainer">
            <div class="author">Central Student Government</div>
            <div class="title">Feb-Ibig 2024</div>
            <div class="des">
              The Central Student Government presents Feb-Ibig 2024. Get ready
              for an event filled with activities, fun, and romance!
            </div>
            <div class="buttons">
              <button type="button" onclick="location.href='regfeb.php'">Register</button>
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="images/DCS 2024.jpg" alt="DCS Week 2024" />
        <div class="content">
          <div class="contentContainer">
            <div class="author">Department of Computer Studies</div>
            <div class="title">DCS Week 2024</div>
            <div class="des">
              Gear up for DCS Week 2024! Join the Alliance of Computer
              Scientists and Information Technology Society in a week-long
              celebration of the Department of Computer Studies.
            </div>
            <div class="buttons">
              <button type="button" onclick="location.href='dcsweek.php'">Register</button>
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="images/Leadership and Mental Semianr.jpg" alt="Bin" />
        <div class="content">
          <div class="contentContainer">
            <div class="author">Central Student Government</div>
            <div class="title">Leadership and Mental Seminar</div>
            <div class="des">
              𝗔 𝗦𝗘𝗠𝗜𝗡𝗔𝗥 𝗠𝗔𝗗𝗘 𝗦𝗣𝗘𝗖𝗜𝗔𝗟𝗟𝗬 𝗙𝗢𝗥 𝗬𝗢𝗨. 💚🦋
            </div>
            <div class="buttons">
              <button type="button" onclick="location.href='leadershipAndmental.php'">Register</button>
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="images/mindmatters.jpg" alt="SBTown Music Fiesta" />
        <div class="content">
          <div class="contentContainer">
            <div class="author">La Liga Psicologia</div>
            <div class="title">MIND MATTERS</div>
            <div class="des">
              Mind Matters Seminar is set on 𝐌𝐚𝐲 𝟎𝟑, 𝟐𝟎𝟐𝟒, 8 AM onwards at SF,
              Multipurpose Hall, New Bldg.
            </div>
            <div class="buttons">
              <button type="button" onclick="location.href='mindmatters.php'">Register</button>
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="images/CSG Elections.jpg" alt="SBTown Music Fiesta" />
        <div class="content">
          <div class="contentContainer">
            <div class="author">Central Student Government</div>
            <div class="title">CSG ELECTIONS</div>
            <div class="des">
              Calling all CvSUeños!🗣️
              We are highly encouraging you to join us at 2024 Central Student Government's Miting de Avance.
            </div>
            <div class="buttons">
              <button type="button" onclick="location.href='csgelections.php'">Register</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- thumbnail -->
    <div class="thumbnail">
      <div class="item">
        <img src="images/CSG Elections.jpg" alt="Biniverse" class="border-solid border-2 border-slate-500" />
        <div class="content">
          <div class="font-bold text-gray-950">CSG LECTIONS</div>
        </div>
      </div>
      <div class="item">
        <img src="images/febibig.jpg" alt="Biniverse" class="border-solid border-2 border-slate-500" />
        <div class="content">
          <div class="font-bold text-gray-950">Feb-Ibig 2024</div>
        </div>
      </div>
      <div class="item">
        <img src="images/DCS 2024.jpg" alt="Biniverse" class="border-solid border-2 border-slate-500" />
        <div class="content">
          <div class="font-bold text-gray-950">DCS Week 2024</div>
        </div>
      </div>
      <div class="item">
        <img src="images/mindmatters.jpg" alt="Biniverse" class="border-solid border-2 border-slate-500" />
        <div class="content">
          <div class="font-bold text-gray-950">MIND MATTERS</div>
        </div>
      </div>
    </div>

    <!-- arrows -->
    <div class="arrows">
      <button id="prev">
        <img class="flex items-center p-2" src="images/bx-chevron-left.svg" alt="">
      </button>
      <button id="next">
        <img class="flex items-center p-2" src="images/bx-chevron-right.svg" alt="">
      </button>
    </div>
  </div>

  <div class="time"></div>
  <script src="app.js"></script>
</body>

</html>