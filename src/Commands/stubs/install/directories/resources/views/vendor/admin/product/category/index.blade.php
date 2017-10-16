@extends('admin::layouts.app')

@section('content')
    <div id="content">
		<div class="container-fluid">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="page-header">
						<h1>@Lang('admin::productCategory.heading.index')</h1>
						<ul class="breadcrumb">
							<li><a href="{{ route('admin') }}">@Lang('admin::home.heading.title')</a></li>
							<li><a href="{{ route('admin.product.category.index') }}">@Lang('admin::productCategory.heading.index')</a></li>
						</ul>
						<div class="pull-right">
							<a href="{{ route('admin.product.category.create') }}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="@Lang('admin::app.button.create')"><i class="fa fa-plus"></i></a>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive ">
					    <table class="table table-tree" id="categories">
					        @if($categories)
					            <tbody >
					        		@foreach($categories as $value)
					                    <tr>
					                        <td class="text-left border" >
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
					                            @if($value->childrens)
					                                @include('admin::product.category.piece',['categories'=>$value->childrens])
					                            @endif
					                        </td>
					                    </tr>
					                @endforeach
					            </tbody>
					        @endif
					    </table>
					</div>
				</div>
			</div>
	    </div>
	</div>
    
@endsection
