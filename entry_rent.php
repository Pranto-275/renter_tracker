<?php
global $connection;
$message = "";
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['entry_rent'])) {
    $user_id = $_POST['user_id'];
    // $renter_name = $_POST['renter_name'];
    $renter_room_no = $_POST['renter_room_no'];
    $rent = $_POST['rent'];
    $pre_due = $_POST['pre_due'];
    $current_rent = $_POST['current_rent'];
    $electric_rent = $_POST['electric_rent'];
    $others_bill = $_POST['others_bill'];
    $rent_date = $_POST['rent_date'];

    // echo $user_id . $renter_room_no . $rent . $current_rent . $pre_due . $electric_rent . $others_bill . $rent_date;

    if (
      empty($user_id) || empty($renter_room_no) || empty($rent) || empty($pre_due) || empty($current_rent)
      || empty($electric_rent) || empty($others_bill) || empty($rent_date)
    ) {
      $message = "empty";
    } else {
      $entry_rent_sql = "INSERT INTO rent_bill(user_id,room_number,rent_date,rent, previous_due, current_rent,
    electric_rent,other_bill,created_by,
    last_update_by) 
    VALUES ('$user_id','$renter_room_no','$rent_date','$rent','$pre_due','$current_rent',
    '$electric_rent','$others_bill','Pranto','Pranto')";
      $entry_rent_sql_result = mysqli_query($connection, $entry_rent_sql);
      if ($entry_rent_sql_result == true) {
        $message = "True";
      } else {
        $message = "False";
      }
    }
  }
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
          <h3>Entry Rent</h3>

          <div class="box">
            <form action="entry_rent.php" method="POST">
              <div class="row">
                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">User Id</label>
                    <select class="form-select" name="user_id" id="user_id" onchange="get_userInfo(this.value)">
                      <option value="" selected>Select Renter</option>
                      <?php echo $renter; ?>
                    </select>
                  </div>
                </div>
                <!-- <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Renter Name</label>
                    <input type="text" name="renter_name" id="renter_name" class="form-control" />
                  </div>
                </div> -->

                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Renter Room No:</label>
                    <input type="text" name="renter_room_no" id="renter_room_no" class="form-control" />
                  </div>
                </div>

                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Rent date</label>
                    <input type="date" name="rent_date" id="rent_date" class="form-control" />
                  </div>
                </div>

              </div>
              <div class="row">

                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Rent</label>
                    <input type="number" name="rent" id="rent" class="form-control" />
                  </div>
                </div>

                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Previous Due</label>
                    <input type="number" name="pre_due" id="pre_due" class="form-control" />
                  </div>
                </div>

                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Electric Rent</label>
                    <input type="number" name="electric_rent" id="electric_rent" class="form-control" onchange="electricbil()" />
                  </div>
                </div>



              </div>

              <div class="row">


                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Others bill</label>
                    <input type="number" name="others_bill" id="others_bill" class="form-control" />
                  </div>
                </div>

                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Current month Rent</label>
                    <input type="number" name="current_rent" id="current_rent" class="form-control" />
                  </div>
                </div>
                <!-- <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Month Rent</label>
                  <select name="" id=""></select>
                  </div>
                </div> -->
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
                <button type="submit" name="entry_rent" class="btn" style="background-color: rgb(21, 182, 21); color: white">
                  Add
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

  <script src="js/jquery-3.7.0.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>

  <script>
    function get_userInfo(user_id) {
      $.ajax({
        type: "post",
        url: "renter_tracker_ajax.php",
        data: {
          code: 101,
          user_id: user_id,
        },
        success: function(response) {
          // console.log(user_info);
          let user_info = JSON.parse(response);
          console.log(user_info);
          $("#renter_room_no").val(user_info.room_no);
          $("#rent").val(user_info.room_rent);
          $("#others_bill").val(user_info.other_amount);

          let current_rent = parseInt(user_info.room_rent) + parseInt(user_info.other_amount);
          $("#current_rent").val(current_rent);
        },
      });
    }


    function electricbil() {
      let current_bill_convert = $("#current_rent").val();
      let current_bill = parseInt(current_bill_convert);
      let electric_rent = parseInt($("#electric_rent").val());
      let total_current_bill = current_bill + electric_rent;

      $("#current_rent").val(total_current_bill);
    }
  </script>
</body>

</html>