function showCustomSucces(text) {
    Swal.fire(
        'Success!',
        text,
        'success'
    )
}

function showDeletedDialog(text) {
    Swal.fire(
        'Deleted!',
        text,
        'Success'
    )
}


function showCustomError(text) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: text
    })
}