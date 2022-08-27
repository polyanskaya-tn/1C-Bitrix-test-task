<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>

<style>
	body {
		background: url("<?=CUtil::JSEscape($component->getPath())?>/templates/.default/images/background.jpg") 
			no-repeat center top;
	}
	.win {
		position: absolute;
		top: 50%;
		left: 50%;
		background: bisque;
		height: 180px;
		width: 300px;
		transform: translate(-50%, -50%);
		text-align: center;
		border-radius: 20px;
	}

	table {
		margin: 40px 20px 20px 20px;
		font-size: 16px;
	}
	td {
		padding: 5px 15px 5px 0;
	}
	button {
		font-size: 14px;
		padding: 7px 15px;
		border-radius: 5px;
		border: 1px solid black;
		background: #dedede;
	}
</style>

<script type="text/javascript" src="<?=CUtil::JSEscape($component->getPath())?>/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?=CUtil::JSEscape($component->getPath())?>/test.js"></script>

<div class="win">
	<table>
	<tr>
		<td>Скидка:</td> 
		<td><div id="discount"></div></td>
</tr>
<tr>
		<td>Код скидки:</td> 
		<td><div id="discode"></div></td>
</tr>

</table>

	<button onclick="BX.My.MyAjax.ajaxGetDiscount()">Получить скидку</button>
</div>


<script>
    BX.My.MyAjax.init({
		ajaxUrl: '<?=CUtil::JSEscape($component->getPath().'/ajax.php')?>',
    });
</script>




