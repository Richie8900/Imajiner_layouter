document.addEventListener("DOMContentLoaded", (event) => {

    document.querySelectorAll('.profile-nav').forEach(anchor => {
        
        // make scroll smooth
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });

        // arrow blink animation
        anchor.addEventListener('mouseover', () => {
            anchor.querySelector('img').classList.add('blink')
            setTimeout(() =>{
                anchor.querySelector('img').classList.remove('blink')
            }, 500)
        })

    });

    // navigation extend
    let nav = document.getElementById('profile-nav')
    if(nav){
        nav.addEventListener('mouseover', () =>{
            nav.classList.add('nav-extend')
            nav.classList.remove('nav-closed')
        })
        nav.addEventListener('mouseout', () =>{
            nav.classList.remove('nav-extend')
            nav.classList.add('nav-closed')
        })
    }

    let imajiner = document.getElementById('imajiner-name')
    if(imajiner){
        imajiner.addEventListener('mouseover', () =>{
            setTimeout(() =>{
                imajiner.classList.remove('hover:text-teal-400')
            }, 500)
        })
        imajiner.addEventListener('mouseout', () =>{
            imajiner.classList.add('hover:text-teal-400')
        })
    }

})