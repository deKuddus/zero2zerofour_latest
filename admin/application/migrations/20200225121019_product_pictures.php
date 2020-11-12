<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_product_pictures extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
        'id' => array(
            'type' => 'INT',
            'constraint' => 11,
            'auto_increment' => TRUE
        ),
        'product_id' => array(
            'type' => 'INT',
            'constraint' => 11
        ),
        'picture' => array(
            'type' => 'VARCHAR',
            'constraint' => 150,
        ),
        'is_active' => array(
            'type' => 'BOOLEAN',
            'default' => '1'
        )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('product_pictures');
    }

    public function down() {
        $this->dbforge->drop_table('product_pictures');
    }

}
