@extends('master')

@section('title','Edit Profile')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-xl-5">
                <div class="d-flex flex-column justify-content-center text-center">
                    <div>
                        <img src="{{ asset(auth()->user()->photo) }}" i class="profile-img" alt="">
                        <p>{{ auth()->user()->name }}</p>
                        <p class="small text-black-50">{{ auth()->user()->email }}</p>
                    </div>
                    <div>
                        <form action="{{ route('updatePassword') }}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <input type="file" class="d-none" name="photo" accept="image/jpeg,image/png" >

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password"  placeholder="name@example.com">
                                <label for="emailInput">Current Password</label>
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"  placeholder="name@example.com">
                                <label for="emailInput">New Password</label>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  placeholder="name@example.com">
                                <label for="emailInput">Confirm Password</label>
                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <button class="btn btn-primary">Update Password</button>
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

    </script>
@endpush

