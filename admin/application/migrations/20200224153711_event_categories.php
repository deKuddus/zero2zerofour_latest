<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_event_categories extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'auto_increment' => TRUE
            ),
            'is_active' => array(
                'type' => 'BOOLEAN',
                'default' => '1'
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('event_categories');
    }

    public function down() {
        $this->dbforge->drop_table('event_categories');
    }

}
