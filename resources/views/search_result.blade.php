@extends('admin.layouts.front')
@section('content')
<div class="container"> 
    <div class="row" style="overflow: hidden; margin-bottom: 15px;">
        <div class="col-md-12">
            <?php
            $keyword = @Session::get('key');
            $keyword_text = $keyword;
            if ((is_int($keyword) || ctype_digit($keyword)) && (int) $keyword > 0) {
                // once i get a keyword, i need to find all symptoms that the keyword is related to.
                $text = DB::table('searchkeyword')
                        ->select('keyword')
                        ->where('id', '=', $keyword)
                        ->get();
                if (!empty($text)) {
                    $keyword_text = $text[0]->keyword;
                }
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
                            ->select('group.mapping', 'group.name', 'group.id', 'group.dieases')
                            ->where('diseases.status', '=', 'Active')
                            ->whereIn('group.symptom', $result)
                            ->get();
                    if (empty($group)) {
                        $empty_record = 0;
                    }
                }
                // if $symptom or $group returns empty, we need to load random stuffs
                if ($empty_record === 0) {
                    $random_articles = TRUE;
                    $random_posts = TRUE;
                    $articles = loadRandomArticles();
                    $blog_posts = loadRandomPosts();
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
                    $articles = loadRandomArticles();
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
                    $blog_posts = loadRandomPosts();
                }
            }

            function loadRandomArticles() {
                return DB::table('diseasesarticle')->inRandomOrder()->take(4)->get();
            }

            function loadRandomPosts() {
                return DB::table('blog')->inRandomOrder()->take(4)->get();
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
                    . $keyword_text . '" was found <br/></div>';
                    echo '<h4 style="margin-bottom: -15px;">Articles you may like:</h4>';
                } else {
                    echo '<h4 style="margin-bottom: -15px;">Articles that may be related to your search term "' . $keyword . '"</h4>';
                }
                ?>
                <!-- Begining of custom search. This search is for keywords not stored as symptoms in the database -->
                @foreach ($articles as $art)
                <div class="col-md-6" style="margin-bottom: -99999px; padding-bottom: 99999px;">
                    <section class="fancy-heading left" style="margin-top: 30px; padding-top: 15px;">
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
                <div class="col-md-12 col-lg-12 col-sm-12" style="padding-top: 70px; clear: both;
                     margin-bottom: -15px;">
                     <?php
                     if ($random_posts) {
                         echo '<h4 style="margin-bottom: -15px;">Check out these interesting blog posts:</h4>';
                     } else {
                         echo '<h4 style="margin-bottom: -15px;">Sugested blog post based on  "' . $keyword_text . '"</h4>';
                     }
                     ?>
                </div>
                @foreach ($blog_posts as $post)
                <div class="col-md-6" style="margin-bottom: -99999px; padding-bottom: 99999px;">
                    <section class="fancy-heading left" style="margin-top: 30px; padding-top: 15px;">
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
        <div class="col-md-12">
            <div>
                @foreach($group as $groups)
                <?php
                $article = DB::table('diseasesarticle')
                        ->where('status', 'Active')
                        ->where('diseases_id', $groups->dieases)
                        ->orderBy('created_at', 'desc')
                        ->take(4)
                        ->get(); //#d6f5d6
                ?>
                <div class="symptom_wrap" style="font-size: 16px; margin-bottom: 10px;
                     background: #eafaea; border: none; border-radius: 5px; font-family: 'Aileron', Arial, sans-serif;">
                    <?php echo ucwords($groups->name); ?>
                </div>
                @foreach ($article as $art1)
                <div class="col-md-6" style="margin-bottom: -9px; padding-bottom: 9px;">
                    <section class="fancy-heading left">
                        <h3><span> {{ $art1->article_title }} </span></h3>
                    </section>
                    <div class="article_detail_img">
                        @if($art1->article_profile!= '')
                        <img width="100%" src="{{ URL::asset('public/uploads') . '/'.  $art1->article_profile }}">
                        @else
                        <img width="100%" src="{{ URL::asset('public/front/img') }}/article.jpg">
                        @endif
                    </div>
                    <p>
                        <?php
                        $plain_text = strip_tags($art1->article_description);
                        echo ucfirst(substr($plain_text, 0, 500)
                                . (strlen($plain_text) > 500 ? "..." : ""));
                        ?>
                    </p>
                    <a href="{{ url('/article_details/'.	$art1->id.'/'
                                .str_replace(' ', '-',strtolower($art1->article_title)))}}" class="btn btn-success">
                        <span style="text-transform: none;" class="fa fa-book"> Read More </span> 
                    </a>	
                </div>
                @endforeach
                @endforeach
            </div>
        </div>
    </div> 
    @endif
</div>
<div class="container-fluid helpful">
    <div class="container">
        <div class="col-md-6 col-sm-8 col-xs-11 helpful_wrap"> 
            <h1>Not what you're looking for?</h1>
            <div class="yes_no">
                <?php
                $useragent = $_SERVER['HTTP_USER_AGENT'];
                if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
                    $href = url('/signin');
                    $pop = '';
                } else {
                    $href = '#';
                    $pop = '#myModal2';
                }
                ?>

            </div>
            <div class="yes_no large_btn">
                <a href="<?php echo $href; ?>" id="ask_doc" 
                   class="btn btn-info" <?php if (Auth::check()) { ?> data-toggle="modal" 
                       data-target="#ask_doctor" <?php } else { ?> data-toggle="modal" 
                       data-target="<?php echo $pop; ?>" <?php } ?> >
                    Speak with a Doctor
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Ask Doctor -->
<div class="modal fade" id="ask_doctor" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="background: #31b0d5;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Please enter your query below</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'users.store', 'files' => true, 'class' => 'form-horizontal1','id'=>'validation_form']) !!}
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <?php
                    $gender['Male'] = 'Male';
                    $gender['Female'] = 'Female';
                    $gender['Other'] = 'Other';
                    ?>
                    {!! Form::select('gender', $gender, old('gender'), array('class'=>'form-control','id'=>'gender')) !!}
                </div>
                <div class="form-group">
                    <label >Age:</label>
                    {!! Form::number('age', old('age'), ['class'=>'form-control', 'placeholder'=> 'Age','min'=>'1','required'=>'true','id'=>'age']) !!}
                </div>
                <div class="form-group">
                    <label for="comment">Query:</label>
                    <textarea name="comment" class="form-control" required rows="3" id="comment"></textarea>
                </div>

                <button  onclick='query_to_doc(0);' type="button" class="btn btn-info" style=" float:none" data-toggle="modal"  >Submit</button>
                <button  id="click_here" type="submit" class="btn btn-info hide" style=" float:none" data-toggle="modal"  >Submit</button>
                <button  id="dismiss" type="button" class="btn btn-info hide" style=" float:none" data-toggle="modal"  data-dismiss="modal" >Submit</button>
                <a href="#" id="thanks_question" class="btn btn-success hide" data-toggle="modal" data-target="#yes_helpful_question">Yes</a>
                </form>      
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="yes_helpful_question" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-thumbs-up"> </i> </h4>
            </div>
            <div class="modal-body">
                <p><h5 id="text_change">Thank you {{ @Auth::user()->name }} for your question. We'll get back to you as soon as we can.</h5></p>
            </div>

        </div>
    </div>
</div>
@endsection
