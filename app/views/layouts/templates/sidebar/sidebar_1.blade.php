<!-- Blog Sidebar Widgets Column -->
<div class="col-md-12">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        {{Form::open(array('route'=>'home-search','method'=>'POST'))}}
        <div class="input-group">
            <input type="text" name="search" class="form-control"/>
            <span class="input-group-btn">
                <button class="btn btn-default" typeof="submit"><span class="fa fa-search"></span></button>
            </span>
        </div>
        {{Form::close()}}

        <!-- /.input-group -->
    </div>

    <!-- only display this if the category is of sales -->
    @if(isset($searchTerm) && $searchTerm == 'Sales' )
    <!-- new post Button  if the category is Sales -->
        <div class="well">
            <h4>New Sales Post</h4>
            @if (Auth::user())
                {{link_to_route('sales-create','New Post',null,array('class'=>'btn btn-info'))}}
            @else
                <p class="text-info">You must log in to create a new sales post.</p>
            @endif
        </div>
    @endif

            <!-- Blog Categories Well -->
        <div class="well">
            <h4>Blog Categories</h4>

            <div class="row">
                <div class="col-lg-12">
                    <ul class=" list-inline beta-cat-list">
                        @foreach($categories as $category)
                            <li>
                                <a href="{{URL::action('HomeController@query',$category->id)}}">{{$category->category}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- /.row -->
        </div>

    <!-- Side Widget Well -->
    <!-- Facebook Likebox -->
        @include('layouts.templates.includes.facebookLikeBox')
</div>