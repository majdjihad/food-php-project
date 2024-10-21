<?php
    include '../config/constants.php';
    if(isset($_SESSION['login_status'])) {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $query_select = "SELECT * FROM admins where id = ?";
            $result_query_select = $server->prepare($query_select);
            $result_query_select->bind_param("s", $id);
            $result_query_select->execute();
            $selectedAdmin = $result_query_select->get_result();
            if($selectedAdmin->num_rows == 1) {
                $query_delete = "DELETE FROM admins where id = 'lXab72fejy'";
                $server->query($query_delete);
                if($result_query_select) {
                    $_SESSION["status_delete"] = "<p class='text-success'>Success Delete</p>";
                } else {
                    $_SESSION["status_delete"] = "<p class='text-error'>Failure Delete</p>";
                }
                header("location:manage-admin.php");
            }
        } else {
            header("location:manage-admin.php");
        }
    } else {
        header("location:login.php");
    }
?>