const condition = document.getElementsByClassName("condition")
const mensBrand = document.getElementsByClassName("mensBrand")

// condition
for (let radioCheck of condition) {
    radioCheck.addEventListener("change", () => {
        let conditionId = radioCheck.value
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: `/monotown`,
            type: "GET",
            data: {
                "condition": conditionId
            },
        })
            // Ajaxリクエストが成功した時発動
            .done((data) => {
                window.location.href = (`/monotown?condition=${conditionId}`)
            })
            // Ajaxリクエストが失敗した時発動
            .fail((data) => {

            })
    })
}

// mensBrandName 
for (let radioCheck of mensBrand) {
    radioCheck.addEventListener("change", () => {
        let mensBrand = radioCheck.value

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: `/monotown`,
            type: "GET",
            data: {
                "mensBrand": mensBrand
            },
        })
            // Ajaxリクエストが成功した時発動
            .done((data) => {
                window.location.href = (`/monotown?mensBrand=${mensBrand}`)
            })
            // Ajaxリクエストが失敗した時発動
            .fail((data) => {

            })
})
}


