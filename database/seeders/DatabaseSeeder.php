<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'email' => 'admin@admin.co.id',
            'password' => Hash::make('admin123'),
            'name' => 'admin',
            'active' => 1,
            'picture' => 'DefaultProfile.jpg',
            'website' => 'admin.com',
            'role' => 'admin'
        ]);
        DB::table('users')->insert([
            'email' => 'jojo@gmail.com',
            'password' => Hash::make('jojojojo'),
            'name' => 'jojo',
            'active' => 1,
            'picture' => 'DefaultProfile.jpg',
            'website' => 'jojo.com',
            'role' => 'user'
        ]);

        DB::table('posts')->insert([
            'PostTitle' => 'dummy post 1',
            'PostImage' => 'DefaultPost.webp',
            'PostDesc' => 'this is dummy post from the database',
        ]);
        DB::table('posts')->insert([
            'PostTitle' => 'dummy post 2',
            'PostImage' => 'DefaultPost.webp',
            'PostDesc' => 'this is dummy post from the database',
        ]);
        DB::table('posts')->insert([
            'PostTitle' => 'dummy post 3',
            'PostImage' => 'DefaultPost.webp',
            'PostDesc' => 'this is dummy post from the database',
        ]);
        DB::table('posts')->insert([
            'PostTitle' => 'dummy post 4',
            'PostImage' => 'DefaultPost.webp',
            'PostDesc' => 'this is dummy post from the database',
        ]);

        DB::table('tags')->insert([
            'TagName'=>'Coding',
        ]);
        DB::table('tags')->insert([
            'TagName'=>'Design',
        ]);
        DB::table('tags')->insert([
            'TagName'=>'Finance',
        ]);

        DB::table('post_headers')->insert([
            'UserID' => 2,
            'PostID' => 4,
        ]);
        DB::table('post_headers')->insert([
            'UserID' => 2,
            'PostID' => 3,
        ]);
        DB::table('post_headers')->insert([
            'UserID' => 2,
            'PostID' => 2,
        ]);
        DB::table('post_headers')->insert([
            'UserID' => 2,
            'PostID' => 1,
        ]);

        DB::table('post_views')->insert([
            'UserID' => 2,
            'PostID' => 3,
        ]);

        DB::table('post_likes')->insert([
            'UserID' => 2,
            'PostID' => 3,
        ]);

        DB::table('post_tags')->insert([
            'PostID' => 3,
            'TagName' => 'Coding'
        ]);
    }
}
