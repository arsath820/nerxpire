<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_love extends CI_Migration {

    public function up()
    {
        if (!$this->db->table_exists('love')) {
        $this->dbforge->add_field([
            'love_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'love_title' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'love_description' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
        ]);
        $this->dbforge->add_key('love_id', TRUE);
        $this->dbforge->create_table('love');
        }
        echo "love tables created successfully";
    }

    public function down()
    {
        $this->dbforge->drop_table('love');

        echo "love tables dropped successfully";
    }
}