<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('juguetes', function (Blueprint $table) {
            $table->decimal('precio', 8, 2)->after('categoria');
        });
    }

    public function down()
    {
        Schema::table('juguetes', function (Blueprint $table) {
            $table->dropColumn('precio');
        });
    }
};
