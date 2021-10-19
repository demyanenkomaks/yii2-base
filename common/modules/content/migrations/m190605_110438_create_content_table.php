<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%textBlock}}`.
 */
class m190605_110438_create_content_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName == 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%content}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'description' => $this->text(),
            'code' => $this->string(255),
            'status' => $this->boolean(),
            'full' => $this->boolean(),
            'sideTitle' => $this->string(255),
            'sideText' => $this->string(255),
            'sideUrl' => $this->string(255),
            'sideBtn' => $this->string(255),
            'template' => $this->string(255)
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%content}}');
    }
}
