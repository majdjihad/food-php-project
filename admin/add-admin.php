<html>
<head>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
        <!-- Menu Section Starts -->
        <?php
    $page_title = "Add-admin";
    include '../layouts/menu.php';
    ?>
    <!-- Menu Section Ends -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name" required>
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username" required>
                    </td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password" required>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <?php
            if(isset($_SESSION['login_status'])) {
                if(isset($_POST['submit'])) {
                    if($server->connect_error) {
                        echo "failure server";
                    } else {
                        $full_name = $_POST['full_name'];
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $insert_query = "INSERT INTO admins set full_name = ?,username = ?, password = ?";
                        $result_insert_query = $server->prepare($insert_query);
                        $result_insert_query->bind_param("sss",$full_name,$username,$password);
                        $result_insert_query->execute();
                        if($result_insert_query) {
                            $_SESSION['status_add'] = "<p class='text-success'>Success Add</p>";
                        } else {
                            $_SESSION['status_add'] = "<p class='text-error'>Failure Add</p>";
                        }
                        header('location:manage-admin.php');
                    }
                }
            } else {
                header("location:login.php");
            }
        ?>
    </div>
</div>

    <!-- Footer Section Starts -->
    <?php
    include '../layouts/footer.php';
    ?>
    <!-- Footer Section Ends -->

</body>
</html>
