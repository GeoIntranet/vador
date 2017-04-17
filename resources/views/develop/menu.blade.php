<ul class="vertical menu" data-accordion-menu>
    <li><a  href="{{action('DevelopController@cssGuide',['id'=>'index'])}}"><b>Overview</b></a></li>

    <li>
        <a href=""><i class="fa fa-angle-right b "></i> Foundation</a>
        <ul class="menu vertical nested">
            <li><a href="{{action('DevelopController@cssGuide',['id'=>'color'])}}">@if($page == 'color') <b>Colors</b> @else Colors @endif</a></li>
            <li><a href="{{action('DevelopController@cssGuide',['id'=>'grid'])}}">@if($page == 'grid') <b>Grid</b> @else Grid @endif</a></li>
            <li><a href="{{action('DevelopController@cssGuide',['id'=>'icone'])}}">@if($page == 'icone') <b>Icones</b> @else Icones @endif</a></li>
            <li><a href="{{action('DevelopController@cssGuide',['id'=>'typography'])}}">@if($page == 'typography') <b>Typography</b> @else Typography @endif</a></li>
            <li><a href="{{action('DevelopController@cssGuide',['id'=>'layout'])}}">Layout</a></li>
        </ul>
    </li>

    <li>
        <a href=""><i class="fa fa-angle-right b "></i> Components</a>
        <ul class="menu vertical nested">
            <li><a href="{{action('DevelopController@cssGuide',['id'=>'avatar'])}}">Avatars</a></li>
            <li><a href="{{action('DevelopController@cssGuide',['id'=>'badge'])}}">Badges</a></li>
            <li><a href="{{action('DevelopController@cssGuide',['id'=>'button'])}}">Buttons</a></li>
            <li><a href="{{action('DevelopController@cssGuide',['id'=>'dropdown'])}}">Dropdown</a></li>
            <li><a href="{{action('DevelopController@cssGuide',['id'=>'table'])}}">Tables</a></li>
            <li><a href="{{action('DevelopController@cssGuide',['id'=>'form'])}}">Forms</a></li>
            <li><a href="{{action('DevelopController@cssGuide',['id'=>'dialog'])}}">Inline dialog</a></li>
            <li><a href="{{action('DevelopController@cssGuide',['id'=>'label'])}}">Label</a></li>
            <li><a href="{{action('DevelopController@cssGuide',['id'=>'lozenge'])}}">Lozenges</a></li>
            <li><a href="{{action('DevelopController@cssGuide',['id'=>'message'])}}">Messages</a></li>
            <li><a href="{{action('DevelopController@cssGuide',['id'=>'navigation'])}}">Navigation</a></li>
            <li><a href="{{action('DevelopController@cssGuide',['id'=>'tabs'])}}">Tabs</a></li>
        </ul>
    </li>

    <li>
        <a href=""> <i class="fa fa-angle-right b "></i> Patterns</a>
        <ul class="menu vertical nested">
            <li><a href="">About page</a></li>
            <li><a href="">Activity stream</a></li>
            <li><a href="">Comments</a></li>
            <li><a href="">Date formats</a></li>
            <li><a href="">Date picker</a></li>
            <li><a href="">Emails</a></li>
            <li><a href="">File Viewer</a></li>
            <li><a href="">Focused tasks</a></li>
            <li><a href="">In-product help</a></li>
            <li><a href="">Mentions</a></li>
            <li><a href="">Progress tracker</a></li>
            <li><a href="">Reveal text</a></li>
            <li><a href="">Sidebar</a></li>
            <li><a href="">Notifications</a></li>

        </ul>
    </li>

    <li>
        <a href=""> <i class="fa fa-angle-right b "></i> Prototype</a>
        <ul class="menu vertical nested">
            <li><a href="">layouts</a></li>

        </ul>
    </li>

</ul>