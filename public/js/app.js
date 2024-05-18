
$('input[name="key"]').keyup(function () {
    var keyword = $(this).val();
    const listSearch = document.querySelector('.list-search');
    listSearch.innerHTML = '';

    $.ajax({
        url: 'http://127.0.0.1:8000/ajax-search?search=' + keyword,
        type: 'GET',
        success: function (res) {
            for (var result of res) {
                const nameRegex = new RegExp('(' + keyword + ')', 'gi')
                const productName = result.product_name.replace(nameRegex, `<span class="highlight">$1</span>`);
                if (res.length < 9) {
                    // listSearch.innerHTML += `<li class="header__search-history-item history-item-link get_name" >
                    //     ${productName}
                    // </li>`;
                    listSearch.innerHTML += `<li class="list-group-item header__search-history-item history-item-link get_name" >${result.product_name}</li>`
                }
            }
            const markjs = new Mark(listSearch);
            markjs.mark(keyword);

            const get_name = document.querySelectorAll('.get_name');
            get_name.forEach(element => {
                element.addEventListener('click', () => {
                    const search = document.querySelector('input[name="key"]');
                    search.value = element.textContent.trim();
                    listSearch.innerHTML = '';
                })
            })
        }
    });
});

$('.btn--cart').click(function () {
    const num_cart_product = document.querySelector('.product-detail-number')
    const id_cart_product = document.querySelector('.product-detail-id')
    const number_cart = document.querySelector('.number_cart')

    if (num_cart_product && id_cart_product) {
        const num_cart_product_text = num_cart_product.textContent;
        const id_cart_product_text = id_cart_product.textContent;
    
        const arrayId = [num_cart_product_text, id_cart_product_text];
        const arrayIdWithQuantity = JSON.stringify(arrayId);
    
        $.ajax({
            url: 'http://127.0.0.1:8000/addToCart',
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { data: arrayIdWithQuantity },
            success: function(res) {
                number_cart.textContent = res;
            }
        });
    } else {
        console.log('Không tìm thấy phần tử có lớp .product-detail-number hoặc .product-detail-id.');
    }
});


const checkboxs = document.querySelectorAll('.checkbox_cart');
const btn_payment = document.querySelector('.btn__payment');
// btn_payment.style.opacity = 0.5;
checkboxs.forEach(element => {
    element.addEventListener('click', ()=>{
        console.log("ê");
        $arrayId = [];
        checkboxs.forEach(item => {
            if(item.checked == true){
                $arrayId.push(item.value);
            }
        })
        if($arrayId.length > 0) {
            btn_payment.disabled = false;
            btn_payment.style.opacity = 1;
        }else {
            btn_payment.disabled = true;
            btn_payment.style.opacity = 0.5;
        }
    })
})

$('.btn__payment').click(function () {
    const checkboxs = document.querySelectorAll('.checkbox_cart');
    $arrayId = [];
    checkboxs.forEach(element => {
        if(element.checked == true){
            $arrayId.push(element.value);
        }
    })
    console.log($arrayId);

    var jsonStr = JSON.stringify($arrayId);

    document.cookie = "name=value; expires=expiry; path=path; domain=domain; secure";

    document.cookie = "carts=" + jsonStr;

    var cookieValue = document.cookie.replace(/(?:(?:^|.*;\s*)carts\s*\=\s*([^;]*).*$)|^.*$/, "$1");

    var retrievedArray = JSON.parse(cookieValue);

    console.log(retrievedArray);


});
