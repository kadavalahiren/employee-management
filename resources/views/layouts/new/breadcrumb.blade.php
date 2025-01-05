<div class="row">
    <div class="col-sm-12">
        <h3 class="page-title">Coupons</h3>
        <ol class="breadcrumb bred-color">
            @if (isset($breadcrumbs))
                @foreach ($breadcrumbs as $breadcrumb)
                    <li class="breadcrumb-item">
                        @if (isset($breadcrumb['link']))
                            <!--<a href="{{ $breadcrumb['link'] }}">-->
                            <a href="{{ url('/admin') . '/' . $breadcrumb['link'] }}">
                        @endif
                        {{ $breadcrumb['name'] }}
                        @if (isset($breadcrumb['link']))
                            </a>
                        @endif
                    </li>
                @endforeach
            @endif
            {{-- <li><a href="{{ url('admin/home') }}">Dashboard</a></li>
            <li><a href="{{ url('admin/category') }}">Coupon</a></li>
            <li class="active"><strong>List</strong></li> --}}
        </ol>
    </div>
    <div class="brade-btn" style="justify-content: end;display: flex;justify-items: start;float: right;">
        @yield('add-button')
    </div>
</div>
