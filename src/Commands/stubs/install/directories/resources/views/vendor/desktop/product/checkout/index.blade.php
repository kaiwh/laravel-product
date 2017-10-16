@extends('desktop::layouts.app')

@section('title',trans('desktop::checkout.heading.checkout'))

@section('content')
<br/>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-header">
                        <h1>@lang('desktop::checkout.heading.address')</h1>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="clearfix">
                        <div class="btn-group" data-toggle="buttons">
                        @foreach(Auth::guard('user')->user()->addresses as $value)
                            <label class="btn btn-primary" collapse-address-button="{{ $value->id }}" role="button">
                                <input type="radio" value="{{ $value->id }}" autocomplete="off">{{ $value->name }}
                            </label>
                        @endforeach
                        </div>
                    </div>
                    <br>
                    <div class="clearfix">
                        @foreach(Auth::guard('user')->user()->addresses as $value)
                        <div class="collapse" collapse-address-content="{{ $value->id }}">
                            <div class="well">
                                <address>
                                  <strong>{{ $value->name . '(' . $value->mobile .')' }}</strong><br>
                                  {{ $value->province . $value->city . $value->district . $value->address }}
                                </address>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-header">
                        <h1>@lang('desktop::checkout.heading.product')</h1>
                    </div>
                </div>
                <div class="panel-body">
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
            </div>            
        </div>
        <form action="{{ route('desktop.product.confirm.index') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="address_id" value="{{ Auth::guard('user')->user()->address_id }}">
            <div class="col-sm-12">
                <div class="clearfix">
                    <button class="btn btn-primary pull-right" type="submit">
                        @lang('desktop::checkout.button.checkout')
                    </button>
                <div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('vendor/desktop/js/checkout.js') }}"></script>
@endpush

@section('script')
<script>
    $('[collapse-address-button]').on('click',function(){
        var id = $(this).attr('collapse-address-button');
        $('[collapse-address-content]').collapse('hide');
        if(!$('[collapse-address-content='+ id + ']').hasClass('in')){
            $('input[name=address_id]').val(id);
            setTimeout("$('[collapse-address-content="+ id + "]').collapse('toggle');",400)
        }
    });
    @if(Auth::guard('user')->user()->address_id)
        $('[collapse-address-button={{ Auth::guard('user')->user()->address_id }}]').trigger('click');
    @endif
</script>
@endsection