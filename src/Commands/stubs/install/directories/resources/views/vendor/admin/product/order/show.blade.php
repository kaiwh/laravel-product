@extends('admin::layouts.app')

@section('content')

    <div id="content">
		<div class="container-fluid">
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="page-header">
						<h1>@Lang('admin::order.heading.create')</h1>
						<ul class="breadcrumb">
							<li><a href="{{ route('admin') }}">@Lang('admin::home.heading.title')</a></li>
							<li><a href="{{ route('admin.order.index') }}">@Lang('admin::order.heading.index')</a></li>
							<li><a href="{{ route('admin.order.show',['id'=>$order->id]) }}">@Lang('admin::order.heading.show')</a></li>
						</ul>
						<div class="pull-right">
							<a href="{{ route('admin.order.index') }}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="@Lang('admin::app.button.cancel')"><i class="fa fa-reply"></i></a>
						</div>
					</div>
				</div>
				<div class="panel-body">
					@if (count($errors) > 0)
					    <div class="alert alert-danger"  role="alert">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
					<form method="POST" class="form-horizontal" id="form">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab-general" data-toggle="tab">@Lang('admin::app.tab.general')</a></li>
							<li class=""><a href="#tab-product" data-toggle="tab">@Lang('admin::order.tab.product')</a></li>
							<li class=""><a href="#tab-history" data-toggle="tab">@Lang('admin::order.tab.history')</a></li>
						</ul>
						<div class="tab-content">
				            <div class="tab-pane active" id="tab-general">
				            	<div class="table-responsive">
					                <table class="table table-striped table-bordered table-hover" id="images">
					                    <tbody>
				                            <tr>
				                                <td>@lang('admin::order.text.order_id')</td>
				                                <td>{{ $order->id }}</td>
				                            </tr>
				                            <tr>
				                                <td>@lang('admin::order.text.name')</td>
				                                <td>{{ $order->name }}</td>
				                            </tr>
				                            <tr>
				                                <td>@lang('admin::order.text.mobile')</td>
				                                <td>{{ $order->mobile }}</td>
				                            </tr>
				                            <tr>
				                                <td>@lang('admin::order.text.email')</td>
				                                <td>{{ $order->name }}</td>
				                            </tr>
				                            @if($order->shipping)
				                            <tr>
				                                <td>@lang('admin::order.text.shipping')</td>
				                                <td>
				                                	<strong>{{ $order->shipping->name . '(' . $order->shipping->mobile .')' }}</strong><br>
                                      				{{ $order->shipping->province . $order->shipping->city . $order->shipping->district . $order->shipping->address }}
				                                </td>
				                            </tr>
				                            @endif
				                            <tr>
				                                <td>@lang('admin::order.text.total')</td>
				                                <td>{{ Currency::format($order->total) }}</td>
				                            </tr>
				                            <tr>
				                                <td>@lang('admin::order.text.order_status')</td>
				                                <td>{{ OrderStatus::enabled($order->order_status_id)->description->title }}</td>
				                            </tr>
				                            <tr>
				                                <td>@lang('admin::order.text.ip')</td>
				                                <td>{{ $order->ip }}</td>
				                            </tr>
				                            <tr>
				                                <td>@lang('admin::order.text.user_agent')</td>
				                                <td>{{ $order->user_agent }}</td>
				                            </tr>
				                            <tr>
				                                <td>@lang('admin::order.text.accept_language')</td>
				                                <td>{{ $order->accept_language }}</td>
				                            </tr>
				                            <tr>
				                                <td>@lang('admin::order.text.created_at')</td>
				                                <td>{{ $order->created_at }}</td>
				                            </tr>
				                            <tr>
				                                <td>@lang('admin::order.text.updated_at')</td>
				                                <td>{{ $order->updated_at }}</td>
				                            </tr>
				                        </tbody>
				                    </table>
				                </div>
				            </div>
							{{-- End tab-general --}}
							<div class="tab-pane" id="tab-product">
				            	<div class="table-responsive">
				            		<table class="table table-striped table-bordered table-hover" id="images">
				            			<thead>
				            				<tr>
				            					<td>@lang('admin::order.text.product')</td>
				            					<td>@lang('admin::order.text.price')</td>
				            					<td>@lang('admin::order.text.quantity')</td>
				            					<td>@lang('admin::order.text.total')</td>
				            				</tr>
				            			</thead>
					                    <tbody>
					                    	@foreach($order->products as $product)
					                    		<tr>
					                    			<td>{{ $product->title }}</td>
					                    			<td>{{ Currency::format($product->price) }}</td>
					                    			<td>{{ $product->quantity }}</td>
					                    			<td>{{ Currency::format($product->total) }}</td>
					                    		</tr>
					                    	@endforeach
				                        </tbody>
				                    </table>
				            	</div>
				           	</div>
				           	{{-- End tab-product --}}
				           	<div class="tab-pane" id="tab-history">
				            	<div class="table-responsive">
				            		<table class="table table-striped table-bordered table-hover" id="images">
				            			<thead>
				            				<tr>
				            					<td>@lang('admin::order.text.order_status')</td>
				            					<td>@lang('admin::order.text.comment')</td>
				            					<td>@lang('admin::order.text.notify')</td>
				            					<td>@lang('admin::order.text.created_at')</td>
				            				</tr>
				            			</thead>
					                    <tbody>
					                    	@foreach($order->histories as $value)
					                    		<tr>
					                    			<td>
					                    				{{ OrderStatus::enabled($value->order_status_id)->description->title }}
					                    			</td>
					                    			<td>{{ $value->comment }}</td>
					                    			<td>{{ $value->notify }}</td>
					                    			<td>{{ $value->created_at }}</td>
					                    		</tr>
					                    	@endforeach
				                        </tbody>
				                    </table>
				            	</div>
				           	</div>
				           	{{-- End tab-history --}}
	       				</div>
	       			</form>
				</div>			
			</div>
			
	    </div>
	</div>
    
@endsection

@push('scripts')

@endpush

@section('script')
<script> 

</script> 
@endsection