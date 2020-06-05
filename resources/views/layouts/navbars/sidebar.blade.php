<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('SD') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('School Dashboard') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="tim-icons icon-single-02" ></i>
                    <span class="nav-link-text" >{{ __('Student') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit')  }}">
                                <i class="tim-icons icon-pencil"></i>
                                <p>{{ __('User Profile') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'personne') class="active " @endif>
                            <a href="{{ route('pages.personne')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Student Management') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'category') class="active " @endif>
                            <a href="{{ route('pages.category')  }}">
                                <i class="tim-icons icon-badge"></i>
                                <p>{{ __('Categorie') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @if ($pageSlug == 'classe') class="active " @endif>
                <a href="{{ route('pages.classe') }}">
                    <i class="tim-icons icon-bell-55"></i>
                    <p>{{ __('Classes') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'session') class="active " @endif>
                <a href="{{ route('pages.session') }}">
                    <i class="tim-icons icon-puzzle-10"></i>
                    <p>{{ __('Sessions') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'subject') class="active " @endif>
                <a href="{{ route('pages.subject') }}">
                    <i class="tim-icons icon-puzzle-10"></i>
                    <p>{{ __('Subjects') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'teacher_subject') class="active " @endif>
                <a href="{{ route('pages.teacher_subject') }}">
                    <i class="tim-icons icon-puzzle-10"></i>
                    <p>{{ __('Teacher subject') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'timetable') class="active " @endif>
                <a href="{{ route('pages.timetable') }}">
                    <i class="tim-icons icon-align-center"></i>
                    <p>{{ __('Gestion Emplois') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
