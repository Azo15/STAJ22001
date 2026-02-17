<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureUserHasRole;

use Illuminate\Foundation\Testing\RefreshDatabase;

class SecurityTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        
        // Define a test route protected by the role middleware
        Route::middleware(['web', EnsureUserHasRole::class . ':admin'])
            ->get('/test-admin-route', function () {
                return 'Admin Access Granted';
            });
    }

    /** @test */
    public function guest_users_should_not_access_admin_routes()
    {
        $response = $this->get('/test-admin-route');

        // Current buggy behavior: Guest gets 200 OK
        // Desired behavior: Guest gets 403 or 302 (redirect)
        
        // We assert what we expect to FAIL if the bug exists, or pass if we are confirming the bug.
        // Let's assert that it redirects or fails, and if it succeeds (200), the test fails, confirming the bug.
        
        if ($response->status() === 200) {
            $this->fail('Guest user was able to access admin route! Security vulnerability confirmed.');
        }
        
        $response->assertRedirect(route('login'));
    }
    
    /** @test */
    public function admin_user_can_access_admin_routes()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        $response = $this->actingAs($admin)
            ->get('/test-admin-route');
            
        $response->assertStatus(200);
        $response->assertSee('Admin Access Granted');
    }
    
    /** @test */
    public function reader_user_cannot_access_admin_routes()
    {
        $reader = User::factory()->create(['role' => 'reader']);
        
        $response = $this->actingAs($reader)
            ->get('/test-admin-route');
            
        // Should redirect to forbidden
        $response->assertRedirect('/forbidden');
    }
}
