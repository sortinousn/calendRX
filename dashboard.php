<?php
include 'session.php';
include 'dbconf.php';
$userid = mysqli_real_escape_string($con, $_SESSION['userid']);

// Add a new medication
if (isset($_POST["add"])) {
    $name = mysqli_real_escape_string($con, $_POST["name"]);
    $userid = mysqli_real_escape_string($con, $_SESSION['userid']);
    $dose = mysqli_real_escape_string($con, $_POST['dose']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    $refill = mysqli_real_escape_string($con, $_POST['refill']);
    $dose_count = mysqli_real_escape_string($con, $_POST['dose_count']);
    $frequency = mysqli_real_escape_string($con, $_POST['frequency']);
    $query = mysqli_query($con, "INSERT INTO medications (user_id, name, dose, quantity, refill_date,frequency,dose_count ) VALUES ('$userid', '$name','$dose','$quantity','$refill','$frequency','$dose_count')") or die(mysqli_error($con));
    header("Location: dashboard.php");
}

// Delete a medication from DB
if (isset($_POST["delete"])) {
    $id = mysqli_real_escape_string($con, $_POST["id"]);
    $query = mysqli_query($con, "DELETE FROM medications WHERE id = '$id'") or die(mysqli_error($con));
    header("Location: dashboard.php");
}

// Retrieve all medications for user

$table_sql = "SELECT * FROM medications where user_id = '$userid'";
$table_query = mysqli_query($con, $table_sql);

?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/css/mdb.min.css" rel="stylesheet">
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js">
    </script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/js/mdb.min.js">
    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.4.2/css/uikit.min.css" rel="stylesheet">
    <script type="text/javascript" src="https: //cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.4.2/js/uikit.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js">
    </script>

    <script src="../js/datepicker.js"></script>

</head>
<header>

    <nav class="navbar navbar-expand-lg navbar-dark primary-color">
        <a class="navbar-brand" href="#"><strong>CalendRX</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Dashboard<span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="btn btn-danger" href="logout.php">Logout<span class="sr-only">(current)</span></a>
                </li>
        </div>
    </nav>
</header>
<h2>Welcome, <?php echo $_SESSION['firstname'] ?></h2>

<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="../dashboard.php" method="post">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">New Prescription Form</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <input type="text" name="name" id="name" class="form-control validate" required>
                        <label data-error="wrong" data-success="right" for="name">Prescription Name</label>
                    </div>
                    <div class="md-form mb-5">
                        <input type="text" name="dose" id="dose" value="0" class="form-control validate" required>
                        <label data-error="wrong" data-success="right" for="dose">Dose in milligrams</label>
                    </div>
                    <label data-error="wrong" data-success="right" for="dosequantity">Dose Count</label>
                    <select name="dose_count" class="browser-default custom-select mb-4">
                        <option value="" disabled>Dose Quantity</option>
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                    <label data-error="wrong" data-success="right" for="frequency">Frequency</label>
                    <select name="frequency" class="browser-default custom-select mb-4">
                        <option value="" disabled>Frequency</option>
                        <option value="daily" selected>Daily</option>
                        <option value="weekly">Weekly</option>
                    </select>

                    <div class="md-form mb-5">
                        <input type="text" name="quantity" id="quantity" class="form-control validate">
                        <label data-error="wrong" data-success="right" for="quantity">Quantity</label>
                    </div>
                    <div class="md-form mb-5">
                        <input type="text" name="refill" placeholder="yyyy-mm-dd"
                            pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" maxlength="10" />
                        <label data-error="wrong" data-success="right" for="refill">Refill Date</label>

                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button name="add" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="text-center">
    <a href="" class="btn btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm">Add
        New Prescription</a>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Dose</th>
            <th scope="col">Refill Date</th>
            <th scope="col">Frequency</th>
            <th scope="col">Dose Count</th>
        </tr>
    </thead>
    <tbody>

        <?php
while ($row = mysqli_fetch_array($table_query)) {
    echo '<tr>
          <td>' . $row['name'] . '</td>
          <td>' . $row['quantity'] . '</td>
          <td>' . $row['dose'] . '</td>
          <td>' . $row['refill_date'] . '</td>
          <td>' . $row['frequency'] . '</td>
          <td>' . $row['dose_count'] . '</td>
         <td>
        <form action="../dashboard.php" method="post">
   <input type=hidden name=id value="' . $row["id"] . '" >
                <input type=submit value=Delete name=delete >
</form> </td>
 </tr>';
}
?>
    </tbody>
</table>
</body>


</html>