
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
            url: '<?php echo site_url('parentcontroller/save_dfo'); ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Don't process the data
            contentType: false,
            success: function (response) {
                if (response.status === 'success') {
                    alert('DFO added successfully!');
                    window.location.href = "<?php echo site_url('parentcontroller/dfo_list') ?>";
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

<?php if($teacher_js_script){ ?>
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
            url: '<?php echo site_url('parentcontroller/save_teacher'); ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Don't process the data
            contentType: false,
            success: function (response) {
                if (response.status === 'success') {
                    alert('Teacher added successfully!');
                    window.location.href = "<?php echo site_url('parentcontroller/teacher_list') ?>";
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
<?php if($parent_js_script){ ?>
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
            url: '<?php echo site_url('parentcontroller/save_parent'); ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Don't process the data
            contentType: false,
            success: function (response) {
                if (response.status === 'success') {
                    alert('Parent added successfully!');
                    window.location.href = "<?php echo site_url('parentcontroller/parent_list') ?>";
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


<?php if($child_js_script){ ?>
    <script>
    $(document).ready(function () {

    $('#registerForm').on('submit', function (e) {
        
        e.preventDefault();
        
        var formData = new FormData(this); // Serialize form data

        $.ajax({
            url: '<?php echo site_url('parentcontroller/save_child'); ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Don't process the data
            contentType: false,
            success: function (response) {
                if (response.status === 'success') {
                    alert('Child added successfully!');
                    window.location.href = "<?php echo site_url('parentcontroller/child_list') ?>";
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function () {
                alert('An unexpected error occurred. Please try again.');
            }
        });
    });

});
</script>
<?php } ?>

<?php if($section_js_script){ ?>
    <script>
    $(document).ready(function () {

    $('#registerForm').on('submit', function (e) {
        
        e.preventDefault();
        
        var formData = new FormData(this); // Serialize form data

        $.ajax({
            url: '<?php echo site_url('parentcontroller/save_section'); ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Don't process the data
            contentType: false,
            success: function (response) {
                if (response.status === 'success') {
                    alert('Section added successfully!');
                    window.location.href = "<?php echo site_url('parentcontroller/section_list') ?>";
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function () {
                alert('An unexpected error occurred. Please try again.');
            }
        });
    });

});
</script>
<?php } ?>


<?php if($attendees_js_script){ ?>
    <script>
    $(document).ready(function () {

    $('#registerForm').on('submit', function (e) {
        
        e.preventDefault();
        
        var formData = new FormData(this); // Serialize form data

        $.ajax({
            url: '<?php echo site_url('parentcontroller/save_attendees'); ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Don't process the data
            contentType: false,
            success: function (response) {
                if (response.status === 'success') {
                    alert('Section added successfully!');
                    window.location.href = "<?php echo site_url('parentcontroller/attendees_list') ?>";
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function () {
                alert('An unexpected error occurred. Please try again.');
            }
        });
    });

});
</script>
<?php } ?>

<?php if($attendees_js_script_edit){ ?>
    <script>
    $(document).ready(function () {

    $('#registerForm').on('submit', function (e) {
        
        e.preventDefault();
        
        var formData = new FormData(this); // Serialize form data

        $.ajax({
            url: '<?php echo site_url('parentcontroller/edit_attendees').'/'.$attendees['id']; ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Don't process the data
            contentType: false,
            success: function (response) {
                if (response.status === 'success') {
                    alert('Section added successfully!');
                    window.location.href = "<?php echo site_url('parentcontroller/attendees_list') ?>";
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function () {
                alert('An unexpected error occurred. Please try again.');
            }
        });
    });

});
</script>
<?php } ?>


<?php if($dfo_js_script_edit){ ?>
    <script>
    $(document).ready(function () {

        $('#registerForm').on('submit', function (e) {
            
            e.preventDefault();
            
            var formData = new FormData(this); // Serialize form data

            $.ajax({
                url: '<?php echo site_url('parentcontroller/edit_dfo').'/'.$user_data['id']; ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false, // Don't process the data
                contentType: false,
                success: function (response) {
                    if (response.status === 'success') {
                        alert('DFO updated successfully!');
                        window.location.href = "<?php echo site_url('parentcontroller/dfo_list') ?>";
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function () {
                    alert('An unexpected error occurred. Please try again.');
                }
            });
        });

    });
    </script>
<?php } ?>

<?php if($teacher_js_script_edit){ ?>
    <script>
    $(document).ready(function () {

        $('#registerForm').on('submit', function (e) {
            
            e.preventDefault();
            
            var formData = new FormData(this); // Serialize form data

            $.ajax({
                url: '<?php echo site_url('parentcontroller/edit_teacher').'/'.$user_data['id']; ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false, // Don't process the data
                contentType: false,
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Teacher updated successfully!');
                        window.location.href = "<?php echo site_url('parentcontroller/teacher_list') ?>";
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function () {
                    alert('An unexpected error occurred. Please try again.');
                }
            });
        });

    });
    </script>
<?php } ?>

<?php if($parent_js_script_edit){ ?>
    <script>
    $(document).ready(function () {

        $('#registerForm').on('submit', function (e) {
            
            e.preventDefault();
            
            var formData = new FormData(this); // Serialize form data

            $.ajax({
                url: '<?php echo site_url('parentcontroller/edit_parent').'/'.$user_data['id']; ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false, // Don't process the data
                contentType: false,
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Parent updated successfully!');
                        window.location.href = "<?php echo site_url('parentcontroller/parent_list') ?>";
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function () {
                    alert('An unexpected error occurred. Please try again.');
                }
            });
        });

    });
    </script>
<?php } ?>
<?php if($child_js_script_edit){ ?>
    <script>
    $(document).ready(function () {

        $('#registerForm').on('submit', function (e) {
            
            e.preventDefault();
            
            var formData = new FormData(this); // Serialize form data

            $.ajax({
                url: '<?php echo site_url('parentcontroller/edit_child').'/'.$child_data['child_id']; ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false, // Don't process the data
                contentType: false,
                success: function (response) {
                    if (response.status === 'success') {
                        alert('child updated successfully!');
                        window.location.href = "<?php echo site_url('parentcontroller/child_list') ?>";
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function () {
                    alert('An unexpected error occurred. Please try again.');
                }
            });
        });

    });
    </script>
<?php } ?>
<?php if($section_js_script_edit){ ?>
    <script>
    $(document).ready(function () {

        $('#registerForm').on('submit', function (e) {
            
            e.preventDefault();
            
            var formData = new FormData(this); // Serialize form data

            $.ajax({
                url: '<?php echo site_url('parentcontroller/edit_section').'/'.$section_data['id']; ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false, // Don't process the data
                contentType: false,
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Section updated successfully!');
                        window.location.href = "<?php echo site_url('parentcontroller/section_list') ?>";
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function () {
                    alert('An unexpected error occurred. Please try again.');
                }
            });
        });

    });
    </script>
<?php } ?>
<?php if($user_js_script_edit){ ?>
    <script>
    $(document).ready(function () {

        $('#registerForm').on('submit', function (e) {
            
            e.preventDefault();
            
            var formData = new FormData(this); // Serialize form data

            $.ajax({
                url: '<?php echo site_url('parentcontroller/edit_your_profile'); ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false, // Don't process the data
                contentType: false,
                success: function (response) {
                    if (response.status === 'success') {
                        alert('You Profile updated successfully!');
                        window.location.href = "<?php echo site_url('parentcontroller/user-edit-profile') ?>";
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function () {
                    alert('An unexpected error occurred. Please try again.');
                }
            });
        });

    });
    </script>
<?php } ?>
<?php if($attendees_js_script || $attendees_js_script_edit){ ?>
    <script>
    document.getElementById('child_id').addEventListener('change', function () {
        // Get the selected option
        let selectedOption = this.options[this.selectedIndex];

        // Retrieve the 'data-parent' attribute
        let parent_id = selectedOption.getAttribute('data-parent');

        // Assign the parent_id to the hidden input field
        document.getElementById('parent_id').value = parent_id;
    });
    </script>
<?php } ?>

<script>
$(document).ready(function () {
    $('#circle').change(function () {
        var circle_id = $(this).val(); // Get selected circle ID

        if (circle_id) {
            $.ajax({
                url: '<?php echo site_url(''); ?>/register/get_divisions_by_circle', // Replace with your controller and method
                type: 'POST',
                data: {circle_id: circle_id},
                dataType: 'json',
                success: function (data) {
                    // Populate the division dropdown
                    $('#division').empty().append('<option value="">-- Select Division --</option>');
                    $.each(data, function (key, value) {
                        $('#division').append('<option value="' + value.id + '">' + value.division + '</option>');
                    });
                },
                error: function () {
                    alert('Error fetching divisions.');
                }
            });
        } else {
            $('#division').empty().append('<option value="">-- Select Division --</option>');
        }
    });
});

function confirmDelete() {
    return confirm("Are you sure you want to delete this item? This action cannot be undone.");
}


document.getElementById('section_details').addEventListener('change', function(event) {
    const files = event.target.files;
    const previewContainer = document.getElementById('preview-container');
    previewContainer.innerHTML = ''; // Clear existing previews

    Array.from(files).forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const previewDiv = document.createElement('div');
            previewDiv.className = 'col-sm-4 position-relative mb-3';

            previewDiv.innerHTML = `
                <img src="${e.target.result}" class="img-fluid rounded" alt="Preview">
                <button class="btn btn-danger btn-sm position-absolute top-0 end-0" 
                        onclick="removeFile(${index})">X</button>
            `;
            previewContainer.appendChild(previewDiv);
        };
        reader.readAsDataURL(file);
    });
});

// Remove file on button click
function removeFile(index) {
    const fileInput = document.getElementById('section_details');
    const dataTransfer = new DataTransfer();

    Array.from(fileInput.files).forEach((file, i) => {
        if (i !== index) {
            dataTransfer.items.add(file);
        }
    });

    fileInput.files = dataTransfer.files;
    document.getElementById('preview-container').children[index].remove();
}


</script>
</body>

</html>