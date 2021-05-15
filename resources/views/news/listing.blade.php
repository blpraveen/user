@extends('layouts.app')

@section('title', 'List of News')

@section('content')
    @if (count($news) === 0)
        Seems like there is no news in database. Maybe it's good reason <a href="{{ route('create_news') }}">to write anything</a>?
    @else
        @foreach ($news as $row)
            <article class="news">
			    <header>
			        <a href="{{ url('/news/'.$row->id) }}"><h2>{{ $row->title }}</h2></a>
			    </header>


			    {!! $row->content !!}


			    <footer>
			        <p>
			            Published <time datetime="{{ $row->created_at }}" title="{{ $row->created_at }}">{{ $row->created_ago }}</time>
			        </p>
			    </footer>
			</article>
        @endforeach

        {{ $news->links() }}
    @endif
@endsection