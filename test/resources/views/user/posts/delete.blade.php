@extends('layouts.main')

@section('page.title', 'Удалить пост')

@section('main.content')

    <style>
        .custom-link {
            text-decoration: none; /* Remove underline */
            color: inherit; /* Preserve the text color */
        }
    </style>

    <x-title>
        {{ __('Удалить пост') }}

        <x-slot name="link">
            <a href="{{ route('user.posts.show', $post->id) }}">
                {{ __('Назад') }}
            </a>
        </x-slot>
    </x-title>


    <h4>{{ __('Вы действительно отите удалить пост: ') }} <br>
        <a  href="{{ route('user.posts.show', $post->id) }}" class=" text-primary custom-link"> {{ $post->title }} </a>
        ?
     </h4>

    <br>

    <div class="d-grid gap-8 d-md-block">
        <form method="POST" action="{{ route('user.posts.delete', $post->id) }}">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <a class="btn btn-primary " href="{{ route('user.posts.show', $post->id) }} type="button">{{ __('Нет, я передумал') }}</a>

            <button class="btn btn-danger ms-2" type="submit">{{ __('Да, удалить пост') }}</button>
        </form>
    </div>
@endsection
