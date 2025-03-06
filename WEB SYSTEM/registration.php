<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="card-title m-0">Register</h3>
                    </div>
                    <div class="card-body">

                        <!--Wag nyo na galawin 'tong form-->
                        <form id="registrationForm" action="register.php" method="POST">

                            <!-- Field (Fullname) -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                            </div>

                            <!-- Field (Email Address)-->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            </div>

                            <!-- Field (Password)-->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                            </div>

                            <!-- Field (Confirm Password)-->
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword" name="repassword" placeholder="Confirm password" required>
                            </div>

                            <!--Button (Register)-->
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- registration.php link to registration.js -->
    <script src="registration.js"></script>

    <!-- PHP Messages (Now Handled in JavaScript) -->
    <script>

        //Kung pareho ang password at confirm password
        <?php if (isset($_GET['success']) && $_GET['success'] == "true") { ?>
            alert('✅ Registration Completed!');
        <?php } ?>

        //Kung ang email ay meron na sa database
        <?php if (isset($_GET['error'])) { 
            if ($_GET['error'] == "duplicate_email") { ?>
                alert('❌ Error: Email already registered!');

        //Check kung ang URL ay may error
        <?php } else if ($_GET['error'] == "database_error") { ?>
                alert('❌ Error: Database issue, please try again.');
        <?php } 
        } ?>
    </script>

</body>
</html>
