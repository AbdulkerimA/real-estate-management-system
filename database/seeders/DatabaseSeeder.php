<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Balance;
use App\Models\Document;
use App\Models\Media;
use App\Models\Property;
use App\Models\PropertyDetail;
use App\Models\Setting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'kiya demeke',
            'email' => 'kiya@gmail.com',
            'phone' => '251904004053',
            'password' => 'kiya123456',
            'role' => 'agent',
        ]);
        User::factory()->create([
            'name' => 'abdulkerim adem',
            'email' => 'alkerim@gmail.com',
            'phone' => '251904004054',
            'password' => 'abdu123456',
            'role' => 'customer',
        ]);
        User::factory()->create([
            'name' => 'kebede',
            'email' => 'kebe@gmail.com',
            'phone' => '251904004055',
            'password' => 'kebe123456',
            'role' => 'agent',
        ]);

        // media
        // agents profile
         Media::create([
            'file_path' => 'profiles/et5BBCSuXiSB4Bv2ADHIWKEjnFZj75jZmv11xZs3.png',
            'file_type' => 'image/png',
        ]);
        
        Media::create([
            'file_path' => 'profiles/vRPRYviV8yLO6e7jwWmifE0HaNLSWWDJOoWGIr7F.jpg',
            'file_type' => 'image/png',
        ]);

        // properties images
        Media::create([
            'file_path' => '[
                                "properties/F3r3Tv0tqZzzaCK2fLg8FjUklilkUIlip6p2MJzc.jpg",
                                "properties/tRIgCtcUI3hHKaeg0joZjdrpgM32rPquQDgozR8q.jpg",
                                "properties/xuzF3tL3ISLh8vBPGiaWmw6z8IoOoweFugAIMBgJ.jpg",
                                "properties/hYr6qhkwtexjh8xG5zyvxcSEtlBymRaWZoDUS9uA.jpg",
                                "properties/CZ4zJdpRKjMdFZSLUBMRoUrBd3dvDT8U2u7Z2FSH.jpg",
                                "properties/FAEdpIzpNhwWxoy12sy7FJdMNa4oDp4U71zwJuJw.jpg",
                                "properties/XGflrraW6nzZWJLYooV6OGTfVFR4iGpJ6iuQZdII.jpg"
                            ]',
            'file_type' => 'image/png',
        ]);

        Media::create([
            'file_path' => '[
                                "properties/F3r3Tv0tqZzzaCK2fLg8FjUklilkUIlip6p2MJzc.jpg",
                                "properties/tRIgCtcUI3hHKaeg0joZjdrpgM32rPquQDgozR8q.jpg",
                                "properties/xuzF3tL3ISLh8vBPGiaWmw6z8IoOoweFugAIMBgJ.jpg",
                                "properties/hYr6qhkwtexjh8xG5zyvxcSEtlBymRaWZoDUS9uA.jpg",
                                "properties/CZ4zJdpRKjMdFZSLUBMRoUrBd3dvDT8U2u7Z2FSH.jpg",
                                "properties/FAEdpIzpNhwWxoy12sy7FJdMNa4oDp4U71zwJuJw.jpg",
                                "properties/XGflrraW6nzZWJLYooV6OGTfVFR4iGpJ6iuQZdII.jpg"
                            ]',
            'file_type' => 'image/png',
        ]);

        Media::create([
            'file_path' => '[
                                "properties/F3r3Tv0tqZzzaCK2fLg8FjUklilkUIlip6p2MJzc.jpg",
                                "properties/tRIgCtcUI3hHKaeg0joZjdrpgM32rPquQDgozR8q.jpg",
                                "properties/xuzF3tL3ISLh8vBPGiaWmw6z8IoOoweFugAIMBgJ.jpg",
                                "properties/hYr6qhkwtexjh8xG5zyvxcSEtlBymRaWZoDUS9uA.jpg",
                                "properties/CZ4zJdpRKjMdFZSLUBMRoUrBd3dvDT8U2u7Z2FSH.jpg",
                                "properties/FAEdpIzpNhwWxoy12sy7FJdMNa4oDp4U71zwJuJw.jpg",
                                "properties/XGflrraW6nzZWJLYooV6OGTfVFR4iGpJ6iuQZdII.jpg"
                            ]',
            'file_type' => 'image/png',
        ]);


        // agents document
        Document::create([
            'file_path' => '["agentDocuments\/PM7tPpJ03QaEPIgvFO3EMWDOtivun9sgpDpedRIE.pdf"]',
            'doc_type' => '["application\/pdf"]',
        ]);
        Document::create([
            'file_path' => '["agentDocuments\/spKlfY2SGkzKilmc0LTHTnI0P9lCqpeIHEpQHSPF.jpg"]',
            'doc_type' => '["image\/jpeg"]',
        ]);


        Agent::create([
            'user_id' => '1',
            'media_id' => '1',
            'document_id' => '1',
            'bio' => 'Hi, I am Kiya. I have sold over 20 apartments in one year, which shows I am great.',
            'about_me' => 'more details are here',
            'address' => 'addis abeba mexico',
            'speciality' => 'apartments',
            'years_of_experience' => '1',
        ]);
        Agent::create([
            'user_id' => '3',
            'media_id' => '2',
            'document_id' => '2',
            'bio' => 'Hi, I am kebede.',
            'about_me' => 'more details are here',
            'address' => 'addis abeba furi',
            'speciality' => 'houses',
            'years_of_experience' => '3',
        ]);

        Balance::create([
            'agent_id'=>'1'
        ]);
        Balance::create([
            'agent_id'=>'2'
        ]);

        Setting::create([
            'user_id'=>'1'
        ]);
        Setting::create([
            'user_id'=>'3'
        ]);

        PropertyDetail::factory()->for(Property::factory()->state([
            'agent_id' => '1',
            'media_id'=>'3' 
        ]))->create();
        PropertyDetail::factory()->for(Property::factory()->state([
            'agent_id' => '1',
            'media_id'=>'4' 
        ]))->create();

        PropertyDetail::factory()->for(Property::factory()->state([
            'agent_id' => '3',
            'media_id' => '5' 
        ]))->create();
    }
}
