@extends('master')

@section('title')

    @section('content')

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit Post</h4>
                        <p class="mb-0">
                            <i class="fa-solid fa-calendar-days"></i>
                            {{ date('d M Y') }}
                        </p>
                    </div>

                    <form action="{{ route('post.update',$post->id) }}" id="profile" method="post" enctype="multipart/form-data" id="post-create">
                        @method('put')
                        @csrf
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control border @error('title') is-invalid border-danger @enderror" name="title" value="{{ $post->title }}" id="postTitle" placeholder="name@example.com">
                            <label for="postTitle">Post Title</label>
                            @error('title')
                            <p class='text-danger'>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <img src="{{ asset('storage/cover/'.$post->cover) }}" id="coverPreview" class="w-100 rounded-2 cover-img " alt="">
                            <input type="file" name='cover' id='cover' class="d-none" accept="image/jpeg,image/png">
                            @error('cover')
                            <p class='text-danger'>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-floating">
                                <textarea class="form-control @error('description') is-invalid border-danger @enderror" name='description' style="height: 350px"  placeholder="Leave a comment here" id="floatingTextarea">
                                    {{ $post->description }}
                                </textarea>
                                <label for="floatingTextarea">Share Your Experience</label>
                                @error('description')
                                <p class='text-danger'>{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                    </form>

                    {{--                    Gallery Image--}}
                    <form action="{{ route('gallery.store') }}" method="post" class="p-3" id="gallery-upload" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div>
                            <input type="file" id="gallery-input" name="galleries[]" class="d-none @error('galleries') is-invalid @enderror"  multiple>
                            @error('galleries')
                            <p class='text-danger'>{{ $message }}</p>
                            @enderror
                            @error('galleries*')
                            <p class='text-danger'>{{ $message }}</p>
                            @enderror
                        </div>
                    </form>

                     <div class="mb-4 card p-2" id="gallery">
                        <div class="d-flex">
                            <div class="border px-5 me-2 rounded-1 d-flex justify-content-center align-items-center" id="upload-ui" style="height: 150px">
                                <i class="fa-solid fa-upload"></i>
                            </div>
                            <div class="d-flex overflow-scroll" style="height: 150px">
                                @forelse($post->galleries as $gallery)
                                    <div class="img-fluid d-inline position-relative ms-1" style="width:250px;" >
                                        <img src="{{ asset('storage/gallery/'.$gallery->photo) }}" class="h-100 d-inline-block rounded-1 " alt="">
                                        <form action="{{ route('gallery.destroy',$gallery->id) }}"  class="position-absolute bottom-0 start-0" method="post" id="gallery-delete">
                                            @csrf
                                            @method('delete')
                                            @can('delete',$gallery)
                                                <button class="btn btn-link " form="gallery-delete">
                                                    <i class="fas fa-trash-alt text-danger"></i>
                                                </button>
                                            @endcan
                                        </form>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 text-end">
                        <button class="btn btn-primary btn-lg" form="post-create">
                            <i class="fa-solid fa-circle-plus"></i>
                            Update Post
                        </button>
                    </div>

                </div>
            </div>
        </div>

        @push('script')

            <script>

                let cover = document.querySelector('#cover');
                let coverPreview = document.querySelector('#coverPreview');
                let uploadUi = document.getElementById('upload-ui');
                let galleryInput = document.getElementById('gallery-input');
                let galleryUpload = document.getElementById('gallery-upload');

                coverPreview.addEventListener("click",function(){
                    cover.click();
                });

                cover.addEventListener("change",function(){
                    let reader = new FileReader();
                    reader.readAsDataURL(cover.files[0]);
                    reader.onload = function(){
                        coverPreview.src = reader.result;
                    }
                });

                uploadUi.addEventListener("click",_=>galleryInput.click());
                galleryInput.addEventListener("change",_=>galleryUpload.submit());

            </script>

        @endpush

    @endsection

