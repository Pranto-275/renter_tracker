<?php
global $connection;
$message = "";
include 'connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['submit_calculator_data'])) {

    $month = $_POST['month'];
    $unit_range = $_POST['unit_range'];
    $unit_price = $_POST['unit_price'];
    $user_id = $_POST['user_id'];
    $sub_meter = $_POST['sub_meter'];
    $prv_month_unit = $_POST['prv_month_unit'];
    $cur_month_unit = $_POST['cur_month_unit'];
    $cur_month_bill = $_POST['cur_month_bill'];
    $due_bill = $_POST['due_bill'];
    $total_electric_bill = $_POST['total_electric_bill'];

    if (
      empty($month) || empty($unit_range) || empty($unit_price) || empty($user_id) || empty($sub_meter) || empty($prv_month_unit) || empty($cur_month_unit)
      || empty($due_bill)
    ) {
      $message = "empty";
    } else {
      $calculator_sql = "INSERT INTO unit_calculator(user_id,month,unit_range, unit_price, previous_month_unit, current_month_unit, 
      previous_due_bill, current_month_bill, total_electric_bill,created_by,last_update_by) 
    VALUES ('$user_id','$month','$unit_range','$unit_price','$prv_month_unit','$cur_month_unit',
    '$due_bill','$cur_month_bill','$total_electric_bill','Pranto','Pranto')";
      $calculator_sql_result = mysqli_query($connection, $calculator_sql);
      if ($calculator_sql_result == true) {
        $message = "True";
      } else {
        $message = "False";
      }
    }
  }
}


//month
$month_list = '';
$month_list_sql = "SELECT price_month,unit_range,unit_price_id FROM unit_price";
$month_list_sql_result = mysqli_query($connection, $month_list_sql);

while ($row = mysqli_fetch_assoc($month_list_sql_result)) {

  $month_list .= "<option value='{$row['unit_price_id']}'>{$row['price_month']} ---- ({$row['unit_range']})</option>";
}




//renter 

$renter = '';
$renter_sql = "SELECT user_id,full_name FROM renter ORDER BY 2 ASC";
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
          <h3>Unit Calculator</h3>

          <div class="box">
            <form action="unit_calculator.php" method="POST">
              <div class="row">

                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">User_id</label>
                    <select class="form-control" name="user_id" id="user_id">
                      <option value="" selected>Select User</option>
                      <?php echo  $renter; ?>
                    </select>
                  </div>
                </div>


                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Sub Meter</label>
                    <input type="number" class="form-control" name="sub_meter" id="sub_meter" />
                  </div>
                </div>

                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Previous Month Unit</label>
                    <input type="number" class="form-control" name="prv_month_unit" id="prv_month_unit" required />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Current Month Unit</label>
                    <input type="number" class="form-control" name="cur_month_unit" id="cur_month_unit" required />
                  </div>
                </div>



                <div class="col-3">
                  <div class="mb-3">
                    <label class="form-label">Month</label>
                    <select class="form-control" name="month" id="month" onchange="monthwiseData(this.value)">
                      <option value="" selected>Select Month</option>
                      <?php echo  $month_list; ?>
                    </select>
                  </div>
                </div>

                <div class="col-3">
                  <div class="mb-3">
                    <label class="form-label">Unit Range</label>
                    <input type="text" name="unit_range" id="unit_range" class="form-control" readonly />
                  </div>
                </div>

                <div class="col-2">
                  <div class="mb-3">
                    <label class="form-label">Used Unit</label>
                    <p style="color: red;" id="used_unit"></p>
                  </div>
                </div>


              </div>

              <div class="row">

                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Unit Price</label>
                    <input type="number" name="unit_price" id="unit_price" class="form-control" readonly />
                  </div>
                </div>

                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Previous Due Bill</label>
                    <input type="number" class="form-control" name="due_bill" id="due_bull" onchange="totalCurrentBill(this.value)" />
                  </div>
                </div>

                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Current Month Bill</label>
                    <input type="text" class="form-control" name="cur_month_bill" id="cur_month_bill" readonly />
                  </div>
                </div>
              </div>

              <div class="row">



                <div class="col-4">
                  <div class="mb-3">
                    <label class="form-label">Total Electric Bill</label>
                    <input type="number" class="form-control" name="total_electric_bill" id="total_electric_bill" readonly />
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
                <button type="submit" name="submit_calculator_data" class="btn" style="background-color: rgb(21, 182, 21); color: white">
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
    function monthwiseData(price_id) {
      $.ajax({
        type: "post",
        url: "renter_tracker_ajax.php",
        data: {
          code: 102,
          price_id: price_id,
        },
        success: function(response) {
          // console.log(response);
          let month_info = JSON.parse(response);
          console.log(month_info);
          $("#unit_range").val(month_info.unit_range);
          $("#unit_price").val(month_info.price);
          // $("#others_bill").val(user_info.other_amount);

          // let current_rent = parseInt(user_info.room_rent) + parseInt(user_info.other_amount);
          // $("#current_rent").val(current_rent);

          let current_unit = parseInt($("#cur_month_unit").val());
          let previous_unit = parseInt($("#prv_month_unit").val());
          let unit_price = parseFloat($("#unit_price").val());
          let total_unit = current_unit - previous_unit;
          console.log(total_unit)
          $("#used_unit").html(total_unit);
          total_current_bill = total_unit * unit_price;
          $("#cur_month_bill").val(total_current_bill)
          // console.log(total_unit);
        },
      });
    }


    function totalCurrentBill(due_prev_bill) {
      let due_bill = parseFloat(due_prev_bill);
      let current_month_bill = parseFloat($("#cur_month_bill").val());
      let total_bill = due_bill + current_month_bill;
      $("#total_electric_bill").val(total_bill)
    }
  </script>
</body>

</html>