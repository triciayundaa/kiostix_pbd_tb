<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInitialTables extends Migration
{
    public function up()
    {
        // 1. user
        $this->forge->addField([
            'id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'full_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'email' => ['type' => 'VARCHAR', 'constraint' => 255],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'no_handphone' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'tanggal_lahir' => ['type' => 'DATE', 'null' => true],
            'gender' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('user', true);

        // 2. country
        $this->forge->addField([
            'id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'name' => ['type' => 'VARCHAR', 'constraint' => 255],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('country', true);

        // 3. city
        $this->forge->addField([
            'id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'country_id' => ['type' => 'VARCHAR', 'constraint' => 36],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('city', true);

        // 4. venue
        $this->forge->addField([
            'id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'title' => ['type' => 'VARCHAR', 'constraint' => 255],
            'city_id' => ['type' => 'VARCHAR', 'constraint' => 36],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('venue', true);

        // 5. category
        $this->forge->addField([
            'id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'title' => ['type' => 'VARCHAR', 'constraint' => 255],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('category', true);

        // 6. event
        $this->forge->addField([
            'id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'title' => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug' => ['type' => 'VARCHAR', 'constraint' => 255],
            'banner_image' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status' => ['type' => 'VARCHAR', 'constraint' => 50],
            'category_id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'venue_id' => ['type' => 'VARCHAR', 'constraint' => 36],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('event', true);

        // 7. atraksi
        $this->forge->addField([
            'id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'title' => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug' => ['type' => 'VARCHAR', 'constraint' => 255],
            'banner_image' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'status' => ['type' => 'VARCHAR', 'constraint' => 50],
            'category_id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'city_id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'country_id' => ['type' => 'VARCHAR', 'constraint' => 36],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('atraksi', true);

        // 8. schedule
        $this->forge->addField([
            'id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'started_at' => ['type' => 'DATETIME'],
            'ended_at' => ['type' => 'DATETIME'],
            'event_id' => ['type' => 'VARCHAR', 'constraint' => 36],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('schedule', true);

        // 9. ticket
        $this->forge->addField([
            'id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'quantity' => ['type' => 'INT', 'constraint' => 11],
            'started_at' => ['type' => 'DATETIME', 'null' => true],
            'ended_at' => ['type' => 'DATETIME', 'null' => true],
            'event_id' => ['type' => 'VARCHAR', 'constraint' => 36, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('ticket', true);

        // 10. cart
        $this->forge->addField([
            'id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'quantity' => ['type' => 'INT', 'constraint' => 11],
            'user_id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'ticket_id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'schedule_id' => ['type' => 'VARCHAR', 'constraint' => 36, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('cart', true);

        // 11. voucher
        $this->forge->addField([
            'id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'code' => ['type' => 'VARCHAR', 'constraint' => 255],
            'amount' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'started_at' => ['type' => 'DATETIME'],
            'ended_at' => ['type' => 'DATETIME'],
            'status' => ['type' => 'VARCHAR', 'constraint' => 50],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('voucher', true);

        // 12. order (using backticks internally or just string)
        $this->forge->addField([
            'id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'order_no' => ['type' => 'VARCHAR', 'constraint' => 255],
            'pay_status' => ['type' => 'VARCHAR', 'constraint' => 50],
            'payment_method' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'sub_total' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'platform_fee' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'grand_total' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'created_at' => ['type' => 'DATETIME'],
            'user_id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'voucher_id' => ['type' => 'VARCHAR', 'constraint' => 36, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('order', true);

        // 13. order_item
        $this->forge->addField([
            'id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'quantity' => ['type' => 'INT', 'constraint' => 11],
            'price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'visit_date' => ['type' => 'DATE', 'null' => true],
            'visit_time' => ['type' => 'TIME', 'null' => true],
            'order_id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'ticket_id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'schedule_id' => ['type' => 'VARCHAR', 'constraint' => 36, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('order_item', true);

        // 14. participant
        $this->forge->addField([
            'id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'email' => ['type' => 'VARCHAR', 'constraint' => 255],
            'no_handphone' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'tanggal_lahir' => ['type' => 'DATE', 'null' => true],
            'gender' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'order_id' => ['type' => 'VARCHAR', 'constraint' => 36],
            'user_id' => ['type' => 'VARCHAR', 'constraint' => 36, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('participant', true);
    }

    public function down()
    {
        $this->forge->dropTable('participant', true);
        $this->forge->dropTable('order_item', true);
        $this->forge->dropTable('order', true);
        $this->forge->dropTable('voucher', true);
        $this->forge->dropTable('cart', true);
        $this->forge->dropTable('ticket', true);
        $this->forge->dropTable('schedule', true);
        $this->forge->dropTable('atraksi', true);
        $this->forge->dropTable('event', true);
        $this->forge->dropTable('category', true);
        $this->forge->dropTable('venue', true);
        $this->forge->dropTable('city', true);
        $this->forge->dropTable('country', true);
        $this->forge->dropTable('user', true);
    }
}
