<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 26/02/2017
 * Time: 23:25
 */

namespace App\Http\Controllers\Lib\Locator;


class Maker
{

    public $zone;
    public $alphabet;
    public $elementDefinition;

    /**
     * Maker constructor.
     */
    public function __construct()
    {
        $this->zone =
        [
            '1' => '',
            '2' => 'A_B_C_D_E_F_G_H_I_J',
            '3' => '',
        ];

        $this->alphabet =
            [
                'A' => 2,
                'B' => 2,
                'C' => 2,
                'D' => 2,
                'E' => 2,
                'F' => 2,
                'G' => 2,
                'H' => 2,
                'I' => 2,
                'J' => 2,
            ];

        $this->elementDefinition =collect(
        [
            'A' =>
                [
                    'name' => 'A',
                    'zone' => 2,
                    'order' => 1,
                    'start' => 1,
                    'end' => 5,
                    'interval' => 3,
                    'etage'=> 3,
                    'exeption'=>'104_204_304'
                ],
            'B' =>
                [
                    'name' => 'B',
                    'zone' => 2,
                    'order' => 2,
                    'start' => 1,
                    'end' => 5,
                    'interval' => 3,
                    'etage'=> 3,
                    'exeption'=>'104_204_304'
                ],
            'C' =>
                [
                    'name' => 'C',
                    'zone' => 2,
                    'order' => 3,
                    'start' => 1,
                    'end' => 5,
                    'interval' => 3,
                    'etage'=> 3,
                    'exeption'=>'104_204_304'
                ],
            'D' =>
                [
                    'name' => 'D',
                    'zone' => 2,
                    'order' => 4,
                    'start' => 1,
                    'end' => 5,
                    'interval' => 3,
                    'etage'=> 3,
                    'exeption'=>'104_204_304'
                ],
            'E' =>
                [
                    'name' => 'E',
                    'zone' => 2,
                    'order' => 5,
                    'start' => 1,
                    'end' => 5,
                    'interval' => 3,
                    'etage'=> 3,
                    'exeption'=>'104_204_304'
                ],
            'F' =>
                [
                    'name' => 'F',
                    'zone' => 2,
                    'order' => 6,
                    'start' => 1,
                    'end' => 5,
                    'interval' => 3,
                    'etage'=> 3,
                    'exeption'=>'104_204_304'
                ],
            'G' =>
                [
                    'name' => 'G',
                    'zone' => 2,
                    'order' => 7,
                    'start' => 1,
                    'end' => 5,
                    'interval' => 3,
                    'etage'=> 3,
                    'exeption'=>'104_204_304'
                ],
            'H' =>
                [
                    'name' => 'H',
                    'zone' => 2,
                    'order' => 8,
                    'start' => 1,
                    'end' => 5,
                    'interval' => 3,
                    'etage'=> 3,
                    'exeption'=>'104_204_304'
                ],
            'I' =>
                [
                    'name' => 'I',
                    'zone' => 2,
                    'order' => 9,
                    'start' => 1,
                    'end' => 5,
                    'interval' => 3,
                    'etage'=> 3,
                    'exeption'=>'104_204_304'
                ],
            'J' =>
                [
                    'name' => 'J',
                    'zone' => 2,
                    'order' => 10,
                    'start' => 1,
                    'end' => 5,
                    'interval' => 3,
                    'etage'=> 3,
                    'exeption'=>'104_204_304'
                ],
        ]);

    }

}