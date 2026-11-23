<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StorefrontFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_guest_can_register_and_sees_the_authenticated_navigation(): void
    {
        $this->get(route('register'))
            ->assertOk()
            ->assertSee('Daftar sebagai seller');

        $this->post(route('register.store'), [
            'name' => 'Ayu Pratama',
            'email' => 'ayu@example.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])->assertRedirect(route('home'));

        $this->assertAuthenticated();
        $this->get(route('home'))
            ->assertSee('SELLER MODE ON')
            ->assertSee('Produk Saya')
            ->assertSee('Keluar')
            ->assertDontSee('Keranjang')
            ->assertDontSee('Daftar sebagai seller');
    }

    public function test_a_guest_cannot_manage_products(): void
    {
        $this->get(route('admin.products.index'))
            ->assertRedirect(route('login'));

        $this->get('/keranjang')->assertNotFound();
        $this->get('/checkout')->assertNotFound();
    }

    public function test_a_guest_sees_a_seller_landing_page_instead_of_a_shopping_storefront(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('MetroStore')
            ->assertSee('Kelola produk tokomu')
            ->assertSee('Daftar sebagai seller')
            ->assertSee('Masuk ke akun')
            ->assertDontSee('Keranjang');
    }

    public function test_an_authenticated_user_can_create_update_and_delete_products(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('admin.products.index'))
            ->assertOk()
            ->assertSee('Produk Saya');

        $this->post(route('admin.products.store'), [
            'name' => 'Kopi Nusantara',
            'description' => 'Kopi pilihan dari petani lokal.',
            'price' => 45000,
            'stock' => 12,
        ])->assertRedirect(route('admin.products.index'));

        $product = Product::where('name', 'Kopi Nusantara')->firstOrFail();
        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 12]);

        $this->get(route('home'))
            ->assertSee('Total produk')
            ->assertSee('Kopi Nusantara')
            ->assertSee('Aman');

        $this->get(route('admin.products.edit', $product))
            ->assertOk()
            ->assertSee('Kopi Nusantara');

        $this->put(route('admin.products.update', $product), [
            'name' => 'Kopi Nusantara Premium',
            'description' => 'Kopi pilihan kualitas premium.',
            'price' => 55000,
            'stock' => 8,
        ])->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Kopi Nusantara Premium',
            'price' => 55000,
            'stock' => 8,
        ]);

        $this->delete(route('admin.products.destroy', $product))
            ->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_an_authenticated_user_can_log_out_and_only_guests_see_register(): void
    {
        $this->get(route('home'))
            ->assertSee('Daftar')
            ->assertSee('Masuk');

        $this->actingAs(User::factory()->create());
        $this->post(route('logout'))
            ->assertRedirect(route('home'));

        $this->assertGuest();
        $this->get(route('home'))
            ->assertSee('Daftar')
            ->assertDontSee('Keluar');
    }
}
