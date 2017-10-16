@extends('desktop::layouts.app')

@section('title',trans('desktop::checkout.heading.order'))

@section('content')
<br/>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="images">
                    <tbody>
                            <tr>
                                <td>@lang('desktop::checkout.text.order_id')</td>
                                <td>{{ $order->id }}</td>
                            </tr>
                            <tr>
                                <td>@lang('desktop::checkout.text.total')</td>
                                <td>{{ Currency::format($order->total) }}</td>
                            </tr>
                            <tr>
                                <td>@lang('desktop::checkout.text.order_status')</td>
                                <td>{{ OrderStatus::enabled($order->order_status_id)->description->title }}</td>
                            </tr>
                            <tr>
                                <td>@lang('desktop::checkout.text.shipping')</td>
                                <td>
                                      <strong>{{ $order->shipping->name . '(' . $order->shipping->mobile .')' }}</strong><br>
                                      {{ $order->shipping->province . $order->shipping->city . $order->shipping->district . $order->shipping->address }}
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('desktop::checkout.text.product')</td>
                                <td>
                                    <ul class="list-unstyled">
                                    @foreach($order->products as $product)
                                        <li>
                                            {{ $product->title }}
                                            {{ Currency::format($product->price) }}
                                            {{ $product->quantity }}
                                            {{ Currency::format($product->total) }}
                                        </li>
                                    @endforeach
                                    <ul>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('desktop::checkout.text.history')</td>
                                <td>
                                    <ul class="list-unstyled">
                                    @foreach($order->histories as $history)
                                        <li>
                                            {{ OrderStatus::enabled($history->order_status_id)->description->title }}
                                            {{ $product->comment }}
                                        </li>
                                    @endforeach
                                    <ul>
                                </td>
                            </tr>
                    </tbody>
                </table>
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