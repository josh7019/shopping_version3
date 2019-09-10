let edit_product;
let edit_button;
let price;
let name;
let is_price_right = true;
let is_name_right = true;
let is_stock_right = true;

window.onload = function(){
    
    edit_product = document.getElementById('edit_product');
    edit_button = document.getElementById('edit_button');
    price = document.getElementById('price');
    name = document.getElementById('name');
    stock = document.getElementById('stock');

    price.oninput = function(event){checkPrice(event);}
    name.oninput = function(event){checkName(event);}
    stock.oninput = function(event) {checkStock(event);}
    edit_button.onclick = function(){alert('not yet'); return false;}
    issubmit();
    
    $(':file').change(function() {  
        checkFile(this);
    });
}


function checkPrice(e){
    price = e.target.value;
    
    if (!price.match(/^[1-9][0-9]{0,}$/)) {
        document.getElementById('price_signal').innerHTML = 'x';
        issubmit()
        is_price_right = false;
    } else if (price > 99999) {
        document.getElementById('price_signal').innerHTML = '價格不得超過99999';
        issubmit()
        is_price_right = false;
    } else {
        document.getElementById('price_signal').innerHTML = 'o';
        issubmit()
        is_price_right = true;
    }
    
}

function checkStock(e){
    stock = e.target.value;
    
    if (!stock.match(/^0$|^[1-9][0-9]{0,}$/)) {
        document.getElementById('stock_signal').innerHTML = 'x';
        issubmit()
        is_stock_right = false;
    } else if (stock > 1000) {
        document.getElementById('stock_signal').innerHTML = '庫存量不得超過1000';
        issubmit()
        is_stock_right = false;
    } else {
        document.getElementById('stock_signal').innerHTML = 'o';
        issubmit()
        is_stock_right = true;
    }
    
}


function checkName(e){
    product_name = e.target.value;
    is_name_right = checkContent(product_name);
    
    if (is_name_right) {
        document.getElementById('name_signal').innerHTML = 'o';
    } else {
        document.getElementById('name_signal').innerHTML = 'x';
    }
    issubmit();
}


function checkDescript(e){
    product_descript = e.target.value;
    is_descript_right = checkContent(product_descript);
    if (is_descript_right) {
        document.getElementById('descript_signal').innerHTML = 'o';
    } else {
        document.getElementById('descript_signal').innerHTML = 'x';
    }
    issubmit();
}


function issubmit(){
    if (is_price_right && is_name_right && is_stock_right) {
        edit_button.onclick = function(){submit();};
    } else {
        edit_button.onclick = function(){alert('格式有誤')};
        
    }
}


function submit(){
    var formData=new FormData(edit_product);
    $.ajax({
            url:'/shopping/Controller/ManagerController.php/Product',
            type:'POST',
            dataType:'text',
            cache: false,
            processData: false,
            contentType: false,
            data:formData,
            success:function(result_array){  
                console.log(result_array)
                result_array = JSON.parse(result_array);
                showSingal(result_array['alert']);
                direct(result_array['location']);
            }
        })
    }

function checkFile(e) {
    //選取類型為file且值發生改變的
    var file = e.files[0]; //定義file=發生改的file
    name = file.name; //name=檔案名稱
    size = file.size; //size=檔案大小
    type = file.type; //type=檔案型態
    if (
        file.type != 'image/png' && 
        file.type != 'image/jpg' && 
        !file.type != 'image/gif' && 
        file.type != 'image/jpeg' 
    ) { //假如檔案格式不等於 png 、jpg、gif、jpeg
        alert("檔案格式不符合: png, jpg or gif"); //顯示警告
        $(this).val(''); //將檔案欄設為空
    } else if (file.size > 10240000) { //假如檔案大小超過10240KB (10240000/1024)
        alert("圖片上限10MB!!"); //顯示警告!!
        $(this).val('');  //將檔案欄設為空白
    }
}