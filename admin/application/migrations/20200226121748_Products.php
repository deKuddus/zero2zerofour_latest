<?php

class Migration_Products extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => false
            ),
            'sku' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => false
            ),
            'category_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => false
            ),
            'sub_category_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => false
            ),
            'purchase_price' => array(
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => false
            ),
            'sale_price' => array(
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => false
            ),
            'discount' => array(
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => false
            ),
            'discount_type' => array(
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => false
            ),
            'tax' => array(
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => false
            ),
            'color' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'size' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'quantity' => array(
                'type' => 'VARCHAR',
                'constraint' => 10,
                'default' => 0
            ),
            'feature_picture' => array(
                'type' => 'VARCHAR',
                'constraint' => 200
            ),
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'is_active' => array(
                'type' => 'BOOLEAN',
                'default' => '1'
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('products');
    }

    public function down() {
        $this->dbforge->drop_table('products');
    }

}
