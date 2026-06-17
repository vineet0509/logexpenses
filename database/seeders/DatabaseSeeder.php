<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\SubscriptionPlan;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Default Subscription Plans
        SubscriptionPlan::create([
            'name' => 'Free',
            'max_projects' => 1,
            'price' => 0.00,
            'features' => json_encode(['limit_bills' => 50])
        ]);

        SubscriptionPlan::create([
            'name' => 'Basic',
            'max_projects' => 3,
            'price' => 499.00,
            'features' => json_encode(['limit_bills' => 'unlimited'])
        ]);

        SubscriptionPlan::create([
            'name' => 'Pro Contractor',
            'max_projects' => null, // unlimited
            'price' => 1499.00,
            'features' => json_encode(['limit_bills' => 'unlimited', 'advanced_reports' => true])
        ]);

        // Default Categories
        $categories = [
            'Sand', 'Cement', 'Steel', 'Bricks', 'Tiles', 
            'Electrical', 'Plumbing', 'Paint', 'Doors', 
            'Windows', 'Labour', 'Misc'
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'is_default' => true
            ]);
        }
    }
}
