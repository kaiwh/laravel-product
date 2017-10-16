<table class="table table-tree  table-checkbox">
    <tbody>
        @foreach($categories as $value)
        <tr>
            <td class="text-left tree border">
                <div class="block">
                    <label>
                        {{ $value->description->title }}
						@if($value->status)
							<span class="badge">@Lang('admin::app.text.enabled')</span>
						@else
							<span class="badge">@Lang('admin::app.text.disabled')</span>
						@endif
                    </label>
                    <div class="pull-right">
						<a href="{{ route('admin.product.category.create',['parent_id'=>$value->id]) }}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="@Lang('admin::productCategory.button.add_children')"><i class="fa fa-plus"></i></a>
						<a href="{{ route('admin.product.category.edit',['id'=>$value->id]) }}"  data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="@Lang('admin::app.button.edit')"><i class="fa fa-pencil"></i></a>
						<a href="{{ route('admin.product.category.destroy',$value->id) }}" onclick="return confirm('@Lang('admin::app.confirm.delete')')?true:false" data-toggle="tooltip" title="" class="btn btn-warning" data-original-title="@Lang('admin::app.button.delete')"><i class="fa fa-trash"></i></a>
					</div>
                </div>
                @if($value['childrens'])
					@include('admin::product.category.piece',['categories'=>$value->childrens])
				@endif
            </td>
        </tr>
		@endforeach
    </tbody>
</table>