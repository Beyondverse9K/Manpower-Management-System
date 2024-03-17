<?php //Signup
$showAlert = false;
$showError = false;
if(isset($_POST["asignup"])){
    include ('admindb.php');
    $username = $_POST["username"];
    $password = $_POST["password"];
    // $exists=false;

    // Check whether this username exists
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        // $exists = true;
        $showError = "Username Already Exists";
    }
    else{
        // $exists = false; 
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` ( `username`, `password`) VALUES ('$username', '$hash')";
            $result = mysqli_query($conn, $sql);
            if ($result){
                $showAlert = true;
            }
    }
}  
?>
<?php //Login
$login = false;
$showError1 = false;
if(isset($_POST["alogin"])){
    include ('admindb.php');
    $username1 = $_POST["username"];
    $password1 = $_POST["password"]; 
    
     
    // $sql = "Select * from users where username='$username' AND password='$password'";
    $sql = "Select * from users where username='$username1'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        while($row=mysqli_fetch_assoc($result)){
            if (password_verify($password1, $row['password'])){ 
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username1;
                header("location: index.php");
            } 
            else{
                $showError1 = "Invalid Credentials";
            }
        }
        
    } 
    else{
        $showError1 = "Invalid Credentials";
    }
}   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="admin_login_style.css">
    <title>SEP</title>
</head>

<body>
<?php //Signup
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
?>
<?php //Login
    if($login){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    if($showError1){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError1.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
?>
    <div class="container1">
        <video src="videos/video.mp4" autoplay loop playsinline muted></video>
        </div>
        <div class="container">
        <div class="login-section">
            <header>Login</header>
            <div class="social-buttons">
                <a href="https://docs.google.com/spreadsheets/d/1vEKCEKneoDvZX6z3XdLx-JuawOShMgJ4woo-5UYIF7c/edit#gid=0">
                    <button><i class='bx bxl-google'></i> Google </button>
                </a>
                <a href="https://github.com/Beyondverse9K/SEP">
                    <button><i class='bx bxl-github'></i> Github </button>
                </a>
            </div>

            <div class="separator">
                <div class="line"></div>
                <p>Or</p>
                <div class="line"></div>
            </div>

            <form  method="post">
                <div class="form-group">
                <label for="username"></label>
                <input type="text" maxlength="30" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Username">            
                </div>
                <div class="form-group">
                <label for="password"></label>
                <input type="password" maxlength="30" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary" name="alogin">Login</button>
            </form>

        </div>
        <div class="signup-section">
            <header>Signup</header>
            <div class="social-buttons1">
                <a href="https://docs.google.com/spreadsheets/d/1vEKCEKneoDvZX6z3XdLx-JuawOShMgJ4woo-5UYIF7c/edit#gid=0">
                    <button><i class='bx bxl-google'></i> Google </button>
                </a>
                <a href="https://github.com/Beyondverse9K/SEP">
                    <button><i class='bx bxl-github'></i> Github </button>
                </a>
            </div>

            <div class="separator">
                <div class="line"></div>
                <p>Or</p>
                <div class="line"></div>
            </div>

            <form method="post">
                <div class="form-group">
                <label for="username"></label>
                <input type="text" maxlength="30" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Username">            
                </div>
                <div class="form-group">
                <label for="password"></label>
                <input type="password" maxlength="30" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary" name="asignup">Signup</button>
            </form>
        </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="admin_login_script.js"></script>
</body>

</html>