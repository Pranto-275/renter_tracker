<?php
global $connection;
$message = "";
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['unit_price'])) {

    $price = $_POST['price'];
    $unit_range = $_POST['unit_range'];
    $month = $_POST['month'];

    // echo $user_id . $renter_room_no . $rent . $current_rent . $pre_due . $electric_rent . $others_bill . $rent_date;

    if (
      empty($price) || empty($unit_range) || empty($month)
    ) {
      $message = "empty";
    } else {
      $entry_unit_price_sql = "INSERT INTO unit_price(price_month,unit_range,price,created_by,
    last_update_by) 
    VALUES ('$month','$unit_range','$price','Pranto','Pranto')";
      $entry_unit_price_sql_result = mysqli_query($connection, $entry_unit_price_sql);
      if ($entry_unit_price_sql_result == true) {
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
          <h3>Add Unit Price</h3>

          <div class="box">
            <form action="add_unit_price.php" method="POST">
              <div class="row">
                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Month</label>
                    <select name="month" id="month" class="form-select">
                      <option value="" selected>Select Range</option>
                      <option value="January <?php echo date('Y') ?>">January <?php echo date('Y') ?></option>
                      <option value="February <?php echo date('Y') ?>">February <?php echo date('Y') ?></option>
                      <option value="March <?php echo date('Y') ?>">March <?php echo date('Y') ?></option>
                      <option value="April <?php echo date('Y') ?>">April <?php echo date('Y') ?></option>
                      <option value="May <?php echo date('Y') ?>">May <?php echo date('Y') ?></option>
                      <option value="June <?php echo date('Y') ?>">June <?php echo date('Y') ?></option>
                      <option value="July <?php echo date('Y') ?>">July <?php echo date('Y') ?></option>
                      <option value="August <?php echo date('Y') ?>">August <?php echo date('Y') ?></option>
                      <option value="August <?php echo date('Y') ?>">September <?php echo date('Y') ?></option>
                      <option value="October <?php echo date('Y') ?>">October <?php echo date('Y') ?></option>
                      <option value="November <?php echo date('Y') ?>">November <?php echo date('Y') ?></option>
                      <option value="December <?php echo date('Y') ?>">December <?php echo date('Y') ?></option>
                    </select>
                  </div>
                </div>
                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Unit Range</label>
                    <select name="unit_range" id="unit_range" class="form-select">
                      <option value="" selected>Select Range</option>
                      <option value="00-50">00-50</option>
                      <option value="51-100">51-100</option>
                      <option value="101-200">101-200</option>
                    </select>
                  </div>
                </div>

                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="text" class="form-control" name="price" id="price" />
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
                <button type="submit" name="unit_price" class="btn" style="background-color: rgb(21, 182, 21); color: white">
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

  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>