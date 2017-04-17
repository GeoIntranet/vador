<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 25/02/2017
 * Time: 16:06
 */

namespace App\Http\Controllers\Lib\Search;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Route;

class Validator extends ConstantSearch
{

    public $result;

    /**
     * Searcher constructor.
     * @param $result
     */
    public function __construct(Request $request)
    {
        $this->result = FALSE;
        parent::__construct( $request->input() );
    }

    /**
     * Fait une validation des input de la requette entrante
     * Methode BootConstant de la class ConstantSearch ( parent du validator )
     * Une fois toute les paramètres trouver , lenght / isNumeric / isMagic / Key / etc...
     * On procede a la logique pour trouver la route et le controller a retourné.
     * @return $this
     */
    public function validateRequestInput()
    {
        $this->bootConstant();

        $this->checkForError();

        if($this->errorDetected == FALSE) $this->makeLogicValidator() ;

        return $this;
    }

    /**
     * Trouve si c'est un input de la forme d'un BL
     * @param $lenght
     * @return bool|string
     */
    public function identifyCommand($lenght)
    {
        if($lenght == 7)
        {
            $this->isValidate = TRUE;
            return 'commande';
        }
        return FALSE ;
    }

    /**
     * Trouve si c'est un input de la forme d'un Client
     * @param $lenght
     * @return bool|string
     */
    public function identifyIncident($lenght)
    {
        if($lenght == 5)
        {
            $this->isValidate = TRUE;
            return 'incident';
        }
        return FALSE ;
    }

    /**
     * Nettoie l'object des variable supperflue
     */
    private function clean()
    {
        $this->cleanConstant();
    }

    /**
     * Input de forme numérique ( bl / client / client  )
     * Determine le format de l'input , en fonction de la longueur de la chaine.
     * 5 pour un incident
     * 6 pour un client
     * 7 pour un bl
     * etc..
     *
     * @return bool|string
     */
    private function detectNumericResult()
    {
        $result = $this->identifyCommand($this->howLenght);

        return  $this->isValidate ? $result : $this->identifyIncident($this->howLenght);
    }

    /**
     * retourne le nom de la route pour la clef trouvé
     * @return bool|string
     */
    private function detectKeyResult()
    {
        switch ($this->usefullDataSymbol)
        {
            case 'id' : return 'id' ; break;
            case 'da' : return 'achat' ; break;
            case 'po' : return 'po' ; break;
            case 'bl' : return 'commande' ; break;
            case 'cl' : return 'client' ; break;
            case 'cli' : return 'client' ; break;
            case 'lo' : return 'locator' ; break;
            case 'ar' : return 'article' ; break;
            default: return FALSE ; break;
        }
    }

    /**
     * detect si il y a une erreur dans le format saisié
     * interrompt la logic pour gagné en performance
     * @return bool
     */
    private function checkForError()
    {
        if($this->isKeyInput) return FALSE ;
        if($this->isMagic) return FALSE ;
        if($this->isNumericFormat) return FALSE ;

        $this->errorDetected = true;

         return  TRUE ;
    }

    /**
     * Logic de valisation et pour trouver le bon format.
     */
    private function makeLogicValidator()
    {
        if(( $this->isNumeric == TRUE ) AND ( $this->isValidate == FALSE ))
        {
            $this->result = $this->detectNumericResult();
        }

        if(( $this->isMagic == TRUE ) AND ( $this->isValidate == FALSE ))
        {
            $this->result = $this->detectMagicResult();
        }

        if(( $this->isKeyInput == TRUE ) AND ( $this->isValidate == FALSE ))
        {
            $this->result = $this->detectKeyResult();
        }

        $this->clean();
    }
}