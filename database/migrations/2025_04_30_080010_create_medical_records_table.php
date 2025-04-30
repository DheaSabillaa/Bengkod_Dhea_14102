<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordsTable extends Migration
{
    public function up()
    /**
     * Run the migrations.
     *
     * Creates the medical records table. The table has the following columns:
     *
     * - id: the primary key of the table, an auto-incrementing integer
     * - patient_name: the name of the patient, a string
     * - medical_note: the medical note, a text
     * - medicine_cost: the cost of the medicine, an integer that can be null
     * - total_cost: the total cost of the medical record, an integer that can be null
     * - timestamps: the created_at and updated_at timestamps
     */
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->text('medical_note');
            $table->integer('medicine_cost')->nullable();
            $table->integer('total_cost')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medical_records');
    }
}