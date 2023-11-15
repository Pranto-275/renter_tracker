<?php
global $connection;
include 'connection.php';

$view_bills = "SELECT (SELECT full_name FROM renter r where r.user_id = uc.user_id  ) user_name,
(SELECT price_month FROM unit_price up WHERE up.unit_price_id = uc.month ) month_name,unit_range,unit_price,
sub_meter,current_month_unit - previous_month_unit used_unit,previous_due_bill,total_electric_bill FROM unit_calculator uc ORDER BY 1 desc";
$view_bills_result = mysqli_query($connection, $view_bills);




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
  <link rel="stylesheet" href="css/jquery.dataTables.min.css" />
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
          <h3>View Rent List</h3>

          <div class="box">
            <table id="example" class="display" style="width: 100%">
              <thead>
                <tr>
                  <th>No:</th>
                  <th>ID</th>
                  <th>Month</th>
                  <th>Unit Range</th>
                  <th>Unit Price</th>
                  <th>Sub Meter</th>
                  <th>Used Unit</th>
                  <th>Due Bill</th>
                  <th>Total Amount</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($view_bills_result)) { ?>


                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['month_name']; ?></td>
                    <td><?php echo $row['unit_range']; ?></td>
                    <td><?php echo $row['unit_price']; ?></td>
                    <td><?php echo $row['sub_meter']; ?></td>
                    <td><?php echo $row['used_unit']; ?></td>
                    <td><?php echo $row['previous_due_bill']; ?></td>
                    <td><?php echo $row['total_electric_bill']; ?></td>

                  </tr>

                <?php

                  $i++;
                }

                ?>


              </tbody>
              <!-- <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
              </tfoot> -->
            </table>
          </div>

          <!-- content end -->
        </div>

        <!-- content end -->
      </div>
    </div>
  </div>

  <script src="js/jquery-3.7.0.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script>
    new DataTable("#example");
  </script>
</body>

</html>