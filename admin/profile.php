<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Update</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body style="background-color:#12473d ;">
  <div class="container mt-5">
  <div class="row">
            <div class="col-lg-3">
            <?php
             include 'layouts/sidebar.php';
          ?>
        
       
        <div class="col-lg-9">
       <div class="card  shadow-sm p-4 mx-3" style="width: 650px;">
      <div class="text-center mb-4">
        <div class="rounded-circle bg-light d-flex justify-content-center align-items-center" style="width: 100px; height: 100px;">
          <i class="bi bi-person-circle" style="font-size: 3rem; color: gray;"></i>
        </div>
        <!-- <input type="file" name="fileToUpload" id="fileToUpload"> -->

      </div>
      <form>
        <div class="mb-3">
          <label for="fullName" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="fullName" placeholder="Enter your full name">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Enter your email">
        </div>
        <button type="submit" class="btn btn-primary w-100">Update Profile</button>
      </form>
    </div>
    </div>
     </div>
  </div>
  </div>
</body>
</html>
