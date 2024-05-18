const number_verify = document.querySelector('input[name="get__number_verify"]');

function generateRanDomNumber() {
    var code = "";
    for($i = 0; $i < 4; $i++){
        var randomNumber = Math.floor(Math.random() * 10);
        code += randomNumber
    }
    return code
}

var code = generateRanDomNumber();
number_verify.value = code;


const add_cart_product = document.querySelectorAll('.product-detail-add')
const sub_cart_product = document.querySelectorAll('.product-detail-sub')
const num_cart_product = document.querySelectorAll('.product-detail-number')


let count = Array.from({ length: add_cart_product.length }, () => 1);

add_cart_product.forEach( (addQuantity, index ) => {
    addQuantity.addEventListener('click', ()=>{  
        count[index] ++
        num_cart_product[index].innerHTML = count[index]
    })
});

sub_cart_product.forEach((subQuantity, index) => {
    subQuantity.addEventListener('click', ()=>{
        if(count[index] >= 2 ){
            count[index] --
        }
        num_cart_product[index].innerHTML = count[index]
    })
})