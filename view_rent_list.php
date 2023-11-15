<?php
global $connection;
include 'connection.php';

$view_all_rents = "SELECT (SELECT full_name FROM renter rn WHERE rn.user_id = rb.user_id) current_renter,room_number,rent_date,rent,other_bill,previous_due,current_rent,electric_rent FROM rent_bill rb";
$view_all_rents_result = mysqli_query($connection, $view_all_rents);



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
                  <th>Renter</th>
                  <th>Room Number</th>
                  <th>Paid Date</th>
                  <th>Rent</th>
                  <th>Other Bill</th>
                  <th>Previous Due</th>
                  <th>Current Rent</th>
                  <th>Electric Bill</th>


                </tr>
              </thead>
              <tbody>

                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($view_all_rents_result)) { ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['current_renter']; ?></td>
                    <td><?php echo $row['room_number']; ?></td>
                    <td><?php echo $row['rent_date']; ?></td>
                    <td><?php echo $row['rent']; ?></td>
                    <td><?php echo $row['other_bill']; ?></td>
                    <td><?php echo $row['previous_due']; ?></td>
                    <td><?php echo $row['current_rent']; ?></td>
                    <td><?php echo $row['electric_rent']; ?></td>
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