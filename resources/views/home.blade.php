@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}" role="alert">
                        {{ Session::get('message') }}
                        </p>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Post</th>
                                <th >Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($posts && count($posts)>0)
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{$post->title}}</td>
                                        <td >{{$post->description}}</td>
                                        <td>
                                            <a href="{{url('/action/like')}}/{{$post->id}}" titlt="like"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>&nbsp;
                                            <a href="{{url('/action/comment')}}/{{$post->id}}" titlt="comment"><i class="fa fa-comment" aria-hidden="true"></i></a>&nbsp;
                                            <a href="{{url('/action/share')}}/{{$post->id}}" titlt="share"><i class="fa fa-share-alt" aria-hidden="true"></i></a>&nbsp;
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
