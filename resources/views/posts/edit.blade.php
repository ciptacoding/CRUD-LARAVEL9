@extends('layout.default')

@section('title')
    Update - Laravel
@endsection

@section('contents')
  <div class="container mt-5 mb-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow rounded">
          <div class="card-body">

            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              
              <div class="form-group">
                <label for="image" class="font-weight-bold">Gambar</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" >
                {{-- error message --}}
                @error('image')
                  <div class="alert alert-danger mt-2">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="title" class="font-weight-bold">Judul</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title', $post->title) }}" placeholder="Masukkan Judul Post">
                {{-- error message --}}
                @error('title')
                  <div class="alert alert-danger mt-2">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="content" class="font-weight-bold">Konten</label>
                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="5" placeholder="Masukan Konten Post">{{ old('content', $post->content) }}</textarea>
                {{-- error message --}}
                @error('content')
                  <div class="alert alert-danger mt-2">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              
              <button type="submit" class="btn btn-md btn-primary">Simpan</button>
              <button type="reset" class="btn btn-md btn-warning">Reset</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
  
@section('script')
<script>
  CKEDITOR.replace('content');
</script>
@endsection
