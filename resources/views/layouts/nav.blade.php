<div class="sidebar">
    <div>
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('public/img/user.webp') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class-->


                <li
                    class="nav-item has-treeview  {{ request()->route()->getName() == 'dashboard.departs' ||request()->route()->getName() == 'dashboard.users'? 'menu-open': '' }}">
                    <a href="#"
                        class="nav-link {{ request()->route()->getName() == 'dashboard.departs' ||request()->route()->getName() == 'dashboard.users'? 'active': '' }}">
                        <i class="nav-icon fa fa-cogs"></i>
                        <p>
                            الإعدادات
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.settings') }}"
                                class="nav-link  {{ request()->route()->getName() == 'dashboard.settings'? 'active': '' }}"><i
                                    class="fa fa-list-ul"></i> إعدادات الموقع </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.departs') }}"
                                class="nav-link  {{ request()->route()->getName() == 'dashboard.departs'? 'active': '' }}"><i
                                    class="fa fa-list-ul"></i> أسماء الأقسام وصورها </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.departs_second') }}"
                                class="nav-link  {{ request()->route()->getName() == 'dashboard.departs_second'? 'active': '' }}"><i
                                    class="fa fa-list-ul"></i> الأقسام الاضافية </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.users') }}"
                                class="nav-link  {{ request()->route()->getName() == 'dashboard.users'? 'active': '' }}"><i
                                    class="fa fa-users"></i> المستخدمين </a>
                        </li>

                    </ul>
                </li>


                <li
                    class="nav-item has-treeview  {{ request()->route()->getName() == 'dashboard.country' ||request()->route()->getName() == 'dashboard.tags' ||request()->route()->getName() == 'dashboard.units' ||request()->route()->getName() == 'dashboard.messages' ||request()->route()->getName() == 'dashboard.posts'? 'menu-open': '' }}">
                    <a href="#"
                        class="nav-link {{ request()->route()->getName() == 'dashboard.country' ||request()->route()->getName() == 'dashboard.tags' ||request()->route()->getName() == 'dashboard.units' ||request()->route()->getName() == 'dashboard.messages' ||request()->route()->getName() == 'dashboard.posts'? 'active': '' }}">
                        <i class="nav-icon fa fa-building"></i>
                        <p>
                            العقارات
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.country') }}"
                                class="nav-link  {{ request()->route()->getName() == 'dashboard.country'? 'active': '' }}"><i
                                    class="fa fa-city"></i> الدول </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.category') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.category'? 'active': '' }}"><i
                                    class="fa fa-list"></i> الأقسام الرئيسية </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.subcategory') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.subcategory'? 'active': '' }}"><i
                                    class="fa fa-list"></i> الأقسام الفرعية </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.units') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.units'? 'active': '' }}"><i
                                    class="fa fa-arrows-alt-h"></i> وحدات القياس </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ route('dashboard.posts') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.posts'? 'active': '' }}"><i
                                    class="fa fa-address-card"></i> الإعلانات </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.messages') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.messages'? 'active': '' }}"><i
                                    class="fa fa-envelope"></i> الرسائل </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.clim.all') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.clim.all'? 'active': '' }}"><i
                                    class="fa fa-envelope"></i> البلاغات </a>
                        </li>

                    </ul>
                </li>

                <li
                    class="nav-item has-treeview  {{ request()->route()->getName() == 'dashboard.weathers' ||request()->route()->getName() == 'dashboard.weathers'? 'menu-open': '' }}">
                    <a href="#"
                        class="nav-link {{ request()->route()->getName() == 'dashboard.weathers' ||request()->route()->getName() == 'dashboard.weathers'? 'active': '' }}">
                        <i class="nav-icon fa fa-cloud"></i>
                        <p>
                            الطقس
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.weathers') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.weathers'? 'active': '' }}"><i
                                    class="fa fa-sun"></i> حالة الطقس </a>
                        </li>


                    </ul>
                </li>

                <li
                    class="nav-item has-treeview  {{ request()->route()->getName() == 'dashboard.currancies' ||request()->route()->getName() == 'dashboard.exchange'? 'menu-open': '' }}">
                    <a href="#"
                        class="nav-link {{ request()->route()->getName() == 'dashboard.currancies' ||request()->route()->getName() == 'dashboard.exchange'? 'active': '' }}">
                        <i class="nav-icon fa fa-coins"></i>
                        <p>
                            العملات
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.showTitle') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.showTitle'? 'active': '' }}"><i
                                    class="fa fa-money-bill-alt"></i> ترويسة صفحة العملات </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.editTablesTitle') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.editTablesTitle'? 'active': '' }}"><i
                                    class="fa fa-money-bill-alt"></i>أسماء الجداول</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.currancies') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.currancies'? 'active': '' }}"><i
                                    class="fa fa-money-bill-alt"></i> العملات </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.exchange') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.exchange'? 'active': '' }}"><i
                                    class="fa fa-exchange-alt"></i> أسعار الصرف </a>
                        </li>


                    </ul>
                </li>



                <li
                    class="nav-item has-treeview  {{ request()->route()->getName() == 'dashboard.analize'? 'menu-open': '' }}">
                    <a href="#"
                        class="nav-link {{ request()->route()->getName() == 'dashboard.analize'? 'active': '' }}">
                        <i class="nav-icon fa fa-coins"></i>
                        <p>
                            الإحصائيات
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.analize') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.currancies'? 'active': '' }}"><i
                                    class="fa fa-money-bill-alt"></i> الإحصائيات </a>
                        </li>




                    </ul>
                </li>

                <li
                    class="nav-item has-treeview  {{ request()->route()->getName() == 'dashboard.materials' ||request()->route()->getName() == 'dashboard.material.exchange'? 'menu-open': '' }}">
                    <a href="#"
                        class="nav-link {{ request()->route()->getName() == 'dashboard.materials' ||request()->route()->getName() == 'dashboard.material.exchange'? 'active': '' }}">
                        <i class="nav-icon fa fa-atom"></i>
                        <p>
                            المعادن
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.materials') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.materials'? 'active': '' }}"><i
                                    class="fa fa-hammer"></i> المعادن </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.material.exchange') }}"
                                class="nav-link {{ request()->route()->getName() == 'dashboard.material.exchange'? 'active': '' }}"><i
                                    class="fa fa-business-time"></i> أسعار المعادن </a>
                        </li>


                    </ul>
                </li>


                <li
                    class="nav-item has-treeview  {{ request()->route()->getName() == 'dashboard.categoryQuiz' ||request()->route()->getName() == 'dashboard.askQuiz' ||request()->route()->getName() == 'dashboard.answerQuiz'? 'menu-open': '' }}">
                    <a href="#"
                        class="nav-link {{ request()->route()->getName() == 'dashboard.categoryQuiz' ||request()->route()->getName() == 'dashboard.askQuiz' ||request()->route()->getName() == 'dashboard.answerQuiz'? 'active': '' }}">
                        <i class="nav-icon fa fa-trophy"></i>
                        <p>
                            المسابقات
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.categoryQuiz') }}"
                                class="nav-link  {{ request()->route()->getName() == 'dashboard.categoryQuiz'? 'active': '' }}">
                                <i class="fa fa-list nav-icon"></i>
                                <p>الأقسام</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard.systems') }}"
                        class="nav-link {{ request()->route()->getName() == 'dashboard.systems'? 'active': '' }}"><i
                            class="fa fa-swatchbook"></i> القوانين </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('dashboard.abouts') }}"
                        class="nav-link {{ request()->route()->getName() == 'dashboard.abouts'? 'active': '' }}">
                        <i class="fa fa-info-circle"></i>
                        <p>عن العراق</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard.info') }}" class="nav-link">
                        <i class="fa fa-info"></i>
                        <p>هل تعلم</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard.logout') }}" class="nav-link">
                        <i class="fa fa-sign-out-alt"></i>
                        <p>تسجيل الخروج</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
