<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1 ps ps--active-y bule_theme_sidebar">
        <!-- Dashboards -->
        <li class="menu-item active open">
        </li>

        <li class="{{ request()->is('employees*') ? 'active' : '' }} menu-item">
            <a href="{{ url('employees') }}" class="menu-link">
                <div data-i18n="Employees">Employees</div>
            </a>
        </li>
    </ul>
    <div class="ps__rail-x" style="left: 0px; bottom: -104px;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 104px; right: 4px; height: 328px;">
        <div class="ps__thumb-y" tabindex="0" style="top: 79px; height: 249px;"></div>
    </div>
    <div class="ps__rail-x" style="left: 0px; bottom: -104px;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 104px; right: 4px; height: 328px;">
        <div class="ps__thumb-y" tabindex="0" style="top: 79px; height: 249px;"></div>
    </div>
    </ul>
</aside>
