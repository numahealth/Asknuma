@extends('admin.layouts.user')

@section('content')
<div class="row">
    <section class="panel">
        <div style="width:98%; height:auto; margin:0px auto 10px; padding:10px 0;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f3f3f3" class="table table-striped table-hover datatable " id="datatables">
                <thead style="height: 35px; margin-bottom:0;">
                    <tr>
                        <th class="">My Saved Items</th>

                    </tr>
                </thead>

                <tbody>
                    <?php $i = 0; ?>

                    @foreach ($bookmark as $row)
                    <?php if ($i % 4 == 0) {
                        ?>
                        <tr>
                            <td>
                                <div class="row">
                                <?php } ?>
                                <?php
                                if ($row->type == 'blog') {
                                    $detail = DB::table('blog')
                                            ->where('id', '=', $row->diseases_article_id)
                                            ->get();
                                    $name = $detail[0]->blog_name;
                                    $des = $detail[0]->description;
                                    $img = $detail[0]->blog_image;
                                    $url = url('/blog/' . $row->diseases_article_id . '/' . str_replace(' ', '-', strtolower($name)));
                                } else {
                                    $detail = DB::table('diseasesarticle')
                                            ->where('id', '=', $row->diseases_article_id)
                                            ->get();
                                    $name = $detail[0]->article_title;
                                    $des = $detail[0]->article_description;
                                    $img = $detail[0]->article_profile;
                                    $url = url('/article_details_small/' . $row->diseases_article_id);
                                }
                                ?>
                                <div class="col-md-3">
                                    <div class="media_wrap">
                                        <div class="image">@if($img != '')<img class="circle" src="{{ asset('public/uploads/thumb') . '/'.  $img }}">@endif </div>
                                        <h4> <?php echo ucfirst(str_limit($name, $limit = 20, $end = '...')) ?> </h4>
                                        <p> <?php
                                            if (isset($des)) {
                                                echo ucfirst(substr($des, 0, 140));
                                            }
                                            ?></p>
                                        <a target="_blank" href="<?php echo $url; ?>" class="btn btn-success">Read More</a>
                                    </div>   
                                </div>

<?php $i++;
if ($i / 4 == 1) {
    ?>
                                </div>
                            </td>
                        </tr>
<?php } ?>	
                    @endforeach
                </tbody>
            </table>

        </div> 
    </section>
</div>
<style>
    thead th {
        text-align: left;
        padding: 10px!important;
    }
</style>
@endsection
@section('page_title')
<span>Personal Health Library</span>
@endsection
@section('page_subtitle')
<span>Read through your favourite Numa health content</span>
@endsection