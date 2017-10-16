@extends('admin::layouts.app')

@section('content')
    <div id="content">
		<div class="container-fluid">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="page-header">
						<h1>@Lang('admin::product.heading.index')</h1>
						<ul class="breadcrumb">
							<li><a href="{{ route('admin') }}">@Lang('admin::home.heading.title')</a></li>
							<li><a href="{{ route('admin.product.index') }}">@Lang('admin::product.heading.index')</a></li>
						</ul>
						<div class="pull-right">
							<a href="{{ route('admin.product.create') }}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="@Lang('admin::app.button.create')"><i class="fa fa-plus"></i></a>
						</div>
					</div>
				</div>
				<div class="panel-body">
				@if(sizeof($products)>0)
					<ul class="list-unstyled list-tree">
						@foreach ($products as $value)
						<li class="">
							<div class="block clearfix">
								<i class="fa fa-angle-double-right"></i> 
								{{ $value->description->title }}
								@if($value->status)
									<span class="badge">@Lang('admin::app.text.enabled')</span>
								@else
									<span class="badge">@Lang('admin::app.text.disabled')</span>
								@endif
								<div class="pull-right">
									<a href="{{ route('admin.product.edit',['id'=>$value->id]) }}"  data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="@Lang('admin::app.button.edit')"><i class="fa fa-pencil"></i></a>
									<a href="{{ route('admin.product.destroy',$value->id) }}" onclick="return confirm('@Lang('admin::app.confirm.delete')')?true:false" data-toggle="tooltip" title="" class="btn btn-warning" data-original-title="@Lang('admin::app.button.delete')"><i class="fa fa-trash"></i></a>
								</div>
							</div>
						</li>
						@endforeach
					</ul>
					<div class="clearfix text-right">
						{{ $products->links() }}
					</div>
				
				@endif
				</div>
			</div>
	    </div>
	</div>
    
@endsection
