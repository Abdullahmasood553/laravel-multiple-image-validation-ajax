<?php $__env->startSection('content'); ?>

<h1 class="text-center p-3 bg-secondary text-white">Image Preview | Validation | Save Image using AJAX</h1>


<div class="container mt-4">
    <form id="updatePostForm"  enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="<?php echo e($post->id); ?>">
        <?php echo csrf_field(); ?>
     
        <div class="upload-imgs">
            <div class="img-uploade-row">
                <div class="upload-column">

                    <input onchange="doAfterSelectImage(this)" type="file" name="screenshot" class="screenshot" id="screenshot"
                        style="display:none">

                    <label for="screenshot" class="img-uploaders">
                        <img src="<?php echo e(asset('storage/users/'.$post->screenshot)); ?>" id="post_user_image_" />
                    </label>

                    <p>Post Screenshot</p>
                    <span style="display:none" id="error_screenshot">
                        <div class="alert alert-danger" role="alert">Post is required</div>
                    </span>
                </div>


            </div>
        </div>
        <br><br>
        <div class="modal-btn">
            <button type="button" class="btn btn_modal_blue update_post_btn">
               Update Post
            </button>
        </div>

    </form>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('javascript'); ?>


<script src="http://code.jquery.com/jquery-3.4.1.js"></script>
<script src="<?php echo e(asset('js/helpers.js')); ?>"></script>
<script>
    $(function () {


        $(document).on("click", ".update_post_btn", function (event) {
            event.preventDefault();
            let check = userHasUploadedScreenshots();
            if (check) {
                let myForm = document.getElementById('updatePostForm');
                let formData = new FormData(myForm);
                uploadScreenshots(formData);
                
            }
        });
    });

    function uploadScreenshots(formData) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const id = $('#id').val();
        $.ajax({
            type: "POST",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            url: "update_post/"+id,
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
        let file = $('#screenshot').get(0).files[0];
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
        let file = $("#screenshot").get(0).files[0];
        if (file == undefined || file == null) {
            $("#error_screenshot").show();
        } else {
            $("#error_screenshot").hide();
        }
    }

    function doAfterSelectImage(input) {
        readURL(input);
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#post_user_image_').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-multiple-image-validation-ajax\resources\views/update_image.blade.php ENDPATH**/ ?>