<?php


use App\Categorie;
use App\Console\Commands\Board\IncidentCache;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

Route::get('/phpinfo',function(){
dd(phpinfo());
});



Route::get('/',function(){

    $b = app('Illuminate\Container\Container');

});

Route::auth();



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' =>'gv'], function () {

    //DASHBOARD
    Route::get('/board','BoardController@index')->middleware('gv');
    Route::get('/flash', array('as' =>'flash' ,'uses'=>'FlashControlle@flash'));
    Route::post('/post/flash', array('as' =>'flash' ,'uses'=>'FlashControlle@errorsFlash'));
//ROUTE DEVELOP POUR STYLEGUIDE CSS -----------------------------------------------------------------------------------------
    Route::get('/develop','DevelopController@cssGuide')->middleware('gv');
    Route::get('/develop/{id}','DevelopController@cssGuide')->middleware('gv');
    Route::get('/whois','DevelopController@whois');
// --------------------------------------------------------------------------------------------------------------------------

// ROUTE MODULE DE STAT -----------------------------------------------------------------------------------------------------
// GENERAL ------------------------------------------------------------------------------------------------------------------
    Route::get('/stat/general','StatController@general')->name('statGeneral')->middleware('gv');
// FAMILLE ------------------------------------------------------------------------------------------------------------------
    Route::resource('/stat/famille', 'FamilleController');
    Route::any('/stat/filtre/famille/{famille}', 'FamilleController@setFiltreCat')->middleware('gv');
    Route::any('/stat/pagination/famille/{state}', 'FamilleController@setPaginationCat')->middleware('gv');
// TECH ---------------------------------------------------------------------------------------------------------------------
    Route::get('/stat/user/{job}/{user}/{year}','StatController@disptachJob')->middleware('gv');
// ENVOIE -------------------------------------------------------------------------------------------------------------------
    Route::get('stat/envoie/show/{bl}/{l}', 'CommandSentClassifyController@show')->name('showBlInteger');
    Route::get('stat/envoie/edit/{id}/{arg}/{value}', 'CommandSentClassifyController@edit')->name('editBl');
    Route::get('stat/envoie', 'CommandSentClassifyController@index')->name('statEnvoie');

// INTEGRATION --------------------------------------------------------------------------------------------------------------
    Route::any('integration/unique/{bl}', 'CommandSentClassifyController@LogicExecutionOnBl')->name('integerBl');
    Route::any('integration/day/{dt}', 'CommandSentClassifyController@LogicExecutionOnDay')->name('integerDay');
    Route::any('integration/week/{dt}', 'CommandSentClassifyController@LogicExecutionOnWeek')->name('integerWeek');
    Route::any('integration/month/{dt}', 'CommandSentClassifyController@LogicExecutionOnMonth')->name('integerMonth');
    Route::any('integration/year/{dt}', 'CommandSentClassifyController@LogicExecutionOnYear')->name('integerYear');
    Route::get('integration/delete/specific/{bl}','CommandSentClassifyController@destroyBl');
    Route::get('integration/delete/order/{order}/{dt}','CommandSentClassifyController@disptachDestroy')->name('deleteInteger');

// CALENDRIER ---------------------------------------------------------------------------------------------------------------
    Route::get('calender/integration/dt/{controller}/{dt}','CalenderController@selectDt');
    Route::get('calender/integration/sub/month/{controller}','CalenderController@subMonth');
    Route::get('calender/integration/sub/year/{controller}','CalenderController@subYear');
    Route::get('calender/integration/add/month/{controller}','CalenderController@addMonth');
    Route::get('calender/integration/add/year/{controller}','CalenderController@addYear');
    Route::get('calender/integration/select/year/{controller}/{year}','CalenderController@selectYear');
    Route::get('calender/integration/select/month/{controller}/{month}','CalenderController@selectMonth');
// --------------------------------------------------------------------------------------------------------------------------

// INCIDENT ---------------------------------------------------------------------------------------------------------------------------
    Route::resource('/incident', 'IncidentController');
    Route::get('/incidents', ['as'=>'incidents','uses' => 'IncidentController@incidentUser']);
    Route::any('/viewer/incidents/set/{x}', array('as' =>'mkviewer' ,'uses'=>'IncidentController@MakeViewer'));
    Route::any('/viewer/incidents/remove', array('as' =>'delviewer' ,'uses'=>'IncidentController@RemoveViewer'));
// ------------------------------------------------------------------------------------------------------------------------------------

// TEAM WORKS ---------------------------------------------------------------------------------------------------------------------------
    Route::get('/team', ['as'=>'team','uses' => 'TeamController@index']);
// ------------------------------------------------------------------------------------------------------------------------------------


// RECHERCHE ---------------------------------------------------------------------------------------------------------------------------
    Route::post('/recherche', ['as'=>'search','uses' => 'SearchController@index']);
// ------------------------------------------------------------------------------------------------------------------------------------

// CATEGORIE -------------------------------------------------------------------------------------------------------------------------
    Route::get('/categorie','CategorieController@index');
// ------------------------------------------------------------------------------------------------------------------------------------
// REDIS CATEGORIE -------------------------------------------------------------------------------------------------------------------------
    Route::get('/redis/categorie','redisController@categorie');
    Route::get('/redis/test','redisController@test');
    Route::get('/redis/del/categorie','redisController@deleteCategorie');
// ------------------------------------------------------------------------------------------------------------------------------------

// EN COURS DE DEV --------------------------------------------------------------------------------------------------------------------
    Route::get('/locator', 'locatorController@index');
    Route::get('/locator/depot', 'locatorController@depot');
    Route::post('/locator/filtre', 'locatorController@filtreStoreArticle');
    Route::post('/locator', 'locatorController@store');

    Route::get('/locator/recherche', 'locatorController@noSession');

    Route::get('/locator/multi', 'locatorController@getMulti');
    Route::post('/locator/multi', 'locatorController@postMultiId');

    Route::get('/locator/multi/out', 'locatorController@getMultiOut');
    Route::post('/locator/multi/out', 'locatorController@postMultiOut');

    Route::get('/locator/multi/deplacement', 'locatorController@getMultiDeplacement');
    Route::post('/locator/multi/deplacement', 'locatorController@postMultiDeplacement');

    Route::get('/locator/input/force/{input}', 'locatorController@forceInput');
    Route::get('/locator/force/{arg}/{value}', 'locatorController@forceSearching');
    Route::any('/locator/search', 'locatorController@search');

    Route::get('/locator/catalogue', 'locatorController@getCatalogue');
    Route::post('/locator/catalogue', 'locatorController@postCatalogue');

    Route::get('/locator/{id}', 'locatorController@show');
    Route::get('/locator/{id}/edit', 'locatorController@edit');

    Route::post('/locator/out', 'locatorController@applyOutId');

    Route::get('/locator/last/out', 'locatorController@lastOut');
    Route::post('/locator/last/out', 'locatorController@lastOutFiltre');

    Route::get('/locator/last/in', 'locatorController@getLastIn');
    Route::post('/locator/last/in', 'locatorController@postLastIn');

    Route::get('/locator/{id}/out', 'locatorController@outId');



    //FORUM ---
    Route::get('forum', 'ThreadController@index');
    Route::post('/forum', 'ThreadController@store');

    Route::get('/forum/create', 'ThreadController@create');

    Route::get('forum/{channel}', 'ThreadController@index');
    Route::post('/forum/{thread}', 'ThreadController@update');

    Route::get('/forum/{channel}/{thread}', 'ThreadController@show');

    Route::get('/forum/{channel}/{thread}/edit/', 'ThreadController@edit');
    Route::get('/forum/{channel}/{thread}/disable', 'ThreadController@disableThread');
    Route::post('/forum/{channel}/{thread}/replies', 'RepliesController@store');

    Route::get('reply/disable/{reply}', 'RepliesController@disableReply');


    Route::get('/channels/create', 'ChannelController@create');
    Route::post('/channels', 'ChannelController@store');

    Route::get('/thread/mode/reply', 'RepliesController@toggleWriteMode');


    // PROTO  ---
    Route::get('/stock/mini', 'StockController@mini');
    Route::get('/stock/mini/{id}/edit', 'StockController@miniEdit');
    Route::get('/stock/mini/ajout', 'StockController@ajoutMini');
    Route::post('/stock/mini/ajout', 'StockController@ajoutMiniData')->name('AjoutStockMini');


    Route::get('/stock/{id}', 'StockController@show');
    Route::get('/proto/multi', 'locatorController@protoMulti');
    Route::get('/proto/userstat', 'ProtoController@userstat');
    Route::get('/proto/injection', 'ProtoController@autoInjection');
    Route::get('/proto/morph', 'ProtoController@morph');

    Route::get('/classement/current', 'DelaisController@categorieCommande');




    Route::get('/prototype/locator', 'locatorController@prototype');
    Route::get('/relations', 'LocatorController@relations');
    Route::get('/hydrate', 'LocatorController@hydrate');
// ------------------------------------------------------------------------------------------------------------------------------------

//HORAIRES ----------------------------------------------------------------------------------------------------------------------------
//CONTROLLEUR DE RESSOURCE ------------------------------------------------------------------------------------------------------------
// /horaire            -- index	    horaire.index      // GET                      ----------------------------------------------------
// /horaire/create     -- create	horaire.create     // GET                      ----------------------------------------------------
// /horaire            -- store	    horaire.store      // POST                     ----------------------------------------------------
// /horaire/{id}/edit  -- edit 	    horaire.edit       // GET                      ----------------------------------------------------
// /horaire/{id}       -- show 	    horaire.show       // GET - METHODE PAR DEFAUT ----------------------------------------------------
// /horaire/{id}       -- update	horaire.update     // VERBE PUT/PATCH          ----------------------------------------------------
// /horaire/{id}       -- destroy	horaire.destroy    // VERBE DELETE             ----------------------------------------------------
    Route::resource('/horaire', 'HoraireController');

    Route::any('/validation/horaire', array('as' =>'validationHoraire' ,'uses'=>'HoraireController@Check'));
    Route::any('/debug/horaire', array('as' =>'debugHoraire' ,'uses'=>'HoraireController@debug'));
    Route::any('/show/horaire', array('as' =>'showHoraire' ,'uses'=>'HoraireController@showHoraire'));
    Route::any('/email/horaire', array('as' =>'emailHoraire' ,'uses'=>'HoraireAdmController@ReminderMail'));

    Route::get('/abs/horaire', array('as' =>'absHoraire' ,'uses'=>'HoraireAdmController@getAbs'));
    Route::post('/abs/horaire', array('as' =>'absHoraire' ,'uses'=>'HoraireAdmController@postAbs'));
    Route::get('/abs/validate', array('as' =>'validateAbs' ,'uses'=>'HoraireAdmController@validateAbs'));
//---------------------------------------------------------------------------------------------------------------------------------

//HORAIRE GESTION -----------------------------------------------------------------------------------------------------------------
    Route::any('/gestion/horaire', array('as' =>'gestionHoraire' ,'uses'=>'HoraireAdmController@getHoraireUser'));
    Route::get('/gestion/edit/horaire/{id}/{user}/{dt}', array('as' =>'GEH' ,'uses'=>'HoraireAdmController@getEditHoraire'));
    Route::post('/gestion/edit/horaire', array('as' =>'postEditHoraire' ,'uses'=>'HoraireAdmController@Store'));
    Route::get('/gestion/delete/horaire/{id}', array('as' =>'deleteHoraire' ,'uses'=>'HoraireAdmController@Delete'));
//---------------------------------------------------------------------------------------------------------------------------------

//HORAIRE CUMULE ------------------------------------------------------------------------------------------------------------------
    Route::any('/gestion/cumule/create/{id}/{force}', array('as' =>'cumuleHoraire' ,'uses'=>'CumuleController@Cumule'));
    Route::any('/gestion/autocumule', array('as' =>'AutoCumule' ,'uses'=>'CumuleController@AutoCumuleUsers'));
    Route::any('/gestion/cumules/resume', array('as' =>'cumulesResumes' ,'uses'=>'HoraireAdmController@QuePassa'));
    Route::any('/gestion/cumules/resume/pdf', array('as' =>'cumulesResumesPdf' ,'uses'=>'HoraireAdmController@QuePassaPDF'));

    Route::get('/gestion/cumule/edit/{id}', array('as' =>'getCumuleEdit' ,'uses'=>'HoraireAdmController@getCumuleEdit'));
    Route::post('/gestion/cumule/edit', array('as' =>'postCumuleEdit' ,'uses'=>'HoraireAdmController@postCumuleEdit'));
//---------------------------------------------------------------------------------------------------------------------------------


//DELAIS ------------------------------------------------------------------------------------------------------------------
    Route::any('/delais', array('as' =>'delais' ,'uses'=>'DelaisController@index'));
    Route::any('/PROTOdelais', array('as' =>'delais' ,'uses'=>'DelaisController@proto'));
    Route::any('/PROTOachat', array('as' =>'delais' ,'uses'=>'DelaisController@achat'));
    Route::get('/delais/create/{id}', array('as' =>'delais' ,'uses'=>'DelaisController@create'));
    Route::any('/delais/filtre/{type}/{value}', array('as' =>'delaisFiltre' ,'uses'=>'DelaisController@filtre'));
//    Route::any('/delais/edit/{id}', array('as' =>'delaisEdit' ,'uses'=>'DelaisController@edit'));
//    Route::any('/delais/calendrier', array('as' =>'delaisCalender' ,'uses'=>'DelaisController@calender'));
    Route::any('/delais/todo', array('as' =>'delaisTodo' ,'uses'=>'DelaisController@todo'));
//---------------------------------------------------------------------------------------------------------------------------------

// PROTOTYPE ------------------------------------------------------------------------------------------------------------------

    Route::get('/proto/dep', array('as' =>'delais' ,'uses'=>'DelaisController@test'));
    Route::any('/proto/wrap', array('as' =>'wrap' ,'uses'=>'LabController@wrap'));
    Route::any('/proto/commande', array('as' =>'wrap' ,'uses'=>'DelaisController@test'));
    Route::any('/proto/achat', array('as' =>'wrap' ,'uses'=>'DelaisController@achat'));
    Route::any('/artisan/commande/cache',function(){
        $command = app(IncidentCache::class);
        $incident = app('App\Http\Controllers\Lib\Board\Module\IncidentModule');
        $command->handle();
    });
//---------------------------------------------------------------------------------------------------------------------------------

// ROUTE PROTOTYPE -----------------------------------------------------------------------------------------------------------------
    Route::post('/test/bbcode',function(){

        $parser = new ParserGestion();

        $body = request()->input()['body'];

        $output = $parser->parse($body);

        echo  $output;

        echo "<h1>test</h1>";

    });
    Route::any('/eventing', 'LabController@Eventing');
//---------------------------------------------------------------------------------------------------------------------------------



});
