 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80);
            $table->string('phone', 16)->unique();
            $table->string('address', 255);
            $table->string('gender', 16);
            $table->string('role', 16)->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('email', 64)->unique();
            $table->timestamp('email_verified_at')->nullable(true);
            $table->string('password', 64);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
