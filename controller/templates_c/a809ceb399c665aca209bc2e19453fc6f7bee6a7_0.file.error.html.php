<?php
/* Smarty version 3.1.33, created on 2019-08-12 11:44:53
  from 'C:\xampp\htdocs\shopping\views\error.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d5135153e6bd8_88381723',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a809ceb399c665aca209bc2e19453fc6f7bee6a7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\shopping\\views\\error.html',
      1 => 1565602777,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d5135153e6bd8_88381723 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src='/shopping/scripts/functions.js'><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src='/shopping/scripts/error.js'><?php echo '</script'; ?>
>
    <title>Document</title>
</head>
<body>
    <input type="hidden" value="<?php ob_start();
echo $_smarty_tpl->tpl_vars['error']->value;
$_prefixVariable1 = ob_get_clean();
echo $_prefixVariable1;?>
" id='error'>
</body>
</html><?php }
}
