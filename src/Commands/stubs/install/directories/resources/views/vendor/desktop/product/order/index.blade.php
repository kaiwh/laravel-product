@extends('desktop::layouts.app')

@section('title',trans('desktop::checkout.heading.order'))

@section('content')
<br/>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="images">
                    <thead>
                        <tr>
                            <td>@lang('desktop::checkout.text.order_id')</td>
                            <td>@lang('desktop::checkout.text.total')</td>
                            <td>@lang('desktop::checkout.text.order_status')</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $value)
                            <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ Currency::format($value->total) }}</td>
                            <td>{{ OrderStatus::enabled($value->order_status_id)->description->title }}</td>
                            <td><a href="{{ route('desktop.order.show',['id'=>$value->id]) }}">@lang('desktop::checkout.text.show')</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="clearfix">
                <div class="pull-right">
                    {{ $orders->links() }}
                <div>
            <div>
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