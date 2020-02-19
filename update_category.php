<!-- Include Head -->
<?php include "assest/head.php"; ?>
<?php 

    $category_id = $_GET["id"];

    // Get category Data to display
    $category = $conn->query("SELECT * FROM category WHERE category_id = $category_id ")->fetch(); 

?>

    <title>Update Category</title>
</head>

<body>

    <!-- Header -->
    <header class="blog-header">
        
        <?php include "assest/header.php" ?>

        <div class="jumbotron text-center ">
            <h1 class="display-3 font-weight-normal text-muted">Update a Category</h1>
        </div>

    </header>

    <!-- Main -->
    <main role="main" class="container">

        <div class="row">

            <div class="col-lg-8 mb-4">
                <!-- Form -->
                <form action="assest/update.php?type=category&id=<?= $category_id ?>&img=<?= $category["category_image"] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="catName">Category Name</label>
                        <input type="text" class="form-control" name="catName" id="catName" value="<?= $category["category_name"] ?>">
                    </div>

                    <div class="form-group">
                        <label for="catImage">Category Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="catImage" id="catImage">
                            <label class="custom-file-label" for="catImage"><?= $category["category_image"] ?></label>
                        </div>
                    </div>
                    
                    <div class="my-2" style="width: 200px;">
                        <img class="w-100 h-auto" src="img/category/<?= $category["category_image"] ?>" alt="">
                    </div>

                    <div class="form-group">
                        <label for="catColor">Category Color</label>
                        <input type="color" id="catColor" name="catColor" value="<?= $category["category_color"] ?>">
                    </div>

                   
                    <div class="text-center">
                        <button type="submit" name="update" class="btn btn-info btn-lg w-25">Update</button>
                    </div>
                </form>
            </div>

            <div class="col-lg-4 mb-4">
                <!-- <h1> Random Articles </h1>  -->
            </div>


        </div>

    </main>

    <!-- Footer -->
    <?php include "assest/footer.php" ?>


</body>

</html>