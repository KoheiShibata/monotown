
const btnSubmitContact = document.getElementById("btn-submit-contact")
btnSubmitContact.addEventListener("click", function () {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-secondary',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        text: "こちらの内容でよろしいでしょうか？",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes!',
        cancelButtonText: 'cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.contactForm.submit()
        } else {
            return false
        }
    })

})