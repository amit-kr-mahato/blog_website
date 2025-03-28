<?php
require('../configure.php');

// Fetch the post to edit
$id = $_GET['rn'];
$select = "SELECT * FROM posts WHERE id='$id'";
$query = mysqli_query($conn, $select);
$total = mysqli_fetch_array($query);

// Fetch categories
$queryCategories = "SELECT * FROM createcategories";
$resultCategories = mysqli_query($conn, $queryCategories);
$totalCategories = mysqli_num_rows($resultCategories);

// Handle form submission
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $image = $_FILES["image"];
    
    // Handle image upload
    $fileDestination = $total['image']; // Default to current image
    if ($image['name']) { // Check if a new image is uploaded
        $upload_folder_path = "images/post/";
        $imageName = $image['name'];
        $fileExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $fileNewName = uniqid('', true) . "." . $fileExt;
        $fileDestination = $upload_folder_path . basename($fileNewName);
        move_uploaded_file($image['tmp_name'], $fileDestination);
    }

    // Update the post
    $queryUpdate = "UPDATE posts SET title='$title', image='$fileDestination', description='$description', status='$status' WHERE id='$id'";
    $resultUpdate = mysqli_query($conn, $queryUpdate);
    
    if ($resultUpdate) {
        $message = "Post updated successfully";
        $messageType = "success";
        header("Location: index-post.php");
        exit();
    } else {
        $message = "Error updating post: " . mysqli_error($conn);
        $messageType = "danger";
    }
}
?>







<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Post - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="background-color: aquamarine;">

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-3">
                <?php
                include 'layouts/sidebar.php';
                ?>
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Edit Post</h2>
                        <div>
                            <a href="create-post.php" class="btn btn-success">
                                <i class="bi bi-plus"></i> Add New
                            </a>
                            <a href="index-post.php" class="btn btn-primary">
                                <i class="bi bi-arrow-left"></i> All Posts
                            </a>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="post"  enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="form-label">Post Title
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($total['title']); ?>"  placeholder="Enter Post Title">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 mt-3">
                                            <label class="form-label">Post Image
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="file" class="form-control" name="image" value="<?php echo $total['image'] ?>" placeholder="Enter Post Title">
                                            <img width=200 height=200 src="<?php echo htmlspecialchars($total['image']) ?>" />
                                        </div>
                                        <div class="form-group col-md-6 mt-3">
                                            <label class="form-label">Category
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Select Category</option>
                                                <?php if ($totalCategories != 0) {

                                                    while ($data = mysqli_fetch_assoc($resultCategories)) {
                                                        echo "
                                                     <option value='" . $data['id'] . "' selected>" . $data['title'] . "</option>
                                                       ";
                                                    }
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="form-label">Post Details
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control" name="description" id="" rows="10" value="<?php echo htmlspecialchars($total['description']) ?>" placeholder="Enter Post details "></textarea>
                                    </div>
                                    <div class="mt-3">
                                        <label class="form-label">Status
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select" name="status" value="<?php echo $total['status']?>" aria-label="Default select example">
                                            <select class="form-select" name="status" aria-label="Default select example">
                                            <option selected>Select status</option>
                                            <option value="1">publish</option>
                                            <option value="0">draft</option>
                                        </select>
                                        </select>
                                        <!-- <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"  id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                          Publish
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                          Draft
                                        </label>
                                      </div> -->
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" name="submit" class="btn btn-primary">Save Post</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>