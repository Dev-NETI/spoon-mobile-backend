<?php

namespace Database\Seeders;

use App\Models\Nationality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nationality::truncate();
        $data = [
            0 => ['Afghan'],
            1 => ['Albanian'],
            2 => ['Algerian'],
            3 => ['American'],
            4 => ['Andorran'],
            5 => ['Angolan'],
            6 => ['Anguillan'],
            7 => ['Argentine'],
            8 => ['Armenian'],
            9 => ['Australian'],
            10 => ['Austrian'],
            11 => ['Azerbaijani'],
            12 => ['Bahamian'],
            13 => ['Bahraini'],
            14 => ['Bangladeshi'],
            15 => ['Barbadian'],
            16 => ['Belarusian'],
            17 => ['Belgian'],
            18 => ['Belizean'],
            19 => ['Beninese'],
            20 => ['Bermudian'],
            21 => ['Bhutanese'],
            22 => ['Bolivian'],
            23 => ['Botswanan'],
            24 => ['Brazilian'],
            25 => ['British'],
            26 => ['British Virgin Islander'],
            27 => ['Bruneian'],
            28 => ['Bulgarian'],
            29 => ['Burkinan'],
            30 => ['Burmese'],
            31 => ['Burundian'],
            32 => ['Cambodian'],
            33 => ['Cameroonian'],
            34 => ['Canadian'],
            35 => ['Cape Verdean'],
            36 => ['Cayman Islander'],
            37 => ['Central African'],
            38 => ['Chadian'],
            39 => ['Chilean'],
            40 => ['Chinese'],
            41 => ['Citizen of Antigua and Barbuda'],
            42 => ['Citizen of Bosnia and Herzegovina'],
            43 => ['Citizen of Guinea-Bissau'],
            44 => ['Citizen of Kiribati'],
            45 => ['Citizen of Seychelles'],
            46 => ['Citizen of the Dominican Republic'],
            47 => ['Citizen of Vanuatu'],
            48 => ['Colombian'],
            49 => ['Comoran'],
            50 => ['Congolese (Congo)'],
            51 => ['Congolese (DRC)'],
            52 => ['Cook Islander'],
            53 => ['Costa Rican'],
            54 => ['Croatian'],
            55 => ['Cuban'],
            56 => ['Cymraes'],
            57 => ['Cymro'],
            58 => ['Cypriot'],
            59 => ['Czech'],
            60 => ['Danish'],
            61 => ['Djiboutian'],
            62 => ['Dominican'],
            63 => ['Dutch'],
            64 => ['East Timorese'],
            65 => ['Ecuadorean'],
            66 => ['Egyptian'],
            67 => ['Emirati'],
            68 => ['English'],
            69 => ['Equatorial Guinean'],
            70 => ['Eritrean'],
            71 => ['Estonian'],
            72 => ['Ethiopian'],
            73 => ['Faroese'],
            74 => ['Fijian'],
            75 => ['Filipino'],
            76 => ['Finnish'],
            77 => ['French'],
            78 => ['Gabonese'],
            79 => ['Gambian'],
            80 => ['Georgian'],
            81 => ['German'],
            82 => ['Ghanaian'],
            83 => ['Gibraltarian'],
            84 => ['Greek'],
            85 => ['Greenlandic'],
            86 => ['Grenadian'],
            87 => ['Guamanian'],
            88 => ['Guatemalan'],
            89 => ['Guinean'],
            90 => ['Guyanese'],
            91 => ['Haitian'],
            92 => ['Honduran'],
            93 => ['Hong Konger'],
            94 => ['Hungarian'],
            95 => ['Icelandic'],
            96 => ['Indian'],
            97 => ['Indonesian'],
            98 => ['Iranian'],
            99 => ['Iraqi'],
            100 => ['Irish'],
            101 => ['Israeli'],
            102 => ['Italian'],
            103 => ['Ivorian'],
            104 => ['Jamaican'],
            105 => ['Japanese'],
            106 => ['Jordanian'],
            107 => ['Kazakh'],
            108 => ['Kenyan'],
            109 => ['Kittitian'],
            110 => ['Kosovan'],
            111 => ['Kuwaiti'],
            112 => ['Kyrgyz'],
            113 => ['Lao'],
            114 => ['Latvian'],
            115 => ['Lebanese'],
            116 => ['Liberian'],
            117 => ['Libyan'],
            118 => ['Liechtenstein citizen'],
            119 => ['Lithuanian'],
            120 => ['Luxembourger'],
            121 => ['Macanese'],
            122 => ['Macedonian'],
            123 => ['Malagasy'],
            124 => ['Malawian'],
            125 => ['Malaysian'],
            126 => ['Maldivian'],
            127 => ['Malian'],
            128 => ['Maltese'],
            129 => ['Marshallese'],
            130 => ['Martiniquais'],
            131 => ['Mauritanian'],
            132 => ['Mauritian'],
            133 => ['Mexican'],
            134 => ['Micronesian'],
            135 => ['Moldovan'],
            136 => ['Monegasque'],
            137 => ['Mongolian'],
            138 => ['Montenegrin'],
            139 => ['Montserratian'],
            140 => ['Moroccan'],
            141 => ['Mosotho'],
            142 => ['Mozambican'],
            143 => ['Namibian'],
            144 => ['Nauruan'],
            145 => ['Nepalese'],
            146 => ['New Zealander'],
            147 => ['Nicaraguan'],
            148 => ['Nigerian'],
            149 => ['Nigerien'],
            150 => ['Niuean'],
            151 => ['North Korean'],
            152 => ['Northern Irish'],
            153 => ['Norwegian'],
            154 => ['Omani'],
            155 => ['Pakistani'],
            156 => ['Palauan'],
            157 => ['Palestinian'],
            158 => ['Panamanian'],
            159 => ['Papua New Guinean'],
            160 => ['Paraguayan'],
            161 => ['Peruvian'],
            162 => ['Pitcairn Islander'],
            163 => ['Polish'],
            164 => ['Portuguese'],
            165 => ['Prydeinig'],
            166 => ['Puerto Rican'],
            167 => ['Qatari'],
            168 => ['Romanian'],
            169 => ['Russian'],
            170 => ['Rwandan'],
            171 => ['Salvadorean'],
            172 => ['Sammarinese'],
            173 => ['Samoan'],
            174 => ['Sao Tomean'],
            175 => ['Saudi Arabian'],
            176 => ['Scottish'],
            177 => ['Senegalese'],
            178 => ['Serbian'],
            179 => ['Sierra Leonean'],
            180 => ['Singaporean'],
            181 => ['Slovak'],
            182 => ['Slovenian'],
            183 => ['Solomon Islander'],
            184 => ['Somali'],
            185 => ['South African'],
            186 => ['South Korean'],
            187 => ['South Sudanese'],
            188 => ['Spanish'],
            189 => ['Sri Lankan'],
            190 => ['St Helenian'],
            191 => ['St Lucian'],
            192 => ['Stateless'],
            193 => ['Sudanese'],
            194 => ['Surinamese'],
            195 => ['Swazi'],
            196 => ['Swedish'],
            197 => ['Swiss'],
            198 => ['Syrian'],
            199 => ['Taiwanese'],
            200 => ['Tajik'],
            201 => ['Tanzanian'],
            202 => ['Thai'],
            203 => ['Togolese'],
            204 => ['Tongan'],
            205 => ['Trinidadian'],
            206 => ['Tristanian'],
            207 => ['Tunisian'],
            208 => ['Turkish'],
            209 => ['Turkmen'],
            210 => ['Turks and Caicos Islander'],
            211 => ['Tuvaluan'],
            212 => ['Ugandan'],
            213 => ['Ukrainian'],
            214 => ['Uruguayan'],
            215 => ['Uzbek'],
            216 => ['Vatican citizen'],
            217 => ['Venezuelan'],
            218 => ['Vietnamese'],
            219 => ['Vincentian'],
            220 => ['Wallisian'],
            221 => ['Welsh'],
            222 => ['Yemeni'],
            223 => ['Zambian'],
            224 => ['Zimbabwean'],
        ];

        foreach ($data as $index => [$name]) {
            Nationality::create([
                'name' => $name,
            ]);
        }
    }
}
