@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Polling') }}</div>
                    <div class="card-body">
                        <div class="container">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            @if ($poll)
                                <h2>{{ $poll->question }}</h2>
                                
                                @if ($userVote)
                                    <p>Anda telah melakukan vote, pilihan anda :
                                        <strong>{{ $userVote->option->name }}</strong></p>
                                    <p>Terima kasih atas partisipasi anda!</p>
                                @else
                                    <form action="{{ route('poll.vote', $poll->id) }}" method="POST">
                                        @csrf
                                        @foreach ($poll->options as $option)
                                            <label>
                                                <input type="radio" name="option" value="{{ $option->id }}">
                                                {{ $option->name }}
                                            </label><br>
                                        @endforeach
                                        <button type="submit" class="btn btn-primary">Vote</button>
                                    </form>
                                @endif
                            @else
                                <p>Data Polling Tidak ada.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
