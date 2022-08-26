<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("DEFAULT_TEMPLATE_NAME1"),
	"DESCRIPTION" => GetMessage("DEFAULT_TEMPLATE_DESCRIPTION"),
	"ICON" => "/images/temp.gif",
	"PATH" => array(
		"ID" => "e-store",
		"CHILD" => array(
			"ID" => "test",
			"NAME" => GetMessage("NAME")
		)
	),
);
?>