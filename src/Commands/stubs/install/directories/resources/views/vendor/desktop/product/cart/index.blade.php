@extends('desktop::layouts.app')

@section('title',trans('desktop::checkout.heading.cart'))

@section('content')
<br/>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="images">
                    <thead>
                        <tr>
                            <td>@lang('desktop::checkout.text.title')</td>
                            <td>@lang('desktop::checkout.text.price')</td>
                            <td>@lang('desktop::checkout.text.quantity')</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $value)
                            <tr>
                            <td>{{ $value['title'] }}</td>
                            <td>{{ Currency::format($value['price']) }}</td>
                            <td>{{ $value['quantity'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right">
                            @lang('desktop::checkout.text.total')：{{ Currency::format($total) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="clearfix">
                <a class="btn btn-primary pull-right" href="{{ route('desktop.product.checkout.index') }}">@lang('desktop::checkout.button.checkout')</a>
            <div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('vendor/desktop/js/checkout.js') }}"></script>
@endpush

@section('script')
<script>        
</script>
@endsection