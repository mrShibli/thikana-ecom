<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        /**
         * Run the migrations.
         */
        public function up (): void {
            Schema::create ('settings', function (Blueprint $table) {
                $table->id ();
                $table->string ("title")->default ("thikana");
                $table->string ("logo");
                $table->string ("slogan")->default ("Unbox The Unexpected");
                $table->string ("address");
                $table->string ("email");
                $table->string ("phone");
                $table->timestamps ();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down (): void {
            Schema::dropIfExists ('settings');
        }
    };
