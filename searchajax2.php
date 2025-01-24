<?php 
  include("conn.php");
  
  if ((isset( $_POST['name']))){

    //$request_url=( $_SERVER["HTTP_REFERER"]);
  
   $name = $_POST['name'];
   //$event_id = intval(substr($request_url,49));


   $sql = "SELECT * FROM registrations JOIN events ON registrations.event_id = events.`event-id` JOIN users ON registrations.user_id = users.`user-id` WHERE (reg_id LIKE '{$name}%' OR studentNum LIKE '{$name}%') AND (payment_status='Pending')";  
   $query = mysqli_query($conn,$sql);
   $data='';
   $numrows = mysqli_num_rows($query);
   if (mysqli_num_rows($query) > 0)
   {while($row = mysqli_fetch_assoc($query))
   {
       $data .=  "<tr><td>". $row["reg_id"]."</td>
       <td>". $row["title"]."</td>
       <td>". $row["studentNum"]."</td>
       <td>". $row["fullname"]."</td>
       <td>". $row["program"]."</td>
       <td>". $row["payment_mode"]."</td>
       <td>". $row["payment_status"]."</td>
       <td>
       <form action='actionbutton.php' method='POST'>
       <button name='".$row["payment_status"]."' value='".$row['reg_id']."' class='bg-stone-500 text-white text-sm leading-5 font-medium rounded-full px-2 py-2 mr-2'>
         <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' style='fill: #ffffff;transform: msFilter'>
           <path d='m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z'></path></svg></button>
       
                        </td>
       <td></tr>";
   }
    echo $data;}
  else {
    echo "No records";
  }}
 ?>

