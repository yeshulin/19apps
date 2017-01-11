<?php
namespace frontend\Libs\PaySDK;

interface paySDKInterface
{
	public function getPay($info);
	public function notify($info);
}