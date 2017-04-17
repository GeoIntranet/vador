<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class TagCategorie extends Model
{

    use SearcheableCategorie;

    protected $categorie;

    /**
     * les attribut que l'on peut rentrer en base de donnée
     * @var array
     */
    protected $fillable =[
        'CAT_famille',
        'CAT_therm',
        'CAT_mic',
        'CAT_pisto',
        'CAT_las',
        'CAT_mat',
        'CAT_as',
        'CAT_jet',
        'CAT_tps',
        'CAT_mo',
    ];

    /**
     * retourne un tableau de tout les attribut non proteger , utile pour fonction hydrate
     * @return array
     */
    public function getFillable()
    {
        return $this->fillable;
    }

    /**
     * retourne le type de chaque champ fillable
     * @return array
     */
    public function defaultFillable()
    {
        return [
            'CAT_famille' => 'var',
            'CAT_therm' => 'int',
            'CAT_mic' => 'int',
            'CAT_pisto' => 'int',
            'CAT_las' => 'int',
            'CAT_mat' => 'int',
            'CAT_as' => 'int',
            'CAT_jet' => 'int',
            'CAT_tps' => 'int',
            'CAT_mo' => 'int',
        ];
    }

    public function scopeCategories($cat){
        $this->categorie = ['CAT_therm','CAT_jet'];

        $searchable = $this->search();
        $cat = $searchable->get();

    }

    /**
     * une categorie appartient a une famille d'article<b> ID</b><b> MODEL  - </b>.<b> AUDIT  </b>->.<b> DEVIS </b>.
     */
    public function article()
    {
        return $this->belongsTo('App\familleArticle');
    }

}
