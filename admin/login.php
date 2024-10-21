
<html>
    <head>
        <title>Food|Login</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <?php
        include "../config/constants.php";
        ?>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>
            <?php
                if($server->connect_error) {
                    echo "Error Connection";
                } else {
                    if(isset($_POST['submit'])) {
                        $userName = $_POST['username'];
                        $password = $_POST['password'];
                        $query_select = "SELECT * from admins where username = ? and password = ?";
                        $result_query_select = $server->prepare($query_select);
                        $result_query_select->bind_param("ss",$userName,$password);
                        $result_query_select->execute();
                        $selectedAdmin = $result_query_select->get_result();
                        if($selectedAdmin->num_rows == 1) {
                            $_SESSION["login_status"] = "true";
                            header("location:index.php");
                        } else {
                            echo "<p class='text-error'>incurrent username or password!</p>";
                        }
                    }
                }
            ?>
            <br><br>

            <!-- Login Form Starts HEre -->
            <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username" required><br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter Password" required><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
            </form>
            <!-- Login Form Ends HEre -->

        </div>

    <div class="footer">
        <div class="wrapper">
            <p class="text-center">2021 All rights reserved, Food House</p>
        </div>
    </div>
    <!-- Footer Section Ends -->

    </body>
</html>

