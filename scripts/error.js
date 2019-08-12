window.onload = function() {
    let error = parseInt($('#error').val());
    switch (error) {
        case 0:
            alert('請重新登入');
            window.location = '/shopping/controller/usercontroller.php/login';
            break;
        case 1:
            alert('編號錯誤');
            window.location = '/shopping/controller/usercontroller.php/shoppingHistory';
            break;
        case 2:
            alert('訂單號碼不存在');
            window.location = '/shopping/controller/usercontroller.php/shoppingHistory';
            break;
    }
}
