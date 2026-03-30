<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LandingSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'name' => 'Hero Section',
                'section_type' => 'hero',
                'sort_order' => 10,
                'content' => [
                    'en' => [
                        'eyebrow' => 'Digital infrastructure for Africa',
                        'title' => 'Building the future<br>we want',
                        'buttons' => [
                            ['text' => 'Explore Sanaa', 'link' => '#services', 'class' => 'btn-cta'],
                            ['text' => 'Shop on Soko 24', 'link' => 'https://soko.sanaa.co', 'class' => 'btn-cta-outline', 'target' => '_blank'],
                        ]
                    ],
                    'fr' => [
                        'eyebrow' => 'Infrastructure numérique pour l\'Afrique',
                        'title' => 'Bâtir le futur<br>que nous voulons',
                        'buttons' => [
                            ['text' => 'Explorer Sanaa', 'link' => '#services', 'class' => 'btn-cta'],
                            ['text' => 'Acheter sur Soko 24', 'link' => 'https://soko.sanaa.co', 'class' => 'btn-cta-outline', 'target' => '_blank'],
                        ]
                    ],
                    'sw' => [
                        'eyebrow' => 'Miundombinu ya kidijitali kwa Afrika',
                        'title' => 'Kujenga mustakabali<br>tunauotaka',
                        'buttons' => [
                            ['text' => 'Gundua Sanaa', 'link' => '#services', 'class' => 'btn-cta'],
                            ['text' => 'Nunua kwenye Soko 24', 'link' => 'https://soko.sanaa.co', 'class' => 'btn-cta-outline', 'target' => '_blank'],
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Mission Section',
                'section_type' => 'mission',
                'sort_order' => 20,
                'content' => [
                    'en' => [
                        'subtitle' => 'Our mission is to empower businesses with modern digital infrastructure for payments, media and commerce.',
                        'insight_eyebrow' => 'Why Sanaa',
                        'insight_content' => 'We unify the rails for commerce in Africa one platform for selling, fulfilling, funding, and storytelling, so every ambitious founder can scale faster.'
                    ],
                    'fr' => [
                        'subtitle' => 'Notre mission est de donner aux entreprises les moyens d\'utiliser une infrastructure numérique moderne pour les paiements, les médias et le commerce.',
                        'insight_eyebrow' => 'Pourquoi Sanaa',
                        'insight_content' => 'Nous unifions les rails du commerce en Afrique une plateforme pour vendre, réaliser, financer et raconter des histoires, afin que chaque fondateur ambitieux puisse évoluer plus rapidement.'
                    ],
                    'sw' => [
                        'subtitle' => 'Dhamira yetu ni kuziwezesha biashara na miundombinu ya kisasa ya kidijitali kwa ajili ya malipo, vyombo vya habari na biashara.',
                        'insight_eyebrow' => 'Kwa nini Sanaa',
                        'insight_content' => 'Tunaunganisha njia za biashara barani Afrika jukwaa moja la kuuza, kutimiliza, kufadhili, na kusimulia hadithi, ili kila mwanzilishi mwenye malengo aweze kukua haraka.'
                    ]
                ]
            ],
            [
                'name' => 'Offerings Section',
                'section_type' => 'offerings',
                'sort_order' => 30,
                'content' => [
                    'en' => [
                        'title' => 'Sanaa Products & Services',
                        'view_all_text' => 'View All Services'
                    ],
                    'fr' => [
                        'title' => 'Produits et services Sanaa',
                        'view_all_text' => 'Voir tous les services'
                    ],
                    'sw' => [
                        'title' => 'Bidhaa na Huduma za Sanaa',
                        'view_all_text' => 'Angalia Huduma Zote'
                    ]
                ]
            ],
            [
                'name' => 'Team Section',
                'section_type' => 'team',
                'sort_order' => 40,
                'content' => [
                    'en' => [
                        'title' => 'Meet the Team'
                    ],
                    'fr' => [
                        'title' => 'Rencontrez l\'équipe'
                    ],
                    'sw' => [
                        'title' => 'Kutana na Timu'
                    ]
                ]
            ],
            [
                'name' => 'Products Section',
                'section_type' => 'products',
                'sort_order' => 50,
                'content' => [
                    'en' => [
                        'title' => 'Featured Products',
                        'subtitle' => 'Discover our selection of quality products from Soko 24',
                        'cta_text' => 'Visit Soko 24'
                    ],
                    'fr' => [
                        'title' => 'Produits vedettes',
                        'subtitle' => 'Découvrez notre sélection de produits de qualité de Soko 24',
                        'cta_text' => 'Visitez Soko 24'
                    ],
                    'sw' => [
                        'title' => 'Bidhaa Zilizoangaziwa',
                        'subtitle' => 'Gundua uteuzi wetu wa bidhaa bora kutoka Soko 24',
                        'cta_text' => 'Tembelea Soko 24'
                    ]
                ]
            ],
            [
                'name' => 'Industries Section',
                'section_type' => 'industries',
                'sort_order' => 60,
                'content' => [
                    'en' => [
                        'eyebrow' => 'Solutions by industry',
                        'title' => 'Made for how you work'
                    ],
                    'fr' => [
                        'eyebrow' => 'Solutions par secteur',
                        'title' => 'Conçu pour votre façon de travailler'
                    ],
                    'sw' => [
                        'eyebrow' => 'Suluhisho kulingana na tasnia',
                        'title' => 'Imeundwa kwa jinsi unavyofanya kazi'
                    ]
                ]
            ],
            [
                'name' => 'Capabilities Section',
                'section_type' => 'capabilities',
                'sort_order' => 70,
                'content' => [
                    'en' => [
                        'eyebrow' => 'Capabilities',
                        'title' => 'See your whole business click into place'
                    ],
                    'fr' => [
                        'eyebrow' => 'Capacités',
                        'title' => 'Voyez toute votre entreprise se mettre en place'
                    ],
                    'sw' => [
                        'eyebrow' => 'Uwezo',
                        'title' => 'Tazama biashara yako nzima ikikaa sawa'
                    ]
                ]
            ],
            [
                'name' => 'Pricing Section',
                'section_type' => 'pricing',
                'sort_order' => 80,
                'content' => [
                    'en' => [
                        'eyebrow' => 'Simple pricing',
                        'title' => 'Run your business with one plan'
                    ],
                    'fr' => [
                        'eyebrow' => 'Tarification simple',
                        'title' => 'Gérez votre entreprise avec un seul plan'
                    ],
                    'sw' => [
                        'eyebrow' => 'Bei rahisi',
                        'title' => 'Endesha biashara yako na mpango mmoja'
                    ]
                ]
            ],
            [
                'name' => 'Blog Section',
                'section_type' => 'blog',
                'sort_order' => 90,
                'content' => []
            ],
            [
                'name' => 'Join Section',
                'section_type' => 'join',
                'sort_order' => 100,
                'content' => [
                    'en' => [
                        'eyebrow' => 'Unified commerce',
                        'title' => 'Join the <span>400+ businesses</span><br>running confidently with <span>Sanaa</span>',
                        'subtitle' => 'From pop-up shops to multi-location enterprises, Sanaa unifies payments, inventory, and customer experience so you can focus on growth.',
                        'cta_primary' => 'Get Started',
                        'cta_secondary' => 'Talk to Sales',
                        'trust_text' => 'Trusted by teams in retail, F&amp;B, beauty, and professional services'
                    ],
                    'fr' => [
                        'eyebrow' => 'Commerce unifié',
                        'title' => 'Rejoignez les <span>plus de 400 entreprises</span><br>qui fonctionnent en toute confiance avec <span>Sanaa</span>',
                        'subtitle' => 'Des boutiques éphémères aux entreprises multi-sites, Sanaa unifie les paiements, l\'inventaire et l\'expérience client afin que vous puissiez vous concentrer sur la croissance.',
                        'cta_primary' => 'Commencer',
                        'cta_secondary' => 'Parler aux ventes',
                        'trust_text' => 'Approuvé par des équipes dans le commerce de détail, l\'alimentation et les boissons, la beauté et les services professionnels'
                    ],
                    'sw' => [
                        'eyebrow' => 'Biashara iliyounganishwa',
                        'title' => 'Jiunge na <span>biashara 400+</span><br>zinazoendeshwa kwa kujiamini na <span>Sanaa</span>',
                        'subtitle' => 'Kuanzia maduka ya muda hadi biashara zenye maeneo mengi, Sanaa inaunganisha malipo, hesabu, na uzoefu wa mteja ili uweze kuzingatia ukuaji.',
                        'cta_primary' => 'Anza Sasa',
                        'cta_secondary' => 'Ongea na Mauzo',
                        'trust_text' => 'Inaaminiwa na timu katika biashara ya rejareja, F&amp;B, urembo, na huduma za kitaalamu'
                    ]
                ]
            ]
        ];

        foreach ($sections as $sectionData) {
            \App\Models\LandingSection::updateOrCreate(
                ['section_type' => $sectionData['section_type']],
                $sectionData
            );
        }
    }
}
