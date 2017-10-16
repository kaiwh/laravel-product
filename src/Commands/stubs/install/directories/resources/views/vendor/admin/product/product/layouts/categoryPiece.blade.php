<table class="table table-tree  table-checkbox">
    <tbody>
        @foreach($trees as $value)
        <tr>
            <td class="text-left tree">
                <div class="block checkbox">
                    <label>
                        @if($categories && in_array($value['id'], $categories))
                            <input name="categories[]" value="{{ $value['id'] }}" type="checkbox" checked="checked">
                        @else
                            <input name="categories[]" value="{{ $value['id'] }}" type="checkbox" >
                        @endif
                        {{ $value['title'] }}
                    </label>
                </div>
                @if($value['childrens'])
					@include('admin::media.media.layouts.categoryPiece',['trees'=>$value['childrens']])
				@endif
            </td>
        </tr>
		@endforeach
    </tbody>
</table>