@extends('desktop::layouts.app')

@section('title',trans('desktop::product.heading.index'))

@section('content')
<br />
<div class="container">
    <div class="row">
    @foreach($products as $value)
        <div class="col-sm-4 col-md-3">
            <div class="thumbnail" >
                <a href="{{ route('desktop.product.show',['id'=>$value->id]) }}">
                	<img alt="{{ $value->description->title }}" src="{{ Image::resize($value->image,300,240) }}" />
                </a>
                <div class="caption">
                    <a href="{{ route('desktop.product.show',['id'=>$value->id]) }}">
	                    <h3>{{ $value->description->title }}</h3>
	                </a>
	                <p>{!! nl2br($value->description->summary) !!}</p>

                </div>
            </div>
        </div>
    @endforeach
    </div>
    <div class="row">
    	<div class="col-sm-12">
    		<div class="pull-right">
    			{{ $products->links() }}
    		</div>
    	</div>
    </div>
</div>
@endsection
