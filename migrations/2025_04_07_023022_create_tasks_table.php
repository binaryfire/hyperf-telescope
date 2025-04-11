<?php

declare(strict_types=1);

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('workflow_id');
            $table->string('status')->index();
            $table->timestamps();
            $table->dateTime('completed_at')->nullable();

            $table->foreign('workflow_id')->references('id')->on('workflows')->onDelete('cascade');
        });
    }
};
