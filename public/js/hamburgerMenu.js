const hamburgerBtn = document.getElementById("hamburger__btn")

hamburgerBtn.addEventListener("click",  function() {
    this.classList.toggle("hamburger__btn--active")
    const hamburgerMenu = document.getElementById("search-sidebar")
    hamburgerMenu.classList.toggle("search-sidebar--active")
})