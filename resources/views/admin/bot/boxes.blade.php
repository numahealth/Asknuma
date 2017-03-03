@extends('admin.layouts.master')
@section('content')
<div>
    <div class="modal fade" id="newCategoryDlg" role="dialog" 
         style="top: 10% !important; background-color: transparent !important;">
        <div class="modal-dialog">
            <div class="panel panel-info">
                <div class="panel-heading" style="background-color: #75d575; color: #fff; border: 1px solid #fff;">
                    <div class="panel-title" style="overflow: hidden;">
                        New Flow Box
                        <button id="modalCloseBtn" style="float: right;" type="button" 
                                class="btn btn-warning" data-dismiss="modal">
                            <i class="fa fa-close"></i> Close
                        </button>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="notice_bar alert alert-warning alert-dismissable" 
                         style="display: none; margin: 10px;">
                        <!-- Notification Panel -->
                    </div>
                    <div class="form-group">
                        <label for="category">Flow Name:</label>
                        <input type="text" class="form-control" id="flowName" required="true"/>
                    </div>
                    <div class="form-group">
                        <label for="category">Shot Description:</label>
                        <textarea class="form-control" id="flowDesc"></textarea>
                    </div>
                    <button class="btn btn-lg btn-success" style="margin-top: 15px; float: right;" 
                            id="addChatFlowBtn">
                        <span style="display: inline;" class="fa fa-save"></span> Save
                    </button> 
                </div>

            </div>
        </div>
    </div>
    <div class="notice_bar alert alert-warning alert-dismissable" 
         style="display: none; margin: 10px;">
        <!-- Notification Panel -->
    </div>
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">Flow Boxes</div>
            <p>
                <input type="button" onclick="showChatFlowDlg();" class="btn btn-success" value="Add New" style="background-color: #333;"/>
            </p>
        </div>
        <div class="portlet-body">
            <table class="no-more-tables table table-striped table-hover table-responsive datatable" id="datatables">
                <thead>
                    <tr>
                        <th style="min-width: 20px;" class="no-sort">S/N</th>
                        <th class="no-sort">Box Description</th>
                        <th>
                            <span class="fa fa-cogs"></span>
                        </th>
                    </tr>
                </thead>
                <tbody id="flowTableBody">
                    
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@section('javascript')
<script type="text/javascript">
    function showChatFlowDlg() {
        $('#newCategoryDlg').modal('show');
    }
</script>
@stop