<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.inc.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <form  class="form-signin text-center"
            id="updateProfileForm"
             method="POST"
            enctype="multipart/form-data">
    <?php echo csrf_field(); ?>


    <div class="photo-row">
        <div class="photo-img" id="image_user"
            style="background-image:url('<?php echo e(asset('public/storage/'.Auth()->user()->profile_pic)); ?>');">
        </div>

        <div class="profile-content">
            <div>
                <label class="change-photo" for="profile_pic">Change Photo</label>
                <input onchange="doAfterSelectImage(this)" type="file" style="display: none;" id="profile_pic"
                    name="profile_pic" />
            </div>

            <div>
                <label onclick="doOnDeleteImageClick()" class="delete-photo"><span>•</span>
                    Delete Photo</label>
            </div>
        </div>
    </div>

    <input hidden value="<?php echo e(Auth::user()->id); ?>" name="user_id" />
    <h1 class="h3 mb-3 font-weight-normal">Update Profile</h1>

    <label for="fname" class="sr-only">First Name</label>
    <input type="text" id="fname" name="fname" class="form-control required_profile" placeholder="First Name"
        value="<?php echo e(Auth::user()->fname); ?>" required autofocus>
    <br>
    <label for="lname" class="sr-only">Last Name</label>
    <input type="text" id="lname" name="lname" class="form-control required_profile" placeholder="Last Name"
        value="<?php echo e(Auth::user()->lname); ?>" required autofocus>
    <br>
    <label for="email" class="sr-only">Email address</label>
    <input type="email" id="email" name="email" class="form-control required_profile" placeholder="Email address"
        value="<?php echo e(Auth::user()->email); ?>" required autofocus>

    <br>
    <label for="password" class="sr-only">Current Password</label>
    <input type="password" id="password" name="password" class="form-control" value="123456" placeholder="Password">
    <br>
    <a class="btn btn-primary collapsed" data-toggle="collapse" href="#collapseExample" role="button"
        aria-expanded="false" aria-controls="collapseExample">Change Password
    </a>


    <div class="collapse" id="collapseExample">
        <div class="col-md-12">
            <div id="floating-label">
                <h3 class="mb-20">Change Password</h3>
                <div class="row">



                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label mb-10">Current Password</label>
                            <input type="password" name="current_password" class="form-control " placeholder=""
                                value="">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label mb-10">New Password</label>
                            <input type="password" name="new_password" class="form-control " placeholder="" value="">
                        </div>
                    </div>
                    <div class="col-md-12 _ch-pass-p"> Minimum 8 Characters </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label mb-10">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control " placeholder=""
                                value="">
                        </div>
                    </div>
                    <div class="col-md-12 PT-10">
                        <button type="button" id="updatePasswordBtn" class="btn btn-primary mr-2 mb-0">Change
                            Password</button>
                        <button class="btn btn-primary btn-pre mb-0 cancelPwChange" type="button" data-toggle="collapse"
                            data-target="#collapseExample" aria-expanded="false"
                            aria-controls="collapseExample">Cancel</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <button class="btn btn-lg btn-primary btn-block" type="submit" id="saveProfile">Save</button>

</form>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function () {

        // Update Password
        $(document).on('click', '#updatePasswordBtn', function () {
            if (!$('[name="current_password"]').val || !$('[name="new_password"]').val() || !$(
                    '[name="confirm_password"]').val()) {
                $('[type="password"]').each(function () {
                    if ($(this).attr('id') == 'mainPwField') {
                        return;
                    }
                    $(this).css("border", "1px solid red");
                });

                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Please provide all the required information');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
                return;
            }

            if ($('[name="new_password"]').val() !== $('[name="confirm_password"]').val()) {
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Password must match');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
                return;
            }

            if ($('[name="new_password"]').val().length < 8) {
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Password must contain 8 characters atleast');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
                return;
            }

            $.ajax({
                type: 'POST',
                data: {
                    new_password: $('[name="new_password"]').val(),
                    current_password: $('[name="current_password"]').val(),
                    _token: $('[name="csrf-token"]').attr('content')
                },
                url: 'UpdatePassword',
                success: function (response) {
                    if (response == 200) {
                        $('.cancelPwChange').click();
                        $('[type="password"]').each(function () {
                            if ($(this).attr('id') == 'mainPwField') {
                                return;
                            }
                            $(this).val("");
                        });
                    } else if (response == 301) {
                        $('#notifDiv').fadeIn();
                        $('#notifDiv').css('background', 'red');
                        $('#notifDiv').text(
                            'Your current password is wrong. Please try again');
                        setTimeout(() => {
                            $('#notifDiv').fadeOut();
                        }, 3000);
                    } else {
                        $('#notifDiv').fadeIn();
                        $('#notifDiv').css('background', 'red');
                        $('#notifDiv').text('There was a problem while updating password');
                        setTimeout(() => {
                            $('#notifDiv').fadeOut();
                        }, 3000);
                    }
                }
            })
        });


        // Update Profile
        $(document).on('click', '#saveProfile', function () {
            var verif = [];
            $('#updateProfileForm .required_profile').css('border', '');
            $('#updateProfileForm .required_profile').parent().css('border', '');

            $('#updateProfileForm .required_profile').each(function () {
                if ($(this).val() == "") {
                    $(this).css("border", "1px solid red");
                    verif.push(false);
                    return;
                } else if ($(this).val() == '-1' || $(this).val() == null) {
                    $(this).parent().css("border", "1px solid red");
                    verif.push(false);
                    return;
                } else {
                    verif.push(true);
                }
            });

            if (verif.includes(false)) {
                return;
            }

            if (verif.includes(false)) {
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Please provide all the required information');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
                return;
            }


            $(this).attr('disabled', 'disabled');
            $(this).text('Processing');

            let myForm = document.getElementById('updateProfileForm');
            let formData = new FormData(myForm);
            console.log(formData);

            $.ajax({
                type: 'POST',
                url: 'save_profile',
                data: formData,
                headers: {
                    'X-CSRF-Token': $('form.hidden-image-upload [name="_token"]').val()
                },
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {

                    if (response == 301) {
                        $('#notifDiv').fadeIn();
                        $('#notifDiv').css('background', 'red');
                        $('#notifDiv').text('Email already exists');
                        setTimeout(() => {
                            $('#notifDiv').fadeOut();
                        }, 3000);
                    } else if (response == 200) {
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

    function doAfterSelectImage(input) {
        readURL(input);

    }

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image_user').css('background-image', 'url(' + e.target.result + ')');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function doOnDeleteImageClick() {
            deleteUserImage();
            let url = '<?php echo e(asset('public/assets/images/default.png')); ?>';
            $('#image_user').css('background-image', 'url(' + url + ')');
        }


        function deleteUserImage() {
            $.ajax({
                type: 'POST',
                data: {
                    '_token': '<?php echo e(csrf_token()); ?>'
                },
                url: '<?php echo e(route('delete.profile.picture')); ?>',
                success: function (response) {
                }.bind($(this))
            });
        }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\myApp\resources\views/update_profile.blade.php ENDPATH**/ ?>