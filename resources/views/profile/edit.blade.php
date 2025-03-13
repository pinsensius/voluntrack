<x-app-layout>

    <head>
        <link rel="stylesheet" href="{{ asset('css/userInfo.css') }}">
        <style>
            * {
                color: black;
            }
        </style>
    </head>


    <div class="row mt-5">
        <img src="../image/backdrop.png" alt="backdrop">
    </div>
    <div class="row profile">
        <div class="col-2">
            @if ( Auth::user()->profile)
            <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt="Profil"
                style="width:179px;height:179px;border-radius: 100%; margin-right: 10px;" class="img-fluid border">
            @else
            <img src="{{asset('image/defaultProfile.png')}}" alt="" style="width:179px;height:179px;border-radius: 100%
                margin-right: 10px;" class="img-fluid border">
                      @endif
        </div>
        <div class="col mt-4">
            <div class="names ps-5 ms-4 d-flex justify-content-between pe-4 ">
                @auth
                <div class="name">
                    <h4 class="m-0">{{ Auth::user()->username }}</h4>
                    <p>{{ Auth::user()->email }}</p>
                </div>
                @endauth
                <div class="edit">
                    <a class="batalEdit" href="{{ route('profileUser') }}">Kembali</a>
                </div>
            </div>
        </div>
    </div>


    <div class="row gap-5 row1">
        <div class="col-4 left">
            <h5>Profil Publik</h5>
            <p class="mt-3" style="color: #999999;">Perubahan ini akan terlihat di profil anda.</p>
        </div>
        <div class="col-5 right">

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>




        </div>
    </div>
    <hr>
    <div class="row row2">
        <div class="col-4 left">
            <h5>Ganti Passowrd</h5>
            <p class="mt-3" style="color: #999999;">Perubahan ini tidak akan terlihat di profil anda.</p>
        </div>
        <div class="col-5 right d-flex">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row row2">
        <div class="col-4 left">
            <h5>Hapus Akun</h5>
            <p class="mt-3" style="color: #999999;">Apakah anda yakin ingin menghapus akun?</p>
        </div>
        <div class="col-5 right d-flex">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>


</x-app-layout>