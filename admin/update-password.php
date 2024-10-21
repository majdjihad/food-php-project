<html>
<head>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
        <!-- Menu Section Starts -->
    <?php
    $page_title = "Update-password";
    include '../layouts/menu.php';
    if(isset($_SESSION['login_status'])) {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $query_select = "SELECT * FROM admins where id = ?";
            $result_query_select = $server->prepare($query_select);
            $result_query_select->bind_param("s",$id);
            $result_query_select->execute();
            $selectedAdmin = $result_query_select->get_result();
            if($selectedAdmin->num_rows == 1) {
            $admin = $selectedAdmin->fetch_assoc();
            $password = $admin['password'];
                if(isset($_POST['submit'])) {
                    $current_password = $_POST['current_password'];
                    $new_password = $_POST['new_password'];
                    $confirm_password = $_POST['confirm_password'];
                    if ($current_password == $password) {
                        if($new_password == $confirm_password) {
                            $query_update = "UPDATE admins set password = ? where id = ?";
                            $result_query_update = $server->prepare($query_update);
                            $result_query_update->bind_param("ss",$new_password,$id);
                            $result_query_update->execute();
                            if($result_query_update) {
                                $_SESSION["admin_status_update"] = "<p class='text-success'>Success Update</p>";
                                header("location:manage-admin.php");
                            } else {
                                $_SESSION["admin_status_update"] = "<p class='text-error'>Failure Update</p>";
                                header("location:manage-admin.php");
                            }
                        } else {
                            echo "<p class='text-error'>current password not same confirm password</p>";
                        }
                    } else {
                        echo "<p class='text-error'>incorrect password</p>";
                    }
                } 
            }  else {
                header("location:manage-admin.php");
            }
        } else {
            header("location:manage-admin.php");
        }    
    } else {
        header("location:login.php");
    }
    ?>
    <!-- Menu Section Ends -->
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password" required>
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password" required>
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>
    <!-- Footer Section Starts -->
    <?php
    include '../layouts/footer.php';
    ?>
    <!-- Footer Section Ends -->
</body>
</html>