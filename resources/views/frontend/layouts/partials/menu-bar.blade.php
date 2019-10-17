<div class="menu">
    <ul>
        <li><a class="{{ activeRoute(['homepage', 'login', 'register']) }}" href="{{ route('homepage') }}"><i class="home"></i></a></li>
        <li><a class="{{ activeRoute(['videos.index','videos.show']) }}" href="{{ route('videos.index') }}"><div class="video"><i class="videos"></i><i class="videos1"></i></div></a></li>
        <li><a class="{{ activeRoute(['reviews.index']) }}" href="{{ route('reviews.index') }}"><div class="cat"><i class="watching"></i><i class="watching1"></i></div></a></li>
        <li><a href="404.html"><div class="bk"><i class="booking"></i><i class="booking1"></i></div></a></li>
        <li><a class="{{ activeRoute(['contact.index']) }}" href="{{ route('contact.index')}}"><div class="cnt"><i class="contact"></i><i class="contact1"></i></div></a></li>
    </ul>
</div>
