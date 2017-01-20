@extends('admin.layouts.front')
@section('content')
<div class="container">
    <div class="row">
        <ul class="col-md-12 blog-posts blog-post-large style-alt">                       
            <li class="blog-post format-standard clearfix">
                <article class="post-body">
                    <?php
                    $blog = DB::table('blog')
                            ->where('status', '=', 'Active')
                            ->orderBy('created_at', 'desc')
                            ->get();
                    ?>
                    @if(!empty($blog))
                    @foreach($blog as $datas)
                    <div class="numa_blog">
                        <div class="post-media">
                            <a href="{{ url('/blog/'.@$datas->id.'/'.str_replace(' ', '-',strtolower($datas->blog_name)))}}">
                                @if($datas->blog_image != '')<img src="{{ URL::asset('public/uploads') . '/'.  $datas->blog_image }}">
                                @else
                                <img src="{{ URL::asset('public/front') }}/img/latest-1.jpg" alt=''/>
                                @endif  
                            </a>
                        </div><!-- .post-media end -->
                        <a href="{{ url('/blog/'.@$datas->id.'/'.str_replace(' ', '-',strtolower($datas->blog_name)))}}">
                            <h2>{{$datas->blog_name}}</h2>
                        </a>
                        <ul class="post-meta">              
                            <li class="fa fa-calendar-o"><span>{{ date('d M Y h:i A',strtotime($datas->created_at)) }}</span></li>
                        </ul><!-- .post-meta end -->
                        <?php echo substr(strip_tags($datas->description), 0, 1000); ?>
                    </div><a href="{{ url('/blog/'.@$datas->id. '/' .str_replace(' ', '-', strtolower($datas->blog_name)))}}" class="btn btn-success">Read More</a>
                    <br>
                    @endforeach
                    @endif  





                    <!--div class="blog-single-author">
                        <div class="avatar">
                            <img alt="" src="{{ URL::asset('public/front') }}/img/blog/avatar-1.png">
                        </div>

                        <div class="text-container">
                            <h4>Pixel Industry</h4>

                            <p>
                                Pixel industry is web agency based in 
                                Croatia. Their main focus is on web 
                                design and development of HTML templates, 
                                Wordpress themes and jQuery and 
                                WordPress plugins. You can check their 
                                work at <a href="#"><strong> www.pixel</strong></a>
                            </p>
                        </div>
                    </div-->

                    <!-- .post-comments start -->
                    <!-- .post-comments start -->
                    <!-- .post-comments end -->

                    <!-- .comment-form start -->
                    <!-- .comment-form end -->
                </article><!-- .post-body end -->
            </li><!-- .blog-post.format-standard end -->
        </ul><!-- .col-md-9.blog-posts end -->

        <!-- .col-md-3 end -->
    </div>

</div>
@endsection
