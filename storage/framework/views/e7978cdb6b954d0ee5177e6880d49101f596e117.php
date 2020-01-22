<?php $__env->startSection('content'); ?>

<h1 class="text-center p-3 bg-primary text-white">Image Preview | Validation | Save Image using AJAX</h1>


<div class="container mt-4">
    <form method="POST" id="updateProfileForm" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="upload-imgs">
            <div class="img-uploade-row">
                <div class="upload-column">
                 
                    <input onchange="doAfterSelectImageInsta(this)" type="file" name="screenshot" class="" id="instagram_screenshot_"
                        style="display:none" >
                  
                    <label for="instagram_screenshot_" class="img-uploaders">
                        <img src="<?php echo e(asset('public/assets/images/placeholder.png')); ?>" id="image_user_insta_" />
                    </label>
                  
                    <p>Instagram</p>
                    <span style="display:none" id="error_instagram_screenshot_">
                        <div class="alert alert-danger" role="alert">Instagram Screenshot is required</div>
                    </span>
                </div>


            </div>
        </div>
        <br><br>
        <div class="modal-btn">
            <button type="button" class="btn btn_modal_blue complete_order_btn">
                Complete Order
            </button>
        </div>

    </form>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('javascript'); ?>


<script src="http://code.jquery.com/jquery-3.4.1.js"></script>
<script src="<?php echo e(asset('public/js/helpers.js')); ?>"></script>
<script>

    $(function () {
        $(document).on("click", ".complete_order_btn", function (event) {
            event.preventDefault();
            let check = userHasUploadedScreenshots();
            if (check) {
                let myForm = document.getElementById('updateProfileForm');
                let formData = new FormData(myForm);
                uploadScreenshots(formData);
                console.log(formData);
            }
        });
    });

    function uploadScreenshots(formData) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                data: formData,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                url: "<?php echo e(route('post.completed.job.modal')); ?>",
                success: function (data) {
                    if (data.status) {
                        showCustomSucces(data.message);
                    } else {
                        showCustomError(data.error)
                    }
                },
                error: function (err) {
                    showCustomError('Something went Wrong!')
                }
            });
        }


           function userHasUploadedScreenshots() {
                let check = true;
                let file = $('#instagram_screenshot_').get(0).files[0];
                console.log(file);
                if (file == undefined || file == null) {
                    check = false;
                    handleErrors();
                    return check;
                    }

                    handleErrors();
                    return check;
              }


            function handleErrors() {
                let file = $("#instagram_screenshot_").get(0).files[0];
                if (file == undefined || file == null) {
                    $("#error_instagram_screenshot_").show();
                } else {
                    $("#error_instagram_screenshot_").hide();
                }
            }

            function doAfterSelectImageInsta(input) {
                readURL(input);
            }

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#image_user_insta_').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

</script>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_image_ajax\resources\views/get_image.blade.php ENDPATH**/ ?>