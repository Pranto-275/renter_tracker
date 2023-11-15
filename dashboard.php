<?php
global $connection;
include 'connection.php';

$count_renter = "SELECT COUNT(user_id) count FROM renter";
$count_renter_result = mysqli_query($connection, $count_renter);
$row = mysqli_fetch_assoc($count_renter_result);
$count = $row['count'];



$total_rent = "SELECT sum(current_rent) total_rent FROM rent_bill";
$total_rent_result = mysqli_query($connection, $total_rent);
$row = mysqli_fetch_assoc($total_rent_result);
$total_rent_sum = $row['total_rent'];




$total_current_bill = "SELECT sum(total_electric_bill) total_electric_bill FROM unit_calculator";
$total_current_bill_result = mysqli_query($connection, $total_current_bill);
$row = mysqli_fetch_assoc($total_current_bill_result);
$total_electric_bill = $row['total_electric_bill'];

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
        <a class="navbar-brand" href="#">Unit Measure Apps</a>
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
        <div class="content" style="padding: 30px">
          <!-- content start -->
          <h3>Dashboard</h3>
          <div class="row text-center">
            <div class="col-3 p-2">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Total Renter</h5>
                  <h1 style="color: blue"><?php echo $count; ?></h1>
                </div>
              </div>
            </div>

            <div class="col-3 p-2">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Total Rent</h5>
                  <h1 style="color: Red"><?php echo $total_rent_sum; ?></h1>
                </div>
              </div>
            </div>

            <div class="col-3 p-2">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Total Current Bill</h5>
                  <h1 style="color: Red"><?php echo $total_electric_bill; ?></h1>
                </div>
              </div>
            </div>

            <!-- <div class="col-3 p-2">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Current Year Bill</h5>
                  <h1 style="color: black">5</h1>
                </div>
              </div>
            </div> -->
          </div>
        </div>

        <!-- content end -->
      </div>
    </div>
  </div>

  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>