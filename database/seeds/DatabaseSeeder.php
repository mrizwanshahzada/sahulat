<?php
use App\Models;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Employee;
use App\Models\Vendor;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(UserSeeder::class);
    	$this->call(VendorSeeder::class);
    	$this->call(ServiceSeeder::class);
    	$this->call(SubscriptionSeeder::class);
    	$this->call(PaymentSeeder::class);
    	$this->call(EmployeeSeeder::class);
    	$this->call(TaskSeeder::class);
    }
}

