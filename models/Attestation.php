<?php

namespace app\models;

use Yii;

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
class Attestation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attestation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['order_field', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'order_field' => 'Order Field',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYearAttestations()
    {
        return $this->hasMany(YearAttestation::className(), ['attestation_id' => 'id']);
    }
}
