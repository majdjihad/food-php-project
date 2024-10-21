<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <?php
        include "./layouts-user/menu.php";
    ?>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
                $id = $_GET['id'];
                $category_title_query = "SELECT * from categorys where id = $id";
                $result_category_title = $server->query($category_title_query);
                $row_category = $result_category_title->fetch_assoc();
                $title_category = $row_category['title'];
            ?>
            <h2>Foods on <a href="#" class="text-white"><?php echo $title_category ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <div class="clearfix"></div>
            <?php
            if(isset($_GET['id'])) {
                $id_category = $_GET['id'];
                $featured_status = "Yes";
                $active_status = "Yes";
                $query_select = "SELECT * FROM foods where featured = ? and active = ? and id_category = ?";
                $result_query_select = $server->prepare($query_select);
                $result_query_select->bind_param("sss",$featured_status,$active_status,$id_category);
                $result_query_select->execute();
                $selectedCategory = $result_query_select->get_result();
                if($selectedCategory->num_rows > 0) {
                    while($row = $selectedCategory->fetch_assoc()) {
                        $id_food = $row['id'];
                        $title_food = $row['title'];
                        $dec_food = $row['description'];
                        $price_food = $row['price'];
                        $image_path_food = $row['image'];
                        echo '
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <img src="'.str_replace("../","",$image_path_food).'" alt="'.$title_food.'" class="img-responsive img-curve">
                                </div>
                                <div class="food-menu-desc">
                                    <h4>'.$title_food.'</h4>
                                    <p class="food-price">$'.$price_food.'</p>
                                    <p class="food-detail">
                                        '.$dec_food.'
                                    </p>
                                    <br>
                                    <a href="order.php?id='.$id_food.'" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>    
                        ';
                    }
                } else {
                    echo '
                    <h1 class = "text-error">NO Found Foods in Category</h1>
                    ';
                }
            } else {
                header("location:index.php");
            }
            ?>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

    <!-- footer Section Starts Here -->
    <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <a href="#">web2Alqsa</a></p>
        </div>
    </section>
    <!-- footer Section Ends Here -->

</body>
</html>