<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $description
 * @property int $status_id
 * @property int $priority
 * @property string $created_at
 *
 * @property Statuses $status
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'status_id', 'priority', 'created_at'], 'required'],
            [['status_id', 'priority'], 'integer'],
            [['created_at'], 'safe'],
            [['description'], 'string', 'min' => 3, 'max' => 256],
            [['description'], 'unique'],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Statuses::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'status_id' => 'Status ID',
            'priority' => 'Priority',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Statuses::className(), ['id' => 'status_id']);
    }

    /**
     * Search
     */
    public function search () {

        $model = $this -> find ();

        if ($this -> description) {
            $model -> filterWhere (['like', 'description', $this -> description]);
        }

        return $model;
    }

}
