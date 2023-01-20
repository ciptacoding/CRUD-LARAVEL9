@extends('layout.default')

@section('title')
  Home - Laravel
@endsection

@section('contents')
    <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow rounded">
          <div class="card-body">
            <a href="{{ route('posts.create') }}" class="btn btn-md btn-success mb-3">Tambah Post</a>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Gambar</th>
                  <th scope="col">Judul</th>
                  <th scope="col">Konten</th>
                  <th style="width: 15%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($posts as $post)
                  <tr>
                    <td class="text-center">
                      <img src="{{ asset('storage/posts/'.$post->image) }}" class="rounded" style="width: 150px" alt="not found">
                    </td>
                    <td>
                      {{ $post->title }}
                    </td>
                    <td>
                      {!! $post->content !!}
                    </td>
                    <td class="text-center">
                      <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-dark"> <i class="fa fa-eye"></i></a>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary"> <i class="fa fa-pencil-alt"></i></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                      </form>
                    </td>
                  </tr>
                @empty
                    <div class="alert alert-danger">
                      Data Post Belum Tersedia.
                    </div>
                @endforelse
              </tbody>
            </table>
            {{ $posts->links() }} {{-- pagination --}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
    
@section('script')
  <script>
  //message with toast
    @if (session()->has('success'))
      toastr.success("{{ session('success') }}", "Berhasil!")
    @elseif (session()->has('error'))
      toastr.error("{{ session('error') }}", "Gagal!")
    @endif
  </script>
@endsection
  
