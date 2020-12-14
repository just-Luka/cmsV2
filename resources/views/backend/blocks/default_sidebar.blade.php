<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php
                $user = \App\User::find(\Illuminate\Support\Facades\Auth::id());
                $profilePic = $user->image;
                $picture = $profilePic ? 'storage/'.$profilePic : "adminLTE/img/default-avatar.png";
                ?>
                <img src="{{ asset($picture) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('backend.dashboard', ['locale'=>App::getLocale()]) }}" class="d-block">{{ ucwords($user->name) }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{ route('backend.dashboard',App::getLocale())}}" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            {{ lang('dashboard') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('backend.menus.index', App::getLocale())}}" class="nav-link">
                        <i class="nav-icon fas fa-ellipsis-v"></i>
                        <p>
                            {{ lang('menu') }}
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('backend.posts.index', App::getLocale())}}" class="nav-link">
                        <i class="nav-icon fas fa-paperclip"></i>
                        <p>
                            {{ lang('posts') }}
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('backend.categories.index', App::getLocale())}}" class="nav-link">
                        <i class="nav-icon fas fa-thumbtack"></i>
                        <p>
                            {{ lang('categories') }}
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('backend.tags.index', App::getLocale())}}" class="nav-link">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>
                            {{ lang('tags') }}
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('backend.pages.index',App::getLocale())}}" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            {{ lang('pages') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('backend.sliders.index',App::getLocale())}}" class="nav-link">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            {{ lang('sliders') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('backend.translation.index',App::getLocale())}}" class="nav-link">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                            {{ lang('translation') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>
                            {{ lang('media') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backend.media.files',App::getLocale())}}" class="nav-link">
                                <p>{{ lang('files') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('backend.media.images',App::getLocale())}}" class="nav-link">
                                <p>{{ lang('images') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{ lang('administration') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backend.users.index',App::getLocale())}}" class="nav-link">
                                <p>{{ lang('users') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('backend.roles.index',App::getLocale())}}" class="nav-link">
                                <p>{{ lang('roles') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('backend.banners.index', App::getLocale())}}" class="nav-link">
                        <i class="nav-icon fas fa-quote-right"></i>
                        <p>
                            {{ lang('banners') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            {{ lang('products') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backend.products.index',App::getLocale())}}" class="nav-link">
                                <p>{{ lang('our_list') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('backend.brands.index',App::getLocale())}}" class="nav-link">
                                <p>{{ lang('brands') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('backend.offers.index',App::getLocale())}}" class="nav-link">
                                <p>{{ lang('offers') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('backend.sales.index',App::getLocale())}}" class="nav-link">
                                <p>{{ lang('orders') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
