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
                    <div class="card-header">{{ __('Data Polling') }}</div>

                    <div class="card-body table-responsive">
                        <a href="{{ route('admin.create') }}">
                            <button class="btn btn-info"> <svg class="bi pe-none me-2" width="16" height="16">
                                    <use xlink:href="#speedometer2" />
                                </svg> Add New Polling</button>
                        </a>
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">No.</th>
                                    <th scope="col">Questions</th>
                                    <th scope="col">Poll Options</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($polls as $poll)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $poll->question }}</td>
                                        <td>
                                            @foreach ($poll->options as $option)
                                                <span class="badge bg-secondary">{{ $option->name }}</span>
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('admin.polls.destroy', $poll->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center text-muted" colspan="4">Data Polling tidak tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
