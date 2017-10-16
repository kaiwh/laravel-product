<div class="form-group">
	<label class="col-sm-2 control-label" for="input-option_title">@Lang('admin::product.form.option_title')</label>
	<div class="col-sm-10">
		@foreach(Language::all() as $language)
			<div class="input-group">
				<span class="input-group-addon">
					<img src="{{ $language->image }}" />
				</span>
				<input name="descriptions[{{ $language->code }}][option_title]" value="{{ $descriptions[$language->code]['option_title'] or '' }}" placeholder="@Lang('admin::product.form.option_title')" id="input-option_title" class="form-control" type="text">
			</div>
		@endforeach
	</div>
</div>{{-- End option_title --}}

{{-- End Tab-content --}}
<div class="form-group ">
	<label class="col-sm-2 control-label" for="input-option_status">@Lang('admin::product.form.option_status')</label>
	<div class="col-sm-10">
		<select name="option_status" id="input-option_status" class="form-control" >
			@if( !$option_status )
			<option value="1" >@Lang('admin::app.text.enabled')</option>
			<option value="0" selected="selected">@Lang('admin::app.text.disabled')</option>
			@else
			<option value="1" selected="selected">@Lang('admin::app.text.enabled')</option>
			<option value="0" >@Lang('admin::app.text.disabled')</option>
			@endif
		</select>
	</div>
</div>{{-- End option_status --}}

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="options">
        <thead>
            <tr>
                <td class="text-left">@Lang('admin::app.text.image')</td>
                <td class="text-left">@Lang('admin::product.form.title')</td>
                <td class="text-left">@Lang('admin::product.form.price')</td>
                <td class="text-left">@Lang('admin::product.form.quantity')</td>
                <td class="text-left">@Lang('admin::product.form.subtract')</td>
                <td class="text-left">@Lang('admin::app.text.sort_order')</td>
                <td class="text-left"></td>
            </tr>
        </thead>
        <tbody>
        	@php
        		$option_row = 0;
        	@endphp
        	@if($options)
        		@foreach($options as $value)
        			<tr id="option-row{{ $option_row }}">
					    <td class="text-left">
					        <a class="img-thumbnail" data-toggle="image" href="" id="thumb-option{{ $option_row }}">
					            <img alt="" data-placeholder="{{ $placeholder }}" src="{{ Image::resize($value['image'],100,100) }}" title=""/>
					        </a>
					        <input id="input-option{{ $option_row }}" name="options[{{ $option_row }}][image]" type="hidden" value="{{ $value['image'] }}"/>
					    </td>
					    <td class="text-left">
					    	@foreach(Language::all() as $language)
					    		<div class="input-group">
					    			<span class="input-group-addon"><img src="{{ $language->image }}"></span>
					    			<input class="form-control" name="options[{{ $option_row }}][descriptions][{{ $language->code }}][title]" placeholder="@Lang('admin::product.form.title')" type="text" value="{{ $value['descriptions'][$language->code]['title'] }}"/>
					    		</div>
					    	@endforeach
					    </td>
					    <td class="text-left">
					        <input class="form-control" name="options[{{ $option_row }}][price]" placeholder="@Lang('admin::product.form.price')" type="text" value="{{ $value['price'] }}"/>
					    </td>
					    <td class="text-left">
					        <input class="form-control" name="options[{{ $option_row }}][quantity]" placeholder="@Lang('admin::product.form.quantity')" type="text" value="{{ $value['quantity'] }}"/>
					    </td>
					    <td class="text-left">
					        <select name="options[{{ $option_row }}][subtract]" class="form-control" >
					        	@if( $value['subtract']==0 )
								<option value="1" >@Lang('admin::app.text.enabled')</option>
								<option value="0" selected="selected">@Lang('admin::app.text.disabled')</option>
								@else
								<option value="1" selected="selected">@Lang('admin::app.text.enabled')</option>
								<option value="0" >@Lang('admin::app.text.disabled')</option>
								@endif
					        </select>
					    </td>
					    <td class="text-right">
					        <input class="form-control" name="options[{{ $option_row }}][sort_order]" placeholder="@Lang('admin::app.text.sort_order')" type="text" value="{{ $value['sort_order'] }}"/>
					    </td>
					    <td class="text-left">
					        <button class="btn btn-danger" data-toggle="tooltip" onclick="$('#option-row{{ $option_row }}').remove();" title="@Lang('admin::app.button.delete')" type="button"><i class="fa fa-minus-circle"></i></button>
					    </td>
					</tr>
					@php
		        		$option_row ++;
		        	@endphp
        		@endforeach
        	@endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6"></td>
                <td class="text-left">
                    <button class="btn btn-primary" data-toggle="tooltip" onclick="addOption();" title="@Lang('admin::app.button.add_option')" type="button"><i class="fa fa-plus-circle"></i></button>
                </td>
            </tr>
        </tfoot>
    </table>
</div>{{-- End --}}
<script> 


var option_row = {{ $option_row }};

function addOption() {
  html  = '<tr id="option-row' + option_row + '">';
  html += '<td class="text-left"><a href="" id="thumb-option' + option_row + '"data-toggle="image" class="img-thumbnail"><img src="{{ $placeholder }}" alt="" title="" data-placeholder="{{ $placeholder }}" /><input type="hidden" name="options[' + option_row + '][image]" value="" id="input-option' + option_row + '" /></td>';
  html += '<td class="text-left">';
  @foreach(Language::all() as $language)
  html += '<div class="input-group"><span class="input-group-addon"><img src="{{ $language->image }}"></span><input type="text" name="options[' + option_row + '][descriptions][{{ $language->code }}][title]" value="" placeholder="@Lang('admin::product.form.title')" class="form-control" /></div>';
  @endforeach
  html += '</td>';
  html += '<td class="text-left"><input type="text" name="options[' + option_row + '][price]" value="0" placeholder="@Lang('admin::product.form.price')" class="form-control" /></td>';
  html += '<td class="text-left"><input type="text" name="options[' + option_row + '][quantity]" value="0" placeholder="@Lang('admin::product.form.quantity')" class="form-control" /></td>';
  html += '<td class="text-left"><select name="options[' + option_row + '][subtract]" class="form-control" ><option value="1" selected="selected">@Lang('admin::app.text.enabled')</option><option value="0" >@Lang('admin::app.text.disabled')</option></select></td>';
  html += '<td class="text-right"><input type="text" name="options[' + option_row + '][sort_order]" value="0" placeholder="@Lang('admin::app.text.sort_order')" class="form-control" /></td>';
  html += '<td class="text-left"><button type="button" onclick="$(\'#option-row' + option_row  + '\').remove();" data-toggle="tooltip" title="@Lang('admin::app.button.delete')" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';
  
  $('#options tbody').append(html);
  
  option_row++;
}

</script> 