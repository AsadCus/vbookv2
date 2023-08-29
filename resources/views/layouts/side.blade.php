<div id="kt_aside" class="aside bg-primary" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
    <!--begin::Logo-->
    <div class="aside-logo d-none d-lg-flex flex-column align-items-center flex-column-auto py-5" id="kt_aside_logo">
        @if (auth()->user()->role_id == 1)
        <a href="/suadmin">
            {{-- <img alt="Logo" src="{{ asset('gambar/logo-vbook.png') }}" class="h-40px" /> --}}
            <img alt="Logo" src="{{ asset('gambar/logo-vbook.png') }}" class="h-40px w-40px" style="object-fit: contain" />
        </a>
        @elseif (isset(auth()->user()->company->logo))
        <a href="/admin">
            <img alt="Logo" src="/gambar/company/{{ auth()->user()->company->logo }}" class="h-40px w-40px" style="object-fit: contain" />
        </a>
        @elseif (auth()->user()->role_id == 7)
        <a href="/pantry">
            <img alt="Logo" src="/gambar/company/{{ auth()->user()->company->logo }}" class="h-40px w-40px" style="object-fit: contain" />
        </a>
        @else
        <a href="/suadmin">
            <img alt="Logo" src="{{ asset('gambar/logo-vbook.png') }}" class="h-40px w-40px" style="object-fit: contain" />
        </a>
        @endif
    </div>
    <!--end::Logo-->
    <!--begin::Nav-->
    <div class="aside-nav d-flex flex-column align-lg-center flex-column-fluid w-100 pt-5 pt-lg-0" id="kt_aside_nav">
        <!--begin::Primary menu-->
        <div id="kt_aside_menu" class="menu menu-column menu-title-gray-600 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-6" data-kt-menu="true">
            @if (auth()->user()->role_id == 2)
            <div class="menu-item">
                <a class="menu-link" href="/admin">
                    <span class="menu-link menu-center" title="Dashboards" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-bar-chart-line fs-2"></i>
                        </span>
                    </span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="/admin/manage-division">
                    <span class="menu-link menu-center" title="Manage Division" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-person-lines-fill fs-2"></i>
                        </span>
                    </span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="/admin/manage-room">
                    <span class="menu-link menu-center" title="Manage Room" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-bank2 fs-2"></i>
                        </span>
                    </span>
                </a>
            </div>
            {{-- <div class="menu-item">
                <a class="menu-link" href="/admin/merge-room">
                    <span class="menu-link menu-center" title="Merge Room" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-input-cursor fs-2"></i>
                        </span>
                    </span>
                </a>
            </div> --}}
            <div class="menu-item">
                <a class="menu-link" href="/admin/manage-user">
                    <span class="menu-link menu-center" title="Manage User" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-person-video2 fs-2"></i>
                        </span>
                    </span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="/admin/manage-receptionist">
                    <span class="menu-link menu-center" title="Manage Receptionist" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-receipt-cutoff fs-2"></i>
                        </span>
                    </span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="/admin/manage-food-categories">
                    <span class="menu-link menu-center" title="Manage Food Categories" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-tag fs-2"></i>
                        </span>
                    </span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="/admin/manage-food">
                    <span class="menu-link menu-center" title="Manage Foods" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-egg-fried fs-2"></i>
                        </span>
                    </span>
                </a>
            </div>
            {{-- <div class="menu-item">
                <a class="menu-link" href="/pantry">
                    <span class="menu-link menu-center" title="Manage Food Ordering" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-cart fs-2"></i>
                        </span>
                    </span>
                </a>
            </div> --}}
            <div class="menu-item">
                <a class="menu-link" href="/admin/report">
                    <span class="menu-link menu-center" title="List Report Booking" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-file-text fs-2"></i>
                        </span>
                    </span>
                </a>
            </div>
            <!-- <div class="menu-item">
                <a class="menu-link" href="/admin/device">
                    <span class="menu-link menu-center" title="Device" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-tv fs-2"></i>

                        </span>
                    </span>
                </a>
            </div> -->
            <div class="menu-item">
                <a class="menu-link" href="/booking">
                    <span class="menu-link menu-center" title="Create Booking Room" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-file-check fs-2"></i>
                        </span>
                    </span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{ route('seeting-admin.index')}}">
                    <span class="menu-link menu-center" title="Setting" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-gear fs-2"></i>
                        </span>
                    </span>
                </a>
            </div>
            @endif
            @if (auth()->user()->role_id == 1)
            <div class="menu-item">
                <a class="menu-link" href="/suadmin">
                    <span class="menu-link menu-center" title="Dashboards" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-bar-chart-line fs-2"></i>
                        </span>
                    </span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{ route('manage-company.index')}}">
                    <span class="menu-link menu-center" title="Manage Company" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-person-video2 fs-2"></i>
                        </span>
                    </span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="/suadmin/device">
                    <span class="menu-link menu-center" title="Device" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-tv fs-2"></i>

                        </span>
                    </span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{ route('superadmin-licence.index')}}">
                    <span class="menu-link menu-center" title="Licence Company" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-key fs-2"></i>
                        </span>
                    </span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{ route('superadmin-setting.index')}}">
                    <span class="menu-link menu-center" title="Setting" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-gear fs-2"></i>
                        </span>
                    </span>
                </a>
            </div>
            @endif
            @if (auth()->user()->role_id == 5)
            <div class="menu-item">
                <a class="menu-link" href="/receptionist">
                    <span class="menu-link menu-center" title="Dashboards" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-bar-chart-line fs-2"></i>
                        </span>
                    </span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{ route('manage-guest.index')}}">
                    <span class="menu-link menu-center" title="Manage guest" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-person-video2 fs-2"></i>
                        </span>
                    </span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{ route('manage-guest.activity')}}">
                    <span class="menu-link menu-center" title="Guest Activity" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-clock-history fs-2"></i>
                        </span>
                    </span>
                </a>
            </div>
            @endif
            @if (auth()->user()->role_id == 7)
            <div class="menu-item">
                <a class="menu-link" href="/pantry">
                    <span class="menu-link menu-center" title="Pantry" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-cart fs-2"></i>
                        </span>
                    </span>
                </a>
            </div>
            @endif
        </div>
        <!--end::Primary menu-->
    </div>
    <!--end::Nav-->

</div>