@extends('commons.fresns')

@section('title', $items['title'] ?? $group['gname'])
@section('keywords', $items['keywords'])
@section('description', $items['description'] ?? $group['description'])

@section('content')
    <main class="container-fluid">
        <div class="row mt-5 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-sm-3">
                @include('groups.sidebar')
            </div>

            {{-- Middle Content --}}
            <div class="col-sm-6">
                <div class="card shadow-sm mb-3">
                    @component('components.group.detail', compact('group'))@endcomponent
                </div>

                {{-- Post List --}}
                <article class="card clearfix">
                    {{-- Check Perm --}}
                    @if($group['mode'] == 2 && ! $group['interactive']['followStatus'])
                        <div class="text-center py-5 text-danger">
                            <i class="bi bi-info-square"></i> {{ fs_code_message('37103') }}
                        </div>
                    @else
                        @foreach($posts as $post)
                            @component('components.post.list', compact('post'))@endcomponent
                            @if (! $loop->last)
                                <hr>
                            @endif
                        @endforeach
                    @endif
                </article>

                {{-- Pagination --}}
                <div class="my-3">
                    {{ $posts->links() }}
                </div>
            </div>

            {{-- Right Sidebar --}}
            <div class="col-sm-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
