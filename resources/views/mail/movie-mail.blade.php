@component('mail::message')

{{ ucwords($fav_movie->movie_name) }} is added to your Favorite Movie list. It is released on {{ Carbon::parse($fav_movie->released_date)->format('d M, Y') }}

Thanks,<br>
Laravel Demo
@endcomponent
