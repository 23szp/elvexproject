<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContactInfoToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'email')) {
                $table->string('email')->after('description')->nullable(false);
            }
            if (!Schema::hasColumn('products', 'phone')) {
                $table->string('phone')->after('email')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('products', 'phone')) {
                $table->dropColumn('phone');
            }
        });
    }
}
