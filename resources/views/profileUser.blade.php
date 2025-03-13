<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile User</title>
    <link rel="stylesheet" href="{{ asset('css/profileUser.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .tags p {
            margin: auto;
            font-size: 12px;
        }

        .diskusi {
            margin-top: -30px !important;
            margin-bottom: -30px !important;
        }

        .diskusi h4 {
            font-size: 20px !important;
        }

        .tags {
            border-radius: 10px;
            text-align: center;
            padding: 10px 0;
            border: 1px solid #E15101;
            color: #E15101;
            background: rgba(229, 103, 33, .1);
            width: 100px;
        }

        .dataTitle {
            margin-bottom: -20px !important;
            margin-top: 35px !important;
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <x-navbar />

        <!-- Utama -->
        <main class="mt-5 ">
            <div class="row">
                <img src="../image/backdrop.png" alt="backdrop">
            </div>
            <div class="row profile">
                <div class="col-2">

                    @if ( Auth::user()->profile)
                        <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt="Profil"
                            style="width:179px;height:179px;border-radius: 100%" margin-right: 10px;" class="img-fluid border">
                        @else
                        <img src="{{asset('image/defaultProfile.png')}}" alt=""
                            style="width:179px;height:179px;border-radius: 100%" margin-right: 10px;" class="img-fluid border">
                                  @endif


                </div>
                <div class="col mt-4 ms-4">
                    <div class="names ps-5 d-flex justify-content-between pe-5 ">
                        @auth
                        <div class="name">
                            <h4 class="m-0">{{ Auth::user()->username }}</h4>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                        @endauth
                        <div class="d-flex align-items-center gap-3">

                            <a href="{{ route('profile.edit') }}">Edit profile</a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-secondary" value="LOGOUT">Logout</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            
    </div>
    </main>

    </div>

    <script src="profileUser.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>