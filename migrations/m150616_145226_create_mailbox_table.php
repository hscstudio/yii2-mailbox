<?php

use yii\db\Schema;
use yii\db\Migration;

class m150616_145226_create_mailbox_table extends Migration
{
    public function safeUp()
    {
		$tableOptions = null;	
		if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
		
		$this->createTable('{{%mailbox}}', [
            'id' => Schema::TYPE_PK,
            'sender' => Schema::TYPE_INTEGER,
            'receiver' => Schema::TYPE_INTEGER,
            'subject' => Schema::TYPE_STRING . '(255) NOT NULL',
            'content' => Schema::TYPE_TEXT,
            'readed' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);
		
		
    }

    public function safeDown()
    {
        $this->dropTable('{{%mailbox}}');
        $this->dropTable('{{%user}}');
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
