<?php

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained();
            $table->nullableMorphs('source');
            $table->decimal('amount', 26, 0);
            $table->decimal('balance', 26, 0)->unsigned()->default(0);
            $table->enum('type', TransactionType::values())->index();
            $table->uuid()->unique();
            $table->enum('status', TransactionStatus::values())
                ->default(TransactionStatus::INITIALIZED->value)->index();
            $table->timestamps();
            $table->timestamp('completed_at')->nullable();
        });

        // @todo add proper indexes
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
