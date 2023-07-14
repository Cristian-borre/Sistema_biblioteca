let lisElements = document.querySelectorAll('.a-click');
let arrow = document.querySelector('.l-arrow');
let submenu = document.querySelector('.submenu');
let side_i = document.querySelectorAll('.icon');
let side_r = document.querySelector('.icon');
let side = document.querySelector('.sidebar');
let icon_c = document.querySelectorAll('.close');

side_i.forEach(side_i =>{
    side_i.addEventListener('click', () => {
        side_i.classList.toggle('hidden')
        side.classList.toggle('w-[240px]')
        side.classList.remove('hidden')
    })
})

icon_c.forEach(icon_c =>{
    icon_c.addEventListener('click', () => {
        side.classList.remove('w-[240px]')
        side_r.classList.remove('hidden')
        side.classList.toggle('hidden')
    })
})

lisElements.forEach(lisElements => {
    lisElements.addEventListener('click', () => {

        lisElements.classList.toggle('arrow');
        arrow.classList.toggle('rotate-180');
        submenu.classList.toggle('hidden');

        let height = 0;
        let menu = lisElements.nextElementSibling;
        if (menu.clientHeight == "0") {
            height = menu.scrollHeight;
        }
        menu.style.height = `${height}px`;
    })
});

const openModalBtn = document.querySelectorAll('.btnmodal');
const modal = document.querySelector('.staticModal');

openModalBtn.forEach(openModalBtn =>{
    openModalBtn.addEventListener('click', () => {
      modal.classList.remove('hidden');
    });
})

