<?php

use App\Models\User;
use App\Models\Vendor;
use App\Models\Service;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedVendor();
        factory(Vendor::class, 5)->create();
    }

    public function seedVendor(){
        $user = User::create([
            'name' => 'Mr Vendor',
            'role' => 'Vendor',
            'phone' => '12312312',
            'address' => 'Lahore',
            'gender' => 'Male',
            'email' => 'vendor@vendor.com',
            'profile_photo' => 'no-photo.jpg',
            'password' => bcrypt('11111111'),
        ]);

        $vendor = Vendor::create([
            'user_id' => $user->id,
            'company_name' => 'ABC Company',
            'business_location' => 'Lahore',
            'rating'=> 5.0,
            'exit_date'=> NULL,
            'status'=> 'Pending',
        ]);

        Service::create([
            'vendor_id' => $vendor->id,
            'title' => 'Example Service',
            'frequency' => 30,
            'description' => 'I will pay your bill',
            'charges' => 1000,
            'service_image' => 'no-image.jpg',
            'requirements' => 'Bill, Cash',
        ]);
    }
}
