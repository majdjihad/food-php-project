<?php
    include '../config/constants.php';
    if(isset($_SESSION['login_status'])) {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $query_select = "SELECT * FROM categorys where id = ?";
            $result_query_select = $server->prepare($query_select);
            $result_query_select->bind_param("s", $id);
            $result_query_select->execute();
            $selectedCategory = $result_query_select->get_result();
            if($selectedCategory->num_rows == 1) {
                $query_delete = "DELETE FROM categorys where id = $id";
                $result_query_delete = $server->query($query_delete);
                if($result_query_delete) {
                    $_SESSION["status_delete"] = "<p class='text-success'>Success Delete</p>";
                } else {
                    $_SESSION["status_delete"] = "<p class='text-error'>Failure Delete</p>";
                }
                header("location:manage-category.php");
            } else {
                header("location:manage-category.php");
                exit();
            }
        } else {
            header("location:manage-category.php");
            exit();
        }
    } else {
        header("location:login.php");
    }
?>