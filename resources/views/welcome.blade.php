@extends('admin.layouts.front')
@section('content')
<div id="preloader">
    <div id="status_ok">&nbsp;</div>
</div>
<div style=" width:100%; height:20px; background:red; display:none;"> </div>
<div class="container-fluid numa_banner testing" >
    <div class="col-md-7 numa_main-search">
        <h1>Your personal health assistant in a mobile app</h1>
        <div class="search_wrap">
            <?php
            $values = array();
            $symptom = DB::table('searchkeyword')->where('status', '=', 'Active')->get();
            if (!empty($symptom)) {
                foreach ($symptom as $records) {
                    $values[$records->id] = $records->keyword;
                }
            }
            ?>
            {!! Form::open(['route' => 'welcome.search', 'files' => true, 'class' => 'form-horizontal','id'=>'form_sumit']) !!}
            {!! Form::select('dieases', $values, old('dieases'), array('class'=>"shearch_here" ,'id'=>'dieases','multiple'=>'true','placeholder'=>'type your question here')) !!}
            {!! Form::hidden('typed_text', 'typed_text', array('id' => 'typed_text')) !!}

            <div class="numa_search_btn material-search" onclick="form_submit();"><img src="{{ URL::asset('public/front/img') . '/material_design.png'   }}"> </div>
            {!! Form::close() !!}
        </div>
        <h2>How can we help?</h2>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 blog_section recognised"> 
            <!-- .fancy-heading start -->
            <h2 class="simple-heading center" style="color: #53b553;">Recognised by</h2>
            <div class="col-md-12"> 
                <div class="col-md-3 col-sm-3"> <img src="{{ URL::asset('public/front/img') . '/logo01.jpg' }}"></div>
                <div class="col-md-3 col-sm-3"> <img src="{{ URL::asset('public/front/img') . '/logo03.jpg' }}"></div>
                <div class="col-md-3 col-sm-3"> <img src="{{ URL::asset('public/front/img') . '/logo02.jpg' }}"></div>         
                <div class="col-md-3 col-sm-3"> <img src="{{ URL::asset('public/front/img') . '/logo04.jpg' }}"></div>
            </div>
        </div>
    </div>
</div>



<div class="container home_about">
    <div class="row">
        <div class="col-md-12"> 
            <!-- .fancy-heading start -->
            <section class="fancy-heading center">
                <h2 style="color: #53b553;">About Us</h2>
            </section>
            <!-- .fancy-heading end -->
            <p class="text-center"> 
                Numa Health builds delightful healthcare tools, made specially for busy achievers, that puts healthcare back in your hands. 
            </p>

            <div class="col-md-12 home_about1"> 
                <div class="col-md-4 col-sm-4 col-xs-12"> <img src="{{ URL::asset('public/front/img') . '/girl.png' }}"> 

                    <p> Your very own artificially intelligent health assistant</p>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12"> <img src="{{ URL::asset('public/front/img') . '/book.png' }}">

                    <p> High quality health advice </p>
                </div>         

                <div class="col-md-4 col-sm-4 col-xs-12"> <img src="{{ URL::asset('public/front/img') . '/hospital.png' }}"> 
                    <p> Find vetted specialists, pharmacies and health facilities near you</p>
                </div>

            </div>

        </div>
        <!-- .col-md-12 end --> 
    </div>
    <!-- .row end --> 

</div>
<div class="clearfix"></div>
<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12"> 
                <!-- .fancy-heading start -->

                <h2 class="simple-heading center" style="color: #53b553;">Health Advice from our Experts</h2>
                <p> Meet Mixed, modern, multipurpose, professional and 
                    pixel perfect HTML template. Mixed offers unlimited design 
                    options to create almost any type of website, from 
                    professional business agency, creative portfolio, personal 
                    portfolio, landing page and so much more. It's 
                    easy to customize, followed up with detailed documentation. You'll have 
                    your site up and running in no time. </p>
            </div>
            <!-- .col-md-12 end --> 
        </div>
        <!-- .row end -->

        <div class="row">
            <?php
            $blog = DB::table('blog')
                    ->where('status', '=', 'Active')
                    ->orderBy('created_at', 'desc')->take(3)
                    ->get();
            ?>
            @if(!empty($blog))
            @foreach($blog as $datas)
            <div class="col-md-4">
                <div class="blog-post-box">
                    <div class="post-media"> <a href="{{ url('/blog/'.@$datas->id.'/'.str_replace(' ', '-',strtolower($datas->blog_name)))}}">
                            @if($datas->blog_image != '')<img src="{{ URL::asset('public/uploads') . '/'.  $datas->blog_image }}">
                            @else
                            <img src="{{ URL::asset('public/front') }}/img/latest-1.jpg" alt=''/>
                            @endif  </a> </div>
                      <!--div class="comment-container"> <a href="{{ url('/blog/'.@$datas->id.'/'.str_replace(' ', '-',strtolower($datas->blog_name)))}}" class="comment-number"> <span class="date">{{ date('d M Y h:i A',strtotime($datas->created_at)) }}</span> <!--i class="fa fa-comments-o"></i>5--></a> </div-->
                    <div class="post-body"> <a href="{{ url('/blog/'.@$datas->id.'/'.str_replace(' ', '-',strtolower($datas->blog_name)))}}">
                            <h3> {{ str_limit($datas->blog_name, $limit = 50, $end = '...')}}</h3>
                        </a>
                        <p> {{ str_limit(strip_tags($datas->description), $limit = 150, $end = '...')}}</p>
                    </div>
                    <!-- .post-body end --> 
                </div>
                <!-- .blog-post-box end --> 
            </div>
            @endforeach
            @endif<!-- .col-md-4 end -->


            <!-- .col-md-4 end -->

            <!-- .col-md-4 end --> 
        </div>
        <!-- .row end --> 
    </div>
    <!-- .container end --> 
</div>
<!-- .page-content end -->

<div class="col-md-12 text-center">
    <?php
    $useragent = $_SERVER['HTTP_USER_AGENT'];

    if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
        ?> 
        <a  href="{{ url('/signin')}}"  class="btn btn-info btn-lg" style=" float: none; margin-bottom: 40px;">Get Started</a>

    <?php } else { ?>
        <a  href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-lg" style=" float: none; margin-bottom: 40px;">Get Started</a>
    <?php } ?>
</div>
<div class="clearfix"></div>
<section id="what_can01" class="long-block" >
    <div class="container">
        <div class="col-md-6 col-sm-12 have_any_more">
            <i class="icon icon-seo-icons-24 pull-left"> </i>
            <article class="pull-left">
                <!-- <h2>Its not just how you buy your drugs,</h2> -->
                <h2>Have any questions? </h2>

                <h4 class="" style="color: #fff; font-weight: 300;">Send us an email at <a style="color:white;" href="mailto:info@numa.io">info@numa.io</a>  for a quick reply</h4>

            </article>
        </div>

        <div class="col-md-6 col-sm-12 home_contact">

            <!-- <h2><strong>01 404-1038</strong></h2> -->

            <h2><a style="color:white;" href="mailto:info@numa.io">info@numa.io</a></h2>

        </div>
    </div>
</section>
<style>
    .selectize-input{height:61px;padding: 20px;font-size: 21px;}
    .selectize-input input{font-size: 21px;}
    .numa_main-search .search_wrap .shearch_here{height:126px!important;}
    .selectize-dropdown-content {
        max-height: 115px!important;
    }
</style>
@endsection