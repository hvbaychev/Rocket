<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini"></a>
            <a href="@" class="simple-text logo-normal">{{ $data->first_name . ' ' . $data->last_name }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') @endif>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Profiles Management') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'dashboard')  @endif>
                <a href="{{ route('admin.searchBd') }}">
                    <i class="tim-icons icon-user-run"></i>
                    <p>{{ __('User Management') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
