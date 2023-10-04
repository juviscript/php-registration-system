<?php
$success = 0;
$user = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];


    /* Verify that username does not already exist in database. 
    Key is set to unique, but this is to display on the webpage itself for the user to see. */

    $sql = "Select * from `registration` where username='$username'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $user = 1;
        } else {
            $sql = "insert into `registration` (username, password, firstname, lastname, email) values('$username', '$password', '$firstname', '$lastname', '$email')";
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
    <link rel="stylesheet" href="styles/main.css">

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
        <strong>Profile Created Successfully</strong> Click here to login: <a href = "login.php"> Login</a> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}
?>

<body>
    <div class="container-fluid bg-gradient bg-dark w-100" id="background">
        <div class="container rounded w-50 h-auto mx-auto my-5 bg-dark p-3 text-white ">
            <h1 class="text-center my-4">Sign-Up</h1>

            <form action="signup.php" method="post">
                <div class="row">
                    <div class="mb-2 mx-auto w-50 column">
                        <label for="first-name" class="form-label">First Name</label>
                        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="John Jacob"
                            name="firstname">
                    </div>

                    <div class="mb-2 mx-auto w-50 column">
                        <label for="last-name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" aria-describedby="emailHelp"
                            placeholder="Jingleheimer Schmidt" name="lastname">
                    </div>
                </div>

                <div class="row">
                    <div class="mb-2 mx-auto w-50">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="ex: PewDiePie"
                            name="username">
                    </div>

                    <div class="mb-2 mx-auto w-50">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" aria-describedby="emailHelp"
                            placeholder="imdabes@gmail.com" name="email">
                    </div>
                </div>

                <div class="mb-5 mx-auto w-50">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Enter your *top secret* password"
                        name="password">
                </div>

                <button type=" submit" class="btn btn-primary w-100 my-3">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>