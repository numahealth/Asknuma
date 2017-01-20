@extends('admin.layouts.front')
@section('content')
<div class="container"> 
    <div class="row" style="overflow: hidden;">
        <div class="col-md-12">
            <?php
            $keyword = @Session::get('key');
            if ((is_int($keyword) || ctype_digit($keyword)) && (int) $keyword > 0) {
                $empty_record = 1;
                $values = array();
                $symptom = DB::table('symptom_search')
                        ->join('symptom', 'symptom.id', '=', 'symptom_search.symptom_id')
                        ->select('symptom_search.symptom_id')
                        ->where('symptom.status', '=', 'Active')
                        ->where('symptom_search.search_keyword', '=', $keyword)
                        ->get();  // @Session::get('id_search')
                $resultArray = json_decode(json_encode($symptom), true);
                $result = ($resultArray);
                if (empty($symptom)) {
                    $empty_record = 0;
                } else {
                    $group = DB::table('group')
                            ->join('diseases', 'diseases.id', '=', 'group.dieases')
                            ->select('group.mapping', 'group.id', 'group.dieases')
                            ->where('diseases.status', '=', 'Active')
                            ->whereIn('group.symptom', $result)
                            ->get();
                    if (empty($group)) {
                        $empty_record = 0;
                    }
                }
            } else {
                $empty_record = 0;
                $random_articles = FALSE;
                $random_posts = FALSE;
                $articles = DB::table('diseasesarticle')
                        ->where('status', 'Active')
                        ->where('article_title', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('meta_title', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('meta_description', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('keyword', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('article_description', 'LIKE', '%' . $keyword . '%')
                        ->orderBy('created_at', 'desc')
                        ->take(4)
                        ->get(); // ->toSql();

                if (empty($articles)) {
                    $random_articles = TRUE;
                    $articles = DB::table('diseasesarticle')->inRandomOrder()->take(4)->get();
                }

                $blog_posts = DB::table('blog')
                        ->where('status', '=', 'Active')
                        ->where('blog_name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('meta_title', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('meta_description', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('keyword', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                        ->orderBy('created_at', 'desc')
                        ->take(4)
                        ->get();
                if (empty($blog_posts)) {
                    $random_posts = TRUE;
                    $blog_posts = DB::table('blog')->inRandomOrder()->take(4)->get();
                }
            }
            ?>
            @if($empty_record==1) 
            <h4>
                Let's get started . Please choose from the options below.
            </h4>
            @else
            <div>
                <?php
                if ($random_articles) {
                    echo '<div class="alert alert-warning alert-dismissible" role="alert">';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    echo '<strong>Oops!</strong> No article related to "'
                    . $keyword . '" was found <br/></div>';
                    echo '<h4>Articles you may like:</h4>';
                } else {
                    echo '<h4>Articles that may be related to your search term "' . $keyword . '"</h4>';
                }
                ?>
                <!-- Begining of custom search. This search is for keywords not stored as symptoms in the database -->
                @foreach ($articles as $art)
                <div class="col-md-6" style="margin-bottom: -99999px; padding-bottom: 99999px;">
                    <section class="fancy-heading left">
                        <h3><span> {{ $art->article_title }} </span></h3>
                    </section>
                    <div class="article_detail_img">
                        @if($art->article_profile!= '')
                        <img width="100%" src="{{ URL::asset('public/uploads') . '/'.  $art->article_profile }}">
                        @else
                        <img width="100%" src="{{ URL::asset('public/front/img') }}/article.jpg">
                        @endif
                    </div>
                    <p>
                        <?php
                        $plain_text = strip_tags($art->article_description);
                        echo ucfirst(substr($plain_text, 0, 500)
                                . (strlen($plain_text) > 500 ? "..." : ""));
                        ?>
                    </p>
                    <a href="{{ url('/article_details/'.	$art->id.'/'
                                .str_replace(' ', '-',strtolower($art->article_title)))}}" class="btn btn-success">
                        <span style="text-transform: none;" class="fa fa-book"> Read More </span> 
                    </a>	
                </div>
                @endforeach
                <div class="col-md-12 col-lg-12 col-sm-12" style="padding-top: 70px; clear: both;">
                    <?php
                    if ($random_posts) {
                        echo '<h4>Check out these interesting blog posts:</h4>';
                    } else {
                        echo '<h4>Sugested blog post based on  "' . $keyword . '"</h4>';
                    }
                    ?>
                </div>
                @foreach ($blog_posts as $post)
                <div class="col-md-6" style="margin-bottom: -99999px; padding-bottom: 99999px;">
                    <section class="fancy-heading left">
                        <h3><span> {{ $post->blog_name }} </span></h3>
                    </section>
                    <div class="article_detail_img">
                        @if($post->blog_image != '')
                        <img width="100%" src="{{ URL::asset('public/uploads') . '/'.  $post->blog_image }}">
                        @else
                        <img width="100%" src="{{ URL::asset('public/front/img') }}/latest-1.jpg">
                        @endif
                    </div>
                    <p>
                        <?php
                        $plain_text = strip_tags($post->description);
                        echo ucfirst(substr($plain_text, 0, 500)
                                . (strlen($plain_text) > 500 ? "..." : ""));
                        ?>
                    </p>
                    <a href="{{ url('/blog/'. @$post->id. '/' .str_replace(' ', '-', strtolower($post->blog_name)))}}" class="btn btn-success">
                        <span style="text-transform: none;" class="fa fa-book"> Read More </span> 
                    </a>	
                </div>
                @endforeach
                <!-- End of custom search -->
            </div>
            @endif
        </div><!-- .col-md-12 end --> 
    </div>
    @if($empty_record==1) 							
    <div class="row">
        @foreach($group as $groups)
        <?php
        $article = DB::table('diseasesarticle')
                ->select('id')
                ->where('status', 'Active')
                ->where('diseases_id', $groups->dieases)
                ->orderBy('created_at', 'desc')
                ->take(1)
                ->get();
        ?>
        <?php if (@$article[0]->id != '') { ?>
            <div class="symptom_wrap">
                <ul class="nav">
                    <?php
                    $symptom_list = json_decode($groups->mapping);
                    foreach (@$symptom_list as $sym) {
                        $name_sym = DB::table('symptom')
                                ->select('symptom_name')
                                ->where('id', @$sym)
                                ->get();
                        ?>
                        <a href="{{ url('/article_details_small/'. @$article[0]->id)}}">  
                            <li>  <i class="fa fa-angle-double-right"> </i>
                                {{ @$name_sym[0]->symptom_name }}
                            </li>
                        </a>
                    <?php } ?>
                </ul>
            </div>   
        <?php } ?>
        @endforeach
    </div> 
    @endif
</div>
@endsection
