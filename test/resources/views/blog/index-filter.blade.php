@extends('layouts.main')

@section('page.title', 'Наш блог')

@section('main.content')
    <x-title>
        {{ __('Списки постов') }}

        <x-slot name="right">
            <x-button-link href="{{ route('blog') }}">
                {{ __('Сбросить фильтры') }}
            </x-button-link>
        </x-slot>
    </x-title>

    @include('blog.filter')

    @if(empty($posts))
        {{ __('Нет ни одного поста.') }}
    @else
        <div class="row">
            @foreach($posts as $post)

                <div class="col-12 col-md-4">
                    <x-post.card :post="$post" />
                </div>
            @endforeach
        </div>

        {{ $posts->links() }}

    @endif
@endsection
