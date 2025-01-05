@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    Account Information
                </div>
                <div class="card-body">
                    @if(session('xtream_user_info'))
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Username:</strong> {{ session('xtream_user_info')['username'] }}</p>
                                <p><strong>Status:</strong> {{ session('xtream_user_info')['status'] }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Active Connections:</strong> {{ session('xtream_user_info')['active_cons'] }}/{{ session('xtream_user_info')['max_connections'] }}</p>
                                <p><strong>Expiry Date:</strong> {{ date('Y-m-d H:i:s', session('xtream_user_info')['exp_date']) }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Created:</strong> {{ date('Y-m-d H:i:s', session('xtream_user_info')['created_at']) }}</p>
                                <p><strong>Trial:</strong> {{ session('xtream_user_info')['is_trial'] ? 'Yes' : 'No' }}</p>
                            </div>
                        </div>
                    @else
                        <p>No account information available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Live TV Section -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    Live TV
                    <a href="{{ route('live.tv') }}" class="btn btn-sm btn-primary float-end">View All</a>
                </div>
                <div class="card-body">
                    @if(isset($liveChannels) && !empty($liveChannels))
                        <div class="row">
                            @foreach(array_slice((array)$liveChannels, 0, 6) as $channel)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        @if(isset($channel['stream_icon']) && $channel['stream_icon'])
                                            <img src="{{ $channel['stream_icon'] }}" class="card-img-top" alt="{{ $channel['name'] }}">
                                        @endif
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $channel['name'] }}</h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>No live channels available.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Movies Section -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    Movies
                    <a href="{{ route('movies') }}" class="btn btn-sm btn-primary float-end">View All</a>
                </div>
                <div class="card-body">
                    @if(isset($movies) && !empty($movies))
                        <div class="row">
                            @foreach(array_slice((array)$movies, 0, 6) as $movie)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        @if(isset($movie['stream_icon']) && $movie['stream_icon'])
                                            <img src="{{ $movie['stream_icon'] }}" class="card-img-top" alt="{{ $movie['name'] }}">
                                        @endif
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $movie['name'] }}</h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>No movies available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Categories Section -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="row">
                        <!-- Live TV Categories -->
                        <div class="col-md-6">
                            <h5>Live TV Categories</h5>
                            @if(isset($liveCategories) && !empty($liveCategories))
                                <ul class="list-group">
                                    @foreach(array_slice((array)$liveCategories, 0, 5) as $category)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $category['category_name'] }}
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $category['category_id'] }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No live TV categories available.</p>
                            @endif
                        </div>

                        <!-- VOD Categories -->
                        <div class="col-md-6">
                            <h5>Movie Categories</h5>
                            @if(isset($vodCategories) && !empty($vodCategories))
                                <ul class="list-group">
                                    @foreach(array_slice((array)$vodCategories, 0, 5) as $category)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $category['category_name'] }}
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $category['category_id'] }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No movie categories available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection