<?php $__env->startSection('content'); ?>
<form class="form-signin text-center ">
    <?php echo csrf_field(); ?>

    <h1 class="h3 mb-3 font-weight-normal">Register</h1>

    <label for="fname" class="sr-only">First Name</label>
    <input type="text" id="fname" name="fname" class="form-control" placeholder="First Name" required autofocus>
    <br>
    <label for="lname" class="sr-only">Last Name</label>
    <input type="text" id="lname" name="lname" class="form-control" placeholder="Last Name" required autofocus>
    <br>
    <label for="email" class="sr-only">Email address</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>

    <br>
    <label for="password" class="sr-only">Password</label>
    <input type="password" id="password" name="password" class="form-control" placeholder="Password">

    <button class="btn btn-lg btn-primary btn-block" type="submit" id="save_form">Sign in</button>

</form>
<?php $__env->stopSection(); ?>




<?php $__env->startSection('javascript'); ?>
<script>
        $(document).ready(function() {
            $('#save_form').on('click', function(e) {
                e.preventDefault();
                var fname = $("#fname").val();
                var lname = $("#lname").val();
                var email = $("#email").val();
                var password = $("#password").val();
    
                $.ajax({
                    type: 'POST',
                    url: 'save_register',
                    data: {
                        '_token': '<?= csrf_token() ?>',
                        email: email,
                        fname: fname,
                        lname: lname,
                        password: password
                    },
                    success:function(data) {
                if (data.exists) {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'red');
                    $('#notifDiv').text('Email already exists');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                } else if (data.success) {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'green');
                    $('#notifDiv').text('Profile updated.');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                    location.reload();
                } else {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'red');
                    $('#notifDiv').text('An error occured. Please try later');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                }
                $(this).text('Save');
                $(this).removeAttr('disabled');
                 }.bind($(this))
                    
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\myApp\resources\views/register.blade.php ENDPATH**/ ?>