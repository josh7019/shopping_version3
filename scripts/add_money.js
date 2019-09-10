

window.onload=function(){
    let password = document.getElementById('password');
    let password_button = document.getElementById('password_button');
    let add_money = document.getElementById('add_money');
    let add_money_button = document.getElementById('add_money_button');
    let password_form = document.getElementById('password_form');
    let add_money_form = document.getElementById('add_money_form');
    let title = document.getElementById('title');
    password_button.onclick = function() {
        is_password_right = checkOldPassword(password);
    }
    add_money.oninput = function() {
        let is_right = checkUnsigned(add_money.value);
        if (!is_right) {
            add_money.value = 1;
            alert("不可小於1");
        }
        if (add_money.value > 9999999) {
            add_money.value = 9999999;
            alert("不可大於9999999");
        }
    }
    add_money_button.onclick = function() {
        addMoney();
    }
}

// 驗證舊密碼
function checkOldPassword(password){
    $.ajax({
        type : 'POST',
        url : '/shopping/controller/usercontroller.php/checkPassword',
        data : {
            'password' : password.value
        },
        success : function(result_array) {
            result_array = JSON.parse(result_array);
            showSingal(result_array['alert']);
            if (result_array['is_success']) {
                password_form.style.display = 'none';
                add_money_form.style.display = 'block';
                title.innerHTML = '加值';
            }
        }
    })
}

// 送出加值
function addMoney() {
    if (confirm('確認儲值嗎?')) {
        $.ajax({
            type : 'POST',
            url : '/shopping/controller/usercontroller.php/addmoney',
            data : {
                'add_money' : add_money.value,
                'password' : password.value
            },
            success : function(result_array) {
                result_array = JSON.parse(result_array);
                showSingal(result_array['alert']);
                direct(result_array['location']);
                if (result_array['is_success']) {

                }
            }
        })
    }
}