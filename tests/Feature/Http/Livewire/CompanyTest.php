<?php

namespace Tests\Feature\Http\Livewire;

use App\Http\Livewire\Companies;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /*
     * Guest / RegUser
     * Route / Livewire Component
     * Validation
     * C(R)UD
     */

    public function test_guest_can_not_see_companies()
    {
        $response = $this->get('/companies');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_registered_user_can_see_companies()
    {
        $this->actingAs($user = User::factory()->create());
        $response = $this->get('/companies');
        $response->assertStatus(200);
    }

    function test_companies_page_contains_livewire_component()
    {
        $this->actingAs($user = User::factory()->create());
        $this->get('/companies')->assertSeeLivewire('companies');
    }

    public function test_company_name_is_required()
    {
        $this->actingAs($user = User::factory()->create());
        Livewire::test(Companies::class)
            ->set('title', '')
            ->call('store')
            ->assertHasErrors(['title' => 'required']);
    }

    public function test_company_name_is_unique()
    {
        $this->actingAs($user = User::factory()->create());
        $company = Company::factory()->create();
        Livewire::test(Companies::class)
            ->set('title', $company->title)
            ->call('store')
            ->assertHasErrors(['title' => 'unique']);
    }

    public function test_company_description_is_required()
    {
        $this->actingAs($user = User::factory()->create());
        Livewire::test(Companies::class)
            ->set('description', '')
            ->call('store')
            ->assertHasErrors(['description' => 'required']);
    }

    public function test_company_description_has_min_chars()
    {
        $this->actingAs($user = User::factory()->create());
        Livewire::test(Companies::class)
            ->set('description', '1')
            ->call('store')
            ->assertHasErrors(['description' => 'min']);
    }

    public function test_company_description_has_max_chars()
    {
        $this->actingAs($user = User::factory()->create());
        Livewire::test(Companies::class)
            ->set('description', str_repeat("1", 201))
            ->call('store')
            ->assertHasErrors(['description' => 'max']);
    }

    public function test_user_can_create_or_update_a_company()
    {
        $this->actingAs($user = User::factory()->create());
        Livewire::test(Companies::class)
            ->set('title', 'Test Company')
            ->set('description', 'Test description')
            ->call('store');
        $this->assertTrue(Company::whereTitle('Test Company')
            ->whereDescription('Test description')
            ->exists());
    }

    public function test_user_can_delete_a_company()
    {
        $this->actingAs($user = User::factory()->create());
        $company = Company::factory()->create();
        Livewire::test(Companies::class)
            ->call('delete', $company->id);
        $this->assertTrue(Company::whereId($company->id)
            ->withTrashed()
            ->whereNotNull($company->deleted_at)
            ->exists());
    }
}
