<html>
<head>


    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <!-- Menu Section Starts -->
    <?php
        $page_title = "Update-admin";
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
                    $full_name = $admin['full_name'];
                    $username = $admin['username'];
                        if(isset($_POST['submit'])) {
                            $new_full_name = $_POST['full_name'];
                            $new_username = $_POST['username'];
                            $query_update = "UPDATE admins set full_name = ? , username = ? where id = ?";
                            $result_query_update = $server->prepare($query_update);
                            $result_query_update->bind_param("sss",$new_full_name,$new_username,$id);
                            $result_query_update->execute();
                            if($result_query_update) {
                                $_SESSION["status_update"] = "<p class='text-success'>Success Update</p>";
                            } else {
                                $_SESSION["status_update"] = "<p class='text-error'>Failure Update</p>";
                            }
                            header("location:manage-admin.php");
                        }    
                } else {
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
        <h1>Update Admin</h1>

        <br><br>


        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
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