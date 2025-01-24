<?php
session_start();
require 'conn.php';

if(isset($_POST['Pending']))
{
    $reg_id = mysqli_real_escape_string($conn, $_POST['Pending']);

    $result = $conn-> query("UPDATE registrations SET payment_status = 'Paid' WHERE reg_id=$reg_id;"); 
    header('Location:'. $_SERVER['HTTP_REFERER']);
}

if(isset($_POST['Paid']))
{
    $reg_id = mysqli_real_escape_string($conn, $_POST['Paid']);

    $result = $conn-> query("UPDATE registrations SET payment_status = 'Present' WHERE reg_id=$reg_id;"); 
    header('Location:'. $_SERVER['HTTP_REFERER']);
}

if(isset($_POST['Present']))
{
    $reg_id = mysqli_real_escape_string($conn, $_POST['present']);

    $result = $conn-> query("UPDATE registrations SET payment_status = 'Present' WHERE reg_id=$reg_id;"); 
    header('Location:'. $_SERVER['HTTP_REFERER']);
}

    /*$row = mysqli_fetch_assoc($result);
    
    $fullname = $row['fullname'];
    $student_num = $row['student_num'];
    $yr_sec = $row['yr_sec'];
    $program = $row['program'];
    $reqtype = $row['reqtype'];
    
    $complquery_run  = mysqli_query($conn, "INSERT INTO completed_request (fullname, student_num, ctrl_num, yr_sec, program, reqtype) VALUES ('$fullname','$student_num','$ctrl_num','$yr_sec','$program','$reqtype')");

    $delquery = "DELETE FROM request WHERE ctrl_num='$ctrl_num' ";
    $delquery_run = mysqli_query($conn, $delquery);/*

    
}

if(isset($_POST['miss']))
{
    $ctrl_num = mysqli_real_escape_string($conn, $_POST['miss']);

    $result = $conn-> query("SELECT * FROM request WHERE ctrl_num=$ctrl_num"); 

    $row = mysqli_fetch_assoc($result);
    
    $fullname = $row['fullname'];
    $student_num = $row['student_num'];
    $yr_sec = $row['yr_sec'];
    $program = $row['program'];
    $reqtype = $row['reqtype'];
    
    $missquery_run  = mysqli_query($conn, "INSERT INTO missed_request (fullname, student_num, ctrl_num, yr_sec, program, reqtype) VALUES ('$fullname','$student_num','$ctrl_num','$yr_sec','$program','$reqtype')");

    $del2query = "DELETE FROM request WHERE ctrl_num='$ctrl_num' ";
    $del2query_run = mysqli_query($conn, $del2query);

    header('Location:requests.php');
}


if(isset($_POST['accept']))
{
    $stud_num = mysqli_real_escape_string($conn, $_POST['accept']);

    $result = $conn-> query("SELECT * FROM enrollees WHERE stud_num=$stud_num"); 

    $row = mysqli_fetch_assoc($result);
    
    $first_n = $row['first_n'];
    $mid_n = $row['mid_n'];
    $last_n = $row['last_n'];
    $year_lvl = $row['year_lvl'];
    $stud_num = $row['stud_num'];
    $email = $row['email'];
    $program = $row['program'];
    $sex = $row['sex'];
    $bday = $row['bday'];
    $civstatus = $row['civstatus'];
    $contactno = $row['contactno'];
    $religion = $row['religion'];
    $street = $row['street'];
    $country = $row['country'];
    $province = $row['province'];
    $municipality = $row['municipality'];
    $barangay = $row['barangay'];
    $zip_code = $row['zip_code'];
    $elem_school = $row['elem_school'];
    $jh_school = $row['jh_school'];
    $sh_school = $row['sh_school'];
    $vocational = $row['vocational'];
    $college_trans = $row['college_trans'];
    //$ = $row[''];

    
    $complquery_run  = mysqli_query($conn, "INSERT INTO students (year_lvl, program,first_n, mid_n, last_n, sex, bday, civstatus, contactno, email, religion, street, country, province, municipality, barangay, zip_code, elem_school, jh_school, sh_school, vocational, college_trans) VALUES ('$year_lvl', '$program','$first_n', '$mid_n', '$last_n', '$sex', '$bday', '$civstatus', '$contactno', '$email', '$religion', '$street', '$country', '$province', '$municipality', '$barangay', '$zip_code', '$elem_school', '$jh_school', '$sh_school', '$vocational', '$college_trans')");

    $delquery = "DELETE FROM enrollees WHERE stud_num='$stud_num' ";
    $delquery_run = mysqli_query($conn, $delquery);

    header('Location:Enrollees.php');
}

if(isset($_POST['reject']))
{
    $stud_num = mysqli_real_escape_string($conn, $_POST['reject']);

    $result = $conn-> query("SELECT * FROM enrollees WHERE stud_num=$stud_num"); 

    $missquery_run  = mysqli_query($conn, "INSERT INTO missed_request (fullname, student_num, ctrl_num, yr_sec, program, reqtype) VALUES ('$fullname','$student_num','$ctrl_num','$yr_sec','$program','$reqtype')");

    $del2query = "DELETE FROM enrollees WHERE stud_num='$stud_num' ";
    $del2query_run = mysqli_query($conn, $del2query);

    header('Location:Enrollees.php');
}
*/



