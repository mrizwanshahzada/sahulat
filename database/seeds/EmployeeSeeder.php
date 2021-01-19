<?php

use App\Models\User;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedEmployee();
        factory(Employee::class, 5)->create();
    }

    public function seedEmployee(){
        $user = User::create([
            'name' => 'Mr Employee',
            'role' => 'Employee',
            'phone' => '12312315',
            'address' => 'Lahore',
            'gender' => 'Male',
            'email' => 'employee@employee.com',
            'profile_photo' => 'no-photo.jpg',
            'password' => bcrypt('11111111'),
        ]);

        $employee = Employee::create([
            'user_id' => $user->id,
            'exit_date' => NULL,
            'rating'=> 5.0,
            'salary'=> 25000,
            'status'=> 'Active',
        ]);
    }
}





