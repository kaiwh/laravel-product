@extends('desktop::layouts.app')

@section('title', $product->description->meta_title)
@section('meta_description', $product->description->meta_description)
@section('meta_keywords', $product->description->meta_keyword)



@section('content')
<br />

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div id="owlcarousel" class="owl-carousel owl-theme">
                @foreach($product->images as $value)
                    <div class="item">
                        <a>
                            <img src="{{ Image::resize($value->image,600,480) }}" alt="slide" class="img-responsive" />
                        </a>
                        <div class="title">
                           {{ $value->title }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-sm-6">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="images">
                    <tr>
                        <td>@lang('desktop::product.text.title')</td>
                        <td>{{ $product->description->title }}</td>
                    </tr>
                    <tr>
                        <td>@lang('desktop::product.text.description')</td>
                        <td>{!! $product->description->description !!}</td>
                    </tr>
                    <tr>
                        <td>@lang('desktop::product.text.price')</td>
                        <td>{{ Currency::format($product->price) }}</td>
                    </tr>
                    <tr>
                        <td>@lang('desktop::product.text.quantity')</td>
                        <td>{{ $product->quantity }}</td>
                    </tr>
                    <tr>
                        <td>@lang('desktop::product.text.minimum')</td>
                        <td>{{ $product->minimum }}</td>
                    </tr>
                    <tr>
                        <td>{{ $product->description->option_title }}</td>
                        <td>
                            @if($product->options)
                                @foreach($product->options as $value)
                                    <div>
                                        {{ $value->description->title }}
                                        {{ Currency::format($value->price) }}
                                        {{ $value->quantity }}
                                        <a href="javascript:;" onclick="$(this).cartStore({ product_id:{{ $product->id }},option_id:{{ $value->id }} });">加入购物车</a>
                                    </div>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="{{ asset('vendor/owlcarousel/assets/owl.carousel.css') }}" rel="stylesheet">
@endpush
@push('scripts')
<script src="{{ asset('vendor/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('vendor/desktop/js/checkout.js') }}"></script>
@endpush

@section('script')
<script type="text/javascript">
$('#owlcarousel').owlCarousel({
    items: 1,
    singleItem: true,
    pagination: true,
    dots:false,
    loop:true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    nav:true,
    navText:['<i class="glyphicon glyphicon-chevron-left"></i>','<i class="glyphicon glyphicon-chevron-right"></i>']
});
</script>
@endsection