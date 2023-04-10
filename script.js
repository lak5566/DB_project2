const optionmenu = document.querySelectorAll(".spanlist");
optionmenu.forEach(item1=>{
            let dd1 = item1.querySelector(".option-menu");
            let dd2 = item1.querySelector(".listIcon");
            dd2.addEventListener("click",()=>{
                dd1.classList.toggle("active");
                dd2.classList.toggle("active");
            })
        })