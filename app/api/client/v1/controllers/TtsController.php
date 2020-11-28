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
		$filePath = $file->tempName;

		$this->convertFile($filePath);

		$myfile = fopen($filePath, "r");

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
		unlink($filePath);

		$res = json_decode($res, true);
		return $res;
	}

	private function convertFile(string $filePath): void
	{
		// curl -F "file=@input.mp3" 127.0.0.1:3000/wav > output.wav
		$curlFile = curl_file_create($filePath);
		$post = array('file'=> $curlFile);

		ob_start();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "ffmpeg/wav");
		curl_setopt($ch, CURLOPT_PORT, 3000);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_exec($ch);
		$converted = ob_get_clean();

		file_put_contents($filePath, $converted);
	}

}