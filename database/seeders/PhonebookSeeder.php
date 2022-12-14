<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PhonebookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Grover Gilbert',
                'email' => 'user1@mail.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Phyllis Morales',
                'email' => 'user2@mail.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Rita Obrien',
                'email' => 'user3@mail.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Tina Lee',
                'email' => 'user4@mail.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Tiffany Soto',
                'email' => 'user5@mail.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Damon Kemp',
                'email' => 'user6@mail.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Jennifer Spencer',
                'email' => 'user7@mail.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Alvin Corbyn',
                'email' => 'user8@mail.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Jack Thompson',
                'email' => 'user9@mail.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Tyne Schwartz',
                'email' => 'user10@mail.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Samantha Rowe',
                'email' => 'user11@mail.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Simona Valdez',
                'email' => 'user12@mail.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Alice Moss',
                'email' => 'user13@mail.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Elena Barrett',
                'email' => 'user14@mail.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Frank Mccoy',
                'email' => 'user15@mail.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $contacts = [
            [
                'user_id' => 1,
                'number' => '09102184911',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 2,
                'number' => '09202184912',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 3,
                'number' => '09302184913',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 4,
                'number' => '09402184914',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 5,
                'number' => '09502184915',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 6,
                'number' => '09112184911',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 7,
                'number' => '09212184912',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 8,
                'number' => '09312184913',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 9,
                'number' => '09412184914',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 10,
                'number' => '09512184915',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 11,
                'number' => '09103184911',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 12,
                'number' => '09203184912',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 13,
                'number' => '09303184913',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 14,
                'number' => '09403184914',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 15,
                'number' => '09503184915',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' =>  $user['email'],
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        foreach ($contacts as $contact) {
            Contact::create([
                'user_id' => $contact['user_id'],
                'number' => $contact['number'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }



        $datausers = User::all();
        $datacontacts = Contact::all();
        foreach ($datausers as $datauser) {
            foreach ($datacontacts as $datacontact) {
                if ($datauser->id != $datacontact->user_id) {
                    $datacontact->users()->attach($datauser);
                }
            }
        }
    }
}
