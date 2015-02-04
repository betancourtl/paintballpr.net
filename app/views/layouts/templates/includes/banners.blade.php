
<header id="myCarousel" class="carousel slide">
    <!-- Indicators -->


    <ol class="carousel-indicators">
        @for($i = 0; $i <= sizeof($banners) -1 ;$i++)
            @if($i == 0)
                <li data-target="#myCarousel" data-slide-to="{{$i}}" class="active"></li>
            @else
                <li data-target="#myCarousel" data-slide-to="{{$i}}"></li>
            @endif
        @endfor

    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        @for($i = 0; $i <= sizeof($banners) -1 ;$i++)
            @if($i == 0)

                <div class="item active">
                    <!-- 1200 x 300 px image -->
                    {{ HTML::image('images/banners/1200x300/'.$banners[$i]['banner_name'], 'carousel image',['class'=>'img-responsive beta-full-width-img']) }}
                    <div class="carousel-caption">
                        <h2>{{$banners[$i]['banner_description']}}</h2>
                    </div>
                </div>
            @else

                <div class="item">
                    <!-- 1200 x 300 px image -->
                    {{ HTML::image('images/banners/1200x300/'.$banners[$i]['banner_name'], 'carousel image',['class'=>'img-responsive beta-full-width-img']) }}
                    <div class="carousel-caption">
                        <h2>{{$banners[$i]['banner_description']}}</h2>
                    </div>
                </div>
            @endif
        @endfor
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="icon-next"></span>
    </a>
</header>
