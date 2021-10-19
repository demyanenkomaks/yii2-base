<?php

namespace common\behaviors;

use yii\behaviors\AttributeBehavior;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;


class DateToTimeBehavior extends AttributeBehavior
{

    public $timeAttribute;
    public $format;

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'convertToTime',
            ActiveRecord::EVENT_AFTER_FIND => 'convertToString',
        ];
    }

    public function convertToTime()
    {
        if (empty($this->timeAttribute)) {
            throw new InvalidConfigException('Please fill "timeAttribute" property');
        }
        if (is_array($this->timeAttribute)) {
            foreach ($this->timeAttribute as $attribute) {
                if (!$this->owner->hasProperty($attribute)) {
                    throw new InvalidConfigException(
                        'Can`t find ' . $attribute . ' property in ' . $this->owner->tableName()
                    );
                }
                if (!is_numeric($this->owner->{$attribute})) {
                    $this->owner->{$attribute} = strtotime($this->owner->{$attribute});
                }
            }
        } else {
            if (!$this->owner->hasProperty($this->timeAttribute)) {
                throw new InvalidConfigException(
                    'Can`t find ' . $this->timeAttribute . ' property in ' . $this->owner->tableName()
                );
            }
            $this->owner->{$this->timeAttribute} = strtotime($this->owner->{$this->timeAttribute});
        }
    }

    public function convertToString()
    {
        if (empty($this->timeAttribute)) {
            throw new InvalidConfigException('Please fill "timeAttribute" property');
        }
        if (is_array($this->timeAttribute)) {
            foreach ($this->timeAttribute as $attribute) {
                if (!$this->owner->hasProperty($attribute)) {
                    throw new InvalidConfigException(
                        'Can`t find ' . $attribute . ' property in ' . $this->owner->tableName()
                    );
                }
                $this->owner->{$attribute} = $this->owner->{$attribute} ? date($this->format, $this->owner->{$attribute}) : null;
            }
        } else {
            if (!$this->owner->hasProperty($this->timeAttribute)) {
                throw new InvalidConfigException(
                    'Can`t find ' . $this->timeAttribute . ' property in ' . $this->owner->tableName()
                );
            }
            $this->owner->{$this->timeAttribute} = $this->owner->{$this->timeAttribute} ? date($this->format, $this->owner->{$this->timeAttribute}) : null;
        }
    }
}

?>