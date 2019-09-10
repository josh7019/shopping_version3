let is_submit = true;

window.onload = function () {
    let cash = document.getElementById('cash');
    let button_element_list = document.getElementsByClassName('delete_button');
    let checkout_button = document.getElementById('checkout_button');
    let user_final_cash = document.getElementById('user_final_cash');
    let total_price = document.getElementById('total_price');
    checkout_button.onclick = function() {checkout();}
    // 刪除鈕事件
    for (let i = 0; i < button_element_list.length; i++) {
        button_element_list[i].onclick = function (e) {
            row = e.target.parentElement.parentElement.parentElement;
            product_id = row.children[0].value;
            deleteOne();
        }
    }
    amount_element_list = document.getElementsByClassName('amount');
    for (let i = 0; i < amount_element_list.length; i++) {
        // 數量修改時改變金額
        amount_element_list[i].oninput = function () {
            let count_price = getTotalPrice();
            let final_cash = cash.innerText - count_price;
            total_price.innerHTML = count_price;
            if (final_cash >= 0) {
                user_final_cash.innerHTML = final_cash;
                checkout_button.disabled = false;
            } else {
                user_final_cash.innerHTML = final_cash + "(餘額不足)";
                checkout_button.disabled = 'disabled';
            }
        }
        //失焦時送出數量改變
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
            changeAmount(e);
        }
        // 按鍵彈起變更
        amount_element_list[i].onkeyup = function (e) {
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
            changeAmount(e);
            is_submit = false;
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
                // 變更右上角購物車數量
                let product_count = document.getElementById('product_count').innerText;
                product_count = parseInt(product_count) - 1;
                document.getElementById('product_count').innerText = product_count;
                // 變更總價
                total_price.innerHTML = result_array['total_price'];
                // 變更餘額
                if (result_array['user_final_cash'] >= 0) {
                    user_final_cash.innerHTML = result_array['user_final_cash'];
                } else {
                    user_final_cash.innerHTML = result_array['user_final_cash'] + "(餘額不足)";
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
            // 修改數量成功
            if (result_array['is_success'] == 1) {
                document.getElementById('total_price').innerHTML =  result_array['total_price'];
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
                document.getElementById('total_price').innerHTML = result_array['total_price'];
                if (result_array['user_final_cash'] >= 0) {
                    document.getElementById('user_final_cash').innerHTML = result_array['user_final_cash'];
                } else {
                    document.getElementById('user_final_cash').innerHTML = result_array['user_final_cash'] + "(餘額不足)";
                }
            }
            showSingal(result_array['alert']);
            direct(result_array['location']);
            is_submit = true;
        }
    })
}

function checkout() {
    if (!is_submit) {
        return;
    }
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

function getTotalPrice(){
    let total = 0;
    for (let i = 0; i < amount_element_list.length; i++) {
        row = amount_element_list[i].parentElement.parentElement;
        product_id = row.children[0].value;
        amount = amount_element_list[i].value;
        price = row.children[4].innerText;
        total += amount*price;
    }
    return total;
}