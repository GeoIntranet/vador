<ul class="vertical menu" data-accordion-menu>
    <li><a  href=""><b>General</b></a></li>
    <li>
        <a href=""><i class="fa fa-angle-right b "></i> Catégories</a>
        <ul class="menu vertical nested">
            <li><a href="{{action('FamilleController@setFiltreCat',['cat' => 'all'])}}">Aucun filtre</a></li>
            @foreach($categorieName as $keyCatName => $valCatName)
                @if($valCatName == 'Jet d\'encre')
                    <li><a href="{{action('FamilleController@setFiltreCat',['cat' => 'jet'])}}">{{$valCatName}}</a></li>
                @else
                    <li><a href="{{action('FamilleController@setFiltreCat',['cat' => $keyCatName])}}">{{$valCatName}}</a></li>
                @endif
            @endforeach
        </ul>
    </li>
    <li>
        <hr class="emp">
    </li>
    @if(Session::has('familleControllerPaginationCat'))

        <li class=" pad3">
            <a class=" badgeMenu"  href="{{action('FamilleController@setPaginationCat',['state' => 'true'])}}"> + Pagination</a>
        </li>

        <li class=" pad3">
            <a  class="" href="{{action('FamilleController@setPaginationCat',['state' => 'false'])}}">- Pagination</a>
        </li>

    @else

        <li class=" pad3">
            <a class=" "  href="{{action('FamilleController@setPaginationCat',['state' => 'true'])}}">+ Pagination</a>
        </li>

        <li class=" pad3">
            <a  class="badgeMenu" href="{{action('FamilleController@setPaginationCat',['state' => 'false'])}}">- Pagination</a>
        </li>

    @endif


</ul>