<?php
/* Smarty version 3.1.33, created on 2019-08-16 16:42:57
  from 'C:\xampp\htdocs\shopping\views\maneger_edit_product.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d566c91d98810_49410128',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2005ce8bf549d2a4a82f5d98def70cafcae62413' => 
    array (
      0 => 'C:\\xampp\\htdocs\\shopping\\views\\maneger_edit_product.html',
      1 => 1565944526,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d566c91d98810_49410128 (Smarty_Internal_Template $_smarty_tpl) {
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
        <?php echo '<script'; ?>
 type="text/javascript" src='/shopping/scripts/manager_edit_product.js'><?php echo '</script'; ?>
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
            background-color:#1c1c1c; 
            }
            #title {
                color:red;
            }
            #edit_product {
                background-color: #262626
            }
            .descript {
                color:red;
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

                        <li><a href="/shopping/controller/usercontroller.php/logout"><span class="glyphicon glyphicon-tower"></span> 登出</a></li>
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

                            <li><a href="/shopping/controller/usercontroller.php/addMoney"><span class="glyphicon glyphicon-briefcase"></span> 儲值</a></li>
                            <li><a href="/shopping/controller/usercontroller.php/userInfo"><span class="glyphicon glyphicon-pencil"></span> 修改個人資料</a></li>
                            <li><a ><span class="glyphicon glyphicon-jpy"></span> 餘額 : <?php ob_start();
echo $_smarty_tpl->tpl_vars['cash']->value;
$_prefixVariable5 = ob_get_clean();
echo $_prefixVariable5;?>
</a></li>
                            <?php ob_start();
}
$_prefixVariable6 = ob_get_clean();
echo $_prefixVariable6;?>

                        <?php ob_start();
}
$_prefixVariable7 = ob_get_clean();
echo $_prefixVariable7;?>

                        
                        
                    </ul>
                    
                    <ul class="nav navbar-nav navbar-right">
                        <?php ob_start();
if ($_smarty_tpl->tpl_vars['is_login']->value) {
$_prefixVariable8 = ob_get_clean();
echo $_prefixVariable8;?>

                            <?php ob_start();
if ($_smarty_tpl->tpl_vars['permission']->value == 2) {
$_prefixVariable9 = ob_get_clean();
echo $_prefixVariable9;?>

                            
                            <li>
                                <a href="/shopping/controller/managercontroller.php/orderMenu">
                                    <span class="glyphicon glyphicon-list-alt"></span> 訂單管理
                                </a>
                            </li>
                            <?php ob_start();
} else {
$_prefixVariable10 = ob_get_clean();
echo $_prefixVariable10;?>

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
$_prefixVariable11 = ob_get_clean();
echo $_prefixVariable11;?>

                                            <?php ob_start();
echo $_smarty_tpl->tpl_vars['order_detail_list_length']->value;
$_prefixVariable12 = ob_get_clean();
echo $_prefixVariable12;?>

                                            <?php ob_start();
} else {
$_prefixVariable13 = ob_get_clean();
echo $_prefixVariable13;?>

                                            0
                                            <?php ob_start();
}
$_prefixVariable14 = ob_get_clean();
echo $_prefixVariable14;?>

                                        </span>
                                    </a>
                                </li>
                            <?php ob_start();
}
$_prefixVariable15 = ob_get_clean();
echo $_prefixVariable15;?>

                            <?php ob_start();
} else {
$_prefixVariable16 = ob_get_clean();
echo $_prefixVariable16;?>

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
$_prefixVariable17 = ob_get_clean();
echo $_prefixVariable17;?>

                                            <?php ob_start();
echo $_smarty_tpl->tpl_vars['order_detail_list_length']->value;
$_prefixVariable18 = ob_get_clean();
echo $_prefixVariable18;?>

                                            <?php ob_start();
} else {
$_prefixVariable19 = ob_get_clean();
echo $_prefixVariable19;?>

                                            0
                                            <?php ob_start();
}
$_prefixVariable20 = ob_get_clean();
echo $_prefixVariable20;?>

                                        </span>
                                    </a>
                                </li>
                        <?php ob_start();
}
$_prefixVariable21 = ob_get_clean();
echo $_prefixVariable21;?>

                    </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        
        <div class='container'>        
            <form id='edit_product' class="form-horizontal myform">
            <fieldset>

            <!-- Form Name -->
            <legend class='descript'>修改產品</legend>

            <input type="hidden" name='product_id' value="<?php ob_start();
echo $_smarty_tpl->tpl_vars['product_item']->value['product_id'];
$_prefixVariable22 = ob_get_clean();
echo $_prefixVariable22;?>
">

            <!-- 名稱輸入 -->
            <div class="form-group">
                <label class="col-md-4 control-label descript"  for="name">產品名稱</label><span class='descript' id='name_signal'></span>
                <div class="col-md-4">
                    <input id="name" value = "<?php ob_start();
echo $_smarty_tpl->tpl_vars['product_item']->value['name'];
$_prefixVariable23 = ob_get_clean();
echo $_prefixVariable23;?>
" autocomplete='off' name="name" type="text" placeholder="請輸入產品名稱" class="form-control input-md" required="">
                    <span class="help-block">20字元以內</span> 
                </div>
            </div>

            <!-- 價格輸入-->
            <div class="form-group">
                <label class="col-md-4 control-label descript" for="price">價格</label><span class='descript' id='price_signal'></span>  
                <div class="col-md-4">
                    <input id="price" value="<?php ob_start();
echo $_smarty_tpl->tpl_vars['product_item']->value['price'];
$_prefixVariable24 = ob_get_clean();
echo $_prefixVariable24;?>
" min='1' max='99999' name="price" type="number" placeholder="請輸入價格" class="form-control input-md" required="">
                    <span class="help-block"></span> 
                </div>
            </div>

            <!-- 庫存輸入-->
            <div class="form-group">
                    <label class="col-md-4 control-label descript" for="price">庫存量</label><span class='descript' id='stock_signal'></span>  
                    <div class="col-md-4">
                        <input id="stock" value="<?php ob_start();
echo $_smarty_tpl->tpl_vars['product_item']->value['stock'];
$_prefixVariable25 = ob_get_clean();
echo $_prefixVariable25;?>
" min='1' max='1000' name="stock" type="number" placeholder="請輸入庫存量" class="form-control input-md" required="">
                        <span class="help-block"></span> 
                    </div>
                </div>

            <!-- 商品狀態選擇-->
            <div class="form-group descript">
                <label class="col-md-4 control-label" for="status">商品狀態</label><span id='status_signal'></span>
                <div class="col-md-4">
                    <select name="status" id="status">
                        <option value="0" <?php ob_start();
if ($_smarty_tpl->tpl_vars['product_item']->value['status'] == 0) {
$_prefixVariable26 = ob_get_clean();
echo $_prefixVariable26;?>
selected<?php ob_start();
}
$_prefixVariable27 = ob_get_clean();
echo $_prefixVariable27;?>
>待上架</option>
                        <option value="1" <?php ob_start();
if ($_smarty_tpl->tpl_vars['product_item']->value['status'] == 1) {
$_prefixVariable28 = ob_get_clean();
echo $_prefixVariable28;?>
selected<?php ob_start();
}
$_prefixVariable29 = ob_get_clean();
echo $_prefixVariable29;?>
>售賣中</option>
                        <option value="2" <?php ob_start();
if ($_smarty_tpl->tpl_vars['product_item']->value['status'] == 2) {
$_prefixVariable30 = ob_get_clean();
echo $_prefixVariable30;?>
selected<?php ob_start();
}
$_prefixVariable31 = ob_get_clean();
echo $_prefixVariable31;?>
>已下架</option>
                    </select>
                </div>
            </div>

            
            
            <!-- 上傳圖片 -->
            <div class="form-group descript">
                <label class="col-md-4 control-label" for="image">變更圖片</label>
                <div class="col-md-4">
                    <input type="file" name='image'>
                </div>
            </div>

            <!-- 送出按鈕 -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="login"></label>
                <div class="col-md-4">
                    <button type='button' id="edit_button" name="edit_button" class="btn btn-success">確定修改</button>
                </div>
            </div>

            <input type="hidden" name='action' value='editProduct'>
            
            </fieldset>
            </form>
        </div>
        
        
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
