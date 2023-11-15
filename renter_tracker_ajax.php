<?php
global $connection;

include 'connection.php';



if ($_POST['code'] == 101) {

    $user_id = $_POST['user_id'];
    // echo $department_id . $sub_section_id;

    $sql = "SELECT full_name,(SELECT room_number FROM room r where r.current_renter = rn.user_id ) room_no,
    room_rent,other_amount
     FROM `renter` rn WHERE user_id = '$user_id'";
    $sql_result = mysqli_query($connection, $sql);
    $data = mysqli_fetch_assoc($sql_result);
    echo json_encode($data);
}



if ($_POST['code'] == 102) {

    $price_id = $_POST['price_id'];
    // echo $department_id . $sub_section_id;

    $sql = "SELECT * FROM `unit_price` WHERE unit_price_id = '$price_id'";
    $sql_result = mysqli_query($connection, $sql);
    $data = mysqli_fetch_assoc($sql_result);
    echo json_encode($data);
}
