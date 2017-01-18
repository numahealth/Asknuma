{{--*/ $breadcum = ucwords(str_replace(array("_","/"),' ',str_replace(url(''),'',url()->current()))) /*--}}

<div style="width: 100%; height: 20px; display: none; margin-top: 118px; background: red;"> </div>
<div class="page-title-3" id="page-title" style="margin-top:0px!important;">
    <!--div class="page-title-inner who_wr_img light">
       
        <div class="container">
            
            <div class="row">
                <div class="col-md-12">
                    
                    <section class="title-container clearfix">
                        <div class="pt-title">
    <?php
    $position = strpos($breadcum, "Search");
    $detail = strpos($breadcum, "Article Details");
    $details = strpos($breadcum, "Blog");
    $keyword = DB::table('searchkeyword')
            ->select('searchkeyword.keyword')
            ->where('searchkeyword.id', '=', @Session::get('key'))
            ->get();
    if ($position == 1) {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $login_status = 1;
        } else {
            $user_id = Session::getId();
            $login_status = 0;
        }
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        //$ip = "103.225.42.90";
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        //error_log('IP address --->   ' . $ip);
        //error_log(var_dump($details));
        $location = property_exists($details, 'city') ? $details->city : 'Lagos ';
        $location .= property_exists($details, 'region') ? $details->region : ', Nigeria ';
        //error_log('LOcation --->   ' . $location);

        DB::table('numa_search_history')->insert(
                ['location' => $location, 'login_status' => $login_status, 
                    'status' => 'Active', 'user_id' => $user_id,
                    'ip_address' => $_SERVER['REMOTE_ADDR'],
                    'seach_keyword' => $keyword[0]->keyword,
                    'created_date' => date('Y-m-d H:i:s')]
        );
        echo '<h1>Your symptoms point towards <strong>"' . $keyword[0]->keyword . '"</strong></h1>';
    } else if ($detail == 1) {
        $details = DB::table('diseasesarticle')
                ->select('article_title')
                ->where('diseasesarticle.status', '=', 'Active')
                ->where('id', '=', @Request::segment(2))
                ->get();
        if (empty($detail)) {
            return Redirect::to('search_result')->send();
        }
        echo '<h1>Article Detail <strong>"' . $details[0]->article_title . '"</strong></h1>';
        $breadcum = '<a href="' . url('') . '">Article</a> / ' . $details[0]->article_title;
    } else if ($details == 1) {
        if (@Request::segment(2) != '') {
            $details = DB::table('blog')
                    ->select('blog_name')
                    ->where('blog.status', '=', 'Active')
                    ->where('id', '=', @Request::segment(2))
                    ->get();
            if (empty($details)) {
                return Redirect::to('search_result')->send();
            }
            echo '<h1>Article Detail <strong>"' . $details[0]->blog_name . '"</strong></h1>';
            $breadcum = '<a href="' . url('/our_blog') . '">Blog</a>  /  ' . $details[0]->blog_name;
        } else {
            ?>
                                                                        <h1>{{ $breadcum  }}</h1>
        <?php } ?>
                                                                }
                                                                else {?>
                                                                <h1>{{ $breadcum  }}</h1>
    <?php } ?>
                                                        
                      

                        
                    </section>
                </div>
            </div>         
        </div>
    </div>-->

    <!--.breadcrumbs-container start -->
    <div class="breadcrumbs-container theme-color">
        <!-- .CONTAINER START -->
        <div class="container">
            <!-- .row start -->
            <div class="row">
                <!-- .col-md-12 start -->
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li>You are here:</li>
                        <li><a href="{{url('')}}">Home</a></li>
                        <li><span class="active"><?php echo $breadcum ?></span></li>
                    </ul><!-- .breadcrumb end -->
                </div><!-- .col-md-12 end -->
            </div><!-- .row end -->
        </div><!-- .container end -->
    </div><!-- .breadcrumb-container end -->
</div>   