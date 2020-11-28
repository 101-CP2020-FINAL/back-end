<?php

namespace app\api\client\v1\controllers;

use WebSocket\Client;
use yii\web\UploadedFile;

class TtsController extends DefaultController
{
	private const FILE_FIELD = 'audio';
	private const ALPHACEP_URL = 'ws://alphacep:2700/';
	private const SENT_TIMEOUT = 2000;
	private const SENT_CHUNK_SIZE = 8000;

	public function behaviors()
	{
		$behaviors = parent::behaviors();
		unset($behaviors['authenticator']);
		unset($behaviors['access']);
		return $behaviors;
	}

	public function actionIndex()
	{
		$file = UploadedFile::getInstanceByName(self::FILE_FIELD);

		$myfile = fopen($file->tempName, "r");

		$client = new Client(self::ALPHACEP_URL, array('timeout' => self::SENT_TIMEOUT));

		while(!feof($myfile)) {
			$data = fread($myfile, self::SENT_CHUNK_SIZE);
			$client->send($data, 'binary');
			$client->receive();
		}
		$client->send("{\"eof\" : 1}");
		$res = $client->receive();
		$client->close();

		fclose($myfile);
		unlink($file->tempName);

		$res = json_decode($res, true);
		return $res;
	}

}