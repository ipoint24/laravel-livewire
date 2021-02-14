<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class TenantScopeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_a_model_has_a_tenant_id_on_the_migration()
    {
        $now = now();
        $this->artisan('make:model Test -m');
        $filename = $now->year . '_' . $now->format('m') . '_' . $now->format('d')
            . '_' . $now->format('H') . $now->format('i') . $now->format('s')
            . '_create_tests_table.php';
        // find the migration file and check it has a tenant_id

        $this->assertTrue(File::exists(database_path('migrations/' . $filename)));
        // Find tenant_id in migration
        $this->assertStringContainsString(
            '$table->foreignId(\'tenant_id\')->nullable()->index()->constrained();',
            File::get(database_path('migrations/' . $filename))
        );
        // clean up
        File::delete(database_path('migrations/' . $filename));
        File::delete(app_path('Models/Test.php'));
    }

    public function test_a_user_can_only_see_users_in_the_save_tenant()
    {
        $tenant1 = Tenant::factory()->create();
        $tenant2 = Tenant::factory()->create();

        $user1 = User::factory()->create([
            'tenant_id' => $tenant1,
        ]);
        User::factory()->count(10)->create([
            'tenant_id' => $tenant1,
        ]);

        User::factory()->count(10)->create([
            'tenant_id' => $tenant2,
        ]);

        auth()->login($user1);
        $this->assertEquals(11, User::count());
    }

    public function test_a_user_can_only_create_new_user_in_his_tenant_even_if_other_tenant_is_provided()
    {
        $tenant1 = Tenant::factory()->create();
        $tenant2 = Tenant::factory()->create();

        $user1 = User::factory()->create([
            'tenant_id' => $tenant1,
        ]);
        auth()->login($user1);
        $createdUser = User::factory()->make();
        $createdUser->tenant_id = $tenant2->id;
        $createdUser->save();
        $this->assertTrue($createdUser->tenant_id == $user1->tenant_id);
    }

    public function test_a_super_admin_has_no_global_scope()
    {

        $tenant1 = Tenant::factory()->create();
        $tenant2 = Tenant::factory()->create();
        $tenant3 = Tenant::factory()->create();

        $superadmin = User::factory()->create([
            'name' => 'superadmin',
            'tenant_id' => $tenant1,
        ]);
        $this->artisan('db:seed --class=RolesAndPermissionsSeeder');
        $superadmin->assignRole('super-admin');

        auth()->login($superadmin);
        $this->actingAs($superadmin);
        $users = User::factory()->count(10)->create([
            'tenant_id' => $tenant2,
        ]);

        User::factory()->count(10)->create([
            'tenant_id' => $tenant3,
        ]);

        $this->assertEquals(21, User::count());
    }
}
