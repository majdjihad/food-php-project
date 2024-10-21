<html>
<head>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <!-- Menu Section Starts -->
    <?php
        $page_title = "Home";
        include '../layouts/menu.php';
    if(!isset($_SESSION["login_status"])) {
        header("location:login.php");
    }
        
        // categorys numbers
        $query_select_category = "SELECT * FROM categorys";
        $result_query_select_category = $server->query($query_select_category);
        $num_category = $result_query_select_category->num_rows;
        
        // foods numbers
        $query_select_food = "SELECT * FROM foods";
        $result_query_select_food = $server->query($query_select_food);
        $num_food = $result_query_select_food->num_rows;
    ?>
    <!-- Menu Section Ends -->
        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br><br>

                <br><br>

                <div class="col-4 text-center">



                    <h1> Categoryes</h1>
                    <br />
                    <h2><?php echo $num_category; ?></h2>
                </div>

                <div class="col-4 text-center">


                    <h1>Foods</h1>
                    <br />
                    <h2><?php echo $num_food; ?></h2>
                </div>

                <div class="col-4 text-center">



                    <h1>number</h1>
                    <br />
                    Total Orders
                </div>

                <div class="col-4 text-center">



                    <h1>number</h1>
                    <br />
                    Revenue Generated
                </div>

                <div class="clearfix"></div>

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