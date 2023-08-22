<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use App\Models\Absensi;
use App\Models\Ochi;
use App\Models\Qcc;
use App\Models\Rekapitulasi;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use WithFaker;
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    public function test_user_index()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('/home'));

        $response->assertStatus(200);
        $response->assertViewIs('karyawan.index');
        $response->assertViewHas(['rekap', 'a', 's', 'sd', 'iz', 'itd', 'icp', 'td', 'cp', 'ochi', 'qcc'. 'oleader']);
    }
}
