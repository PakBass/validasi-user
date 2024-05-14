@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <main class="d-flex flex-nowrap">
                    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px">
                        <a href="/dashboard"
                            class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <svg class="bi pe-none me-2" width="40" height="32">
                                <use xlink:href="#bootstrap" />
                            </svg>
                            <span class="fs-4">Administrator</span>
                        </a>
                        <hr />
                        <ul class="nav nav-pills flex-column mb-auto">
                            <li class="nav-item">
                                <a href="/admin" class="nav-link text-white" aria-current="page">
                                    <svg class="bi pe-none me-2" width="16" height="16">
                                        <use xlink:href="#home" />
                                    </svg>
                                    Data User/operator
                                </a>
                            </li>
                            <li>
                                <a href="/upload" class="nav-link text-white">
                                    <svg class="bi pe-none me-2" width="16" height="16">
                                        <use xlink:href="#speedometer2" />
                                    </svg>
                                    New Polling
                                </a>
                            </li>
                        </ul>
                        <hr />
                        <div class="dropdown">
                            <a href="#"
                                class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                                    class="rounded-circle me-2" />
                                <strong>{{ Auth::user()->name }}</strong>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sign out') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </main>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('New Polling') }}</div>
                    <div class="card-body table-responsive">
                        <div class="container">
                            <h1>Create a New Poll</h1>

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form action="{{ route('admin.poll.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="question">Poll Question</label>
                                    <input type="text" class="form-control" id="question" name="question" required>
                                </div>
                                <div class="form-group">
                                    <label for="options">Poll Options</label>
                                    <div id="options">
                                        <input type="text" class="form-control mb-2" name="options[]" required>
                                        <input type="text" class="form-control mb-2" name="options[]" required>
                                    </div>
                                    <button type="button" class="btn btn-secondary" onclick="addOption()">Tambahkan pilihan baru</button>
                                    <button type="submit" class="btn btn-primary">Buat Polling</button>
                                </div>
                            </form>
                        </div>

                        <script>
                            function addOption() {
                                var optionsDiv = document.getElementById('options');
                                var input = document.createElement('input');
                                input.type = 'text';
                                input.name = 'options[]';
                                input.className = 'form-control mb-2';
                                input.required = true;
                                optionsDiv.appendChild(input);
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
