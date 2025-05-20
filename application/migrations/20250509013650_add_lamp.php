<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_lamp extends CI_Migration {

    public function up()
    {
        if (!$this->db->table_exists('lamp')) {
        $this->dbforge->add_field([
            'lamp_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'lamp_title' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'lamp_description' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
        ]);
        $this->dbforge->add_key('lamp_id', TRUE);
        $this->dbforge->create_table('lamp');
    }
        echo "lamp table created successfully";
    }

    public function down()
    {
        $this->dbforge->drop_table('lamp');

        echo "lamp table dropped successfully";
    }
}
