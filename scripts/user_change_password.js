let is_old_password_right = false;
let isPasswordTwice = false;
let isNameRight = false;

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


    old_password.oninput = function () {
        
        is_old_password_right = checkPassword(old_password.value);
        old_password_signal = (is_old_password_right) ? 'o' : '格式錯誤';
    }
    
    
    old_form_button.onclick = function() {
        
        old_form.style.display = 'none';
        new_form.style.display = 'block';
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

// 二次驗證輸入密碼
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


