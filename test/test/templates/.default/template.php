<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>

<style>
	#discount, #discode {
		display: inline-block;
	}
	.disc {
		margin: 50px 0 20px 20px;
	}
	.code {
		margin-left:20px;
	}
	button {
		margin: 30px 20px;
	}
</style>

<script type="text/javascript" src="<?=CUtil::JSEscape($component->getPath())?>/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?=CUtil::JSEscape($component->getPath())?>/test.js"></script>

<div class="disc">Скидка: <div id="discount"></div></div>
<div class="code">Код скидки: <div id="discode"></div></div>

<button onclick="BX.My.MyAjax.ajaxGetDiscount()">Получить скидку</button>

<script>
    BX.My.MyAjax.init({
		ajaxUrl: '<?=CUtil::JSEscape($component->getPath().'/ajax.php')?>',
    });
</script>




