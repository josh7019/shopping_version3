window.onload = function(){
    
    changeShipped();
}


function changeShipped(){
    let button_list = document.getElementsByClassName('shipped_button');
    for (let i = 0; i < button_list.length; i++) {
        button_list[i].onclick = function(){
            row = this.parentElement.parentElement.parentElement;
            order_menu_id = row.children[1].innerText;
            shipped_button = this;
            let is_shipped = shipped_button.children[0];
            $.ajax({
                    type : 'PUT',
                    url : '/shopping/controller/managercontroller.php/isShipped',
                    data : {
                        'order_menu_id' : order_menu_id,
                        'is_shipped' : is_shipped.value
                    },
                    success : function (result_array){
                        result_array = JSON.parse(result_array);
                        if (result_array['is_success']) {
                            if (is_shipped.value == 1) {
                                is_shipped.value = 0;
                            shipped_button.children[1].classList.replace('btn-danger', 'btn-success');
                            shipped_button.children[1].children[0].classList.replace(
                                'glyphicon-object-align-right',
                                'glyphicon-plane'
                                )
                            shipped_button.children[1].children[1].innerText = '已出貨';
                            } else {
                                is_shipped.value = 1;
                            shipped_button.children[1].classList.replace('btn-success', 'btn-danger');
                            shipped_button.children[1].children[0].classList.replace(
                                'glyphicon-plane',
                                'glyphicon-object-align-right'
                                )
                            shipped_button.children[1].children[1].innerText = '待出貨';
                            }
                            
                        } else {
                            alert('failed')
                        }
                    }
                })
        }
    }
}
