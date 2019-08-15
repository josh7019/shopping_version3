<?php
/* Smarty version 3.1.33, created on 2019-08-15 05:44:39
  from 'C:\xampp\htdocs\shopping\views\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d54d52728d609_26236712',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fa6dbb0517706804fb3f185326640df8063973a0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\shopping\\views\\login.tpl',
      1 => 1565840655,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_5d54d52728d609_26236712 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" 
        integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src='/shopping/scripts/functions.js'><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src='/shopping/scripts/login.js'><?php echo '</script'; ?>
>
        <title>Document</title>
        <style>
            .myform {
                margin-top:20%;
                color: red;
                width:50%;
                margin-left:25%;
                text-align:center;
                border-radius: 20px;
            }
            body {
            font-family: arial,"Microsoft JhengHei","微軟正黑體",sans-serif !important;
            color:#a6a6a6;
            background-color:#1c1c1c; 
            }
            th {
                text-align: center;
            }
            tr {
                text-align: center;
            }
            #title {
                color: red;
            }
            #login_form {
                background-color: #262626
            }
        </style>
    </head>
    <body>
        <!-- 導覽列 -->
        <?php ob_start();
$_smarty_tpl->_subTemplateRender('file:header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_prefixVariable1 = ob_get_clean();
echo $_prefixVariable1;?>

        <!-- 導覽列結束 -->

        
        <div class='container'>
            
            <form id='login_form' class="form-horizontal myform" >
            <fieldset>
            <!-- Form Name -->
            <legend id='title'>登入</legend>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="Account">帳號</label>  
                <div class="col-md-4">
                    <input id="account" name="account" type="text" placeholder="請輸入帳號" class="form-control input-md" required>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="password">密碼</label>  
                <div class="col-md-4">
                    <input id="password" name="password" type="password" placeholder="請輸入密碼" class="form-control input-md" required>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="signin"></label>
                <div class="col-md-4">
                    <button id='login_button' type='button' id="signin" name="signin" class="btn btn-info">登入</button>
                    <a href="/shopping/controller/guestcontroller.php/signup" class='btn btn-success'>註冊</a>
                </div>
            </div>
            </fieldset>
            </form>
        </div>
        <input type="hidden" id='message' value=''>
    
        <?php echo '<script'; ?>
 
        src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" 
        integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" 
        crossorigin="anonymous">
    <?php echo '</script'; ?>
>
    </body>
</html><?php }
}
