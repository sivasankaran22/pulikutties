
</div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Pulikutties <?php echo DATE("Y"); ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('assets/js/sb-admin-2.min.js') ?>"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url('assets/vendor/chart.js/Chart.min.js') ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url('assets/js/demo/chart-area-demo.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/demo/chart-pie-demo.js') ?>"></script>

        <!-- Page level plugins -->
        <script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url('assets/js/demo/datatables-demo.js') ?>"></script>
    <!-- Additional Page-Specific Scripts -->
<?php if($dfo_js_script){ ?>
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
        
        var formData = new FormData(this); // Serialize form data

        $.ajax({
            url: '<?php echo site_url('admin/save_dfo'); ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Don't process the data
            contentType: false,
            success: function (response) {
                if (response.status === 'success') {
                    alert('User added successfully!');
                    // Optionally, clear the form or redirect
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function () {
                alert('An unexpected error occurred. Please try again.');
            }
        });
    });

   // On password field blur
    $('#password').on('blur', function () {
        validatePasswords();
    });

    // Validate password function
    function validatePasswords() {
        let password = $('#password').val();
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
<?php } ?>
</body>

</html>