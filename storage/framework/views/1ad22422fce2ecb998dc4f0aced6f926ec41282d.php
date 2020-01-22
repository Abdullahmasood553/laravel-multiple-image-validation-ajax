<?php $__env->startSection('content'); ?>
<form class="form-signin text-center" style="">
    <?php echo csrf_field(); ?>
   
    <h1 class="h3 mb-3 font-weight-normal">Login</h1>
    <label for="email" class="sr-only">Email address</label>
    <input type="email" id="email" class="form-control" placeholder="Email address" required autofocus>
   
    <label for="password" class="sr-only">Password</label>
    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
    <a href="<?php echo e(route('check_email_page')); ?>">Reset Password</a>
    <button class="btn btn-lg btn-primary btn-block" id="loginBtn" type="submit">Sign in</button>

  </form>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        $("#loginBtn").click(function(e) {
  
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    
            e.preventDefault();
            var email     = $("#email").val();
            var password  = $("#password").val();
    
            $.ajax({
                url: 'user_login',
                type: 'POST',
                data: {
                    email: email,
                    password: password
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                      if(data.success) {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'green');
                    $('#notifDiv').text('User Successfully Login');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                    window.location = "<?php echo e(route('dashboard')); ?>";
                  } else if(data.verify_email) {
                      $('#notifDiv').fadeIn();
                       $('#notifDiv').css('background', 'red');
                       $('#notifDiv').text('Verify your account first from email');
                       setTimeout(() => {
                        $('#notifDiv').fadeOut();
                       }, 3000);
                    }
                    } 
                     else {
                       $('#notifDiv').fadeIn();
                       $('#notifDiv').css('background', 'red');
                       $('#notifDiv').text('An error occured. Please try later');
                       setTimeout(() => {
                        $('#notifDiv').fadeOut();
                       }, 3000);
                    }
                }
            });
          });  
        }); 
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\myApp\resources\views/login.blade.php ENDPATH**/ ?>