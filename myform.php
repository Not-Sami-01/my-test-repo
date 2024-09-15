<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="https://img.icons8.com/?size=100&id=XBMnwwJYQvfN&format=png&color=000000"
        type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice</title>
</head>

<body>
    <div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Contact Us</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Insert</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Show Table</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
    <!-- Form -->
    <div class="container mt-4">
        <form action="myform.php" method="post">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Name</label>
                <input type="text" required name="name" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Email</label>
                <input type="text" required name="email" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Concern</label>
                <input type="text" required name="concern" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <!-- Insert into table -->
    <div class="container">
        <?php

        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'mydatabase';
        $Technicalerror = '<div class="alert mt-2 alert-warning alert-dismissible fade show" role="alert">
  <strong>Error!</strong> Sorry we are facing some technical issues.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
        try {
            $connect = mysqli_connect($servername, $username, $password, $dbname);

        } catch (Exception $e) {
            echo $Technicalerror;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['name'], $_POST['concern'], $_POST['email'])) {
                try {
                    $name = $_POST['name'];
                    $concern = $_POST['concern'];
                    $email = $_POST['email'];
                    $sql = "INSERT INTO `mytable` (`name`, `email`, `concern`, `dt`) VALUES ( '$name', '$email', '$concern', current_timestamp());";
                    $tf = mysqli_query(mysqli_connect($servername, $username, $password, $dbname), $sql);
                    if ($tf) {
                        echo '<div class="alert mt-2 alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Record inserted successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
                    } else {
                        echo $Technicalerror;
                    }
                } catch (Exception $e) {
                    echo $Technicalerror;
                }
            } else {
                echo '<div class="alert mt-2 alert-warning alert-dismissible fade show" role="alert">
  <strong>Error!</strong> Form fields are not set.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
            }
        }

        ?>
    </div>
    <!-- Show Table -->
    <div class="container mt-5" id="first">
        <h1>Table </h1>
        <?php
        // Connecting to the database
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'mydatabase';

        // Creating a connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Die if connection was not successful
        if (!$conn) {
            die("Sorry we failed to connect: " . mysqli_connect_error());
        }
        $sql2 = 'SELECT * FROM `mytable`';
        $data = mysqli_query($conn, $sql2);
        $num = mysqli_num_rows($data);
        if ($num > 0) {
            echo '<div class ="container">
        <table class="table">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Concerns</th>
          <th scope="col">Date Time</th>
        </tr>
      </thead>
      <tbody>';
            for ($i = 1; $i <= $num; $i++) {
                $row = mysqli_fetch_assoc($data);
                foreach ($row as $key => $value) {
                    if ($key == 'sno') {
                        echo "<th scope='row'>" . $i . "</th>";
                        continue;
                    }
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }
            echo "<tbody></table> </div>";
        } else {
            echo '<div class="alert mt-2 alert-warning alert-dismissible fade show" role="alert">
  <strong>Not Found!</strong> There is no data in your table.</div>';
        }
        ?>
    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</html>