<html>
<head>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>

    <!-- Menu Section Starts -->
    <?php
    $page_title = "Admin";
    include '../layouts/menu.php';
    ?>
    <!-- Menu Section Ends -->
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br/>
        <br>
        <br>
        <br>
        <!-- Button to Add Admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <br/><br/><br/>
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
                $select_query = "SELECT * FROM admins";
                $result_query = $server->query($select_query);
                if($result_query->num_rows > 0) {      
                    echo '
                    <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Actions</th>
                    </tr>
                    </td>
                    </tr>
                    ';
                    $count = 1;
                    while($row = $result_query->fetch_assoc()) {
                        $id = $row['id'];
                        echo "
                        <tr>
                            <td>".$count."</td>
                            <td>".$row['full_name']."</td>
                            <td>".$row['username']."</td>
                            <td>".$row['password']."</td>
                            <td>
                            <a href='update-admin.php?id=".$id."' class='btn-secondary' > update </a>&nbsp;
                            <a href='delete-admin.php?id=".$id."' class='btn-danger' > delete </a> &nbsp;
                            <a href='update-password.php?id=".$id."' class='btn-primary'> change password </a> &nbsp;
                            </td>
                        </tr>";
                        $count++;
                    }
                } else {
                    echo "
                    <tr>
                    <td>
                        <h2 class = 'text-error'> no admin yet ! </h2></td>
                    </td>
                </tr>";}    
            } else {
                header("location:login.php");
            }
        ?>
        </table>

    </div>
</div>
<!-- Main Content Setion Ends -->
    <!-- Footer Section Starts -->
    <?php
    include '../layouts/footer.php';
    ?>
    <!-- Footer Section Ends -->
</body>
</html>