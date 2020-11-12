<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_categories extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
        'id' => array(
            'type' => 'INT',
            'constraint' => 11,
            'auto_increment' => TRUE
        ),
        'pid' => array(
            'type' => 'INT',
            'constraint' => 11
        ),
        'category_name' => array(
            'type' => 'VARCHAR',
            'constraint' => 100,
            'null' => false
        ),
        'is_active' => array(
            'type' => 'BOOLEAN',
            'default' => '1'
        )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('categories');
    }

    public function down() {
        $this->dbforge->drop_table('categories');
    }

}
