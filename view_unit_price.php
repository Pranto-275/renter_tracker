<?php
global $connection;
include 'connection.php';

$view_unit_price_sql = "SELECT * FROM unit_price";
$view_unit_price = mysqli_query($connection, $view_unit_price_sql);



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
          <h3>View Unit Price</h3>

          <div class="box">
            <table id="example" class="display" style="width: 100%">
              <thead>
                <tr>
                  <th>No:</th>
                  <th>Price Month</th>
                  <th>Price Range</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($view_unit_price)) { ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['price_month']; ?></td>
                    <td><?php echo $row['unit_range']; ?></td>
                    <td><?php echo $row['price']; ?></td>
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