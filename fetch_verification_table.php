<?php
// connect to database
include("connection.php");

// check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// fetch data from database
$sql = "SELECT 
sp.Provider_ID, 
u.First_Name, 
u.Last_Name, 
s.Service_Name, 
sp.Service_Desc, 
sp.Qualification_File, 
sp.Insurance_File, 
sp.Certificate_File, 
sp.Price, 
sp.Verification_status 
FROM 
tbl_service_provider sp 
INNER JOIN tbl_services s ON sp.Service_ID = s.Service_ID 
INNER JOIN tbl_user u ON sp.User_ID = u.User_ID WHERE sp.Verification_status = 'pending'";
$result = mysqli_query($con, $sql);


// generate table rows from data
$output = '';
if (mysqli_num_rows($result) > 0) {
    $output = '<thead>';
    $output .= '<tr>';
    $output .= '<th>#</th>';
    $output .= '<th>Name</th>';
    $output .= '<th>Service type</th>';
    $output .= '<th>Description</th>';
    $output .= '<th>Qualification</th>';
    $output .= '<th>Certification</th>';
    $output .= '<th>Insurance</th>';
    $output .= '<th>Price /hr</th>';
    $output .= '<th>Verify</th>';
    $output .= '</tr>';
    $output .= '</thead>';
    $count = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '<tr>';
        $output .= '<td>' . $count . '</td>';
        $output .= '<td>' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</td>';
        $output .= '<td>' . $row['Service_Name'] . '</td>';
        $output .= '<td>' . $row['Service_Desc'] . '</td>';
        $output .= '<td> <button class="btn btn-secondary pdf-button" onclick="window.open(`uploaded files/qualification/' . $row['Qualification_File'] . '`, `_blank`)">Qualification</button></td>';
        $output .= '<td> <button class="btn btn-secondary pdf-button" onclick="window.open(`uploaded files/certificates/' . $row['Certificate_File'] . '`, `_blank`)">Certificate</button></td>';
        $output .= '<td> <button class="btn btn-secondary pdf-button" onclick="window.open(`uploaded files/insurance/' . $row['Insurance_File'] . '`, `_blank`)">Insurance</button></td>';
        $output .= '<td>' . $row['Price'] . '</td>';
        $output .= '<td><a class="btn btn-primary" href="verify_provider.php?sp_id='.$row['Provider_ID'].'">
    Verify
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