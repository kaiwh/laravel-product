@extends('admin::layouts.app')

@section('content')
    <div id="content">
		<div class="container-fluid">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="page-header">
						<h1>@Lang('admin::checkoutorder.heading.index')</h1>
						<ul class="breadcrumb">
							<li><a href="{{ route('admin') }}">@Lang('admin::home.heading.title')</a></li>
							<li><a href="{{ route('admin.media.index') }}">@Lang('admin::media.heading.index')</a></li>
						</ul>
						<div class="pull-right">
							<a href="{{ route('admin.media.create') }}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="@Lang('admin::app.button.create')"><i class="fa fa-plus"></i></a>
						</div>
					</div>
				</div>
				<div class="panel-body">
				@if($orders->total())
					<ul class="list-unstyled list-tree">
						@foreach ($orders as $value)
						<li class="">
							<div class="block clearfix">
								<i class="fa fa-angle-double-right"></i> 
								{{ $value->id }}
								<span class="badge">{{ OrderStatus::enabled($value->order_status_id)->description->title }}</span>
								<div class="pull-right">
									<a href="{{ route('admin.product.order.show',['id'=>$value->id]) }}"  data-toggle="tooltip" title="" class="btn btn-info" data-original-title="@Lang('admin::app.button.show')"><i class="fa fa-eye"></i></a>
								</div>
							</div>
						</li>
						@endforeach
					</ul>
					<div class="clearfix text-right">
						{{ $orders->links() }}
					</div>
				
				@endif
				</div>
			</div>
	    </div>
	</div>
    
@endsection
