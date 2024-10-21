    <html>
    <head>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
    <!-- Menu Section Starts -->
    <?php
    $page_title = "Add-category";
    include '../layouts/menu.php';
    ?>
    <!-- Menu Section Ends -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <br><br>
        <!-- Add CAtegory Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title" required>
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes" checked required> Yes
                        <input type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes" checked required> Yes
                        <input type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
            <?php
            if(isset($_SESSION['login_status'])) {
                if(isset($_POST['submit'])) {
                    if($server->connect_error) {
                        echo "failure server";
                    } else {
                        $title = $_POST['title'];
                        $featured = $_POST['featured'];
                        $active = $_POST['active'];
                        if(isset($_FILES['image']) && $_FILES['image']['name'] != "") {
                            $name = $_FILES['image']['name'];
                            $tmp_name = $_FILES['image']['tmp_name'];
                            $ext = explode('.',$name);
                            $ext = end($ext);
                            $image_path = "../images/categorys/".$title.".".$ext;
                            move_uploaded_file($tmp_name,$image_path);
                        } else {
                            $image_path = '../images/logo.png';
                        }
                        $query_insert = "INSERT INTO categorys set title = ?, image = ? ,featured = ?, active = ?";
                        $result_query_insert = $server->prepare($query_insert);
                        $result_query_insert->bind_param('ssss',$title,$image_path,$featured,$active);
                        $result_query_insert->execute();
                        if($result_query_insert) {
                            $_SESSION['status_add'] = "<p class='text-success'>Success Add</p>";
                        } else {
                            $_SESSION['status_add'] = "<p class='text-error'>Failure Add</p>";
                        }
                        header("location:manage-category.php");
                        exit();
                    }
                }
            } else {
                header("location:login.php");
            }
            ?>
        </form>
        <!-- Add CAtegory Form Ends -->


    </div>
</div>
    <!-- Footer Section Starts -->
    <?php
    include '../layouts/footer.php';
    ?>
    <!-- Footer Section Ends -->
    </body>
    </html>