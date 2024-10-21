<html>
<head>


    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <!-- Menu Section Starts -->
    <?php
    $page_title = "Category";
    include '../layouts/menu.php';
    ?>
    <!-- Menu Section Ends -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br>
        <br>
        <br>
        <!-- Button to Add Admin -->
        <a href="add-category.php" class="btn-primary">Add Category</a>
        <br>
        <br>
        <br>
        <?php
        if(isset($_SESSION['login_status'])) {
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
            $select_query = "SELECT * FROM categorys";
            $result_query = $server->query($select_query);
            if($result_query->num_rows > 0) {      
                echo '
                <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                </td>
                </tr>
                ';
                $count = 1;
                while($row = $result_query->fetch_assoc()) {
                    $id = $row['id'];
                    $image = $row['image'];
                    echo "
                    <tr>
                        <td>".$count."</td>
                        <td>".$row['title']."</td>
                        <td><img src = \"$image\" style= 'width: 50px'/></td>
                        <td>".$row['featured']."</td>
                        <td>".$row['active']."</td>
                        <td>
                        <a href='update-category.php?id=".$id."' class='btn-secondary' > update </a>&nbsp;
                        <a href='delete-category.php?id=".$id."' class='btn-danger' > delete </a> &nbsp;
                        </td>
                    </tr>";
                    $count++;
                }
            } else {
                echo "
                <tr>
                <td>
                    <h2 class = 'text-error'> no category yet ! </h2></td>
                </td>
            </tr>";}
        } else {
            header("location:login.php");
        }
            ?>
    <!-- Footer Section Starts -->
    <?php
    include '../layouts/footer.php';
    ?>
    <!-- Footer Section Ends -->
</body>
</html>