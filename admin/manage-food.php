<html>
<head>


    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <!-- Menu Section Starts -->
    <?php
    $page_title = "Food";
    include '../layouts/menu.php';
    ?>
    <!-- Menu Section Ends -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br/><br/>

        <!-- Button to Add Admin -->
        <a href="add-food.php" class="btn-primary">Add Food</a>

        <br/><br/><br/>
        <?php
            if(isset($_SESSION['login_status'])) {
                if($server->connect_error) {
                    echo "Error Connection";
                } else {
                    if(isset($_SESSION['status_add'])) {
                        echo $_SESSION['status_add'];
                        unset($_SESSION['status_add']);
                    } else if(isset($_SESSION['status_update'])) {
                        echo $_SESSION['status_update'];
                        unset($_SESSION['status_update']);
                    } else if(isset($_SESSION['status_delete'])) {
                        echo $_SESSION['status_delete'];
                        unset($_SESSION['status_delete']);
                    }
                    $query_select = "SELECT * FROM foods";
                    $result_query = $server->query($query_select);
                    if($result_query->num_rows> 0) {
                        echo '
                        <table class="tbl-full">
                        <tr>
                            <th>S.N.</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Featured</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>';
                        $count = 0;
                        while($row = $result_query->fetch_assoc()) {
                            $id = $row['id'];
                            $title = $row['title'];
                            $description = $row['description'];
                            $image = $row['image'];
                            $price = $row['price'];
                            $id_category = $row['id_category'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            echo '
                            <tr>
                                <td>'.$count.'</td>
                                <td>'.$title.'</td>
                                <td>'.$description.'</td>
                                <td>'.$price.'</td>
                                <td><img src = "'.$image.'" alt = "'.$title.'" style = "max-width: 50px;"/></td>
                                <td>'.$featured.'</td>
                                <td>'.$active.'</td>
                                <td>
                                    <a href="../admin/update-food.php?id='.$id.'" class="btn-secondary">Update Food</a>
                                    <a href="../admin/delete-food.php?id='.$id.'" class="btn-danger">Delete Food</a>
                                </td>
                            </tr>';
                            $count++;
                        }
                    } else {
                        echo "
                        <tr>
                        <td>
                            <h2 class = 'text-error'> no category yet ! </h2></td>
                        </td>
                    </tr>";
                    }
                }
            } else {
                header("location:login.php");
            }
        ?>
        </table>
    </div>
</div>
    <!-- Footer Section Starts -->
    <?php
    include '../layouts/footer.php';
    ?>
    <!-- Footer Section Ends -->
</body>
</html>