<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 22/02/2017
 * Time: 21:35
 */

namespace App\Http\Controllers\Lib\Incident;


use App\User;

class IncidentConstante
{
    public $Attribute =
        [
            'Appel/Dossier passé à' => 1,
            'A rappeler par' => 2,
            'Attente D\'info du client' => 3,
            'Retour matos NEUF (Suite Err)' => 4,
            'Expedition Pièces/Machines' => 5,
            'Attente Pièces/Machines du client' => 6,
            'Demande de réparation/inter' => 7,
            'Attente Fournisseur' => 8,
            'Cloture de l\'incident' => 9,
            'Non attribué' => 10,
            'Demande de réparation' => 11,
            'Demande d\'inter' => 12,
            'Bonjour,>> Urgence' => 13,
            'Appel/Dossier passÃ© Ã' => 14,
            'Attente PiÃƒÂ¨ces/Machines du client' => 15,
            'Expedition PiÃ¨ces/Machines' => 16,
            'A rappeller par... -->' => 17,
        ];

    public $action =
        [
           1 => 'Appel/Dossier passé à',
           2 => 'A rappeler par',
           3 => 'Attente D\'info du client',
           4 => 'Retour matos NEUF (Suite Err)',
           5 => 'Expedition Pièces/Machines',
           6 => 'Attente Pièces/Machines du client',
           7 => 'Demande de réparation/inter',
           8 => 'Attente Fournisseur',
           66 => '-------------------------',
           9 => 'Cloture de l\'incident',
        ];

    public $etat = 9;
    /**
     * @var User
     */
    private $receiver;

    /**
     * IncidentConstante constructor.
     * @param array $action
     */
    public function __construct(User $receiver)
    {
        $this->receiver = $receiver;
    }

    public function getReceiver()
    {
        return $this->formatUser();
    }

    private function formatUser()
    {
        $users=[];
        $model = $this->receiver->actif()->get();

        foreach ($model as $index => $item) {
            $users[$item->id]=$item->USER_prenom.' '.$item->USER_nom.' ('.$item->id.')';
        }

        return $users;
    }

    public function getSpecificUser($id)
    {
        return $this->receiver->find($id);
    }


}