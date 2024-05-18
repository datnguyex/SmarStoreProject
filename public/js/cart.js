const addQuantities = document.querySelectorAll('.add_quantity')
const subQuantities = document.querySelectorAll('.sub_quantity')
const numberQuantity = document.querySelectorAll('.number_quantity')
const priceProduct = document.querySelectorAll('.price__product-cart')
const totalProduct = document.querySelectorAll('.total__product-cart')
const checkbox_cart = document.querySelectorAll('.checkbox_cart')


// let counts = Array.from({ length: addQuantities.length }, () => 1);?

addQuantities.forEach( (addQuantity, index ) => {
    $(addQuantity).click(function() {  
        numberQuantity[index].textContent ++;
        const data = [
            checkbox_cart[index].value,
            numberQuantity[index].textContent,   
        ]
        const arrayIdWithQuantity = JSON.stringify(data);
        console.log(arrayIdWithQuantity);
        $.ajax({
            url: 'http://127.0.0.1:8000/addQuantity',
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { data: arrayIdWithQuantity},
            success: function(res) {
                var total = parseInt(priceProduct[index].textContent) * res
                totalProduct[index].innerHTML = total.toString()
            }
        });
    })
});


subQuantities.forEach((subQuantity, index) => {
    $(subQuantity).click(function() {
        if(numberQuantity[index].textContent >= 2 ){
            numberQuantity[index].textContent --
        }  
        const data = [
            checkbox_cart[index].value,
            numberQuantity[index].textContent,
        ]
        const arrayIdWithQuantity = JSON.stringify(data);
        console.log(arrayIdWithQuantity);
        $.ajax({
            url: 'http://127.0.0.1:8000/addQuantity',
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { data: arrayIdWithQuantity},
            success: function(res) {
                var total = parseInt(priceProduct[index].textContent) * res
                totalProduct[index].innerHTML = total.toString()
            }
        });
    })
})








