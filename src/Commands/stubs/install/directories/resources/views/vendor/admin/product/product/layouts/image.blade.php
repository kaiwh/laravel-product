<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="images">
        <thead>
            <tr>
                <td class="text-left">@Lang('admin::media.form.image')</td>
                <td class="text-left">@Lang('admin::media.form.title')</td>
                <td class="text-left">@Lang('admin::app.text.sort_order')</td>
                <td class="text-left"></td>
            </tr>
        </thead>
        <tbody>
        	@php
        		$image_row = 0;
        	@endphp
        	@if($images)
        		@foreach($images as $value)
        			<tr id="image-row{{ $image_row }}">
					    <td class="text-left">
					        <a class="img-thumbnail" data-toggle="image" href="" id="thumb-image{{ $image_row }}">
					            <img alt="" data-placeholder="{{ Image::placeholder(100,100) }}" src="{{ Image::resize($value['image'],100,100) }}" title=""/>
					        </a>
					        <input id="input-image{{ $image_row }}" name="images[{{ $image_row }}][image]" type="hidden" value="{{ $value['image'] }}"/>
					    </td>
					    <td class="text-left">
					        <input class="form-control" name="images[{{ $image_row }}][title]" placeholder="@Lang('admin::media.form.title')" type="text" value="{{ $value['title'] }}"/>
					    </td>
					    <td class="text-right">
					        <input class="form-control" name="images[{{ $image_row }}][sort_order]" placeholder="@Lang('admin::app.text.sort_order')" type="text" value="{{ $value['sort_order'] }}"/>
					    </td>
					    <td class="text-left">
					        <button class="btn btn-danger" data-toggle="tooltip" onclick="$('#image-row{{ $image_row }}').remove();" title="@Lang('admin::app.button.delete')" type="button"><i class="fa fa-minus-circle"></i></button>
					    </td>
					</tr>
					@php
		        		$image_row ++;
		        	@endphp
        		@endforeach
        	@endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td class="text-left">
                    <button class="btn btn-primary" data-toggle="tooltip" onclick="addImage();" title="@Lang('admin::app.button.add_image')" type="button"><i class="fa fa-plus-circle"></i></button>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
<script> 
var image_row = {{ $image_row }};

function addImage() {
  html  = '<tr id="image-row' + image_row + '">';
  html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '" data-toggle="image" class="img-thumbnail"><img src="{{ Image::placeholder(100,100) }}" alt="" title="" data-placeholder="{{ Image::placeholder(100,100) }}" /><input type="hidden" name="images[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
  html += '  <td class="text-left"><input type="text" name="images[' + image_row + '][title]" value="" placeholder="@Lang('admin::media.form.title')" class="form-control" /></td>';
  html += '  <td class="text-right"><input type="text" name="images[' + image_row + '][sort_order]" value="" placeholder="@Lang('admin::app.text.sort_order')" class="form-control" /></td>';
  html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="@Lang('admin::app.button.delete')" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';
  
  $('#images tbody').append(html);
  
  image_row++;
}
</script> 