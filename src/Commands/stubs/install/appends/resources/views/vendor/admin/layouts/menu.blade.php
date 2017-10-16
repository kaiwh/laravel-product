{{-- Product --}}
<li id="menu-product">
    <a class="parent"><i class="fa fa-heart fa-fw"></i><span>@Lang('admin::product.heading.catalog')</span></a>
    <ul>
        <li><a href="{{ route('admin.product.category.index') }}">@Lang('admin::productCategory.heading.index')</a></li>
        <li><a href="{{ route('admin.product.index') }}">@Lang('admin::product.heading.index')</a></li>
        <li><a href="{{ route('admin.product.order.index') }}">@Lang('admin::productOrder.heading.index')</a></li>
    </ul>
</li>