<?php

use Illuminate\Database\Seeder;

class SubcategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subcategories')->insert([
            ['name' => 'Duksevi',
             'category_id'=>'1',
             'gender_id'=>'0'
        	],
        	['name' => 'Džemperi',
             'category_id'=>'1',
             'gender_id'=>'0'
        	],
        	['name' => 'Jakne',
             'category_id'=>'1',
             'gender_id'=>'0'
        	],
        	['name' => 'Kaputi mantili',
             'category_id'=>'1',
             'gender_id'=>'0'
        	],
        	['name' => 'Pantalone',
             'category_id'=>'1',
             'gender_id'=>'0'
        	],
            ['name' => 'Trenerke',
             'category_id'=>'1',
             'gender_id'=>'0'
            ],
            ['name' => 'Šorcevi i bermude',
             'category_id'=>'1',
             'gender_id'=>'1'
            ],
        	['name' => 'Majice',
             'category_id'=>'1',
             'gender_id'=>'0'
        	],
        	['name' => 'Prsluci',
             'category_id'=>'1',
             'gender_id'=>'0'
        	],
            ['name' => 'Rolke',
             'category_id'=>'1',
             'gender_id'=>'0'
            ],
            ['name' => 'Venčanice',
             'category_id'=>'1',
             'gender_id'=>'2'
            ],
        	['name' => 'Haljine',
             'category_id'=>'1',
             'gender_id'=>'2'
        	],
            ['name' => 'Tunike',
             'category_id'=>'1',
             'gender_id'=>'2'
            ],
        	['name' => 'Suknje',
             'category_id'=>'1',
             'gender_id'=>'2'
        	],
            ['name' => 'Kompleti',
             'category_id'=>'1',
             'gender_id'=>'2'
            ],
        	['name' => 'Helanke',
             'category_id'=>'1',
             'gender_id'=>'2'
        	],
            ['name' => 'Džins',
             'category_id'=>'1',
             'gender_id'=>'0'
            ],
        	['name' => 'Bunde',
             'category_id'=>'1',
             'gender_id'=>'2'
        	],
        	['name' => 'Poslovna Odela',
             'category_id'=>'1',
             'gender_id'=>'0'
        	],
            ['name' => 'Sakoi i Odela',
             'category_id'=>'1',
             'gender_id'=>'0'
            ],
        	['name' => 'Košulje',
             'category_id'=>'1',
             'gender_id'=>'0'
        	],
            ['name' => 'Poslovne Košulje i kravate',
             'category_id'=>'1',
             'gender_id'=>'0'
            ],
            ['name' => 'Donji veš i čarape',
             'category_id'=>'1',
             'gender_id'=>'0'
            ],
            ['name' => 'Pidžame',
             'category_id'=>'1',
             'gender_id'=>'0'
            ],
            ['name' => 'Kupaće gaće',
             'category_id'=>'1',
             'gender_id'=>'0'
            ],
        	['name' => 'Ostalo',
             'category_id'=>'1',
             'gender_id'=>'0'
        	],
			//obuca 
        	['name' => 'Patike',
             'category_id'=>'2',
             'gender_id'=>'0'
        	],
        	['name' => 'Cipele',
             'category_id'=>'2',
             'gender_id'=>'0'
        	],
        	['name' => 'Čizme',
             'category_id'=>'2',
             'gender_id'=>'0'
        	],
        	['name' => 'Sandale',
             'category_id'=>'2',
             'gender_id'=>'0'
        	],
        	['name' => 'Štikle',
             'category_id'=>'2',
             'gender_id'=>'2'
        	],
        	['name' => 'Papuče',
             'category_id'=>'2',
             'gender_id'=>'0'
        	],
            ['name' => 'Baletanke',
             'category_id'=>'2',
             'gender_id'=>'2'
            ],
            ['name' => 'Ostalo',
             'category_id'=>'2',
             'gender_id'=>'0' 
            ],
          
        	// aksesoar
             ['name' => 'Satovi',
             'category_id'=>'3',
             'gender_id'=>'0' 
            ],
            ['name' => 'Kaiš',
             'category_id'=>'3',
             'gender_id'=>'0' 
            ],
             ['name' => 'Nakit',
             'category_id'=>'3',
             'gender_id'=>'0' 
            ],
             ['name' => 'Naočare',
             'category_id'=>'3',
             'gender_id'=>'0' 
            ],
             ['name' => 'Šeširi',
             'category_id'=>'3',
             'gender_id'=>'0' 
            ],
             ['name' => 'Šalovi',
             'category_id'=>'3',
             'gender_id'=>'0' 
            ],
             ['name' => 'Kape',
             'category_id'=>'3',
             'gender_id'=>'0' 
            ],
             ['name' => 'Ostalo',
             'category_id'=>'3',
             'gender_id'=>'0' 
            ],
            // decija odeca

            ['name' => 'Odeća',
             'category_id'=>'4',
             'gender_id'=>'0' 
            ],
            ['name' => 'Obuća',
             'category_id'=>'4',
             'gender_id'=>'0' 
            ],
            ['name' => 'Ostalo',
             'category_id'=>'4',
             'gender_id'=>'0' 
            ],
            //sportska oprema
            ['name' => 'Fitnes',
             'category_id'=>'5',
             'gender_id'=>'0' 
            ], 
             ['name' => 'Fudbal',
             'category_id'=>'5',
             'gender_id'=>'0' 
            ], 
             ['name' => 'Košarka',
             'category_id'=>'5',
             'gender_id'=>'0' 
            ], 
             ['name' => 'Odbojka',
             'category_id'=>'5',
             'gender_id'=>'0' 
            ], 
             ['name' => 'Plivanje',
             'category_id'=>'5',
             'gender_id'=>'0' 
            ], 
             ['name' => 'Skijanje',
             'category_id'=>'5',
             'gender_id'=>'0' 
            ], 
             ['name' => 'Tenis',
             'category_id'=>'5',
             'gender_id'=>'0' 
            ], 
             ['name' => 'Trčanje',
             'category_id'=>'5',
             'gender_id'=>'0' 
            ], 
             ['name' => 'Trening',
             'category_id'=>'5',
             'gender_id'=>'0' 
            ], 
             ['name' => 'Rukomet',
             'category_id'=>'5',
             'gender_id'=>'0' 
            ], 
            ['name' => 'Ostalo',
             'category_id'=>'5',
             'gender_id'=>'0' 
            ]

        ]);
    }
}
