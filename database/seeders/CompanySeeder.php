<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::truncate();
        $data = [
            0 => ['NONE'],
            1 => ['Abosta Shipmanagement Corporation'],
            2 => ['Adfil Shipmanning and Management Corporation'],
            3 => ['Albar Shipping and Trading Corporation'],
            4 => ['Alpha Shipmanagement Corporation'],
            5 => ['Araw Shipping Agency, Inc.'],
            6 => ['Asia Bulk Transport Philippines, Inc.'],
            7 => ['Astra Marine International, Inc.'],
            8 => ['Baliwag Navigation, Inc.'],
            9 => ['Barko International, Inc.'],
            10 => ['Beamko Shipmanagement Corporation'],
            11 => ['Bouvet Shipping Management Corporation'],
            12 => ['Bridge Marine Corporation'],
            13 => ['BSM Crew Service Centre Philippines, Inc.'],
            14 => ['Caravel Navigation Philippines, Inc.'],
            15 => ['Cargo Safeway, Inc.'],
            16 => ['Cleene Maritime Corporation'],
            17 => ['Cordial Shipping, Inc.'],
            18 => ['Dalisay Shipping Corporation'],
            19 => ['Eastgate Maritime Corporation'],
            20 => ['Elite Maritime Management Corporation'],
            21 => ['Fair Shipping Corporation'],
            22 => ['Fil-Maritime Travelers, Inc.'],
            23 => ['Fil-Star Maritime Corporation'],
            24 => ['Fleet Management Services Philippines, Inc.'],
            25 => ['Grace Marine and Shipping Corporation'],
            26 => ['Hanseatic Shipping Philippines, Inc.'],
            27 => ['IMS Philippines Maritime Corporation'],
            28 => ['Intermodal Shipping, Inc.'],
            29 => ['Island Overseas Transport Corporation'],
            30 => ['Jebsen-PTC Maritime, Inc.'],
            31 => ['K LNG Maritime Services, Inc.'],
            32 => ['Leonis Navigation Company, Inc.'],
            33 => ['Magsaysay Maritime Corporation'],
            34 => ['Magsaysay MOL Marine, Inc.'],
            35 => ['Maine Marine Philippines, Inc.'],
            36 => ['Manila Ocean Crew Management, Inc.'],
            37 => ['Maranaw Luzon Shipping Company, Inc.'],
            38 => ['Matagumpay Maritime, Inc.'],
            39 => ['Maunlad Trans, Inc.'],
            40 => ['Mercury Shipping Corporation'],
            41 => ['Merfolk Shipping, Inc.'],
            42 => ['MMSPhil Maritime Services, Inc.'],
            43 => ['MOT-Barko Manila, Inc.'],
            44 => ['Multinational Maritime, Inc.'],
            45 => ['New Filipino Maritime Agencies, Inc.'],
            46 => ['NS United Marine Philippines Inc.'],
            47 => ['NYK-Fil Ship Management, Inc.'],
            48 => ['One Shipping Corporation'],
            49 => ['Oriental Shipmanagement Company, Inc.'],
            50 => ['Orophil Shipping International Company, Inc.'],
            51 => ['Philippine Transmarine Carriers, Inc.'],
            52 => ['Philippine Transworld Shipping Corporation'],
            53 => ['Phil-Crewing Maritime Services, Inc.'],
            54 => ['Phoenix Martime Corporation'],
            55 => ['S.T. Ocean Philippines, Inc.'],
            56 => ['SDV Maritime Corporation'],
            57 => ['Sea Cap Shipping, Inc.'],
            58 => ['Seacrest Maritime Management, Inc.'],
            59 => ['Solpia Marine and Ship Management, Inc.'],
            60 => ['Southfield Agencies Inc.'],
            61 => ['Splash Philippines, Inc.'],
            62 => ['TDG Crew Management, Inc.'],
            63 => ['Top Ever Marine Management Philippine Corporation'],
            64 => ['Transorient Maritime Agencies, Inc.'],
            65 => ['TSM Maritime Services (Phils.), Inc.'],
            66 => ['Unitra Maritime Manila, Inc.'],
            67 => ['Ventis Maritime Corporation'],
            68 => ['Veritas Maritime Corporation'],
            69 => ['Vintex Shipping Philippines Corporation'],
            70 => ['Virjen Shipping Corporation'],
            71 => ['Wallem Maritime Services, Inc.'],
            72 => ['NYK-Fil Maritime E-Training Inc.'],
            73 => ['IMMAJ-PJMCC'],
            74 => ['NYK-TDG Maritime Academy']
        ];

        foreach ($data as $index => [$name]) {
            Company::create([
                'name' => $name,
            ]);
        }
    }
}
