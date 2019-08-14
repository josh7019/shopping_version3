window.onload = function() {
    let error = parseInt($('#error').val());
    switch (error) {
        case 0:
            alert('請重新登入');
            window.location = '/shopping/controller/guestcontroller.php/login';
            break;
        case 1:
            alert('編號錯誤');
            window.location = '/shopping/controller/usercontroller.php/shoppingHistory';
            break;
        case 2:
            alert('訂單號碼不存在');
            window.location = '/shopping/controller/usercontroller.php/shoppingHistory';
            break;
        case 3:
            alert('權限錯誤');
            window.location = '/shopping/controller/guestcontroller.php/index';
            break;
        case 4:
            alert('請先登入');
            window.location = '/shopping/controller/guestcontroller.php/login';
            break;
        case 5:
            alert('錯誤請求');
            window.location = '/shopping/controller/guestcontroller.php/index';
            break;
        case 6:
            alert('帳戶已凍結,請撥打分機號碼2116進行解鎖');
            alert('進行自動登出');
            window.location = '/shopping/controller/guestcontroller.php/logout';
            break;
        case 7:
            alert('請先登出');
            window.location = '/shopping/controller/guestcontroller.php/index';
            break;
    }
}
