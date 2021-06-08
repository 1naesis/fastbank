if(document.querySelectorAll('.select-client-type')){
    let selects = document.querySelectorAll('.select-client-type');
    let inputBlock = document.querySelectorAll('.client-select');
    selects.forEach(el => {
        el.addEventListener('change', function (){
            inputBlock.forEach(inputBlock => {
                if(inputBlock.getAttribute('data-select') === el.value){
                    inputBlock.classList.add('active');
                }else{
                    inputBlock.classList.remove('active');
                }
            })
        })
    })
}
if(document.querySelectorAll('.select-product-type')){
    let selects = document.querySelectorAll('.select-product-type');
    let inputBlock = document.querySelectorAll('.product-select');
    selects.forEach(el => {
        el.addEventListener('change', function (){
            inputBlock.forEach(inputBlock => {
                if(inputBlock.getAttribute('data-select') === el.value){
                    inputBlock.classList.add('active');
                }else{
                    inputBlock.classList.remove('active');
                }
            })
        })
    })
}