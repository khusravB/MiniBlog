@extends('layouts.main')

@section('page.title', 'Просмотр')

@section('main.content')
    <x-title>
        {{ __('Просмотр поста') }}

        <x-slot name="link">
            <a href="{{ route('user.posts') }}">
                {{ __('Назад') }}
            </a>
        </x-slot>

        <x-slot name="right">
            <x-button-link href="{{ route('user.posts.edit', $post->id) }}">
                {{ __('Изменить') }}
            </x-button-link>
            <x-button-link-danger href="{{ route('user.posts.confirm-deleting', $post->id) }}">
                {{ __('Удалить') }}
            </x-button-link-danger>
        </x-slot>
    </x-title>

    <h2 class="h4">
        {{ $post->title }}
    </h2>

    <div class="small text-muted">
        {{ $post->published_at->format('d/m/Y H:i') }}
    </div>

    <div class="pt-3">
        {!! $post->content !!}
    </div>
@endsection
