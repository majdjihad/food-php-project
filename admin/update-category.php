<html>
<head>


    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <!-- Menu Section Starts -->
    <?php
        $page_title = "Update-category";
        include '../layouts/menu.php';
        if(isset($_SESSION['login_status'])) {
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $query_select = "SELECT * FROM categorys WHERE id = ?";
                $result_query_select = $server->prepare($query_select);
                $result_query_select->bind_param("s", $id);
                $result_query_select->execute();
                
                $selectedCategory = $result_query_select->get_result();
                
                if($selectedCategory->num_rows == 1) {
                    $category = $selectedCategory->fetch_assoc();
                    
                    // Assign fetched values to variables
                    $current_title = $category['title'];
                    $current_image = $category['image'];
                    $current_featured = $category['featured'];
                    $current_active = $category['active'];
                    if(isset($_POST['submit'])) {
                        $new_title = $_POST['title'];
                        $new_featured = $_POST['featured'];
                        $new_active = $_POST['active'];
                        if(isset($_FILES['image']) && $_FILES['image']['name'] != "") {
                            $name = $_FILES['image']['name'];
                            $tmp_name = $_FILES['image']['tmp_name'];
                            $ext = explode('.',$name);
                            $ext = end($ext);
                            $new_image_path = "../images/categorys/".$new_title.".".$ext;
                            move_uploaded_file($tmp_name,$new_image_path);
                        } else {
                            $new_image_path = $current_image;
                        }
                        $query_update = "UPDATE categorys set title = ?, image = ? ,featured = ?, active = ? where id = ?";
                        $result_query_update = $server->prepare($query_update);
                        $result_query_update->bind_param("sssss",$new_title,$new_image_path,$new_featured,$new_active,$id);
                        $result_query_update->execute();
                        if($result_query_update) {
                            $_SESSION["status_update"] = "<p class='text-success'>Success Update</p>";
                        } else {
                        $_SESSION["status_update"] = "<p class='text-error'>Failure Update</p>";
                        }
                        header("location:manage-category.php");
                        exit();
                    }
                } else {
                    header("location: manage-category.php");
                    exit(); // Optional, to prevent executing further code
                }
            } else {
                header("location: manage-category.php");
                exit(); // Optional, to prevent executing further code
            }
        } else {
            header("location:login.php");
        }
// Further code execution...
?>

    <!-- Menu Section Ends -->
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>


        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $current_title ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <img src="<?php echo $current_image ?>" style='width:50px' alt="">
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php if($category['featured'] == 'Yes') echo 'checked'?>> Yes

                        <input type="radio" name="featured" value="No" <?php if($category['featured'] == 'No') echo 'checked'?>> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?php if($category['active'] == 'Yes') echo 'checked'?>> Yes

                        <input type="radio" name="active" value="No" <?php if($category['active'] == 'No') echo 'checked'?>> No
                        </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="">
                        <input type="hidden" name="id" value="">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
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