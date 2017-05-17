<?php

use yii\db\Migration;

class m170517_141817_change_visit_table extends Migration
{
    public function up()
    {

        // drops foreign key for table `year_attestation`

        $this->dropForeignKey(
            'fk-visit-year_attestation_id',
            'visit'
        );

        // drops index for column `year_attestation_id`
        $this->dropIndex(
            'idx-visit-year_attestation_id',
            'visit'
        );

        // drops foreign key for table `subject`
        $this->dropForeignKey(
            'fk-visit-subject_id',
            'visit'
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            'idx-visit-subject_id',
            'visit'
        );


        // drops foreign key for table `group`
        $this->dropForeignKey(
            'fk-visit-group_id',
            'visit'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            'idx-visit-group_id',
            'visit'
        );


        $this->dropColumn('visit', 'group_id');
        $this->dropColumn('visit', 'subject_id');
        $this->dropColumn('visit', 'year_attestation_id');

    }

    public function down()
    {
        echo "m170517_141817_change_visit_table cannot be reverted.\n";

        return false;
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
