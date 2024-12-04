<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <style>
        .no-default-icon {
            appearance: none; /* Standard */
            -webkit-appearance: none; /* Safari and Chrome */
            -moz-appearance: none; /* Firefox */
        }

        /* Ensure consistent password field styling */
        input[type="password"] {
            font-size: 16px;
            padding-right: 30px; /* Space for custom icon */
        }
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Create New Account!</h1>
                                    </div>
                                    <form class="user" id="registerForm">
                                        <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                                placeholder="First Name" name="first_name" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-user" id="exampleLastName"
                                                placeholder="Last Name" name="last_name" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="email" class="form-control form-control-user" id="email" name="email"
                                                placeholder="Email Address" required>
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="number" class="form-control form-control-user" id="phone" name="phone"
                                                placeholder="Phone No" required>
                                            </div>
                                        </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user" name="password"
                                                id="password" placeholder="Password" required>
                                                <span id="togglePassword"  class="fa fa-eye" style="position: absolute; right: 26px; top: 72%; transform: translateY(-50%); cursor: pointer;"></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user"
                                                id="confirmPassword" placeholder="Repeat Password" required>
                                                <span id="toggleConfirmPassword"  class="fa fa-eye" style="position: absolute; right: 26px; top: 72%; transform: translateY(-50%); cursor: pointer;"></span>
                                        </div>
                                        <div id="passwordError" style="color: red; display: none;"></div>
                                    </div>
                                        <button class="btn btn-primary btn-user" type="submit">
                                            Sign Up
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('assets/js/sb-admin-2.min.js'); ?>"></script>
<script>
$(document).ready(function () {
    // Check email
    $('#email').on('blur', function () {
        let email = $(this).val();
        if (email) {
            $.ajax({
                url: '<?php echo site_url('register/check_unique'); ?>',
                type: 'POST',
                data: { field: 'email', value: email },
                dataType: 'json',
                success: function (response) {
                    if (response.exists) {
                        alert('Email ID already exists!');
                        $('#email').val(''); // Clear the input field
                    }
                }
            });
        }
    });

    // Check phone number
    $('#phone').on('blur', function () {
        let phone = $(this).val();
        if (phone) {
            $.ajax({
                url: '<?php echo site_url('register/check_unique'); ?>',
                type: 'POST',
                data: { field: 'phone', value: phone },
                dataType: 'json',
                success: function (response) {
                    if (response.exists) {
                        alert('Phone number already exists!');
                        $('#phone').val(''); // Clear the input field
                    }
                }
            });
        }
    });

    $('#registerForm').on('submit', function (e) {
        if (!validatePasswords()) {
            e.preventDefault();
        } // Prevent default form submission
        e.preventDefault();
        
        let formData = $(this).serialize(); // Serialize form data

        $.ajax({
            url: '<?php echo site_url('register/save_user'); ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    alert('Registration successful! Redirecting to login...');
                    window.location.href = response.redirect; // Redirect to login page
                } else {
                    alert(response.message || 'An error occurred.');
                }
            },
            error: function () {
                alert('An unexpected error occurred. Please try again.');
            }
        });
    });

   // On password field blur
    $('#password, #confirmPassword').on('blur', function () {
        validatePasswords();
    });

    // Validate password function
    function validatePasswords() {
        let password = $('#password').val();
        let confirmPassword = $('#confirmPassword').val();
        let errorDiv = $('#passwordError');

        // Password validation criteria
        let passwordCriteria = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        // Clear previous errors
        errorDiv.hide().text('');

        // Validate password criteria
        if (password && !passwordCriteria.test(password)) {
            errorDiv.text('Password must be at least 8 characters long, include an uppercase letter, a lowercase letter, a number, and a special character.').show();
            return false;
        }

        // Check if passwords match
        if (password && confirmPassword && password !== confirmPassword) {
            errorDiv.text('Passwords do not match.').show();
            return false;
        }

        return true;
    }


    $('#togglePassword').on('click', function () {
        let passwordField = $('#password');
        let fieldType = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', fieldType);
        $(this).toggleClass('fa-eye fa-eye-slash'); // Toggle between eye and eye-slash icons
    });

    // Toggle password visibility for the confirm password field
    $('#toggleConfirmPassword').on('click', function () {
        let confirmPasswordField = $('#confirmPassword');
        let fieldType = confirmPasswordField.attr('type') === 'password' ? 'text' : 'password';
        confirmPasswordField.attr('type', fieldType);
        $(this).toggleClass('fa-eye fa-eye-slash'); // Toggle between eye and eye-slash icons
    });

});
</script>


</body>

</html>