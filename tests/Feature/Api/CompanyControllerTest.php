<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Company;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private Company $company;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:refresh --env=testing');
        $this->artisan('db:seed --env=testing');

        $this->company = Company::factory()->create();

    }

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/api/companies');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_returns_a_collection_of_companies()
    {
        // Act
        $response = $this->get('/api/companies');

        // Assert
        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        // Add other expected fields here
                    ],
                ],
            ]);
    }

    /** @test */
    public function it_returns_a_single_company()
    {
        // Arrange
        $company = Company::factory()->create();

        // Act
        $response = $this->get("/api/companies/{$company->id}");

        // Assert
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $company->id,
                    'name' => $company->name,
                ],
            ]);
    }

    /** @test */
    public function it_creates_a_new_company()
    {
        // Arrange
        $companyData = Company::factory()->raw();

        // Act
        $response = $this->post('/api/companies', $companyData);

        // Assert
        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => $companyData['name'],
                ],
            ]);

        $this->assertDatabaseHas('companies', $companyData);
    }

    /** @test */
    public function it_updates_an_existing_company()
    {
        $company = Company::factory()->create();
        $updatedData = ['name' => 'Updated Company Name'];
        $response = $this->put("/api/companies/{$company->id}", $updatedData);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'Updated Company Name',
                ],
            ]);

        $this->assertDatabaseHas('companies', array_merge(['id' => $company->id], $updatedData));
    }

    /** @test */
    public function it_deletes_an_existing_company()
    {
        $company = Company::factory()->create();
        $response = $this->delete("/api/companies/{$company->id}");
        $response->assertNoContent();

        $this->assertDatabaseMissing('companies', ['id' => $company->id]);
    }
}
