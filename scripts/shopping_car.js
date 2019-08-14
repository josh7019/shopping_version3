

window.onload = function () {
    button_element_list = document.getElementsByClassName('delete_button');
    checkout_button = document.getElementById('checkout_button');
    checkout_button.onclick = function() {checkout();}
    for (let i = 0; i < button_element_list.length; i++) {
        button_element_list[i].onclick = function (e) {
            row = e.target.parentElement.parentElement.parentElement;
            product_id = row.children[0].value;
            deleteOne();
        }
    }

    amount_element_list = document.getElementsByClassName('amount');
    for (let i = 0; i < amount_element_list.length; i++) {
        amount_element_list[i].onblur = function (e) {
            row = e.target.parentElement.parentElement;
            product_id = row.children[0].value;
            amount = e.target.value;
            if (!checkUnsigned(amount)) {
                alert('請輸入不小於1的整數');
                if (amount <= 0) {
                    e.target.value = 1;
                    amount = e.target.value;
                }
            }
            
            changeAmount(e)
        }
    }
    
}

function deleteOne() {
    if (!confirm('確定移除商品嗎?')) {
        return ;
    }
    $.ajax({
        type : 'DELETE',
        url : '/shopping/controller/usercontroller.php/product',
        data : {'product_id' : product_id},
        success : function(result_array) {
            result_array = JSON.parse(result_array);
            showSingal(result_array['alert']);
            if (result_array['is_success']) {
                row.style.display = 'none';
                let product_count = document.getElementById('product_count').innerText;
                product_count = parseInt(product_count) - 1;
                document.getElementById('product_count').innerText = product_count;
                document.getElementById('total_price').innerHTML = 'NT' + result_array['total_price'];
                if (result_array['user_final_cash'] >= 0) {
                    document.getElementById('user_final_cash').innerHTML = result_array['user_final_cash'];
                } else {
                    document.getElementById('user_final_cash').innerHTML = result_array['user_final_cash'] + "(餘額不足)";
                    checkout_button.disabled = 'disabled';
                }
                if (result_array['total_price'] <= 0 || result_array['user_final_cash'] < 0) {
                    checkout_button.disabled = 'disabled';
                } else {
                    checkout_button.disabled = false;
                }
            } else {
                row.style.display = 'none';
            }
            direct(result_array['location']);
        }
    })
}

function changeAmount(e) {
    $.ajax({
        type : 'PUT',
        url : '/shopping/controller/usercontroller.php/product',
        data : {
            'product_id' : product_id,
            'amount' : amount
        },
        success : function(result_array) {
            result_array = JSON.parse(result_array);
            showSingal(result_array['alert']);
            // 修改數量成功
            if (result_array['is_success'] == 1) {
                document.getElementById('total_price').innerHTML = 'NT' + result_array['total_price'];
                if (result_array['user_final_cash'] >= 0) {
                    document.getElementById('user_final_cash').innerHTML = result_array['user_final_cash'];
                } else {
                    document.getElementById('user_final_cash').innerHTML = result_array['user_final_cash'] + "(餘額不足)";
                }
                if (result_array['total_price'] <= 0 || result_array['user_final_cash'] < 0) {
                    checkout_button.disabled = 'disabled';
                } else {
                    checkout_button.disabled = false;
                }
                // 商品已下架
            } else if (result_array['is_success'] == 2) {
                row.style.display = 'none';
                // 庫存量不足
            } else if (result_array['is_success'] == 3) {
                e.target.value = result_array['amount'];
                document.getElementById('total_price').innerHTML = 'NT' + result_array['total_price'];
                if (result_array['user_final_cash'] >= 0) {
                    document.getElementById('user_final_cash').innerHTML = result_array['user_final_cash'];
                } else {
                    document.getElementById('user_final_cash').innerHTML = result_array['user_final_cash'] + "(餘額不足)";
                }
            }
            direct(result_array['location']);
        }
    })
}

function checkout() {
    $.ajax({
        type : 'PUT',
        url : '/shopping/controller/usercontroller.php/checkOut',
        success : function(result_array) {
            result_array = JSON.parse(result_array);
            showSingal(result_array['alert']);
            direct(result_array['location']);
            
        }
    })
}