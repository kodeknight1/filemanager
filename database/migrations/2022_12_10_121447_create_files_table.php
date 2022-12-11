<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Folder;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {

            $table->id();
            $table->string( 'original_name');
            $table->string( 'file_name');
            $table->string( 'path' );
            $table->string( 'extension' );
            $table->integer( 'size' )->nullable();
            $table->foreignIdFor(Folder::class)->default(0);
            $table->foreignIdFor(User::class);
            
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
};
