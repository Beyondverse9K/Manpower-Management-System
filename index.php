<?php
include('admindb.php');
?>
<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: admin_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>Welcome</title>
</head>

<body>

  
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bxl-tailwind-css'></i>
            <div class="logo-name"><span>MP</span>MS</div>
        </a>
        <ul class="side-menu">
            <li class="active"><a href="#"><i class='bx bxs-bullseye' ></i>Analytics</a></li>
            <li><a href="Projects.php"><i class='bx bxs-dashboard'></i>Projects</a></li>
            <li><a href="Reminders.php"><i class='bx bxs-note'></i>Reminders</a></li>
            <li><a href="about.html"><i class='bx bxl-github' ></i>About Us</a></li>
            <li><a href="contact.html"><i class='bx bxl-slack'></i>Contact Us</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="admin_logout.php" class="logout">
                    <i class='bx bx-power-off' ></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
   

   
    <div class="content">
      
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <p>Manpower Management System</p>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="profile">
                <img src="images/logo.png">
            </a>
        </nav>

        <main>
            <div class="header">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">                       
                        <li><a href="#" class="active">Analytics</a></li>
                    </ul>
                </div>
                <a href="https://drive.google.com/drive/folders/19dXw0TU5wZQp3mB22KGj1Iw6WLxnKlli?usp=sharing" class="report">
                    <i class='bx bx-cloud-download'></i>
                    <span>Download Database</span>
                </a>
            </div>

       
            <ul class="insights">
                <li>
                    <i class='bx bx-calendar-check'></i>
                    <span class="info">
                        <h3>
                        <?php 
                            $sql= "SELECT * FROM `projects` WHERE `status` = 'Completed'";
                            $result = mysqli_query($conn, $sql);
                            $num = mysqli_num_rows($result);
                            echo $num;
                        ?>
                        </h3>
                        <p>Projects Completed</p>
                    </span>
                </li>
                <li><i class='bx bx-calendar-x' ></i>
                    <span class="info">
                        <h3>
                        <?php 
                            $sql= "SELECT * FROM `projects` WHERE `status` = 'Pending'";
                            $result = mysqli_query($conn, $sql);
                            $num = mysqli_num_rows($result);
                            echo $num;
                        ?>
                        </h3>
                        <p>Projects Pending</p>
                    </span>
                </li>
                <li><i class='bx bx-calendar-exclamation'></i>
                    <span class="info">
                        <h3>
                        <?php 
                            $sql= "SELECT * FROM `projects` WHERE `status` = 'Ongoing'";
                            $result = mysqli_query($conn, $sql);
                            $num = mysqli_num_rows($result);
                            echo $num;
                        ?>
                        </h3>
                        <p>Projects Ongoing</p>
                    </span>
                </li>
                <li><i class='bx bxs-group'></i>
                    <span class="info">
                        <h3>
                        <?php 
                            $sql = "SELECT * FROM `projects`";
                            $result = mysqli_query($conn, $sql);
                            $sum = 0;
                            while($row = mysqli_fetch_assoc($result)){
                                $sum = $sum + $row['emp'];                               
                            } 
                            echo $sum;
                        ?>
                        </h3>
                        <p>Bench Strength</p>
                    </span>
                </li>
            </ul>

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <a style="text-decoration: none; color: black;" href="Projects.php">
                        <i class='bx bxs-dashboard'></i></a>
                        <h3>Project Progress</h3>
                        <a style="text-decoration: none; color: black;" href="Projects.php">
                        <i class='bx bx-filter'></i></a>
                        <a style="text-decoration: none; color: black;" href="Projects.php">
                        <i class='bx bxs-report' ></i></a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Start</th>
                                <th>Duration(d)</th>
                                <th>Status</th>
                                <th>Manpower</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $sql = "SELECT * FROM `projects`";
                            $result = mysqli_query($conn, $sql);
                            $sno = 0;
                            while($row = mysqli_fetch_assoc($result)){
                                $sno = $sno + 1;
                                echo "<tr>
                                <th scope='row'>". $row['pname'] ."</th>
                                <td>". $row['start'] . "</td>
                                <td>". $row['duration'] . "</td>
                                <td>". $row['status'] . "</td>
                                <td>". $row['emp'] . "</td>
                                </tr>";
                            } 
                        ?>
                        </tbody>
                    </table>
                </div>

             
                <div class="reminders">
                    <div class="header">
                        <a style="text-decoration: none; color: black;" href="Reminders.php">                     
                        <i class='bx bx-note'></i></a>
                        <h3>Reminders</h3>
                        <a style="text-decoration: none; color: black;" href="Reminders.php">
                        <i class='bx bx-filter'></i></a>
                        <a style="text-decoration: none; color: black;" href="Reminders.php">                       
                        <i class='bx bxs-report' ></i></a>                  
                    </div>
                    
                    <ul class="task-list">
                        <li class="completed">
                            <div class="task-title">                                
                                <?php 
                                    $sql = "SELECT * FROM `reminders`";
                                    $result = mysqli_query($conn, $sql);
                                    $sno = 0;
                                    while($row = mysqli_fetch_assoc($result)){
                                    $sno = $sno + 1;
                                    echo "<tr>
                                    <th scope='row'>"."</th>
                                    <td>". $row['title'] . "</td>
                                    </tr>";
                                    echo "<br>";
                                } 
                                ?>
                            </div>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>                      
                    </ul>
                </div>

              

            </div>

        </main>

    </div>
    <script>
    const toggler = document.getElementById('theme-toggle');

        toggler.addEventListener('change', function () {
            if (this.checked) {
                document.body.classList.add('dark');
            } else {
                document.body.classList.remove('dark');
            }
        });
        </script>
    <script src="index.js"></script>
</body>

</html>
