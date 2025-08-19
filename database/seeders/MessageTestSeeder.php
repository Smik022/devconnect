<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\Message;

class MessageTestSeeder extends Seeder
{
    public function run()
    {
        $user = User::first() ?? User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin = Admin::first() ?? Admin::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        Message::create([
            'sender_id' => $user->id,
            'sender_type' => User::class,
            'receiver_id' => $admin->id,
            'receiver_type' => Admin::class,
            'body' => 'Hello Admin, this is a test message!',
        ]);

        $this->command->info("Test message sent from User({$user->id}) to Admin({$admin->id})");
    }
}
