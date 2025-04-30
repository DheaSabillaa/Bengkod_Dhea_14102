<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyMedicalRecordsTableStructure extends Migration
{
    public function up()
    {
        Schema::table('medical_records', function (Blueprint $table) {
            // Pastikan kolom-kolom berikut ada dan memiliki struktur yang benar
            if (!Schema::hasColumn('medical_records', 'patient_name')) {
                $table->string('patient_name');
            }
            if (!Schema::hasColumn('medical_records', 'medical_note')) {
                $table->text('medical_note');
            }
            if (!Schema::hasColumn('medical_records', 'appointment_date')) {
                $table->date('appointment_date')->nullable();
            }
            if (!Schema::hasColumn('medical_records', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('medical_records', 'status')) {
                $table->string('status')->default('pending');
            }
            if (Schema::hasColumn('medical_records', 'medicine_cost')) {
                $table->decimal('medicine_cost', 10, 2)->default(0)->change();
            } else {
                $table->decimal('medicine_cost', 10, 2)->default(0);
            }
            if (Schema::hasColumn('medical_records', 'total_cost')) {
                $table->decimal('total_cost', 10, 2)->default(0)->change();
            } else {
                $table->decimal('total_cost', 10, 2)->default(0);
            }
        });
    }

    public function down()
    {
        Schema::table('medical_records', function (Blueprint $table) {
            // Jika perlu rollback, hapus foreign key dan kolom
            if (Schema::hasColumn('medical_records', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('medical_records', 'patient_name')) {
                $table->dropColumn('patient_name');
            }
            if (Schema::hasColumn('medical_records', 'medical_note')) {
                $table->dropColumn('medical_note');
            }
            if (Schema::hasColumn('medical_records', 'appointment_date')) {
                $table->dropColumn('appointment_date');
            }
            if (Schema::hasColumn('medical_records', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('medical_records', 'medicine_cost')) {
                $table->decimal('medicine_cost', 10, 2)->change();
            }
            if (Schema::hasColumn('medical_records', 'total_cost')) {
                $table->decimal('total_cost', 10, 2)->change();
            }
        });
    }
}