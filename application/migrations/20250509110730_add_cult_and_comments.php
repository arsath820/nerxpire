<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_cult_and_comments extends CI_Migration {

    public function up()
    {
        if (!$this->db->table_exists('cult')) {
        $this->dbforge->add_field([
            'cult_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'cult_title' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'cult_description' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
        ]);
        $this->dbforge->add_key('cult_id', TRUE);
        $this->dbforge->create_table('cult');
    }
        if (!$this->db->table_exists('comments')) {
        $this->dbforge->add_field([
            'comment_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'blog_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
            ],
            'comment_body' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
        ]);
        $this->dbforge->add_key('comment_id', TRUE);
        $this->dbforge->create_table('comments');
        }
        echo "blog and comments tables created successfully";
    }

    public function down()
    {
        $this->dbforge->drop_table('comments');
        $this->dbforge->drop_table('cult');

        echo "cult and comments tables dropped successfully";
    }
}
