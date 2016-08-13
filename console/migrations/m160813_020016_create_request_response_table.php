<?php
use yii\db\Schema;
use yii\db\Migration;

class m160813_020016_create_request_response_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%request_response}}', [
            'id' => Schema::TYPE_PK,
            'request_id' => Schema::TYPE_INTEGER.' NOT NULL DEFAULT 0',
            'responder_id' => Schema::TYPE_BIGINT.' NOT NULL DEFAULT 0',
            'note' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
            'response' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
 	  	$this->dropTable('{{%request_response}}');
    }
}
