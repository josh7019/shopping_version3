<?php
/* Smarty version 3.1.33, created on 2019-08-16 16:39:55
  from 'C:\xampp\htdocs\shopping\views\maneger_member.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d566bdb52b834_54388872',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '45b2f92f1b8341371223961f5fa609138d0f1dd4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\shopping\\views\\maneger_member.html',
      1 => 1565944532,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d566bdb52b834_54388872 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="zh-tw">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src='/shopping/scripts/functions.js'><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src='/shopping/scripts/maneger_member.js'><?php echo '</script'; ?>
>
        <title>Document</title>
        <style>
            .table-striped>thead>tr{
                background-color: #2980b9;
                color: white;
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
            .item-color-1 {
                background-color:#f6f6f6;
            }
            .item-color-2 {
                background-color:#e9e9e9;
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
            <div id="nowTime"></div>
            <div>
                <!-- 會員新增表格 -->
                <div id='addTodoList'>
                    <form id='add_message_form' class="form-horizontal" method='POST' action='/shopping/cont/addmessage.php'>
                        <fieldset>
                        <!-- Form Name -->
                            <legend style="color: red;">會員管理</legend>
                        </fieldset>
                        <span class="pull-right">
                            <select id="search_status" class="form-control">
                                <option value="">帳戶狀態</option>
                                <option value="/shopping/controller/managercontroller.php/member?type=3&search_value=0">正常</option>
                                <option value="/shopping/controller/managercontroller.php/member?type=3&search_value=1">凍結中</option>
                                <option value="/shopping/controller/managercontroller.php/member">所有會員</option>
                        </select></span>
                    </form>
                    <form class="navbar-form navbar-left" role="search" method="GET" action="">
                            <select name="type" id="type" class="form-control">
                                <option value="0">搜尋編號</option>
                                <option value="1">搜尋帳號</option>
                                <option value="2">搜尋名稱</option>
                            </select>
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="" name="search_value">
                        </div>
                        <button type="submit" class="btn btn-info" id='search'>
                            <span class="glyphicon glyphicon-search"></span> 搜尋
                        </button>
                        
                    </form>
                </div><!-- 會員新增表格結束 -->
                
                <!-- 會員顯示區 -->
                <table class="table table-striped" id='showTodoList'>
                    <thead>
                        <tr>
                            <th>編號</th>
                            <th>帳號</th>
                            <th>名稱</th>
                            <th>帳戶狀態</th>
                            <th>餘額</th>
                            <th>帳號創建時間</th>
                            <th>總消費金額</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id='messageArea'>
                        <?php ob_start();
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user_list']->value, 'user_item', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['user_item']->value) {
$_prefixVariable22 = ob_get_clean();
echo $_prefixVariable22;?>

                            <?php ob_start();
if ($_smarty_tpl->tpl_vars['user_item']->value['permission'] < 2) {
$_prefixVariable23 = ob_get_clean();
echo $_prefixVariable23;?>

                            <tr class="item-color-1">
                                <td><?php ob_start();
echo $_smarty_tpl->tpl_vars['user_item']->value['user_id'];
$_prefixVariable24 = ob_get_clean();
echo $_prefixVariable24;?>
</td>
                                <td><?php ob_start();
echo $_smarty_tpl->tpl_vars['user_item']->value['account'];
$_prefixVariable25 = ob_get_clean();
echo $_prefixVariable25;?>
</td>
                                <td><?php ob_start();
echo $_smarty_tpl->tpl_vars['user_item']->value['name'];
$_prefixVariable26 = ob_get_clean();
echo $_prefixVariable26;?>
</td>
                                <td>
                                    <select name="status" id="status">
                                        <option value="0" <?php ob_start();
if ($_smarty_tpl->tpl_vars['user_item']->value['permission'] == 0) {
$_prefixVariable27 = ob_get_clean();
echo $_prefixVariable27;?>
selected<?php ob_start();
}
$_prefixVariable28 = ob_get_clean();
echo $_prefixVariable28;?>
>正常</option>
                                        <option value="1" <?php ob_start();
if ($_smarty_tpl->tpl_vars['user_item']->value['permission'] == 1) {
$_prefixVariable29 = ob_get_clean();
echo $_prefixVariable29;?>
selected<?php ob_start();
}
$_prefixVariable30 = ob_get_clean();
echo $_prefixVariable30;?>
>凍結中</option>
                                    </select>
                                </td>
                                <td><?php ob_start();
echo $_smarty_tpl->tpl_vars['user_item']->value['cash'];
$_prefixVariable31 = ob_get_clean();
echo $_prefixVariable31;?>
</td>
                                <td><?php ob_start();
echo $_smarty_tpl->tpl_vars['user_item']->value['created_at'];
$_prefixVariable32 = ob_get_clean();
echo $_prefixVariable32;?>
</td>
                                <td><?php ob_start();
echo $_smarty_tpl->tpl_vars['user_item']->value['total_price'];
$_prefixVariable33 = ob_get_clean();
echo $_prefixVariable33;?>
</td>
                                <td>
                                    <span class="pull-right update_button">
                                        <span class="btn btn-warning" >
                                            <span class="glyphicon glyphicon-pencil">
                                            </span>
                                            確認修改
                                        </span>
                                    </span>
                                </td>
                            </tr>
                            <?php ob_start();
}
$_prefixVariable34 = ob_get_clean();
echo $_prefixVariable34;?>

                        <?php ob_start();
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_prefixVariable35 = ob_get_clean();
echo $_prefixVariable35;?>


                    </tbody>
                </table><!-- 會員顯示區結束 -->
            </div>
        </div>
        <input type="hidden" id='message' value=''>
        
        
        <?php echo '<script'; ?>
 type="text/javascript" src=''><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 
        src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" 
        integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" 
        crossorigin="anonymous">
        <?php echo '</script'; ?>
>
    </body>
</html><?php }
}
