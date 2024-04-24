
<?php


// nav with user Login
if(isset($_SESSION['username'])){
    include 'assets/php/db_conn.php';

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM users WHERE username='$username' and email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // User Navbar
        if($row['role'] == "user"){
            echo '
            <ul class="navbar-nav">
                <li class="nav-item first">
                <a class="nav-link nav-hover" href="./">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link nav-hover" href="#">Products</a>
                </li>
                <li class="nav-item">
                <a class="nav-link nav-hover" href="#">About Us</a>
                </li>
                <li class="nav-item adminlast">
                <a class="nav-link nav-hover" href="#">Contact</a>
                </li>
                <li class="nav-item">
                <a class="nav-link nav-hover" href="dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                <a class="nav-link nav-hover" href="logout">Logout</a>
                </li>
            </ul>
            ';
        }
        // Admin Navbar
        if($row['role'] == "admin"){
            echo '
            <ul class="navbar-nav">
                <li class="nav-item first">
                <a class="nav-link nav-hover" href="./">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link nav-hover" href="#">Products</a>
                </li>
                <li class="nav-item">
                <a class="nav-link nav-hover" href="#">About Us</a>
                </li>
                <li class="nav-item adminlast">
                <a class="nav-link nav-hover" href="#">Contact</a>
                </li>
                <li class="nav-item">
                <a class="nav-link nav-hover" href="admin">Admin</a>
                </li>
                <li class="nav-item">
                <a class="nav-link nav-hover" href="dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                <a class="nav-link nav-hover" href="logout">Logout</a>
                </li>
            </ul>
            ';
        }

    }
}