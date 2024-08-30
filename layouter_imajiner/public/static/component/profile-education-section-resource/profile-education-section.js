document.addEventListener("DOMContentLoaded", (event) => {

    let sd = document.getElementById("sd")
    let smp = document.getElementById("smp")
    let sma = document.getElementById("sma")
    let uni = document.getElementById("uni")

    sd.addEventListener("mouseover", () =>{
        let content = document.getElementById("sd-content")
        content.classList.add('edu-slide')
    })
    sd.addEventListener("mouseout", () =>{
        let content = document.getElementById("sd-content")
        content.classList.remove('edu-slide')
    })

    smp.addEventListener("mouseover", () =>{
        let content = document.getElementById("smp-content")
        content.classList.add('edu-slide')
    })
    smp.addEventListener("mouseout", () =>{
        let content = document.getElementById("smp-content")
        content.classList.remove('edu-slide')
    })

    sma.addEventListener("mouseover", () =>{
        let content = document.getElementById("sma-content")
        content.classList.add('edu-slide')
    })
    sma.addEventListener("mouseout", () =>{
        let content = document.getElementById("sma-content")
        content.classList.remove('edu-slide')
    })

    uni.addEventListener("mouseover", () =>{
        let content = document.getElementById("uni-content")
        content.classList.add('edu-slide')
    })
    uni.addEventListener("mouseout", () =>{
        let content = document.getElementById("uni-content")
        content.classList.remove('edu-slide')
    })

})