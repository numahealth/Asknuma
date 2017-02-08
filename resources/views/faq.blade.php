@extends('admin.layouts.front')
@section('content')
<div class="container">
    <?php
    $open = 1;
    $categories = DB::select('SELECT category_name, id, 
           (
           SELECT COUNT(*) FROM faq q
           WHERE q.category_id = f.id
           ) AS faq_count FROM faq_category f 
           WHERE status = ' . " 'active' OR status = " . " 'Active' ");
    ?>   
    <div class="row">
        <div class="col-md-4 col-lg-4" style="padding-top: 40px;">
            <?php foreach ($categories as $cat) { ?>
                <?php if ($cat->faq_count > 0) { ?>
                    <div class="faqHeader" style="font-size: 18px;">
                        <a href="#" class="faqScrollable" onclick="scrollToId(<?php echo $cat->id; ?>);">
                            <span style="color: #75d575;" class="fa fa-book"></span> 
                            <?php echo $cat->category_name; ?>
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="col-md-8 col-lg-8 
             col-sm-12 col-xs-12">
             <?php foreach ($categories as $cat) { ?>
                 <?php if ($cat->faq_count > 0) { ?>
                    <div class="faqHeader" style="font-size: 19px;" id="<?php echo $cat->id; ?>">
                        <?php echo $cat->category_name; ?>
                    </div>
                    <?php
                    $faqs = DB::table('faq')
                            ->where('category_id', '=', $cat->id)
                            ->whereIn('status', ['active', 'Active'])
                            ->get();
                    ?>  
                    <div class="panel-group" id="accordion<?php echo $cat->id; ?>" >
                        <?php foreach ($faqs as $faq) { ?>
                            <div class="panel panel-default">
                                <div class="panel-heading" style="padding: 7px; padding-left: 10px;">
                                    <h4 class="panel-title" style="font-size: 15px; padding: 0px;">
                                        <a data-toggle="collapse" data-parent="#accordion<?php echo $cat->id; ?>" href="#collapse<?php echo $faq->id ?>">
                                            <?php echo 'Q. ' . $faq->question; ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse<?php echo $faq->id ?>" 
                                     class="panel-collapse collapse <?php
                                     echo $open == 1 ? 'in' : '';
                                     $open++;
                                     ?>">
                                    <div class="panel-body">
                                        <?php echo $faq->answer; ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
@endsection
