<?php
/* Smarty version 3.1.33, created on 2019-08-14 16:46:59
  from 'C:\xampp\htdocs\shopping\views\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d53ca83b27047_85457992',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5606f6176a2754057bba4ced841219b008b2559c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\shopping\\views\\index.html',
      1 => 1565772416,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d53ca83b27047_85457992 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/shopping/scripts/functions.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/shopping/scripts/index.js"><?php echo '</script'; ?>
>
    <title>Document</title>
    <style>
        .row > div > img {
            width:220px;
            height:326px;
        }
        .item_title {
            font-size:26px;
            word-wrap:break-word;word-break:break-all;
            width:100%;
        }
        .row > div > .col-md-12 > .price {
            font-size:20px;
        }
        body {
            font-family: arial,"Microsoft JhengHei","微軟正黑體",sans-serif !important;
            background-color:#1c1c1c; 
        }
        #title {
            background-color:#660000;
            border-top-left-radius: 40px;
            border-top-right-radius: 40px
        }
        .row {
            color:#a6a6a6;
        }
    </style>
</head>

<body>
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
}
$_prefixVariable3 = ob_get_clean();
echo $_prefixVariable3;?>

                <?php ob_start();
if ($_smarty_tpl->tpl_vars['permission']->value == 2) {
$_prefixVariable4 = ob_get_clean();
echo $_prefixVariable4;?>

                <li class=""><a href="/shopping/controller/managercontroller.php/member"><span class="glyphicon glyphicon-user"></span> 會員管理 <span class="sr-only">(current)</span></a></li>
                <li><a href="/shopping/controller/managercontroller.php/product"><span class="glyphicon glyphicon-list-alt"></span> 產品管理 </a></li>
                <?php ob_start();
}
$_prefixVariable5 = ob_get_clean();
echo $_prefixVariable5;?>

                
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <?php ob_start();
if ($_smarty_tpl->tpl_vars['is_login']->value) {
$_prefixVariable6 = ob_get_clean();
echo $_prefixVariable6;?>

                    <?php ob_start();
if ($_smarty_tpl->tpl_vars['permission']->value == 2) {
$_prefixVariable7 = ob_get_clean();
echo $_prefixVariable7;?>

                    
                    <li>
                        <a href="/shopping/controller/managercontroller.php/orderMenu">
                            <span class="glyphicon glyphicon-list-alt"></span> 訂單管理
                        </a>
                    </li>
                    <?php ob_start();
} else {
$_prefixVariable8 = ob_get_clean();
echo $_prefixVariable8;?>

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
$_prefixVariable9 = ob_get_clean();
echo $_prefixVariable9;?>

                                    <?php ob_start();
echo $_smarty_tpl->tpl_vars['order_detail_list_length']->value;
$_prefixVariable10 = ob_get_clean();
echo $_prefixVariable10;?>

                                    <?php ob_start();
} else {
$_prefixVariable11 = ob_get_clean();
echo $_prefixVariable11;?>

                                    0
                                    <?php ob_start();
}
$_prefixVariable12 = ob_get_clean();
echo $_prefixVariable12;?>

                                </span>
                            </a>
                        </li>
                    <?php ob_start();
}
$_prefixVariable13 = ob_get_clean();
echo $_prefixVariable13;?>

                    <?php ob_start();
} else {
$_prefixVariable14 = ob_get_clean();
echo $_prefixVariable14;?>

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
$_prefixVariable15 = ob_get_clean();
echo $_prefixVariable15;?>

                                    <?php ob_start();
echo $_smarty_tpl->tpl_vars['order_detail_list_length']->value;
$_prefixVariable16 = ob_get_clean();
echo $_prefixVariable16;?>

                                    <?php ob_start();
} else {
$_prefixVariable17 = ob_get_clean();
echo $_prefixVariable17;?>

                                    0
                                    <?php ob_start();
}
$_prefixVariable18 = ob_get_clean();
echo $_prefixVariable18;?>

                                </span>
                            </a>
                        </li>
                <?php ob_start();
}
$_prefixVariable19 = ob_get_clean();
echo $_prefixVariable19;?>

            </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <div class="container-fluid">
        <div class='row'>
            <div class="col-md-1">
            </div>
            <div class="col-md-10">
                <img src="/shopping/img/bg1.jpg" style="width:100%;height:500px;">
            </div>
        </div>
    </div>
    <hr>
    <div class="container" style='text-align:center; '>
        <div class='row'>
                
                <form class="navbar-form navbar-left" role="search" method="GET" action="">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="" name="search_value">
                    </div>
                    <button type="submit" class="btn btn-default" id='search'>搜尋商品名稱</button>
                </form>
            <div class="col-md-12" id='title'>
                <h2>商品目錄</h2>
            </div>
            <?php ob_start();
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_list']->value, 'product_item', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['product_item']->value) {
$_prefixVariable20 = ob_get_clean();
echo $_prefixVariable20;?>

            <div class=col-md-3 style='background-color: #262626'>
                <div class=col-md-12 ><b class='item_title'><?php ob_start();
echo $_smarty_tpl->tpl_vars['product_item']->value['name'];
$_prefixVariable21 = ob_get_clean();
echo $_prefixVariable21;?>
</b></div>
                <img src="/shopping/img/<?php ob_start();
echo $_smarty_tpl->tpl_vars['product_item']->value['image'];
$_prefixVariable22 = ob_get_clean();
echo $_prefixVariable22;?>
" alt="">
                <div class=col-md-12 ><b class='item_price'>價格:NT<?php ob_start();
echo $_smarty_tpl->tpl_vars['product_item']->value['price'];
$_prefixVariable23 = ob_get_clean();
echo $_prefixVariable23;?>
</b></div>
                <div class=col-md-12 >
                    <b class='item_price'>
                    庫存量:<?php ob_start();
if ($_smarty_tpl->tpl_vars['product_item']->value['stock'] < 10) {
$_prefixVariable24 = ob_get_clean();
echo $_prefixVariable24;?>
 <?php ob_start();
echo $_smarty_tpl->tpl_vars['product_item']->value['stock'];
$_prefixVariable25 = ob_get_clean();
echo $_prefixVariable25;?>
 <?php ob_start();
} else {
$_prefixVariable26 = ob_get_clean();
echo $_prefixVariable26;?>
 庫存量 > 10 <?php ob_start();
}
$_prefixVariable27 = ob_get_clean();
echo $_prefixVariable27;?>

                    </b>
                </div>

                <div class=col-md-12 ><b class='item_created_date'>上架日期:<?php ob_start();
echo $_smarty_tpl->tpl_vars['product_item']->value['updated_at'];
$_prefixVariable28 = ob_get_clean();
echo $_prefixVariable28;?>
</b></div>
                <div class=col-md-12 >
                    <b class='item_saled'>已售出:
                        <?php ob_start();
if ($_smarty_tpl->tpl_vars['product_item']->value['total_saled']) {
$_prefixVariable29 = ob_get_clean();
echo $_prefixVariable29;?>

                            <?php ob_start();
echo $_smarty_tpl->tpl_vars['product_item']->value['total_saled'];
$_prefixVariable30 = ob_get_clean();
echo $_prefixVariable30;?>

                        <?php ob_start();
} else {
$_prefixVariable31 = ob_get_clean();
echo $_prefixVariable31;?>

                            0
                        <?php ob_start();
}
$_prefixVariable32 = ob_get_clean();
echo $_prefixVariable32;?>
套
                    </b>
                </div>
                <div class=col-md-12 >
                    <input type="hidden" value = <?php ob_start();
echo $_smarty_tpl->tpl_vars['product_item']->value['product_id'];
$_prefixVariable33 = ob_get_clean();
echo $_prefixVariable33;?>
>
                    <!-- <span class='btn btn-warning'>
                        <span class="glyphicon glyphicon-eye-open"></span> 商品資訊
                    </span> -->
                    <button class='btn btn-info add_button' <?php ob_start();
if ($_smarty_tpl->tpl_vars['product_item']->value['stock'] <= 0) {
$_prefixVariable34 = ob_get_clean();
echo $_prefixVariable34;?>
 disabled <?php ob_start();
}
$_prefixVariable35 = ob_get_clean();
echo $_prefixVariable35;?>
>
                        <span class="glyphicon glyphicon-shopping-cart"></span> 加入購物車
                    </button>
                </div>
            </div>
            <?php ob_start();
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_prefixVariable36 = ob_get_clean();
echo $_prefixVariable36;?>

        </div>
        <div class="col-md-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php ob_start();
$_smarty_tpl->tpl_vars['page_number'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['page_number']->step = 1;$_smarty_tpl->tpl_vars['page_number']->total = (int) ceil(($_smarty_tpl->tpl_vars['page_number']->step > 0 ? $_smarty_tpl->tpl_vars['page_amount']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['page_amount']->value)+1)/abs($_smarty_tpl->tpl_vars['page_number']->step));
if ($_smarty_tpl->tpl_vars['page_number']->total > 0) {
for ($_smarty_tpl->tpl_vars['page_number']->value = 1, $_smarty_tpl->tpl_vars['page_number']->iteration = 1;$_smarty_tpl->tpl_vars['page_number']->iteration <= $_smarty_tpl->tpl_vars['page_number']->total;$_smarty_tpl->tpl_vars['page_number']->value += $_smarty_tpl->tpl_vars['page_number']->step, $_smarty_tpl->tpl_vars['page_number']->iteration++) {
$_smarty_tpl->tpl_vars['page_number']->first = $_smarty_tpl->tpl_vars['page_number']->iteration === 1;$_smarty_tpl->tpl_vars['page_number']->last = $_smarty_tpl->tpl_vars['page_number']->iteration === $_smarty_tpl->tpl_vars['page_number']->total;
$_prefixVariable37 = ob_get_clean();
echo $_prefixVariable37;?>

                        <li <?php ob_start();
if ($_smarty_tpl->tpl_vars['page_number']->value == $_smarty_tpl->tpl_vars['now_page']->value) {
$_prefixVariable38 = ob_get_clean();
echo $_prefixVariable38;?>
class="active"<?php ob_start();
}
$_prefixVariable39 = ob_get_clean();
echo $_prefixVariable39;?>
>
                            <?php ob_start();
if ($_smarty_tpl->tpl_vars['search']->value) {
$_prefixVariable40 = ob_get_clean();
echo $_prefixVariable40;?>

                            <a href="/shopping/controller/guestcontroller.php/index?search_value=<?php ob_start();
echo $_smarty_tpl->tpl_vars['search_value']->value;
$_prefixVariable41 = ob_get_clean();
echo $_prefixVariable41;?>
&page=<?php ob_start();
echo $_smarty_tpl->tpl_vars['page_number']->value;
$_prefixVariable42 = ob_get_clean();
echo $_prefixVariable42;?>
">
                                <?php ob_start();
echo $_smarty_tpl->tpl_vars['page_number']->value;
$_prefixVariable43 = ob_get_clean();
echo $_prefixVariable43;?>

                            </a>
                            <?php ob_start();
} else {
$_prefixVariable44 = ob_get_clean();
echo $_prefixVariable44;?>

                            <a href="/shopping/controller/guestcontroller.php/index?page=<?php ob_start();
echo $_smarty_tpl->tpl_vars['page_number']->value;
$_prefixVariable45 = ob_get_clean();
echo $_prefixVariable45;?>
">
                                <?php ob_start();
echo $_smarty_tpl->tpl_vars['page_number']->value;
$_prefixVariable46 = ob_get_clean();
echo $_prefixVariable46;?>

                            </a>
                            <?php ob_start();
}
$_prefixVariable47 = ob_get_clean();
echo $_prefixVariable47;?>

                        </li>
                        <?php ob_start();
}
}
$_prefixVariable48 = ob_get_clean();
echo $_prefixVariable48;?>

                    </ul>
                </nav>
            </div>
    </div>
    
            <hr>
            <div class="container">
              <div class="text-center">Copyright © 2019 - Start Bootstrap</div>
            </div>
    <?php echo '<script'; ?>
 
        src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" 
        integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" 
        crossorigin="anonymous">
    <?php echo '</script'; ?>
>
</body>
</html><?php }
}
