<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Comments extends ActiveRecord
{	
	    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }
}
