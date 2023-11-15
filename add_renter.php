<?php
global $connection;
$message = "";
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['submit_renter'])) {
    $fullName = $_POST['full_name'];
    $permanentAddress = $_POST['permanent_address'];
    $familyMembers = $_POST['family_members'];
    $jobLocation = $_POST['job_location'];
    $spouse = $_POST['spouse'];
    $children = $_POST['children'];
    $nid = $_POST['nid'];
    $phn1 = $_POST['phn1'];
    $phn2 = $_POST['phn2'];
    $entryDate = $_POST['entry_date'];
    $roomRent = $_POST['room_rent'];
    $otherAmount = $_POST['other_amount'];
    $totalAmount = $_POST['total_amount'];


    if (
      empty($fullName) || empty($permanentAddress) || empty($familyMembers) || empty($jobLocation) || empty($spouse)
      || empty($children) || empty($nid) || empty($phn1) ||  empty($entryDate) ||  empty($roomRent) ||  empty($otherAmount) || empty($totalAmount)
    ) {
      $message = "empty";
    } else {
      $add_renter_sql = "INSERT INTO renter(full_name,permanent_address,family_members,job_location, spouse, children,
  national_id,phone_1, phone_2, entry_date, room_rent, other_amount, total_rent_amount, created_by,
  last_update_by) 
  VALUES ('$fullName','$permanentAddress','$familyMembers','$jobLocation','$spouse','$children',
  '$nid','$phn1','$phn2','$entryDate','$roomRent','$otherAmount','$totalAmount','Pranto','Pranto')";
      $add_renter_sql_result = mysqli_query($connection, $add_renter_sql);
      if ($add_renter_sql_result == true) {
        $message = "True";
      } else {
        $message = "False";
      }
    }
  }
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
          <h3>Add Renter</h3>

          <div class="box">
            <form action="add_renter.php" method="POST">
              <div class="row">
                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="full_name" class="form-control" />
                  </div>
                </div>

                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Permanent Address</label>
                    <input type="text" name="permanent_address" class="form-control" />
                  </div>
                </div>
                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Family Members</label>
                    <input type="number" name="family_members" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Job Location</label>
                    <input type="text" name="job_location" class="form-control" />
                  </div>
                </div>
                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Spouse</label>
                    <input type="text" name="spouse" class="form-control" />
                  </div>
                </div>

                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Children</label>
                    <input type="number" name="children" class="form-control" />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">National ID</label>
                    <input type="number" name="nid" class="form-control" />
                  </div>
                </div>
                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Phone 1</label>
                    <input type="number" name="phn1" class="form-control" />
                  </div>
                </div>

                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Phone 2</label>
                    <input type="number" name="phn2" class="form-control" />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-3">
                  <div class="mb-3">
                    <label class="form-label">Entry date</label>
                    <input type="date" name="entry_date" class="form-control" />
                  </div>
                </div>
                <div class="col-3">
                  <div class="mb-3">
                    <label class="form-label">Room Rent</label>
                    <input type="number" name="room_rent" class="form-control" id="room_rent" />
                  </div>
                </div>

                <div class="col-3">
                  <div class="mb-3">
                    <label class="form-label">Other Amount</label>
                    <input type="number" name="other_amount" class="form-control" id="other_amount" onchange="totalAmount()" />
                  </div>
                </div>
                <div class="col-3">
                  <div class="mb-3">
                    <label class="form-label">Total Rent Amount</label>
                    <input type="number" name="total_amount" id="total_amount" class="form-control" />
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
                <button type="submit" name="submit_renter" class="btn" style="background-color: rgb(21, 182, 21); color: white">
                  <i class="fa-solid fa-floppy-disk fa-xl"></i> Add
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
    function totalAmount() {
      let room_rent = parseInt($("#room_rent").val());
      let current_unit = parseInt($("#other_amount").val());
      total_rent = room_rent + current_unit;
      $("#total_amount").val(total_rent)
    }
  </script>
</body>

</html>