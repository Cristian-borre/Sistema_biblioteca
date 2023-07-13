let lisElements = document.querySelectorAll('.a-click');

lisElements.forEach(lisElements => {
    lisElements.addEventListener('click',()=>{
        
        lisElements.classList.toggle('arrow');

        let height = 0;
        let menu = lisElements.nextElementSibling;
        console.log(height);
        if(menu.clientHeight == "0"){
            height=menu.scrollHeight;
        }
        menu.style.height= `${height}px`;
    })
})