<?php
global $connection;
$message = "";
include 'connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['submit_room'])) {

    $roomNumber = $_POST['room_number'];
    $roomCategory = $_POST['room_category'];
    $roomPlace = $_POST['room_place'];
    $roomStatus = $_POST['room_status'];
    $currentRenter = $_POST['current_renter'];
    $roomStove = $_POST['room_stove'];

    if (
      empty($roomNumber) || empty($roomCategory) || empty($roomPlace) || empty($roomStatus) || empty($roomStove)
    ) {
      $message = "empty";
    } else {
      $add_room_sql = "INSERT INTO room(room_number,room_category,room_place, current_renter, room_status,
    room_stove,created_by,last_update_by) 
    VALUES ('$roomNumber','$roomCategory','$roomPlace','$currentRenter','$roomStatus',
    '$roomStove','Pranto','Pranto')";
      $add_room_sql_result = mysqli_query($connection, $add_room_sql);
      if ($add_room_sql_result == true) {
        $message = "True";
      } else {
        $message = "False";
      }
    }
  }
}


//room category 
$catagory = '';
$room_cat_sql = "SELECT * FROM room_category ORDER BY 2 asc";
$room_cat_sql_result = mysqli_query($connection, $room_cat_sql);

while ($row = mysqli_fetch_assoc($room_cat_sql_result)) {

  $catagory .= "<option title= '{$row['id']}'' value='{$row['id']}'>{$row['category']}</option>";
  // $select_str .= "<option value='{$row['ITEM_ID']}'>{$row['DESCRIPTION']}</option>";
}



//renter 

$renter = '';
$renter_sql = "SELECT user_id,full_name FROM renter ORDER BY 2 asc";
$renter_sql_result = mysqli_query($connection, $renter_sql);

while ($row = mysqli_fetch_assoc($renter_sql_result)) {

  $renter .= "<option title= '{$row['user_id']}'' value='{$row['user_id']}'>{$row['full_name']}</option>";
  // $select_str .= "<option value='{$row['ITEM_ID']}'>{$row['DESCRIPTION']}</option>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Unit Measure Apps</title>
  <link rel="stylesheet" href="css/all.min.css" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar_background">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Renter Tracker Apps</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
          <span class="navbar-text"> </span>
        </div>
      </div>
    </nav>
  </div>

  <div class="container-fluid">
    <div class="row flex-nowrap">
      <?php include 'sidebar.php'; ?>
      <div class="col py-3">
        <div class="content" style="padding: 35px">
          <!-- content start -->
          <h3>Add Room</h3>

          <div class="box">
            <form method="POST">
              <div class="row">
                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Room Number</label>
                    <input type="text" name="room_number" class="form-control" />
                  </div>
                </div>
                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Room Category</label>
                    <select class="form-select" name="room_category">
                      <option value="" selected>Select Category</option>
                      <?php echo $catagory; ?>
                    </select>
                  </div>
                </div>

                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Room Place</label>
                    <input type="text" class="form-control" name="room_place" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Room Status</label>
                    <select class="form-select" name="room_status">
                      <option value="" selected>Select Status</option>
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                </div>
                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Current Renter</label>
                    <select class="form-select" name="current_renter">
                      <option value="" selected>Select Renter</option>
                      <?php echo $renter; ?>
                    </select>
                  </div>
                </div>

                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Room Stove</label>
                    <select class="form-select" name="room_stove">
                      <option value="" selected>Select Stove</option>
                      <option value="single">single</option>
                      <option value="personal">Personal</option>
                      <option value="combined">combined</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="text-end">
                <?php
                if ($message == 'True') {  ?>
                  <span style="color: green;"><b>Data Saved Successfully!! <i class="fa-solid fa-thumbs-up fa-xl"></i></b></span>
                <?php  } else if ($message == 'False') {  ?>
                  <span style="color: Red;"><b>Data Not Saved!! <i class="fa-solid fa-xmark fa-xl"></i></b></span>
                <?php } else if ($message == 'empty') { ?>
                  <span style="color: #f39c12;"><b>Empty Field</b> <i class="fa-solid fa-expand fa-xl"></i></span>
                <?php   }
                ?>
                <button type="submit" name="submit_room" class="btn" style="background-color: rgb(21, 182, 21); color: white">
                  Add Room
                </button>
              </div>
            </form>
          </div>

          <!-- content end -->
        </div>

        <!-- content end -->
      </div>
    </div>
  </div>

  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>