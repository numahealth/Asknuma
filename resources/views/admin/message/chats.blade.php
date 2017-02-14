<?php foreach ($message as $value) { ?>
    <div class="chatboxmessage <?php
    if ($value->user_id == 1) {
        echo "ltr";
    }
    ?>">
        <span class="chatboxmessagefrom"><?php if ($value->user_id == 1) { ?> <img style="width:50px;" src="{{ URL::asset("public")}}/quickadmin/images/asknuma.png" /> <?php
            } else {
                $user_sent = 2;
                if (@$name[0]->profile_pic != '') {
                    $url = URL::asset('public/uploads/thumb') . '/' . @$name[0]->profile_pic;
                } else {

                    $url = URL::asset('public/quickadmin/images/user_profile.jpg');
                }
                ?> <img style="width:50px;" src="<?php echo $url; ?>" /> 
            <?php } ?></span>
        <div class="chatboxmessagecontent"><time datetime="2009-11-13T20:00"><?php
                if ($value->age !== 0) {
                    echo 'Age : ' . $value->age . ' | ' . $value->gender . ' | ';
                }
                ?><? echo date('d M Y h:iA',strtotime($value->created_at)); ?> @if($value->embedded != '')
                | <a style="cursor:pointer" data-toggle="modal" data-target="#myModalv{{ $value->id }}"> Video attachment </a>
                @endif  </a> </time> 

            @if($value->profile_pic != '')<img style="cursor:pointer" data-toggle="modal" data-target="#myModal{{ $value->id }}" src="{{ URL::asset('public/uploads/thumb') . '/'.  $value->profile_pic }}">
            <div class="chatbox_text"><p id="message_for_slack<?php echo $value->id; ?>"> 
                    <?php echo trim($value->message); ?>
                </p></div>
            @else
            <p id="message_for_slack<?php echo $value->id; ?>"><?php echo trim($value->message); ?></p>	
            @endif
        </div>
    </div>
    <div class="modal fade" id="myModal{{ $value->id }}" tabindex="-1" role="dialog" 
         aria-labelledby="myModalLabel" style="background-color: transparent;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Attachment</h4>
                </div>
                <div class="modal-body">
                    @if($value->profile_pic != '')<img  style="width: 100%; cursor:pointer" src="{{ URL::asset('public/uploads') . '/'.  $value->profile_pic }}">
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModalv{{ $value->id }}" tabindex="-1" role="dialog" 
         aria-labelledby="myModalLabel" style="background-color: transparent;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Video Attachment</h4>
                </div>
                <div class="modal-body">
                    <?php echo $value->embedded ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>