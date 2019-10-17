<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
        <div class="pull-left image">
            <img {{Auth::user()->image ? $url = Auth::user()->image : $url = config('image.default_image')}} src="{{ asset($url) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p><a href="{{ route('users.show', Auth::user()->access_token) }}">{{Auth::user()->fullname}}</a></p>
        </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">{{ __('Main Navigation') }}</li>

            <li class="{{ activeRoute(['home.index']) }}">
                <a href="/">
                <i class="fa fa-home" aria-hidden="true"></i> <span>{{ __('Trang chủ') }}</span>
                </a>
            </li>

            <li class="{{ activeRoute(['cities.index']) }}">
                <a href="{{ route('cities.index') }}">
                <i class="fa fa-institution" aria-hidden="true"></i>
                <span>{{ __('Cities') }}</span>
                <span class="pull-right-container">
                    <small class="label pull-right bg-aqua">{{ getCount(App\Models\City::class) }}</small>
                </span>
                </a>
            </li>

            <li class="{{ activeRoute(['cinemas.index', 'cinemas.create', 'cinemas.edit']) }}">
                <a href="{{ route('cinemas.index') }}">
                <i class="fa fa-tv" aria-hidden="true"></i>
                <span>{{ __('Cinemas') }}</span>
                <span class="pull-right-container">
                    <small class="label pull-right bg-green">{{ getCount(App\Models\Cinema::class) }}</small>
                </span>
                </a>
            </li>

            <li class="{{ activeRoute(['films.index', 'films.create', 'films.edit']) }}">
                <a href="{{route('films.index')}}">
                <i class="fa fa-film" aria-hidden="true"></i>
                <span>{{ __('Films') }}</span>
                <span class="pull-right-container">
                    <small class="label pull-right bg-blue">{{ getCount(App\Models\Film::class) }}</small>
                </span>
                </a>
            </li>

            <li class="{{ activeRoute(['rooms.index', 'rooms.create', 'rooms.edit']) }}">
                <a href="{{route('rooms.index')}}">
                <i class="fa fa-book" aria-hidden="true"></i>
                <span>{{ __('Rooms') }}</span>
                <span class="pull-right-container">
                    <small class="label pull-right bg-purple">{{ getCount(App\Models\Room::class) }}</small>
                </span>
                </a>
            </li>

            <li class="{{ activeRoute(['seats.index', 'seats.create', 'seats.edit']) }}">
                <a href="{{route('seats.index')}}">
                <i class="fa fa-group" aria-hidden="true"></i>
                <span>{{ __('Seats') }}</span>
                <span class="pull-right-container">
                    <small id="total-categories" class="label pull-right bg-gray">{{ getCount(App\Models\Seat::class) }}</small>
                </span>
                </a>
            </li>

            <li class="{{ activeRoute(['schedules.index', 'schedules.create', 'schedules.update']) }}">
                <a href="{{route('schedules.index')}}">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                <span>{{ __('Schedules') }}</span>
                <span class="pull-right-container">
                    <small id="total-categories" class="label pull-right bg-fuchsia">{{ getCount(App\Models\Schedule::class) }}</small>
                </span>
                </a>
            </li>

            <li class="{{ activeRoute(['users.index', 'users.create', 'users.edit']) }}">
                <a href="{{ route('users.index') }}">
                <i class="fa fa-male" aria-hidden="true"></i>
                <span>{{ __('Users') }}</span>
                <span class="pull-right-container">
                    <small id="total-categories" class="label pull-right bg-orange">{{ getCount(App\Models\User::class) }}</small>
                </span>
                </a>
            </li>

            <li class="{{ activeRoute(['bookings.index']) }}">
                <a href="{{ route('bookings.index') }}">
                <i class="fa fa-bar-chart-o" aria-hidden="true"></i>
                <span>{{ __('Bookings') }}</span>
                <span class="pull-right-container">
                    <small id="total-categories" class="label pull-right bg-yellow">{{ getCount(App\Models\Borrowing::class) }}</small>
                </span>
                </a>
            </li>
        </ul>
    </section>
</aside>
