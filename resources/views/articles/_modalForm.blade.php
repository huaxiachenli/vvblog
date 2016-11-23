<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title text-xs-center" id="myModalLabel">回复</h4>
            </div>
            <div class="modal-body">
                <div id="replyForm" data-parent-id='0' >
                    {{ Form::hidden('parent_id',0) }}
                    <fieldset class="form-group">
                        {{ Form::textarea('content',null,["data-provide"=>"markdown","data-iconlibrary"=>"fa",'id'=>'markdown','required'=>'required']) }}
                    </fieldset>
                    <fieldset class="form-group">
                        {{ Form::submit('提交',['class'=>'btn btn-primary btn-block replyBtn',]) }}
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>