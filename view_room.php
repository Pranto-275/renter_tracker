<?php
global $connection;
include 'connection.php';

$view_room_sql = "SELECT room_number,room_category,(SELECT category FROM room_category rc WHERE rc.id  = r.room_category ) Catagory_name ,room_place,
                (SELECT full_name FROM renter rn WHERE rn.user_id = r.current_renter ) current_renter,room_stove,room_status FROM ROOM r";
$view_room_result = mysqli_query($connection, $view_room_sql);



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
          <h3>View Room</h3>

          <div class="box">
            <table id="example" class="display" style="width: 100%">
              <thead>
                <tr>
                  <th>No:</th>
                  <th>Room Number</th>
                  <th>Room Category</th>
                  <th>Room Place</th>
                  <th>Renter</th>
                  <th>Room Stove</th>
                  <th>Status</th>

                </tr>
              </thead>
              <tbody>

                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($view_room_result)) { ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['room_number']; ?></td>
                    <td><?php echo $row['Catagory_name']; ?></td>
                    <td><?php echo $row['room_place']; ?></td>
                    <td><?php echo $row['current_renter']; ?></td>
                    <td><?php echo $row['room_stove']; ?></td>
                    <td>
                      <?php
                      if ($row['room_status'] == '1') {  ?>
                        <span style="color: #44bd32;">Active</span>
                      <?php } else {  ?>
                        <span style="color: #c0392b;">InActive</span>
                      <?php }
                      ?>
                    </td>
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