<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParticipantsCountToCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            // Menambahkan kolom untuk jumlah peserta
            $table->unsignedInteger('participants_count')->default(0); // Default 0
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            // Menghapus kolom participants_count jika migration di-rollback
            $table->dropColumn('participants_count');
        });
    }
}
