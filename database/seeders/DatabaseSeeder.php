<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(5)->create();

        $user=User::factory()->create([
            'name'=>'Frank Entsie',
         'email'=>'frank@gmail.com' 
        ]);
        Listing::factory(6)->create([
            'user_id'=>$user->id,
        ]);












        // \App\Models\User::factory()->create([
        //     'title' => 'Laravel Senior Developer',
        //     'tags' => 'Laravel, Javascript',
        //     'company' => 'Justina Corp',
        //     'location' => 'Okinawa',
        //     'email' => 'test@example.com',
        //     'website' => 'www.lol.com',
        //     'description' => 'lorem ipsum dolor sit amet, consectetur adipiscing lorem, sed do eiusmod tempor incididunt ut labore'
            
        // ]);

        
        
        
        
        
        
        
        // Listing::create([
        //         'title' => 'Laravel Senior Developer',
        //         'tags' => 'Laravel, Javascript',
        //         'company' => 'Justina Corp',
        //         'location' => 'Okinawa',
        //         'email' => 'test@example.com',
        //         'website' => 'www.lol.com',
        //         'description' => 'lorem ipsum dolor sit amet, consectetur adipiscing lorem, sed do eiusmod tempor incididunt ut labore'
                
        //      ]);

        //      Listing::create([
        //         'title' => 'Full Stack Developer',
        //         'tags' => 'Laravel, Javascript',
        //         'company' => 'Justina Corp',
        //         'location' => 'Okinawa',
        //         'email' => 'test@example.com',
        //         'website' => 'www.lolest.com',
        //         'description' => 'lorem ipsum dolor sit amet, consectetur adipiscing lorem, sed do eiusmod tempor incididunt ut labore'
        //      ]);
    }
}
