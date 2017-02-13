<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;
use App\Watchlist;
use App\Permission;
use App\Role;

use Faker\Factory as Faker;
class UsersTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {


        $faker = Faker::create();

        Permission::truncate();
        Role::truncate();
        User::truncate();

        \DB::table('role_user')->delete();
        \DB::table('permission_role')->delete();

        $user = User::create([
            'fullname' => 'Ralph John Galindo',
            'username' => 'ralphjohngalindo',
            'password' => bcrypt('ralph123$$'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $admin = User::create([
            'fullname' => 'Vladimir Putin',
            'username' => 'admin',
            'password' => bcrypt('admin123$$'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'The man who cant be moved',
        ]);

        $clientRole = Role::create([
            'name' => 'client',
            'display_name' => 'Client',
            'description' => 'The client who buys the stocks',
        ]);

        $admin->attachRole($adminRole);
        $user->attachRole($clientRole);

        foreach ([ 'GOOGL' , 'YHOO' , 'NDAQ' ,'TWTR' , 'DOW' , 'AAPL'] as $key => $symbol) {
            Watchlist::create([
                'user_id' => $user->id,
                'stock_symbol' => $symbol,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
