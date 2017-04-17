<?php

namespace App\Http\Controllers;


use App\Commande;
use App\Http\controllers\Lib\Achat\WorkWithAchat;
use App\Http\controllers\Lib\Commande\WorkWithCommande;
use App\Http\controllers\Lib\Delais\FiltreDelaisManager;
use App\Http\controllers\Lib\Order\OrderGestion;
use App\Http\controllers\Lib\Order\OrderGestion_;
use App\Http\Controllers\Lib\Gestion;
use App\Thread;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class DelaisController extends Gestion
{
    protected $delaisGestion;
    protected $delai;
    protected $option;



    /**
     * DelaisController constructor.
     */
    public function __construct( OrderGestion_ $orderGestion_ , OrderGestion $orderGestion  )
    {
        $this->orderGestion_ = $orderGestion_;
        $this->orderGestion = $orderGestion;

    }

    public function proto()
    {
        /*
        * 1 commande unique existante >searchOrder(3162820)
        * 2 commande en cours ->searchOrder('current')
        * 3 commande qui existe pas integer  ->searchOrder(989868354354354345)
        * 3 commande qui existe pas varchar  ->searchOrder('ssdxgdfgdfg')
       */

        $orders= [];
//        $unique = Commande::find(3170713);
//        $orders = $this->orderGestion->searchOrder($unique);
//        $orders = $this->orderGestion->searchOrder(3170713)->get() ;

        $orders = $this->orderGestion->searchOrder('current')
            ->get()
            //->withLigneMinimal()
            //->withTag()
            //->withAchat()
            ->render()
        ;

        //var_dump($orders);
        $i = 0;
        foreach ($orders as $index => $order) {
            //$lignes = $order->lignes;
//
//
            //if($i == 1  AND isset($lignes->lignes)){
            //    foreach ($lignes->lignes as $index => $ligne)
            //    {
//          //          /var_dump($index);
//          //          /var_dump($ligne);
            //    }
            //}

            $i++;
        }

        $orderDisplay=[];
        //$orderDisplay = $orders->get()->render();

        //var_dump($orders->manager->clients);
        //var_dump($orders->manager->arrayKeyCmd);
        //var_dump($orders->manager->arrayKeyClient);
        //var_dump($orders->manager->arrayCommandeLigne);
        //var_dump($orders->manager->commandes);
        //var_dump($orders);
        var_dump('i');
        //var_dump($order->currentOrder);
        //$order = $order->executeOrderTasks();

    }

    public function achat()
    {

        $testIn1 ='3170769';
        $testIn2 = [ '4070199', '3152436', '3152294', '3152313', '3170612', '3170666', '3170666', '3170681'];
        $testIn3 = '4070199_3161905_3162820_3170497_3170612_3170666_3170666_3170681';
        $testIn4='31374';
        $testIn5=['31376', '31375', '31374', '31373'];
        $testIn6='31376_31375_31374_31373';
        $test7=['021402'];

        $testEnCours = Commande::EnCours();
        $arrayCmd = $testEnCours->pluck('id_cmd');
        $gestion = new Gestion();

        $achat = app(WorkWithAchat::class);
        $achat->setIn($arrayCmd)->handle();

        $render = $achat->ForDelais()->render();

        /*
         * In -
         *  1 commandes
         *  2 client
         *
         * */


        //var_dump($achat);
        var_dump($render);
        var_dump('retour');
    }


    public function index()
    {

        /*
         * Design the code !
         * regroupement get Data : En cours -> return collection -> extract list Bl ->extract List Client ->extract list Vendeur ->get list User
         * test si presence delai via bl
         */

        $cache = Redis::get('cacheDelaisRender');

        if($cache)
        {
            $cmd = unserialize($cache);
        }
        else
        {
            $cmd = app(WorkWithCommande::class) ;
            $itemSearcheable = 'current' ;

            $cmd = $cmd
                ->getOptions()
                ->setIn($itemSearcheable)
                ->withLigne()
                ->withTag()
                ->withDelais()
                ->withAchat()
                ->handle()
            ;

            $cmd_ = serialize($cmd);
            $cache = Redis::set('cacheDelaisRender',$cmd_);
        }

        $explosedUser = collect($cmd->options['user'])->flip();

        return view('delai.index_correct')
            ->with('cmd',$cmd)
            ->with('users',$this->vendeurDelais)
            ->with('user_',$this->getUsers())
            ->with('explosedUser',$explosedUser)
            ->with('categories',$this->getCategorieGlobal())
            ;

    }

    public function filtre(Session $session,$type,$value)
    {
        $filter = new FiltreDelaisManager($session, $type,$value);
        $filter->handle();
        return $filter;

    }

    public function create($id)
    {
        /*
         * test existence commande ?
         * recupe info lié a la commande table cmd + cmd lignes
         * recupe les da lié a id_cmd dans table pd
         * recupe les action des DA table da_action
         * recup les date d'arriver pour le PO table PO
         * recupe sur categorie ? fonctione ligne cmd
         * recup eventuelle date ? via info bl
         *
         * --Table ?
         * - cmd
         * - cmd_lignes
         * - it_bl
         * - pd
         * - po
         * - pd_actions
        */


        if($this->orderGestion->existOrder($id))
        {
            $information = $this->orderGestion->getNewDelais();


//            return view('delais.create')
//                ->with('info',$information);
            return "n° de commande $id";
        }

        return  "Cette commande n'existe pas ! ";

    }

    public function test()
    {
        //$commande = Commande::with('achat')
        //    ->find(3172364 )
        //;
        $commandes = Commande::whereIn('id_cmd',[3142364,3162523])
            ->get()
        ;

        $specific  = $commandes->where('pds_colis', 90);
        dump($specific);
        dump($commandes);
//
//        /**
//         * return collection of model
//         * les 2 syntax donne le meme resultat.
//         * multiple result
//         */
//        $commande = Commande::find(['3172123','3152363']);
//        $commande = Commande::whereIn('id_cmd',['3172123','3152363'])->get();
//
//        /**
//         * return single model instance
//         * les 2 syntax donne le meme resultat.
//         * single result
//         */
//        $commande = Commande::find('3151232');
//        $commande = Commande::where('id_cmd','3151232')->first();
//
//        /**
//         * Methode pour update un model
//         * 1 - methode save , permet de sauvegarder une entré du model trouver
//         * 2 - methode qu'on appel Mass Update ,
//         * qui permet de rechercher plusieur entré et de les updater en MASS
//         */
//        $thread = Thread::find(10);
//        //$thread->title = 'update_title';
//        $thread->save();
//
//        $thread = Thread::find(10)
//            //->update([
//            //    'title' => '2ndUpdate'
//            //])
//        ;
//
//
//        /**
//         * instance du model
//         * utilisation de la methode fill , qui accepte un array avec le nom des colonne a remplir
//         * attention dans model , les colonne doivent etre specifier dans fillable .
//         * Auto fill model
//         */
//        request()->merge([
//            'body' => 'dfgdfgfdg',
//
//        ]);
//
//        ( new Thread() )
//            ->fill(request()->input())
//            //->save()
//        ;
//
//        Thread::find(17)->update(request()->input());
//        var_dump(request()->input());




        return 'ok';
    }
    
    
    
    
}
