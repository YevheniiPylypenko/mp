<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_contact".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $contact_type
 * @property string $info
 * @property string $details
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class UserContact extends \yii\db\ActiveRecord
{
	const TYPE_OTHER = 0;
    const TYPE_PHONE = 10;
    const TYPE_SKYPE = 20;

	const STATUS_ACTIVE = 0;
	const STATUS_INACTIVE = 10;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_contact';
    }

	public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'info' ], 'required'],
            [['user_id', 'contact_type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['details'], 'string'],
            [['info'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'user_id' => Yii::t('frontend', 'User ID'),
            'contact_type' => Yii::t('frontend', 'Contact Type'),
            'info' => Yii::t('frontend', 'Info'),
            'details' => Yii::t('frontend', 'Details'),
            'status' => Yii::t('frontend', 'Status'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

 	public function getUserContactType($data) {
      $options = $this->getUserContactTypeOptions();
      return $options[$data];
    }

    public function getUserContactTypeOptions()
    {
      return array(
          self::TYPE_PHONE => 'Phone',
          self::TYPE_SKYPE => 'Skype',
          self::TYPE_OTHER => 'Other'
         );
     }
}
