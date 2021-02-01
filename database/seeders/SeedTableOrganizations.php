<?php

namespace Database\Seeders;

use App\Models\Organizations;
use Illuminate\Database\Seeder;

class SeedTableOrganizations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
     public function __construct()
     {
        
     }

     public function run()
    {
        $organizations = [
            'Essere',
            'Kimberlit',
            'Loyder',
            'Floema'
        ];

        foreach ($organizations as $organization) {
            $model = new Organizations();
            $model->name = $organization;
            $model->url = \App\Http\Controllers\Controller::slugify($organization);
            $model->save();
        }
    }
}
