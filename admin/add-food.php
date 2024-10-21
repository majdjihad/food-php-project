    <html>
    <head>
    

        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
    <!-- Menu Section Starts -->
    <?php
    $page_title = "Add-food";
    include '../layouts/menu.php';
    ?>
    <!-- Menu Section Ends -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>



        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food" required>
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food." required></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" required>
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" required>
                            <?php
                                $query_select = "SELECT * FROM categorys";
                                $query_result = $server->query($query_select);
                                if($query_result->num_rows > 0) {
                                    while($row = $query_result->fetch_assoc()) {
                                        $id_cat = $row['id'];
                                        $title_cat = $row['title'];
                                        echo "<option value='$id_cat'>$title_cat</option>";
                                    }
                                } else {
                                    echo "<option value='0'>No Category Found</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
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
                        $description = $_POST['description'];
                        $price = $_POST['price'];
                        $id_category = $_POST['category'];
                        $featured = $_POST['featured'];
                        $active = $_POST['active'];
                        if(isset($_FILES['image']) && $_FILES['image']['name'] != "") {
                            $name = $_FILES['image']['name'];
                            $tmp_name = $_FILES['image']['tmp_name'];
                            $ext = explode('.',$name);
                            $ext = end($ext);
                            $image_path = "../images/foods/".$title.".".$ext;
                            move_uploaded_file($tmp_name,$image_path);
                        } else {
                            $image_path = '../images/logo.png';
                        }
                        $query_insert = "INSERT INTO foods set title = ?, description = ?, image = ? , price = ?, id_category = ?, featured = ?, active = ?";
                        $result_query_insert = $server->prepare($query_insert);
                        $result_query_insert->bind_param("sssisss",$title,$description,$image_path,$price, $id_category ,$featured,$active);
                        $result_query_insert->execute();
                        if($result_query_insert) {
                            $_SESSION['status_add'] = "<p class='text-success'>Success Add</p>";
                        } else {
                            $_SESSION['status_add'] = "<p class='text-error'>Failure Add</p>";
                        }
                        header("location:manage-food.php");
                    }
                }
            } else {
                header("location:login.php");
            }
            ?>
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