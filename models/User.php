<?php

namespace app\models;


use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\helpers\Url;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'auth_key',
                    'password_hash',
                    'email',
                    'username',
                    'name',
                ],
                'required'
            ],
            [
                [
                    'auth_key',
                    'password_hash',
                    'email',
                    'username',
                    'name',
                ],
                'string',
                'max' => 255
            ],

            [
                [
                    'is_admin',
                ],
                'integer',
            ],

            ['username', 'unique'],

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Электронная почта',
            'name' => 'ФИО преподавателя',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }


    /**
     * Get user status
     */
    public static function getUserStatus($id)
    {
        $result = [
            self::STATUS_DELETED => "Удален",
            self::STATUS_ACTIVE => "Активный"
        ];
        if (array_key_exists($id, $result)) {
            return $result[$id];
        } else {
            return $result;
        }
    }

    /**
     * Get Teachers
     */
    public static function getTeachers()
    {
        return self::find()->where(['is_admin' => 0 ]);
    }

    public static function roleCurrentUser() {
        if (Yii::$app->user->isGuest)
        {
            return '';
        } else {
            if (Yii::$app->user->identity->is_admin ==1) return 'admin';
            if (Yii::$app->user->identity->is_admin ==0) return 'user';
        }

    }

    public static function getMenuItemsByRoleUserAndLayout($role)
    {

        switch ($role) {
            case 'admin':
                return [
                    [
                        'label' => 'Справочники',
                        'items' => [
                            ['label' => 'Учебные годы', 'url' => ['/year/index']],
                            ['label' => 'Типы формы контроля', 'url' => ['/checkout-form/index']],
                            ['label' => 'Предметы', 'url' => ['/subject/index']],
                            ['label' => 'Аттестации', 'url' => ['/attestation/index']],
                            ['label' => 'Методы оценки', 'url' => ['/rating/index']],
                            ['label' => 'Уровни компетенции', 'url' => ['/competence-level/index']],
                        ],
                    ],
                    [
                        'label' => 'Студенты',
                        'items' => [
                            ['label' => 'Группы', 'url' => ['/group/index']],
                            ['label' => 'Студенты', 'url' => ['/student/index']],
                        ],
                    ],
                    [
                        'label' => 'Оценивание',
                        'items' => [
                            ['label' => 'Аттестации по годам', 'url' => ['/year-attestation/index']],
                            ['label' => 'Контроль успешности обучения', 'url' => ['/control/index']],
                        ],
                    ],
                    ['label' => 'Преподаватели', 'url' => ['/teacher/index']],
                    [
                        'label' => 'Выйти (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post'],
                        'active' => false
                    ],

                ];
                break;

            case 'user':
                return [
                    [
                        'label' => 'Студенты',
                        'items' => [
                            ['label' => 'Группы', 'url' => ['/group/index']],
                            ['label' => 'Студенты', 'url' => ['/student/index']],
                        ],
                    ],
                    [
                        'label' => 'Оценивание',
                        'items' => [
                            ['label' => 'Аттестации по годам', 'url' => ['/year-attestation/index']],
                            ['label' => 'контроль успешности обучения', 'url' => ['/checkout/index']],
                        ],
                    ],
                    [
                        'label' => 'Выйти (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post'],
                        'active' => false
                    ],
                ];
                break;
            default:
                return [
                    ['label' => 'Войти', 'url' => ['/site/login']]
                ];
        }
    }
}
