
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            $table->foreignId('room_type_id')
                ->constrained('room_types')
                ->restrictOnDelete();

            $table->string('number', 10);
            $table->integer('floor');
            $table->decimal('night_price', 10, 2);
            $table->integer('beds');
            $table->boolean('has_balcony')->default(false);
            $table->timestamps();

            $table->unique(['room_type_id', 'number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
