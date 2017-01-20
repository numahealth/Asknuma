@extends('admin.layouts.front')
@section('content')
<?php
$detail = DB::table('diseasesarticle')
        ->where('diseasesarticle.status', '=', 'Active')
        ->where('id', '=', @Request::segment(2))
        ->get();
if (empty($detail)) {
    return Redirect::to('search_result')->send();
}
//	print_r($detail);
?>
<div class="container"> 
    <div class="row disease_details">
        <section class="fancy-heading left">
            <h3><span> {{$detail[0]->article_title}} </span></h3>
        </section>
        <div class="article_detail_img">
            @if($detail[0]->article_profile!= '')
            <img width="100%"src="{{ URL::asset('public/uploads') . '/'.  $detail[0]->article_profile }}">
            @else
            <img width="100%"src="{{ URL::asset('public/front/img') }}/article.jpg">
            @endif
        </div>
        <?php
        echo $detail[0]->article_description;
        ?>
        @if($detail[0]->article_video!= '')
        <div class="article_detail_video">
            <?php echo $detail[0]->article_video; ?>	
        </div>
        @endif


        @if($detail[0]->references!= '' || $detail[0]->disclaimer!='')
        <a id="shows_dis" class="btn btn-success search_health disclaimer-btn">Disclaimer and references</a>
        <div id="refr" style="display:none;"class="disclaimer-detail">
            @if($detail[0]->disclaimer!='')

            <h3> Disclaimer  </h3>

            {{$detail[0]->disclaimer}}
            @endif
            @if($detail[0]->references!='')
            <h3> References</h3>

            {{$detail[0]->references}}
            @endif
        </div>
        @endif


    </div>     
</div>
<style>
    body { margin:0; padding:0; }
    /*#map { position:absolute; top:0; bottom:0; width:100%;height:400px }*/
    #map { height:385px }
    .map_m{
        background: #fff;
        padding-bottom: 15px;
    }

    .search_health {width:245px; margin:0 auto 53px; float:none; display: block;  padding: 15px;}
    .disease_details {margin-bottom:0;}
</style>

<div class="container">

    <!--a href="{{ url('/map')}}" target="_blank" style="cursor:pointer"  data-toggle="modal" data-target="" class="btn btn-success search_health" > Search for health facility </a-->

</div>

<div class="container-fluid helpful">
    <div class="container">


        <div class="col-md-6 col-sm-8 col-xs-11 helpful_wrap"> 
            <h1>Was this helpful?</h1>
            <div class="yes_no">

                <a href="#"  class="btn btn-danger"   data-toggle="modal" data-target="#no_helpful">NO</a>
                <a style="cursor:pointer"  data-toggle="modal" data-target="#yes_pop_helpful" class="btn btn-success" >Yes</a>
                <a href="#" id="thanks" class="btn btn-success hide" data-toggle="modal" data-target="#yes_helpful">Yes</a>
                <a href="#" id="thanks_question" class="btn btn-success hide" data-toggle="modal" data-target="#yes_helpful_question">Yes</a>
            </div>
            <div class="yes_no large_btn">

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
                <a href="<?php echo $href; ?>" id="ask_doc" class="btn btn-info" <?php if (Auth::check()) { ?> data-toggle="modal" data-target="#ask_doctor" <?php } else { ?> data-toggle="modal" data-target="<?php echo $pop; ?>" <?php } ?> >Ask A Doctor</a>
                <a href="{{ url('')}}" class="btn btn-info">Change Symptoms</a>
            </div>
            <div class="yes_no large_btn">
                <?php
                if (Auth::check()) {
                    $exist_bookmark = DB::table('numa_bookmark')
                            ->select('id')
                            ->where('user_id', '=', Auth::user()->id)
                            ->where('diseases_article_id', '=', $detail[0]->id)
                            ->where('type', '=', 'article')
                            ->where('status', '=', 'Active')
                            ->get();
                    if (empty($exist_bookmark)) {
                        ?>
                        <a style="cursor:pointer" <?php if (Auth::check()) { ?> onclick ='bookmark({{$detail[0]->id}}, "Active");' <?php } else { ?> data-toggle="modal" data-target="#myModal" <?php } ?> class="btn save_bookmark" >Save this article for later</a>
                    <?php } else { ?>
                        <a style="cursor:pointer" <?php if (Auth::check()) { ?> onclick ='bookmark({{$detail[0]->id}}, "Inactive");' <?php } else { ?> data-toggle="modal" data-target="#myModal" <?php } ?> class="btn delete_bookmark" >Delete Bookmark</a>	
                    <?php }
                } else {
                    ?>
                    <a style="cursor:pointer" <?php if (Auth::check()) { ?> onclick ='bookmark({{$detail[0]->id}});' <?php } else { ?> data-toggle="modal" data-target="#myModal" <?php } ?> class="btn save_bookmark" >Save this article for later</a>
<?php } ?>

            </div>


        </div>

    </div>
</div>


<!-- Popup modal box -->

<!-- Was this helpful? (Yes) -->
<div class="modal fade" id="yes_helpful" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-thumbs-up"> </i> </h4>
            </div>
            <div class="modal-body">
                <p><h5 id="text_change">Thank you {{ @Auth::user()->name }} for your feedback. </h5></p>
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


<!-- Was this helpful? (No) -->
<div class="modal fade" id="no_helpful" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Please let us know why...</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="comment">Reason:</label>

                    <?php
                    $values = array();
                    $symptom = DB::table('reason')->where('status', '=', 'Active')->where('type', '=', 'No')->get();
                    if (!empty($symptom)) {
                        foreach ($symptom as $records) {

                            $values[$records->id] = $records->reason;
                        }
                    }
                    ?>
                    {!! Form::select('search_keyword', $values, old('search_keyword'), array('class'=>'form-control','id'=>'reason_id')) !!}



                </div>
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" rows="3" id="reasons"></textarea>
                </div>
                <button onclick ='yes_no({{$detail[0]->id}}, "No");' type="submit" class="btn btn-success" style=" float:none"  data-dismiss="modal">Submit</button>

            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="yes_pop_helpful" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Please let us know why...</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="comment">Reason:</label>

                    <?php
                    $values = array();
                    $symptom = DB::table('reason')->where('status', '=', 'Active')->where('type', '=', 'Yes')->get();
                    if (!empty($symptom)) {
                        foreach ($symptom as $records) {

                            $values[$records->id] = $records->reason;
                        }
                    }
                    ?>
                    {!! Form::select('search_keyword', $values, old('search_keyword'), array('class'=>'form-control','id'=>'y_reason_id')) !!}



                </div>
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" rows="3" id="y_reasons"></textarea>
                </div>
                <button onclick ='yes_no({{$detail[0]->id}}, "Yes");' type="submit" class="btn btn-success" style=" float:none"  data-dismiss="modal">Submit</button>

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

                <button  onclick='query_to_doc(<?php echo @Request::segment(2) ?>);' type="button" class="btn btn-info" style=" float:none" data-toggle="modal"  >Submit</button>
                <button  id="click_here" type="submit" class="btn btn-info hide" style=" float:none" data-toggle="modal"  >Submit</button>
                <button  id="dismiss" type="button" class="btn btn-info hide" style=" float:none" data-toggle="modal"  data-dismiss="modal" >Submit</button>

                </form>      
            </div>

        </div>
    </div>
</div>
@endsection
