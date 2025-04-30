<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToMedicalRecordsTable extends Migration
{
    public function up()
    {
        Schema::table('medical_records', function (Blueprint $table) {
            $table->date('appointment_date')->nullable()->after('medical_note');
            $table->unsignedBigInteger('user_id')->nullable()->after('appointment_date');
            $table->string('status')->default('pending')->after('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('medical_records', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['appointment_date', 'user_id', 'status']);
        });
    }
}