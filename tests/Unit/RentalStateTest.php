<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Rental;
use App\Models\User;
use App\Models\Books;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Patterns\State\PendingState;
use App\Patterns\State\ApprovedState;

class RentalStateTest extends TestCase
{
    use RefreshDatabase;

    public function test_pending_rental_can_be_approved()
    {
        $user = User::factory()->create();
        $book = Books::factory()->create();
        $rental = Rental::create([
            'user_id' => $user->id,
            'books_id' => $book->id,
            'status' => 'Pending Review',
            'rental_requested_at' => now(),
        ]);

        $this->assertInstanceOf(PendingState::class, $rental->state());

        $rental->approve();

        $this->assertEquals('Approved', $rental->fresh()->status);
        $this->assertInstanceOf(ApprovedState::class, $rental->fresh()->state());
    }

    public function test_pending_rental_can_be_rejected()
    {
        $user = User::factory()->create();
        $book = Books::factory()->create();
        $rental = Rental::create([
            'user_id' => $user->id,
            'books_id' => $book->id,
            'status' => 'Pending Review',
            'rental_requested_at' => now(),
        ]);

        $rental->reject();

        $this->assertEquals('Rejected', $rental->fresh()->status);
    }

    public function test_approved_rental_cannot_be_approved_again()
    {
        $user = User::factory()->create();
        $book = Books::factory()->create();
        $rental = Rental::create([
            'user_id' => $user->id,
            'books_id' => $book->id,
            'status' => 'Approved',
            'rental_requested_at' => now(),
            'rental_start_at' => now(),
            'rental_due_at' => now()->addWeeks(2),
        ]);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Bu durumdan 'Onaylandı' durumuna geçiş yapılamaz.");

        $rental->approve();
    }

    public function test_returned_rental_cannot_be_cancelled()
    {
        $user = User::factory()->create();
        $book = Books::factory()->create();
        $rental = Rental::create([
            'user_id' => $user->id,
            'books_id' => $book->id,
            'status' => 'Returned',
            'rental_requested_at' => now(),
            'rental_start_at' => now()->subWeeks(1),
            'returned_at' => now(),
        ]);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Bu durumdan 'İptal Edildi' durumuna geçiş yapılamaz.");

        $rental->cancel();
    }
}
