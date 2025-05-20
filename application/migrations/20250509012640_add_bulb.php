<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_bulb extends CI_Migration {

    public function up()
    {
        if (!$this->db->table_exists('bulb')) {
        $this->dbforge->add_field([
            'bulb_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'bulb_title' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'bulb_description' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
        ]);
        $this->dbforge->add_key('bulb_id', TRUE);
        $this->dbforge->create_table('bulb');
    }
        echo "table bulb created successfully";
    }

    public function down()
    {
        $this->dbforge->drop_table('bulb');

        echo "table bulb dropped successfully";
    }
}
