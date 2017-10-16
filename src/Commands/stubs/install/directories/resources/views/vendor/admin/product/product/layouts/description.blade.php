<ul class="nav nav-tabs" id="language">
	@foreach(Language::all() as $k=>$value)
        <li class="{{ $loop->first?'active':'' }}">
        	<a href="#language-{{ $value->code }}" data-toggle="tab">
        		<img src="{{ $value->image }}"> {{ $value->title }}
        	</a>
        </li>
	@endforeach
</ul>
<div class="tab-content">
	
	@foreach(Language::all() as $k=>$value)
	<div class="tab-pane {{ $loop->first?'active':'' }}" id="language-{{ $value->code }}" >
		<div class="form-group required">
			<label class="col-sm-2 control-label" for="input-title-{{ $value->code }}">@Lang('admin::media.form.title')</label>
			<div class="col-sm-10">
				<input name="descriptions[{{ $value->code }}][title]" value="{{ $descriptions[$value->code]['title'] or '' }}" placeholder="@Lang('admin::media.form.title')" id="input-title-{{ $value->code }}" class="form-control" type="text">
			</div>
		</div>
    
		<div class="form-group">
			<label class="col-sm-2 control-label" for="input-description-{{ $value->code }}">@Lang('admin::media.form.description')</label>
			<div class="col-sm-10">
				<textarea name="descriptions[{{ $value->code }}][description]" data-toggle="summernote" rows="5" placeholder="@Lang('admin::media.form.description')" id="input-description-{{ $value->code }}" class="form-control" type="text">{{ $descriptions[$value->code]['description'] or '' }}</textarea>
			</div>
		</div>
    	<div class="form-group ">
			<label class="col-sm-2 control-label" for="input-summary-{{ $value->code }}">@Lang('admin::media.form.summary')</label>
			<div class="col-sm-10">
				<textarea name="descriptions[{{ $value->code }}][summary]" rows="5" placeholder="@Lang('admin::media.form.summary')" id="input-summary-{{ $value->code }}" class="form-control unresize" type="text">{{ $descriptions[$value->code]['summary'] or '' }}</textarea>
			</div>
		</div>
		<div class="form-group required">
			<label class="col-sm-2 control-label" for="input-meta_title-{{ $value->code }}">@Lang('admin::media.form.meta_title')</label>
			<div class="col-sm-10">
				<input name="descriptions[{{ $value->code }}][meta_title]" value="{{ $descriptions[$value->code]['meta_title'] or '' }}" placeholder="@Lang('admin::media.form.meta_title')" id="input-meta_title-{{ $value->code }}" class="form-control" type="text">
			</div>
		</div>
   
		<div class="form-group required">
			<label class="col-sm-2 control-label" for="input-meta_description-{{ $value->code }}">@Lang('admin::media.form.meta_description')</label>
			<div class="col-sm-10">
				<textarea name="descriptions[{{ $value->code }}][meta_description]" rows="5" placeholder="@Lang('admin::media.form.meta_description')" id="input-meta_description-{{ $value->code }}" class="form-control unresize" type="text">{{ $descriptions[$value->code]['meta_description'] or '' }}</textarea>
			</div>
		</div>
    
		<div class="form-group required">
			<label class="col-sm-2 control-label" for="input-meta_keyword-{{ $value->code }}">@Lang('admin::media.form.meta_keyword')</label>
			<div class="col-sm-10">
				<textarea name="descriptions[{{ $value->code }}][meta_keyword]" rows="5" placeholder="@Lang('admin::media.form.meta_keyword')" id="input-meta_keyword-{{ $value->code }}" class="form-control unresize" type="text">{{ $descriptions[$value->code]['meta_keyword'] or '' }}</textarea>
			</div>
		</div>

	</div>
	@endforeach
</div>	