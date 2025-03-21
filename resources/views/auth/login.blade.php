@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xl-8 d-none d-xl-flex">
                <div class="auth-full-page position-relative">
                    <img src="{{ asset('images/cmufountain.jpeg') }}" class="auth-bg" alt="Unsplash">
                    <div class="auth-quote">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" data-lucide="quote" class="lucide lucide-quote">
                            <path
                                d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z">
                            </path>
                            <path
                                d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z">
                            </path>
                        </svg>
                        <figure>
                            <blockquote>
                                <p>Central Mindanao University</p>
                            </blockquote>
                            <figcaption>
                                —&nbsp;The Academic Paradise of the South
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="auth-full-page d-flex p-4 p-xl-5">
                    <div class="d-flex flex-column w-100 h-100">
                        <div class="auth-form">

                            <div class="text-center">
                                <div class="text-center">
                                    <img src="{{ asset('images/cmulogo.png') }}" class="img-fluid rounded-circle"
                                        alt="CMU Logo" width="120" height="120" />
                                    <h1 class="h2">Budget and Procurement System</h1>
                                    <p class="lead">
                                        Login
                                    </p>
                                </div>
                            </div>

                            <div class="mb-3">

                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input class="form-control form-control-lg  @error('email') is-invalid @enderror"
                                            type="email" name="email" placeholder="Enter your email" required
                                            autofocus />
                                        <small>
                                            @error('email')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input class="form-control form-control-lg  @error('password') is-invalid @enderror"
                                            type="password" name="password" placeholder="Enter your password" required />
                                        <small>
                                            @error('password')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </small>
                                    </div>

                                    <div class="d-grid gap-2 mt-3">
                                        <button class="btn btn-lg btn-success" type="submit">Sign in</button>
                                    </div>


                                    <div class="text-center">
                                        <p class="mb-1 mt-3">
                                            <a href="/cmu-bac"><i class="fas fa-arrow-left"></i>{{ __(' Back to home') }}</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="mb-0">
                                © 2025 - <a href="/" style="color: #02681e">CMU | Software Development Department</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
