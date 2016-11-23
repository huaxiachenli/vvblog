<fieldset class="form-group">
    {{ Form::label('title','标题') }}
    {{ Form::text('title',null,['class'=>'form-control','reuquired'=>'required']) }}
</fieldset>

<fieldset class="form-group">
    {{ Form::label('intro','简介') }}
    {{ Form::text('intro',null,['class'=>'form-control','placeholder'=>'本文简介信息（30字左右）','required'=>'required']) }}
</fieldset>

<fieldset class="form-group">
    {{ Form::label('content','内容') }}
    {{ Form::textarea('content',null,["data-provide"=>"markdown","data-iconlibrary"=>"fa",'id'=>'markdown','required'=>'required','placeholder'=>'支持markdown语法']) }}
</fieldset>


<fieldset class="form-group">
    {{ Form::label('logo','LOGO') }}
    {{ Form::file('logo',['class'=>'form-control-file','required'=>'required']) }}
</fieldset>

<fieldset class="form-group">
    {{ Form::label('tag','标签') }}
    {{ Form::text('tag',null,['class'=>'form-control','id'=>'tag','required'=>'required']) }}
</fieldset>

<fieldset class="form-group">
    {{ Form::label('child_category_id','分类') }}
    {{ Form::select('child_category_id',Auth::user()->child_categories()->pluck('name','id'), null, ['placeholder' => '请选择分类','class'=>'form-control','required'=>'required']) }}
</fieldset>

<fieldset class="form-group">
    {{ Form::submit('提交',['class'=>'btn btn-block btn-primary' ]) }}
</fieldset>
