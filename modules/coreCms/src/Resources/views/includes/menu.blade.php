<nav class="page-sidebar" data-pages="sidebar">
    <div class="sidebar-menu">
        <ul class="menu-items">
            @if($menu = config('corecms.menu')) 
                @foreach($menu as $name => $element)
                    @if(is_array($element)) 
                    <li class="parent <?= selectMenu($element,'active') ?>">
                        <a href="parent">
                            <span class="title">{{$name}}</span>
                            <span class="arrow"><i class="fa fa-angle-down pull-right" aria-hidden="true"></i></span>
                        </a>
                        <ul class="sub-menu <?= selectMenu($element,'show') ?>">
                        @foreach($element as $href => $e)
                            @can($e[1])
                            <li class="<?= selectMenu($href,'active')?>"> 
                                <a href="{{route($href)}}">{{$e[0]??$e}}</a>
                            </li>
                            @endcan
                        @endforeach
                    </ul>
                    </li> 
                    
                    @else
                    <li class="m-t-30">
                        <a href="{{route($name)}}" class="detailed">
                            <span class="title">{{$element}} </span>
                        </a>
                    </li>
                    @endif
                @endforeach
            @endif
        </ul>
    </div>
</nav>

<script>

$(document).ready(function(){
    $('a[href="parent"]').click(function(e){
        e.preventDefault();
        console.log($($(this).parent().find('.sub-menu')[0]).toggleClass('show'));
    })
});


</script>