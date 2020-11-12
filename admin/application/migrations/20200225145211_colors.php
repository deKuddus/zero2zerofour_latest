<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_colors extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
        'id' => array(
            'type' => 'INT',
            'constraint' => 11,
            'auto_increment' => TRUE
        ),
        'value' => array(
            'type' => 'VARCHAR',
            'constraint' =>50,
            'null' => TRUE
        ),
        'is_active' => array(
            'type' => 'BOOLEAN',
            'default' => '1'
        )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('colors');
    }

    public function down() {
        $this->dbforge->drop_table('colors');
    }

}
