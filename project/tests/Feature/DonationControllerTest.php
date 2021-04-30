<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Donation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Tests\Cases\TestCaseFeature;

class DonationControllerTest extends TestCaseFeature
{
    /**
     *
     * @return void
     */
    public function testShouldSeeIndex()
    {
        $response = $this->get('/admin/doacoes');

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testShouldBringDonationInPagination()
    {
        $donation = factory(Donation::class)->create();

        $response = $this->getJson('/pagination/admin/donations');
        $response->assertJson([
            'data' => [
                ['name' => $donation->name]
            ]
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldNotSeeDonationsAsVoluntary()
    {
        $voluntary = User::query()->firstWhere('name', 'Voluntário');
        $this->actingAs($voluntary);
        Auth::login($voluntary);

        $donation = factory(Donation::class)->create();

        $responseIndex = $this->get('/admin/doacoes');
        $responseCreate = $this->get('/admin/doacoes/create');
        $responseEdit = $this->get("/admin/doacoes/{$donation->id}/edit");

        $responseIndex->assertStatus(403);
        $responseCreate->assertStatus(403);
        $responseEdit->assertStatus(403);
    }

    /**
     *
     * @return void
     */
    public function testShouldShowCreateDonation()
    {
        $response = $this->get('/admin/doacoes/create');

        $response->assertSee('Doação :. Novo');
    }

    /**
     *
     * @return void
     */
    public function testShouldCreateDonation()
    {
        $donationData = factory(Donation::class)->make()->toArray();
        $donationData['validate'] = Carbon::make($donationData['validate'])->format('d/m/Y');

        $response = $this->post('/admin/doacoes', $donationData);
        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    /**
     *
     * @return void
     */
    public function testShouldNotCreateDonation()
    {
        $donationData = factory(Donation::class)->state('empty')->make()->toArray();

        $response = $this->post('/admin/doacoes', $donationData);

        $response->assertSessionHasErrors([
            'name' => 'Campo obrigatório.',
            'quantity' => 'Campo obrigatório.',
            'donation_unit_id' => 'Campo obrigatório.',
            'donation_category_id' => 'Campo obrigatório.',
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldShowEditDonation()
    {
        $donation = factory(Donation::class)->create();

        $response = $this->get('/admin/doacoes/' . $donation->id . '/edit');

        $response->assertSee($donation->name);
    }

    /**
     *
     * @return void
     */
    public function testShouldEditUnit()
    {
        $donation = factory(Donation::class)->create();
        $newData = factory(Donation::class)->make()->toArray();
        $newData['validate'] = Carbon::make($newData['validate'])->format('d/m/Y');

        $response = $this->put("/admin/doacoes/{$donation->id}", $newData);
        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    /**
     *
     * @return void
     */
    public function testShouldNotEditUnit()
    {
        $donation = factory(Donation::class)->create();

        $response = $this->put("/admin/doacoes/{$donation->id}", ['name' => '']);

        $response->assertSessionHasErrors([
            'name' => 'Campo obrigatório.'
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldDeleteDonation()
    {
        $donation = factory(Donation::class)->create();
        $response = $this->delete("/admin/doacoes/{$donation->id}");

        $response->assertJson([
            "type" => "success",
            "message" => "Registro removido com sucesso."
        ]);
    }
}
