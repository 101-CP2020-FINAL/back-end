<?php

namespace app\api\common\models;

use app\tables\TblEmployer;
use app\tables\TblInternalServices;
use app\tables\TblTicket;

class ApiTicket extends TblTicket
{
    const SCENARIO_VIEW = 'view';

    public function fields()
    {
        if ($this->scenario === self::SCENARIO_VIEW) {
            return [
                'id',
                'type' => function(){
                    return $this->type ? [
                        'id' => $this->type->id,
                        'title' => $this->type->title
                    ] : null;
                },
                'priority' => function(){
                    return $this->priority ? [
                        'id' => $this->priority->id,
                        'title' => $this->priority->title
                    ] : null;
                },
                'title',
                'description',
                'date_start',
                'deadline',
                'author' => function(){
                    $author = TblEmployer::findOne($this->author_id);
                    if ($author) {
                        return [
                            'id' => $this->author_id,
                            'title' => $author->last_name.' '.$author->first_name,
                            'type' => 'employer'
                        ];
                    }
                    $author = TblInternalServices::findOne($this->author_id);
                    if ($author) {
                        return [
                            'id' => $this->author_id,
                            'title' => $author->name,
                            'type' => 'service'
                        ];
                    }
                    return null;
                },
                'parent' => function(){
                    return $this->parent ? [
                        'id' => $this->parent->id,
                        'title' => $this->parent->title
                    ] : null;
                }
            ];
        }
        return parent::fields();
    }


}