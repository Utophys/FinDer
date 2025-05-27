<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_account')->insert([
            [
                'USER_ID' => 'aed03260-6103-4441-b632-df78399fdc69',
                'USERNAME' => 'test',
                'DISPLAY_NAME' => 'test',
                'PASSWORD' => '$2y$12$iJIpn.AItdlzjxKwDwJwE.FJKB9VYTcbx4rBVOSPv6eFnOyV7K/xG',
                'ROLE' => 'user',
                'EMAIL' => 'sultan@gmail.com',
                'IMAGE' => '',
                'IS_DELETED' => 0,
                'remember_token' => null,
            ],
            [
                'USER_ID' => 'bb97a8b7-9da0-4df7-b335-3b3ee31fd7e9',
                'USERNAME' => 'Team4PCD',
                'DISPLAY_NAME' => 'Team4PCD',
                'PASSWORD' => '$2y$12$CaiGZ/13tcwSbiKsfymklu824Pk5i.WK9n6r0EbcRq0ZD.3aFW0Pq',
                'ROLE' => 'user',
                'EMAIL' => 'teampcd4@gmail.com',
                'IMAGE' => 'https://lh3.googleusercontent.com/a/ACg8ocIsnUjQfpayNINDlAZ7cTaxdjIKW0qqENnDcESb3L0qfjM3UA=s96-c',
                'IS_DELETED' => 0,
                'remember_token' => 'Dyn70j4EuDKgFmTNHS2tbUjTnEeadSN2KMHXMXO5byaey5iwI6Zyoa0l10hG',
            ],
            [
                'USER_ID' => 'fdd426fe-47de-4550-8442-228fb5b6a6ca',
                'USERNAME' => 'Sulthan Islami Zacky',
                'DISPLAY_NAME' => 'Sulthan Islami Zacky',
                'PASSWORD' => '$2y$12$56rv/.VhNItVQME/dVTiXOEhvDkIqSC37DAuSavAYmR3FGICZ6zua',
                'ROLE' => 'user',
                'EMAIL' => 'xmipa733sulthanislamizacky@gmail.com',
                'IMAGE' => 'https://lh3.googleusercontent.com/a/ACg8ocLKCFqyNu1pPuUtpwyE-F6-5_O8BuKsQD09oWKE43iX9KRRfA=s96-c',
                'IS_DELETED' => 0,
                'remember_token' => 'YHWa5IVuGVLBzujEohOqxRuUr224RsiJiuHaCOt14DbChBtJvD7YfO0DHrQM',
            ],
            [
                'USER_ID' => 'USR00001',
                'USERNAME' => 'Ripat',
                'DISPLAY_NAME' => 'ripatganteng',
                'PASSWORD' => 'aduhai', // Perhatian: Password ini tidak di-hash. Sebaiknya di-hash.
                'ROLE' => 'user',
                'EMAIL' => 'mochamad@gmail.com',
                'IMAGE' => '',
                'IS_DELETED' => 0,
                'remember_token' => null,
            ],
            [
                'USER_ID' => 'USR00002',
                'USERNAME' => 'admin',
                'DISPLAY_NAME' => 'iniAdminWo',
                'PASSWORD' => '$2y$12$635bjVQ8P.OW4xgZrtJoluGhzCpYXgeP5izo13rXE6nK4SEyPQ0fK',
                'ROLE' => 'admin',
                'EMAIL' => 'admin@gmail.com',
                'IMAGE' => '',
                'IS_DELETED' => 0,
                'remember_token' => null,
            ],
        ]);
    }
}