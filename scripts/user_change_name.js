window.onload = function() {
    let input_name = document.getElementById('name');
    let button = document.getElementById('change_button');
    let signal = document.getElementById('name_signal');
    button.onclick = function() {changeName(input_name);}
    input_name.oninput = function() {
        let is_right = checkNameFormat(input_name.value);
        button.disabled = (is_right) ? false : 'disabled';
        signal.innerText = (is_right) ? 'o' : 'x';
    }
}

function changeName(input_name) {
    $.ajax({
        type: "PUT",
        url: "/shopping/controller/usercontroller.php/changename",
        data: {
            'name' : input_name.value
        },
        success: function (result_array) {
            result_array = JSON.parse(result_array);
            showSingal(result_array['alert']);
            direct(result_array['location']);
        }
    });
}