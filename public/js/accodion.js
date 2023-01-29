const itemAccodionBtn = document.getElementById("more__btn")
itemAccodionBtn.addEventListener("click", function () {
    if (itemAccodionBtn.textContent == "More >") {
        itemAccodionBtn.textContent = "Close >"
        const hiddenSaleItem = document.querySelectorAll(".sale__item--hidden")
        for (let saleItem of hiddenSaleItem) {
            saleItem.className = "sale__item sale__item--active"
        }
    } else {
        itemAccodionBtn.textContent = "More >"
        const activeSaleItem = document.querySelectorAll(".sale__item--active")
        for(let saleItem of activeSaleItem) {
            saleItem.className = "sale__item sale__item--hidden"
        } 
    }
})