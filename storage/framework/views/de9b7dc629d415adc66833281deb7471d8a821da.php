<?php $__env->startSection('content'); ?>

<h1 class="text-center p-3 bg-secondary text-white">Image Preview | Validation | Save Image using AJAX</h1>


<div class="container mt-4">
    <form method="POST" id="updateProfileForm" enctype="multipart/form-data">
        <input type="hidden" name="post_updating_id">
        <?php echo csrf_field(); ?>

        <div class="upload-imgs">
            <div class="img-uploade-row">
                <div class="upload-column">

                    <input onchange="doAfterSelectImage(this)" type="file" name="screenshot" class="screenshot_" id="screenshot_"
                        style="display:none">

                    <label for="screenshot_" class="img-uploaders">
                        <img src="<?php echo e(asset('assets/images/placeholder.png')); ?>" id="post_user_image_" />
                    </label>

                    <p>Post Screenshot</p>
                    <span style="display:none" id="error_screenshot_">
                        <div class="alert alert-danger" role="alert">Post is required</div>
                    </span>
                </div>


            </div>
        </div>
        <br><br>
        <div class="modal-btn">
            <button type="button" class="btn btn_modal_blue complete_order_btn">
               Save Post
            </button>
        </div>

    </form>


    <br> <br>


    <h3 class="text-center p-3 bg-secondary text-white">Posts Listings</h3>
    <div class="body serviceListHolder"></div>



</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('javascript'); ?>


<script src="http://code.jquery.com/jquery-3.4.1.js"></script>
<script src="<?php echo e(asset('js/helpers.js')); ?>"></script>
<script>
    $(function () {

        getPostImages();
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
                    getPostImages();
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
        let file = $('#screenshot_').get(0).files[0];
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
        let file = $("#screenshot_").get(0).files[0];
        if (file == undefined || file == null) {
            $("#error_screenshot_").show();
        } else {
            $("#error_screenshot_").hide();
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



    ////////////////////// Get all Customers //////////////////////////////
    // Get all the services from DB
    function getPostImages() {
        $.ajax({
            type: 'GET',
            url: "get_posts",
            success: function (response) {
                var response = JSON.parse(response);
                $('.serviceListHolder').empty();
                $('.serviceListHolder').append(`<table class="table table-hover dt-responsive nowrap serviceList" id="example" style="width:50%">
    <thead>
    <tr>
        <th>Service ID</th>
        <th>Images</th>
        <th>Action</th>
        <th></th>
    </tr>
</thead>
<tbody>
</tbody>
</table>`);
                response.forEach(element => {
                    $('.serviceList tbody').append(`<tr>
                <td>${element.id}</td>
                <td><img src="<?php echo e(asset('storage/users/${element.screenshot}')); ?>" class="proporsal-imag"> </td>
                <td><a class="btn btn-default btn-sm update_post" href="<?php echo e(url('update_image/${element.id}')); ?>">Update</a></td>
                <td><button class="btn btn-danger btn-sm del_post" id="${element['id']}">Delete</button></td>

        </tr>`);
                });
            }
        })
    }


    //Delete for Sub Category
    $(document).on('click', '.del_post', function () {
        var id = $(this).attr('id');
    
        $.ajax({
            type: 'GET',
            url: 'delete_post/'+id,
            data: {
                id: id
            },
            success: function (data) {

                if (data.status) {
                    showCustomSucces(data.message);
                    getPostImages();
                } else {
                    showCustomError(data.error)
                }

            }
        });
    });
    // End of delete sub category


</script>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\image_validation\resources\views/get_image.blade.php ENDPATH**/ ?>