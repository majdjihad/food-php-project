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
    <?php
        include "./layouts-user/menu.php";
    ?>
    <!-- CAtegories Section Starts Here -->
    <?php
        include "./layouts-user/search.php";
    ?>
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
            $query_select = "SELECT * FROM categorys where featured = 'Yes' and active = 'Yes'";
            $result_query_select = $server->query($query_select);
            if($result_query_select->num_rows >  0) {
                while($row = $result_query_select->fetch_assoc()) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_path = $row['image'];
                    echo '
                    <a href="category-foods.php?id='.$id.'">
                    <div class="box-3 float-container">
                        <img src="'.str_replace("../","",$image_path).'" alt="'.$title.'" class="img-responsive img-curve">
                        <h3 class="float-text text-white">'.$title.'</h3>
                    </div>
                    </a>';
                }
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- footer Section Starts Here -->
    <?php
        include "./layouts-user/footer.php";
    ?>
    <!-- footer Section Ends Here -->

</body>
</html>