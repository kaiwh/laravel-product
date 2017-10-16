
@php

	$placeholder = Image::placeholder(100,100);

	if( old('image') ){
		$thumb = Image::resize(old('image'),100,100);
	}
	else{
		$thumb = $placeholder;
	}
	
										
@endphp
@extends('admin::layouts.app')

@section('content')

    <div id="content">
		<div class="container-fluid">
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="page-header">
						<h1>@Lang('admin::product.heading.create')</h1>
						<ul class="breadcrumb">
							<li><a href="{{ route('admin') }}">@Lang('admin::home.heading.title')</a></li>
							<li><a href="{{ route('admin.product.index') }}">@Lang('admin::product.heading.index')</a></li>
							<li><a href="{{ route('admin.product.create') }}">@Lang('admin::product.heading.create')</a></li>
						</ul>
						<div class="pull-right">
							<button type="submit" form="form" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="@Lang('admin::app.button.save')"><i class="fa fa-save"></i></button>
							<a href="{{ route('admin.product.index') }}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="@Lang('admin::app.button.cancel')"><i class="fa fa-reply"></i></a>
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
					<form method="POST" action="{{ route('admin.product.create') }}" class="form-horizontal" id="form">
	            		{{ csrf_field() }}
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab-general" data-toggle="tab">@Lang('admin::app.tab.general')</a></li>
							<li class=""><a href="#tab-data" data-toggle="tab">@Lang('admin::app.tab.data')</a></li>
							<li class=""><a href="#tab-category" data-toggle="tab">@Lang('admin::app.tab.category')</a></li>
							<li class=""><a href="#tab-option" data-toggle="tab">@Lang('admin::app.tab.option')</a></li>
							<li class=""><a href="#tab-image" data-toggle="tab">@Lang('admin::app.tab.image')</a></li>
						</ul>
						<div class="tab-content">
				            <div class="tab-pane active" id="tab-general">
				            	
				            	@php
				            		$descriptions = [];
									if(old('descriptions')){
										$descriptions = old('descriptions');
									}
								@endphp
				            	@include('admin::product.product.layouts.description',['descriptions'=>$descriptions])
				            </div>
							{{-- End tab-general --}}
							<div class="tab-pane" id="tab-data">
								<div class="form-group ">
									<label class="col-sm-2 control-label" for="input-image">@Lang('admin::product.form.image')</label>
									<div class="col-sm-10">
										<a href="#" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="{{ $thumb }}" alt="" title="" data-placeholder="{{ $placeholder }}" /></a>
                  						<input type="hidden" name="image" value="{{ old('image') }}" id="input-image" />
									</div>
								</div>
	          					<div class="form-group">
									<label class="col-sm-2 control-label" for="input-price">@Lang('admin::product.form.price')</label>
									<div class="col-sm-10">
										<input name="price" value="{{ old('price')?old('price'):'0.0000' }}" placeholder="@Lang('admin::product.form.price')" id="input-price" class="form-control" type="text">
									</div>
								</div>{{-- End Price --}}
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-quantity">@Lang('admin::product.form.quantity')</label>
									<div class="col-sm-10">
										<input name="quantity" value="{{ old('quantity')?old('quantity'):0 }}" placeholder="@Lang('admin::product.form.quantity')" id="input-quantity" class="form-control" type="text">
									</div>
								</div>{{-- End quantity --}}
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-minimum">@Lang('admin::product.form.minimum')</label>
									<div class="col-sm-10">
										<input name="minimum" value="{{ old('minimum')?old('minimum'):1  }}" placeholder="@Lang('admin::product.form.minimum')" id="input-minimum" class="form-control" type="text">
									</div>
								</div>{{-- End minimum --}}
								<div class="form-group ">
									<label class="col-sm-2 control-label" for="input-subtract">@Lang('admin::product.form.subtract')</label>
									<div class="col-sm-10">
										<select name="subtract" id="input-subtract" class="form-control" >
											@if( !is_null(old('subtract')) && old('subtract')==0 )
											<option value="1" >@Lang('admin::app.text.enabled')</option>
											<option value="0" selected="selected">@Lang('admin::app.text.disabled')</option>
											@else
											<option value="1" selected="selected">@Lang('admin::app.text.enabled')</option>
											<option value="0" >@Lang('admin::app.text.disabled')</option>
											@endif
										</select>
									</div>
								</div>{{-- End subtract --}}
								<div class="form-group ">
									<label class="col-sm-2 control-label" for="input-parent">@Lang('admin::product.form.status')</label>
									<div class="col-sm-10">
										<select name="status" id="input-status" class="form-control" >
											@if( !is_null(old('status')) && old('status')==0 )
											<option value="1" >@Lang('admin::app.text.enabled')</option>
											<option value="0" selected="selected">@Lang('admin::app.text.disabled')</option>
											@else
											<option value="1" selected="selected">@Lang('admin::app.text.enabled')</option>
											<option value="0" >@Lang('admin::app.text.disabled')</option>
											@endif
										</select>
									</div>
								</div>
							</div>
							{{-- End tab-data --}}
							<div class="tab-pane" id="tab-category">
							@inject('categoryRepository', 'App\Repositories\ProductCategoryRepository')
							@php
			            		$categories = [];
								if(old('categories')){
									$categories = old('categories');
								}
							@endphp
			            	@include('admin::product.product.layouts.category',['categories'=>$categories,'trees'=>$categoryRepository->trees(['status'=>1])])
			            	</div>
			            	{{-- End tab-category --}}
							<div class="tab-pane" id="tab-option">
								@php
				            		$options = [];
									if(old('options')){
										$options = old('options');
									}
									$option_status = 1;
									if(old('option_status')){
										$option_status = old('option_status');
									}
								@endphp
				            	@include('admin::product.product.layouts.option',['option_status'=>$option_status,'descriptions'=>$descriptions,'options'=>$options])
							</div>{{-- End tab-option --}}

							<div class="tab-pane" id="tab-image">
								@php
				            		$images = [];
									if(old('images')){
										$images = old('images');
									}
								@endphp
				            	@include('admin::product.product.layouts.image',['images'=>$images])
							</div>
							{{-- End tab-image --}}
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