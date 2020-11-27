<?php

namespace app\models;

use app\tables\TblTicketFile;
use Yii;
use yii\helpers\FileHelper;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\UploadedFile;

class TicketFile extends TblTicketFile
{

    /**
     * @param $ticketId
     * @param $file
     * @param string $path
     * @return boolean
     * @throws BadRequestHttpException
     */
    public static function saveFile($ticketId, $file, $path = 'uploads')
    {
        if (!is_null($file)) {
            $fileName = self::savePhysicalFile($file, $path);

            $model = new self();
            $model->setAttributes([
                'ticket_id' => $ticketId,
                'path' => '/' . $path . '/' . $fileName
            ]);

            return $model->save();
        } else {
            throw new BadRequestHttpException(Yii::t('app', '[File can not be empty]'));
        }
    }

    /**
     * @param UploadedFile $file
     * @param              $path - saving path
     * @return string - file name whatever saved successful
     * @throws BadRequestHttpException
     * @throws ServerErrorHttpException
     */
    private static function savePhysicalFile($file, $path)
    {
        $name_saved = uniqid() . "." . $file->getExtension();
        $path = \Yii::getAlias('@app/web') . '/' . $path;

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $document = file_get_contents($file->tempName);

        if (file_put_contents($path . '/' . $name_saved, $document)) {
            return $name_saved;
        } else {
            throw new ServerErrorHttpException(Yii::t('app', '[File saving error]'));
        }
    }

    /**
     * deletes physical file after delete model
     */
    public function afterDelete()
    {
        FileHelper::unlink(\Yii::getAlias('@app/web') . $this->path);

        return parent::afterDelete();
    }
}