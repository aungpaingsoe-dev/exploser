@extends('master')

@section('title','Edit Profile')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-xl-5">
                <div class="d-flex flex-column justify-content-center text-center">
                    <div>
                        <img src="{{ asset(auth()->user()->photo) }}" id="profileImage" class="profile-img" alt="">
                        <p>{{ auth()->user()->name }}</p>
                        <p class="small text-black-50">{{ auth()->user()->email }}</p>
                    </div>
                    <div>
                        <form action="{{ route('updateProfile') }}" method="post" id="profileUpdateForm" enctype="multipart/form-data">
                            @csrf
                            <input type="file" class="d-none" name="photo" accept="image/jpeg,image/png" id="profileInput">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" id="nameInput" placeholder="name@example.com">
                                <label for="nameInput">Your Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" id="emailInput" placeholder="name@example.com">
                                <label for="emailInput">Your Email</label>
                            </div>
                            <div>
                                <button class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('script')
    <script>
        let profileImage = document.getElementById('profileImage');
        let profileInput = document.getElementById('profileInput');

        profileImage.addEventListener("click",_=>profileInput.click());
        profileInput.addEventListener('change',_=>{
            let file = profileInput.files[0];
            let reader = new FileReader();
            reader.onload = function (){
                profileImage.src = reader.result;
            }
            reader.readAsDataURL(file);
        })

    </script>
@endpush

