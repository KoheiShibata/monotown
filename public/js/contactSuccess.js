window.addEventListener("load", function () {
    const contactMessageSuccess = document.getElementById("contact-message")
    if (contactMessageSuccess) {
        contactMessageSuccess.classList.add("contact__message--active")
        setTimeout(function () {
            contactMessageSuccess.classList.remove("contact__message--active")
        }, 5000)
    }
})