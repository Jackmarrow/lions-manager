<?php

namespace Database\Seeders;

use App\Models\Tool;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tool::insert([
            [
                'name' => 'Boitier – 1 Caméra Panasonic Lumix DC-GH5 Mirrorless Micro Four Thirds .  Réf : DC-GH5KBODY',
                'image' => 'tool1.jpg',
                'etat' => true,
                'stock' => 2,
            ],
            [
                'name' => 'MEDIUM 12-35mm (O58mm) Caméra Panasonic Lumix G X Vario 12-35mm f/2.8 II ASPH. POWER O.I.S. Réf : H-HSA12035 ou modèle équivalent',
                'image' => 'tool2.jpg',
                'etat' => true,
                'stock' => 1,
            ],
            [
                'name' => 'CLOSE-UP 35-100mm (O58 mm) Caméra Panasonic Lumix G X Vario 35-100mm f/2.8 II POWER O.I.S. Réf : H-HSA35100 ou modèle équivalent',
                'image' => 'tool3.jpg',
                'etat' => true,
                'stock' => 1,
            ],
            [
                'name' => 'SanDisk 64GB Extreme PRO UHS-II SDXC Memory Card. Réf : SDSDXPK-064G-ANCIN',
                'image' => 'tool4.jpg',
                'etat' => true,
                'stock' => 5,
            ],
            [
                'name' => 'Trépied Caméra Studio.  Réf : Manfrotto 504HD',
                'image' => 'tool5.jpg',
                'etat' => true,
                'stock' => 2,
            ],
            [
                'name' => ' Lecteur de carte Lexar Professional USB 3.0.  Réf : Dual-Slot Reader (UDMA 7)',
                'image' => 'tool6.jpg',
                'etat' => true,
                'stock' => 1,
            ],
            [
                'name' => 'Panasonic DMW-BLF19 Rechargeable.  Réf : Lithium-ion Battery Pack (7.2V, 1860mAh)',
                'image' => 'tool7.jpg',
                'etat' => true,
                'stock' => 2,
            ],
            [
                'name' => 'Stabilisateur Mobile',
                'image' => 'tool8.jpg',
                'etat' => true,
                'stock' => 1,
            ],

            [
                'name' => 'Boitier – 1 DJI Stabilisateur 3 axes pour smartphones. Réf : DC-GH5KBODY',
                'image' => 'tool9.jpg',
                'etat' => true,
                'stock' => 2,
            ],
            [
                'name' => 'Caméra portable DJI Pocket',
                'image' => 'tool10.webp',
                'etat' => true,
                'stock' => 1,
            ],
            [
                'name' => 'Microcravate Rode + une rallonge. ',
                'image' => 'tool11.jpg',
                'etat' => true,
                'stock' => 2,
            ],
            [
                'name' => 'Adapteur Lignthing JACK',
                'image' => 'tool12.jpg',
                'etat' => true,
                'stock' => 2,
            ],
            [
                'name' => 'Caméra Photo Vidéo Eclairage Kit',
                'image' => 'tool13.webp',
                'etat' => true,
                'stock' => 1,
            ],
            [
                'name' => 'Zoom H6 Handy Recorder with Interchangeable Microphone System',
                'image' => 'tool14.jpg',
                'etat' => true,
                'stock' => 1,
            ],
            [
                'name' => 'Micro-Cravate SENNHEISER Portable sans fil G4. Réf : EW 112P G4-B (626 - 668 MHz)',
                'image' => 'tool15.jpg',
                'etat' => true,
                'stock' => 4,
            ],
            [
                'name' => 'Audio-Technica Casque de monitoring fermé dynamique. Réf : ATH-M20X',
                'image' => 'tool16.webp',
                'etat' => true,
                'stock' => 4,
            ],
            [
                'name' => 'Audio-Technica Microphone - Microphone à condensateur à directivité variable. Réf : AT2050',
                'image' => 'tool17.png',
                'etat' => true,
                'stock' => 4,
            ],
            [
                'name' => 'Bras Pied de micro Bureau Suspension Boom Mic cisaillement Bras avec table Clip Microphone Support de montage Filtre anti-bruit Kit Noir Pare-brise',
                'image' => 'tool18.webp',
                'etat' => true,
                'stock' => 4,
            ],
            [
                'name' => 'Carte micro Kingston SDCX10/64GB',
                'image' => 'tool19.jpg',
                'etat' => true,
                'stock' => 4,
            ],
            [
                'name' => 'NANGUANG LED Lumière Studio Kit. Réf : NANGUANG CN-30F+CN-600SA Studio',
                'image' => 'tool20.jpg',
                'etat' => true,
                'stock' => 1,
            ],
            [
                'name' => 'Savage Widetone Seamless Background Paper (#75 True green, m 3,500" x  m 2,7)',
                'image' => 'tool21.jpg',
                'etat' => true,
                'stock' => 1,
            ],
            [
                'name' => 'Savage Widetone Seamless Background Paper (#70 Storm White, m 3,500" x  m 2,7)',
                'image' => 'tool22.webp',
                'etat' => true,
                'stock' => 1,
            ],
            [
                'name' => 'Savage Widetone Seamless Background Paper (#43 Marmalade, m 3,500" x  m 2,7)',
                'image' => 'tool23.jpg',
                'etat' => true,
                'stock' => 1,
            ],
            [
                'name' => 'Savage Widetone Seamless Background Paper (#29 Orchid, m 3,500" x  m 2,7)',
                'image' => 'tool24.jpg',
                'etat' => true,
                'stock' => 1,
            ],
            [
                'name' => 'Background Holder ',
                'image' => 'tool25.jpg',
                'etat' => true,
                'stock' => 1,
            ],
            [
                'name' => 'BLACKMAGIC DESIGN ATEM MINI Pro – Mélangeur',
                'image' => 'tool26.webp',
                'etat' => true,
                'stock' => 1,
            ],
        ]);
    }
}
