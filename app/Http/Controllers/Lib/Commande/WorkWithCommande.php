<?php
namespace App\Http\Controllers\Lib\Commande;


use App\Http\Controllers\Lib\Delais\DelaisManager;
use App\Http\Controllers\Lib\Achat\WorkWithAchat;
use App\Http\Controllers\Lib\WorkWith;
use App\Http\Controllers\Lib\Gestion;
use App\LigneCommande;
use App\Commande;
use App\Client;
use Illuminate\Support\Facades\Session;

/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 28/12/2016
 * Time: 17:24
 */
class WorkWithCommande extends WorkWith
{

    public $commande;
    public $commandes;
    public $tasks;
    public $lignes;
    public $gestion;
    public $arrayKeyCmd;
    public $withTag;
    public $delais;
    public $delaiRenderView;


    CONST EN_COURS = 'current';

    public function __construct(Commande $commande, LigneCommande $ligneCommande ,Client $client)
    {
        $this->commande = $commande;
        $this->LigneCommande = $ligneCommande;
        $this->client = $client;

        $this->out = collect([]);
        $this->withTag = FALSE;

        $this->renderMode = self::RENDER_COMMANDE_DELAIS;

        $this->tasks =[
            'autoDetect',
            'transform',
            'search',
            'extractBl',
            'extractClient',
            'searchExtractedClient',
        ];

    }

    public function  handle()
    {
        $this->specialCase();

        foreach ($this->tasks as $index => $task)
        {
            if( $this->error == FALSE)
                $this->$task();
        }

        $this->deleteCommande();

        $this->render();
        $this->clean();

        return $this;
    }

    /**
     * Mode de recherche en fonction DU TYPE
     * on peut chercher :
     * une commande / une liste de commande
     * les commandes d'un client / d'une liste de client
     *
     */
    public function search()
    {
        if($this->mode == self::BL_MODE) $this->commandes = $this->commande->multipleOrder($this->out,$this->options)->get()->toArray();
    }

    public function searchCurrent()
    {
         $this->commandes = $this->commande->EnCours($this->options)->toArray();
    }

    public function withLigne()
    {
        array_push($this->tasks,'getLigne');
        return $this;
    }

    public function getLigne()
    {
        $this->lignes = new WorkWithCommandeLigne($this->arrayKeyCmd,new LigneCommande());

        $this->lignes = $this->lignes->setOption('DELAIS');

        if($this->withTag == TRUE)$this->lignes = $this->lignes->withTag();

        $tmp = $this->lignes->handle();

        $this->lignes = $tmp->lignes;

        $this->tags = $this->withTag == TRUE ? $tmp->tags : null ;
        $this->tagsMap = $this->withTag == TRUE ? $tmp->tagsMap : null ;

        $this->filtreCategorie();

        return $this;
    }

    public function withDelais()
    {
        array_push($this->tasks,'getDElais');
        return $this;
    }

    public function getDelais()
    {
        $this->delais = app(DelaisManager::class);

        $this->delais->setBl($this->arrayKeyCmd)->handle();

        $result = $this->getExtractedData($this->delais) ;

        $this->delais = $result;

        $this->delaiRenderView =[];

        $this->gestion = $this->gestion == null ? new Gestion() : $this->gestion;


        foreach ( $this->delais as $index => $delai)
        {
            $render = (
            new $this->renderMode
            (
                $delai,
                $this->clients,
                $this->gestion
            )
            )->handle();
            $this->delaiRenderView[$delai['id_cmd']] =$render;
        }
        //var_dump($this);
        return $this->delaiRenderView;
    }
    
    public function withAchat()
    {
        array_push($this->tasks,'getAchat');
        return $this;
    }

    public function getAchat()
    {
        $this->achat = app(WorkWithAchat::class)->setIn($this->arrayKeyCmd)->handle();

        if($this->renderMode == self::RENDER_COMMANDE_DELAIS) $this->achat = $this->achat->ForDelais()->render();

        return $this;
    }

    public function withTag()
    {
        $this->withTag = TRUE;
        return $this;
    }

    /**
     * on initialise le mode DE RENDU .
     * adapter pour les delais.
     * @return $this
     */
    public function ForDelais()
    {
        $this->renderMode = self::RENDER_COMMANDE_DELAIS;
        
        return $this;
    }

    /**
     * @return $this
     */
    public function extractBl()
    {
        $this->arrayKeyCmd = array_column($this->commandes,'id_cmd');

        return $this;
    }

    /**
     * @return $this
     */
    public function extractClient()
    {
        $this->arrayKeyClient = array_column($this->commandes,'id_clientlivr');

        return $this;
    }



    /**
     * @return $this
     */
    public function searchExtractedClient()
    {
        $this->clients = $this->client->NameClient($this->arrayKeyClient);

        return $this;
    }


    public function render()
    {
        $this->renderView =[];

        $this->gestion = $this->gestion == null ? new Gestion() : $this->gestion;


        foreach ($this->commandes as $index => $commande)
        {
            $render = (
                new $this->renderMode
                (
                $commande,
                $this->clients,
                $this->gestion
                )
            )->handle();
            $this->renderView[$commande['id_cmd']] =$render;
        }

        return $this->renderView;
    }

    private function specialCase()
    {
        if($this->in == 'current')
        {
            $this->tasks = array_diff($this->tasks, ['autoDetect', 'transform','search']);
            array_unshift($this->tasks,'searchCurrent');
        }
    }

    /**
     *
     */
    public function clean()
    {
        unset($this->commande);
        unset($this->in);
        unset($this->out);
        unset($this->tasks);
        unset($this->mode);
        unset($this->type);
        unset($this->error);
        unset($this->LigneCommande);
        unset($this->liste);
        unset($this->client);
        unset($this->arrayKeyClient);
        unset($this->commandes);
        unset($this->renderMode);
        unset($this->clients);
        unset($this->arrayKeyCmd);
        unset($this->gestion);
    }

    private function getExtractedData($bl)
    {
        $extractedData = [];
        $bls = collect($bl->bl)->flip();

        foreach ($this->commandes as $index => $commande)
        {
            $id = $commande['id_cmd'];

            if($bls->has($id))
            {
                $commande['date_cmd']=$bl->delais[$id]['date_envoie'];
                $extractedData[] = $commande;
                unset($this->commandes[$index]);
            }
        }

       return $extractedData;
    }

    public function getOptions()
    {
        $gestion = new Gestion();
        $user = $gestion->users;
        $this->options['users']=array_keys($user);

        $dateFilter = Session::has('delaisControllerDateFilter') ? true : false;
        $categorieFilter= Session::has('delaisControllerCategorieFilter') ? true : false;
        $userFilter= Session::has('delaisControllerUserFilter') ? true : false;

        $this->options['date'] = $dateFilter == TRUE ? Session::get('delaisControllerDateFilter'): 'DESC';
        $this->options['categorie']= $categorieFilter == TRUE ? Session::get('delaisControllerCategorieFilter'): 'ALL';
        $this->options['user'] = $userFilter == TRUE ? explode('_',Session::get('delaisControllerUserFilter')): 'ALL';

        return $this;
    }

    private function filtreCategorie()
    {
        if($this->options['categorie'] !== 'ALL')
        {
            $explodedCategorie = explode('_',$this->options['categorie']);
            $bl = collect($this->arrayKeyCmd)->flip();

            unset($this->arrayKeyCmd);
            $this->arrayKeyCmd=[];

            foreach ($explodedCategorie as $index => $categorie)
            {
                $tagsBls = collect($this->tagsMap[$categorie])->keys()->toArray();
                $this->arrayKeyCmd = array_merge($this->arrayKeyCmd,$tagsBls);
            }
        }

    }

    private function deleteCommande()
    {
       $availableBl = collect($this->arrayKeyCmd)->flip();

        foreach ($this->commandes as $index => $commande)
        {
            if( ! $availableBl->has($commande['id_cmd']))
            {
                unset($this->commandes[$index]);
            }
        }

    }
}