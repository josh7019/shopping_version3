<?php
/* Smarty version 3.1.33, created on 2019-08-16 04:44:27
  from 'C:\xampp\htdocs\shopping\views\signup.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d56188bceece9_29562084',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b07fe474bfe1398a515d91df67089ba7b70b9907' => 
    array (
      0 => 'C:\\xampp\\htdocs\\shopping\\views\\signup.html',
      1 => 1565918152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d56188bceece9_29562084 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
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
        
        <title>Document</title>
        <style>
            .myform{
                margin-top:20%;
                width:50%;
                margin-left:25%;
                text-align:center;
                border-radius: 20px;
            }
            body {
            font-family: arial,"Microsoft JhengHei","微軟正黑體",sans-serif !important;
            color:red;
            background-color:#1c1c1c; 
            }
            #title {
                color:red;
            }
            #signup_form {
                background-color: #262626
            }
        </style>
    </head>
    <body>
        
        <!-- 導覽列 -->
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                
                <a class="navbar-brand" href="/shopping/controller/guestcontroller.php/index">商城首頁</a>
                </div>
            
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php ob_start();
if (!$_smarty_tpl->tpl_vars['is_login']->value) {
$_prefixVariable1 = ob_get_clean();
echo $_prefixVariable1;?>

                    <li class=""><a href="/shopping/controller/guestcontroller.php/login"><span class="glyphicon glyphicon-user"></span> 登入 <span class="sr-only">(current)</span></a></li>
                    <li><a href="/shopping/controller/guestcontroller.php/signup"><span class="glyphicon glyphicon-tower"></span> 註冊</a></li>
                    <?php ob_start();
} else {
$_prefixVariable2 = ob_get_clean();
echo $_prefixVariable2;?>

                    <li><a href="/shopping/controller/usercontroller.php/logout"><span class="glyphicon glyphicon-tower"></span>登出</a></li>
                        <?php ob_start();
if ($_smarty_tpl->tpl_vars['permission']->value == 2) {
$_prefixVariable3 = ob_get_clean();
echo $_prefixVariable3;?>

                        <li class=""><a href="/shopping/controller/managercontroller.php/member"><span class="glyphicon glyphicon-user"></span> 會員管理 <span class="sr-only">(current)</span></a></li>
                        <li><a href="/shopping/controller/managercontroller.php/product"><span class="glyphicon glyphicon-list-alt"></span> 產品管理 </a></li>
                        <?php ob_start();
} else {
$_prefixVariable4 = ob_get_clean();
echo $_prefixVariable4;?>

                        <li><a href="/shopping/controller/usercontroller.php/addMoney"><span class="glyphicon glyphicon-briefcase"></span>儲值</a></li>
                        <li><a href="/shopping/controller/usercontroller.php/userInfo"><span class="glyphicon glyphicon-pencil"></span>修改個人資料</a></li>
                        <?php ob_start();
}
$_prefixVariable5 = ob_get_clean();
echo $_prefixVariable5;?>

                    <?php ob_start();
}
$_prefixVariable6 = ob_get_clean();
echo $_prefixVariable6;?>

                    
                    
                </ul>
                
                <ul class="nav navbar-nav navbar-right">
                    <?php ob_start();
if ($_smarty_tpl->tpl_vars['is_login']->value) {
$_prefixVariable7 = ob_get_clean();
echo $_prefixVariable7;?>

                        <?php ob_start();
if ($_smarty_tpl->tpl_vars['permission']->value == 2) {
$_prefixVariable8 = ob_get_clean();
echo $_prefixVariable8;?>

                        
                        <li>
                            <a href="/shopping/controller/managercontroller.php/orderMenu">
                                <span class="glyphicon glyphicon-list-alt"></span> 訂單管理
                            </a>
                        </li>
                        <?php ob_start();
} else {
$_prefixVariable9 = ob_get_clean();
echo $_prefixVariable9;?>

                            <li>
                                <a href="/shopping/controller/usercontroller.php/shoppinghistory">
                                    <span class="glyphicon glyphicon-list-alt"></span> 我的訂單
                                </a>
                            </li>
                            <li>
                                <a href="/shopping/controller/usercontroller.php/shoppingcar">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> 購物車
                                    <span class="badge badge-light" id='product_count'>
                                        <?php ob_start();
if (isset($_smarty_tpl->tpl_vars['order_detail_list_length']->value)) {
$_prefixVariable10 = ob_get_clean();
echo $_prefixVariable10;?>

                                        <?php ob_start();
echo $_smarty_tpl->tpl_vars['order_detail_list_length']->value;
$_prefixVariable11 = ob_get_clean();
echo $_prefixVariable11;?>

                                        <?php ob_start();
} else {
$_prefixVariable12 = ob_get_clean();
echo $_prefixVariable12;?>

                                        0
                                        <?php ob_start();
}
$_prefixVariable13 = ob_get_clean();
echo $_prefixVariable13;?>

                                    </span>
                                </a>
                            </li>
                        <?php ob_start();
}
$_prefixVariable14 = ob_get_clean();
echo $_prefixVariable14;?>

                        <?php ob_start();
} else {
$_prefixVariable15 = ob_get_clean();
echo $_prefixVariable15;?>

                            <li>
                                <a href="/shopping/controller/usercontroller.php/shoppinghistory">
                                    <span class="glyphicon glyphicon-list-alt"></span> 我的訂單
                                </a>
                            </li>
                            <li>
                                <a href="/shopping/controller/usercontroller.php/shoppingcar">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> 購物車
                                    <span class="badge badge-light" id='product_count'>
                                        <?php ob_start();
if (isset($_smarty_tpl->tpl_vars['order_detail_list_length']->value)) {
$_prefixVariable16 = ob_get_clean();
echo $_prefixVariable16;?>

                                        <?php ob_start();
echo $_smarty_tpl->tpl_vars['order_detail_list_length']->value;
$_prefixVariable17 = ob_get_clean();
echo $_prefixVariable17;?>

                                        <?php ob_start();
} else {
$_prefixVariable18 = ob_get_clean();
echo $_prefixVariable18;?>

                                        0
                                        <?php ob_start();
}
$_prefixVariable19 = ob_get_clean();
echo $_prefixVariable19;?>

                                    </span>
                                </a>
                            </li>
                    <?php ob_start();
}
$_prefixVariable20 = ob_get_clean();
echo $_prefixVariable20;?>

                </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        
        <div class='container'>        
            <form id='signup_form' class="form-horizontal myform">
            <fieldset>

            <!-- Form Name -->
            <legend id='title'>註冊</legend>
            <!-- 帳號輸入 -->
            <div class="form-group">
                <label class="col-md-4 control-label"  for="Account">帳號</label><span id='account_Signal'></span>
                <div class="col-md-4">
                    <input id="account" autocomplete='off' name="account" type="text" placeholder="請輸入帳號" class="form-control input-md" required="">    
                    <span class="help-block">7~20字元,開頭為英文,不得有符號</span> 
                </div>
            </div>
            <!-- 密碼輸入-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="password">密碼</label><span id='password_Signal'></span>  
                <div class="col-md-4">
                    <input id="password" name="password" type="password" placeholder="請輸入密碼" class="form-control input-md" required="">
                    <span class="help-block">4~20字元,不得有符號</span> 
                </div>
            </div>
            <!-- 二次密碼輸入-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="password">驗證密碼</label><span id='passwordTwice_Signal'></span>
                <div class="col-md-4">
                    <input id="passwordTwice" name="passwordTwice" type="password" placeholder="請再次輸入密碼" class="form-control input-md" required="">
                </div>
            </div>
            <div class="form-group">
                    <label class="col-md-4 control-label" for="password">暱稱</label><span id='name_Signal'></span>
                    <div class="col-md-4">
                        <input value="" id="name" name="name" type="text" placeholder="請輸入姓名" class="form-control input-md" required="">
                        <span class="help-block">2~10字元,全英文,不得有符號</span> 
                    </div>
                </div>
            <div class="form-group">
                    <label class="col-md-4 control-label" for="password">身分證號碼</label><span id='id_number_Signal'></span>
                    <div class="col-md-4">
                        <input value='a123456789*' id="id_number" name="id_number" type="text" placeholder="請輸入身分證號碼" class="form-control input-md" required="">
                    </div>
            </div>
            <!-- 送出按鈕 -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="login"></label>
                <div class="col-md-4">
                    <button type='button' id="login_button" name="signup" class="btn btn-success">註冊</button>
                </div>
            </div>
            
            </fieldset>
            </form>
        </div>
        <input type="hidden" id='message' value=''>
        
        <?php echo '<script'; ?>
 type="text/javascript" src='/shopping/scripts/signup.js'><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 
        src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" 
        integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" 
        crossorigin="anonymous">
        <?php echo '</script'; ?>
>
        <!-- 清除message -->
    </body>
</html><?php }
}
