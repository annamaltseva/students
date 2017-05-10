<?php

use yii\db\Migration;

class m170510_072552_add_unique_index_to_group extends Migration
{
    public function up()
    {
        $this->createIndex(
            'unique-group-name',
            'group',
            'name',
            true
        );
    }

    public function down()
    {
        $this->dropIndex(
            'unique-group-name',
            'group'
        );
    }

}
