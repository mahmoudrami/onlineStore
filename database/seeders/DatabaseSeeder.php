<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $routes = Route::getRoutes();

        $resourceNames = collect($routes)->filter(function ($route) {
            return $route->getName() && str_starts_with($route->getName(), 'admin.') && str_contains($route->getName(), '.index');
        })->map(function ($route) {
            // مثال: admin.products.index => products
            $name = $route->getName(); // admin.products.index
            return explode('.', $name)[1]; // products
        })->unique()->values();
        $permissions = [];
        foreach ($resourceNames as $key => $one) {
            $data  = [
                'name' => $one . 's',
                'route_name' => 'admin.' . $one . '.index',
                'parent_id' => 0,
                'icon' => '<i class="fas fa-bullseye"></i>',
                'in_sidebar' => 1,
                'reorder_by' => ++$key,
            ];
            array_push($permissions, $data);
        }

        Permission::factory()->count(count($permissions))->sequence(...$permissions)->create();

        // User::factory(10)->create();
        Admin::factory()->create([
            'name' => 'Admin',
            'email' => 'm@gmail.com',
            'status' => 'active',
            'password' => 123456789
        ]);
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
