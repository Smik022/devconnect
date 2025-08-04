<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeveloperProfileFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('bio')->nullable()->after('role');
            $table->text('skills')->nullable()->after('bio');
            $table->text('experience')->nullable()->after('skills');
            $table->text('education')->nullable()->after('experience');
            $table->string('github')->nullable()->after('education');
            $table->string('stackoverflow')->nullable()->after('github');
            $table->string('portfolio')->nullable()->after('stackoverflow');
            $table->string('resume')->nullable()->after('portfolio');  // store resume filename/path
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'bio', 'skills', 'experience', 'education',
                'github', 'stackoverflow', 'portfolio', 'resume'
            ]);
        });
    }
}
