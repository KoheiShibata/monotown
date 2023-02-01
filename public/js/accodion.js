const itemAccodionBtn = document.getElementById("accodion__btn")
itemAccodionBtn.addEventListener("click", function () {
    itemAccodionBtn.style.display = "none"
    itemAccodionBtn.className = "common__btn accodion__btn accodion__btn--close"
    const hiddenSaleItem = document.querySelectorAll(".sale__item--hide")
    for (let saleItem of hiddenSaleItem) {
        saleItem.className = "sale__item sale__item--show"
    }
})