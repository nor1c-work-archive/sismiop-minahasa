<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>


<?php

include "../bin/dbconn.php";

$sql = "select * from dat_login";
$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));

//create an array
$emparray = array();
while($row = mysqli_fetch_assoc($result)) {
    array_push(
    $emparray,
    array(
       'a' => $row['NIP'],
       'x' => $row['NIP']
    ));
}

echo json_encode($emparray);
mysqli_close($conn);

?>
