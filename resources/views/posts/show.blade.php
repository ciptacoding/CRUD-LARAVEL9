@extends('layout.default')

@section('title')
    Show - Laravel
@endsection

@section('contents')
  <div class="container mt-5 mb-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card border-0 shadow rounded">
          <div class="card-body">
            <img src="{{ asset('storage/posts/'.$post->image) }}" class="w-100 rounded" alt="not found">
            <hr>
            <h4>{{ $post->title }}</h4>
            <p class="tmt-3">
              {!! $post->content !!}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection