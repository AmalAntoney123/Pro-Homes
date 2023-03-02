<?php
// connect to database
include("connection.php");


// fetch data from database
$sql = "SELECT * FROM `tbl_user`";
$result = mysqli_query($con, $sql);


// generate table rows from data
$output = '';
if (mysqli_num_rows($result) > 0) {
    $output = '<thead>';
    $output .= '<tr>';
    $output .= '<th>#</th>';
    $output .= '<th>Name</th>';
    $output .= '<th>Username</th>';
    $output .= '<th>Email </th>';
    $output .= '<th>Phone_Number</th>';
    $output .= '<th>City</th>';
    $output .= '<th>User Type</th>';
    $output .= '<th>Action</th>';
    $output .= '</tr>';
    $output .= '</thead>';
    $count = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '<tr>';
        $output .= '<td>' . $count . '</td>';
        $output .= '<td>' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</td>';
        $output .= '<td>' . $row['Username'] . '</td>';
        $output .= '<td>' . $row['Email'] . '</td>';
       $output .= '<td>' . $row['Phone_Number'] . '</td>';
       $output .= '<td>' . $row['City'] . '</td>';
       $output .= '<td>' . $row['User_Type'] . '</td>';
        $output .= '<td><a class="btn btn-primary" href="user_disable.php?sp_id='.$row['User_ID'].'">
    Disable
</a></td>';
        $output .= '</tr>';
        $count++;
    }
} else {
    $output .= '<tr><td colspan="9">No Pending Request</td></tr>';
}

// send table rows back to Ajax
echo $output;

// close connection
mysqli_close($conn);
?>