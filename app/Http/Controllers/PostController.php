<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

/*
PENJELASAN
1. PERTAMA KITA IMPORT MODEL POST = App\Models\Post;
2. MEMBUAT METHOD INDEX
3. MENGAMBIL SEMUA DATA MELALUI MODEL POST
    -function latest() digunakan untuk mengurutkan data yang ditampilkan dari yang paling terbaru
    -function paginate(5) digunakan untuk membatasi posts yang akan ditampilkan pada setiap halaman
4. MENGEMBALIKAN VIEW PADA FOLDER POSTS/INDEX.PHP SAMBIL MENGIRIMKAN DATA DARI VARIABLE $posts.
*/

class PostController extends Controller
{
  public function index()
  {
    // get posts
    $posts = Post::latest()->simplepaginate(5);

    // render view Posts
    return view('posts.index', compact('posts'));
  }

  public function create()
  {
    return view('posts.create');
  }

  public function store(Request $request)
  {
    // form validation
    $this->validate($request, [
      'image' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048',
      'title' => 'required|min:5',
      'content' => 'required|min:10'
    ]);

    // upload image
    $image = $request->file('image');
    $image->storeAs('public/posts', $image->hashName());

    // create post with eloquent
    Post::create([
      'image' => $image->hashName(),
      'title' => $request->title,
      'content' => $request->content
    ]);

    return redirect()->route('posts.index')->with(['success'=>'Data Berhasil Disimpan!']); 
  }

  public function show($id)
  { 
    // get post by id
    $post = Post::find($id);

    return view('posts.show', compact('post'));
  }

  public function edit(Post $post)
  {
    return view('posts.edit', compact('post'));
  }

  public function update(Request $request, Post $post)
  {
    // validate form
    $this->validate($request, [
      'image' => 'image|mimes:png,jpg,jpeg,gif,svg|max:2048',
      'title' => 'required|min:5',
      'content' => 'required|min:10'
    ]);

    // check if image is uploaded
    if($request->hasFile('image')) {
      // upload ne image
      $image = $request->file('image');
      $image->storeAs('public/posts', $image->hashName());
      // delete old image
      Storage::delete('public/posts'.$post->image);
      // update post with new image
      $post->update([
        'image' => $image->hashName(),
        'title' => $request->title,
        'content' => $request->content
      ]);
    }else{
      // update without image
      $post->update([
        'title' => $request->title,
        'content' => $request->content
      ]);
    }
    return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Diubah!']);
  }

  public function destroy(Post $post)
  {
    // delete image
    Storage::delete('public/posts'.$post->image);

    // delete post
    $post->delete();

    // redirect
    return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Dihapus!']);
  }
}
