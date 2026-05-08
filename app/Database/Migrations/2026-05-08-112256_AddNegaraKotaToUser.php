<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNegaraKotaToUser extends Migration
{
    public function up()
    {
        $this->forge->addColumn('user', [
            'negara' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'kota' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('user', 'negara');
        $this->forge->dropColumn('user', 'kota');
    }
}
