<script type="text/javascript" src="{{ URL::asset('public/user/assets/js')}}/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="{{ URL::asset('public/quickadmin/js') }}/main.js"></script>
<script type="text/javascript" src="{{ URL::asset('public/user/assets/js')}}/jquery.ui.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('public/user/assets/plugins/bootstrap')}}/bootstrap.min.js"></script>
<!-- Modernizr Library For HTML5 And CSS3 -->

<script type="text/javascript" src="{{ URL::asset('public/user/assets/plugins/mmenu')}}/jquery.mmenu.js"></script>
<!-- Library 10+ Form plugins-->
<script type="text/javascript" src="{{ URL::asset('public/user/assets/plugins/form')}}/form.js"></script>
<!-- Datetime plugins -->
<script type="text/javascript" src="{{ URL::asset('public/user/assets/plugins/datetime')}}/datetime.js"></script>
<!-- Library Chart-->
<script type="text/javascript" src="{{ URL::asset('public/user/assets/plugins/chart')}}/chart.js"></script>
<!-- Library  5+ plugins for bootstrap -->
<script type="text/javascript" src="{{ URL::asset('public/user/assets/plugins/pluginsForBS')}}/pluginsForBS.js"></script>
<!-- Library 10+ miscellaneous plugins -->
<script type="text/javascript" src="{{ URL::asset('public/user/assets/plugins/miscellaneous')}}/miscellaneous.js"></script>
<!-- Library Themes Customize-->
<script type="text/javascript" src="{{ URL::asset('public/user/assets/js')}}/caplet.custom.js"></script>
<?php if( Auth::user()->flag==0 ) { ?>
<script>
$(document).ready(function(){
$("#welcome_message").trigger("click");
  });
</script>
<?php } ?>
<script>
$(document).ready(function() {
  
    $.ajax({
        	url:"<?php echo url('admin/welcome/unread_update')?>",
            method:'POST',
        	data:{
				'_token':'<?php echo csrf_token();?>',
        	},
        	success: function(result){
               
				
        }});
        

});
$(document).ready(function() {
    $('#close_popup').click(function() {
    var value= ($('#dont_show').prop('checked'))
    var flag=0;
    if(value)
    {
    	flag=1;
    }
    $.ajax({
        	url:"<?php echo url('admin/welcome/message_deny')?>",
            method:'POST',
        	data:{
				'_token':'<?php echo csrf_token();?>',
				'value':flag,
        	},
        	success: function(result){
				
        }});
        
    });
});

</script>
