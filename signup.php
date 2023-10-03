<?php
$success = 0;
$user = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    /* Verify that username does not already exist in database. Key is set to unique, but this is to display on the webpage itself for the user to see. */
    $sql = "Select * from `registration` where username='$username'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $user = 1;
        } else {
            $sql = "insert into `registration` (username, password) values('$username', '$password')";
            $result = mysqli_query($con, $sql);

            if ($result) {
                $success = 1;
            } else {
                die(mysqli_error($con));
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width = device-width, initial-scale = 1, shrink-to-fit = no">

    <!-- BootStrap Import -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>JuviScript: Create An Account</title>
</head>

<?php
if ($user) {
    echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        <strong>Username Already Exists:</strong> Try another one!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}

if ($success) {
    echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        <strong>Profile Created Successfully</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}
?>

<body class="bg-primary-gradient">
    <div class="container rounded w-25 h-auto mx-auto my-5 bg-dark p-3 text-light ">
        <h1 class="text-center my-4">Signup</h1>

        <form action="signup.php" method="post">
            <div class="mb-2 mx-auto w-100">
                <label for="first-name" class="form-label">First Name</label>
                <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="John Jacob"
                    name="first">
            </div>

            <div class="mb-2 mx-auto w-100">
                <label for="last-name" class="form-label">Last Name</label>
                <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Jingleheimer Schmidt"
                    name="last">
            </div>

            <div class="mb-2 mx-auto w-100">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="imdabes@gmail.com"
                    name="last">
            </div>

            <div class="mb-2 mx-auto w-100">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="ex: PewDiePie"
                    name="username">
            </div>

            <div class="mb-5 mx-auto w-100">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter your *top secret* password"
                    name="password">
            </div>

            <button type=" submit" class="btn btn-primary w-100 my-3">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>

</body>

</html>