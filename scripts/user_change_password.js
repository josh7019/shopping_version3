let is_old_password_right = false;
let isPasswordTwice = false;
let isNameRight = false;
let is_new_password_right = false;
let is_password_twice_right = false;

window.onload=function(){
    let old_password = document.getElementById('old_password');
    let new_password = document.getElementById('new_password');
    let password_twice = document.getElementById('password_twice');
    let old_form = document.getElementById('old_form');
    let new_form = document.getElementById('new_form');
    let old_form_button = document.getElementById('old_form_button');
    let new_form_button = document.getElementById('new_form_button');
    let old_password_signal = document.getElementById('old_password_signal');
    let new_password_signal = document.getElementById('new_password_signal');
    let password_twice_signal = document.getElementById('password_twice_signal');
    
    // old_password.oninput = function () {
    //     is_old_password_right = checkPassword(old_password.value);
    //     old_password_signal = (is_old_password_right) ? 'o' : '格式錯誤';
    // }
    
    old_form_button.onclick = function() {
        is_old_password_right = checkOldPassword(old_password);
    }

    new_form_button.onclick = function() {
        changePassword(new_password);
    }

    new_password.oninput = function () {
        is_new_password_right = checkPasswordFormat(new_password.value);
        new_password_signal.innerText = (is_new_password_right) ? 'o' : '格式錯誤';
        password_twice_signal.innerText = '密碼不相同';
        is_password_twice_right = false;
        isSubmit();
    }

    password_twice.oninput = function () {
        if (new_password.value == password_twice.value) {
            password_twice_signal.innerText = 'o';
            is_password_twice_right = true;
        } else {
            password_twice_signal.innerText = '密碼不相同';
            is_password_twice_right = false;
        }
        isSubmit();
    }

}


// 檢查密碼格式
function checkPassword(e) {
    if(checkPasswordFormat(e.target.value)){
        isPasswordRight=true;
        isPasswordTwice=false;
        $('#password_Signal').html('ok');
        $('#passwordTwice_Signal').html('密碼不相同');
    }else{
        isPasswordRight=false;
        isPasswordTwice=false;
        $('#passwordTwice_Signal').html('密碼不相同');
        $('#password_Signal').html('格式錯誤');
    }
    isSubmit();
}

// 二次驗證密碼格式
function confirmPassword (e) {
    let password='';
    password=$('#password').val();
    if(e.target.value==password){
        isPasswordTwice=true;
        $('#passwordTwice_Signal').html('ok');
    }else{
        isPasswordTwice=false;
        $('#passwordTwice_Signal').html('密碼不相同');
    }
    isSubmit();
}

// 驗證舊密碼
function checkOldPassword(old_password){
    $.ajax({
        type : 'POST',
        url : '/shopping/controller/usercontroller.php/checkPassword',
        data : {
            'password' : old_password.value
        },
        success : function(result_array) {
            result_array = JSON.parse(result_array);
            showSingal(result_array['alert']);
            if (result_array['is_success']) {
                old_form.style.display = 'none';
                new_form.style.display = 'block';
            }
        }
    })
}

// 驗證是否可送出
function isSubmit() {
    new_form_button.disabled = (is_password_twice_right && is_new_password_right) ? false : 'disabled';
}

function changePassword(new_password){
    $.ajax({
        type : 'PUT',
        url : '/shopping/controller/usercontroller.php/changePassword',
        data : {
            'password' : new_password.value
        },
        success : function(result_array) {
            console.log(result_array);
            result_array = JSON.parse(result_array);
            showSingal(result_array['alert']);
            direct(result_array['location']);
        }
    })
}

