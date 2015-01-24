<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "participant".
 *
 * @property integer $id
 * @property integer $meeting_id
 * @property integer $participant_id
 * @property integer $invited_by
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $invitedBy
 * @property Meeting $meeting
 * @property User $participant
 */
class Participant extends \yii\db\ActiveRecord
{
  
    public $email;
    public $username;
    public $password;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'participant';
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
            [['meeting_id'], 'required'],
          // the email attribute should be a valid email address
            ['email', 'email'],            
            [['meeting_id', 'participant_id', 'invited_by', 'status', 'created_at', 'updated_at'], 'integer']
              ['username', 'filter', 'filter' => 'trim'],
              ['username', 'required'],
              ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
              ['username', 'string', 'min' => 2, 'max' => 255],

              ['email', 'filter', 'filter' => 'trim'],
              ['email', 'required'],
              ['email', 'email'],
              ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

              ['password', 'required'],
              ['password', 'string', 'min' => 6],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'meeting_id' => Yii::t('frontend', 'Meeting ID'),
            'participant_id' => Yii::t('frontend', 'Participant ID'),
            'invited_by' => Yii::t('frontend', 'Invited By'),
            'status' => Yii::t('frontend', 'Status'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvitedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'invited_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeeting()
    {
        return $this->hasOne(Meeting::className(), ['id' => 'meeting_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticipant()
    {
        return $this->hasOne(User::className(), ['id' => 'participant_id']);
    }
    
    public function add() {
      // new participant from meeting invite
      // lookup email as existing user
      // if not exist, create user entry
      // username, email and password
      if ($user = $model->signup()) {
          if (Yii::$app->getUser()->login($user)) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save();
      }}
      // return participant id
      return ;
    }
}
