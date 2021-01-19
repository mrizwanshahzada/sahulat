<?php
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedAdminAndCustomer();
        factory(User::class, 5)->create();
    }

    public function seedAdminAndCustomer(){
        DB::table('users')->insert([
            'name' => 'Mr Admin',
            'role' => 'Admin',
            'phone' => '1234678',
            'address' => 'Lahore',
            'gender' => 'Male',
            'email' => 'admin@admin.com',
            'profile_photo' => 'no-photo.jpg',
            'password' => bcrypt('11111111'),
        ]);

        DB::table('users')->insert([
            'name' => 'Mr Customer',
            'role' => 'Customer',
            'phone' => '12345555',
            'address' => 'Lahore',
            'gender' => 'Male',
            'email' => 'customer@customer.com',
            'profile_photo' => 'no-photo.jpg',
            'password' => bcrypt('11111111'),
        ]);
    }
}
