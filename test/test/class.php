<?php

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Web\Json;


if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

/**
 * @var $APPLICATION CMain
 * @var $USER CUser
 */

Loc::loadMessages(__FILE__);

class TestComponent extends \CBitrixComponent
{
	protected $action;

	protected function GetDiscountAction() {

		$user = \Bitrix\Main\Engine\CurrentUser::get()->getId();
		$result = array();

		$query = 'SELECT * FROM atest_data where userid = ' . $user;
		$resQuery = $this->runQuery($query);
		$qcount = 0;
		foreach ($resQuery as $key=>$data)
		{
			$qcount = $qcount + 1;

			$now = new DateTime();
			$nowDate = $now->getTimestamp();
			$dbDate = $data['create_date']->getTimestamp();
			if ($nowDate - $dbDate < 60*60) {
				$result["discount"] = $data['discount'];
				$result["discode"] = $data['discount_code'];
				break;
			}
		}

		if (count($result) == 0) {
			//create 
			$result["discount"] = rand(1,50);
			$result["discode"] = uniqid();

			$time = date('Y-m-d H:i:s');

			if ($qcount == 0) {
				$query = 'INSERT INTO atest_data (userid, discount, discount_code, create_date) VALUES ('
					. $user . ',' . $result["discount"] . ',"' . $result["discode"] 
					. '","' . $time . '");';
			} else {

				$query = "UPDATE atest_data SET discount=${result['discount']}, "
					. "discount_code='${result['discode']}', create_date='${time}' "
					. "WHERE userid=${user};";
				
			}

			$this->runQuery($query);
		}

		$this->sendAjax($result);
	}

	protected function sendAjax($result)
	{
		global $APPLICATION;

		$APPLICATION->RestartBuffer();
		header('Content-Type: application/json');
		echo Json::encode($result);
		CMain::FinalActions();
		die();
	}

	protected function runQuery ($query) {
		try
        {
            $connection = Main\Application::getInstance()->getConnection();
            return $connection->query($query);
        }
        catch( Main\DB\SqlException $e )
        {
            var_dump($e->getMessage());
        }
	}

	protected function prepareAction()
	{
		$action = $this->request->offsetExists($this->arParams['ACTION_VARIABLE'])
			? $this->request->get($this->arParams['ACTION_VARIABLE'])
			: $this->request->get('action');

		return $action;
	}

	protected function actionExists($action)
	{
		return is_callable([$this, $action.'Action']);
	}

	protected function doAction($action)
	{
		if ($this->actionExists($action))
		{
			$this->{$action.'Action'}();
		}
	}

	public function executeComponent()
	{
		global $APPLICATION;

		$this->setFrameMode(false);
		$this->context = Main\Application::getInstance()->getContext();
		$this->checkSession = $this->arParams["DELIVERY_NO_SESSION"] == "N" || check_bitrix_sessid();
		$this->isRequestViaAjax = $this->request->isPost() && $this->request->get('via_ajax') == 'Y';
		$isAjaxRequest = $this->request["is_ajax_post"] == "Y";

		if ($isAjaxRequest)
			$APPLICATION->RestartBuffer();

		$this->action = $this->prepareAction();
		$this->doAction($this->action);

		if (!$isAjaxRequest)
		{
			CJSCore::Init(['fx', 'popup', 'window', 'ajax', 'date']);
		}

		//is included in all cases for old template
		$this->includeComponentTemplate();

		if ($isAjaxRequest)
		{
			$APPLICATION->FinalActions();
			die();
		}
	}
}
