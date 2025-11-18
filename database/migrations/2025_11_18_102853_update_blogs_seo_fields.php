<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('blogs', function (Blueprint $table) {

        if (!Schema::hasColumn('blogs', 'slug')) {
            $table->string('slug')->unique()->after('title');
        }

        if (!Schema::hasColumn('blogs', 'seo_title')) {
            $table->string('seo_title')->nullable()->after('slug');
        }

        if (!Schema::hasColumn('blogs', 'meta_description')) {
            $table->text('meta_description')->nullable()->after('seo_title');
        }
    });

    // 🟢 STEP 1: Change ENUM → VARCHAR temporarily
    DB::statement("ALTER TABLE blogs MODIFY status VARCHAR(20)");

    // 🟢 STEP 2: Update existing values to new schema
    DB::table('blogs')->where('status', 'active')->update(['status' => 'published']);
    DB::table('blogs')->where('status', 'inactive')->update(['status' => 'draft']);

    // 🟢 STEP 3: Convert VARCHAR → new ENUM
    DB::statement("ALTER TABLE blogs MODIFY status ENUM('draft','published') DEFAULT 'draft'");
}




public function down()
{
    Schema::table('blogs', function (Blueprint $table) {

        if (Schema::hasColumn('blogs', 'slug')) {
            $table->dropColumn('slug');
        }
        if (Schema::hasColumn('blogs', 'seo_title')) {
            $table->dropColumn('seo_title');
        }
        if (Schema::hasColumn('blogs', 'meta_description')) {
            $table->dropColumn('meta_description');
        }

        DB::statement("ALTER TABLE blogs MODIFY status ENUM('active','inactive') DEFAULT 'active'");
    });
}


};
