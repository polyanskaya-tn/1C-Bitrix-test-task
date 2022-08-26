<? define("NEED_AUTH", true); ?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>

<? 
global $APPLICATION;

$APPLICATION->IncludeComponent(
	'test:test',
	'.default',
	$params
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>