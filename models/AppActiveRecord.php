<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "attestation".
 *
 * @property integer $id
 * @property string $name
 * @property integer $order_field
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property YearAttestation[] $yearAttestations
 */
class AppActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}