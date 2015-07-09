@extends('layouts.master')
@section('title', ' - ' . $user->full_name)
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="span3 well">
                <a href="" class="btn btn-primary" onclick="window.history.back();return false;">Back</a>
                <center>
                    <img src="{{ $user->profile_picture }}" name="aboutme" width="140" height="140" class="img-circle">
                    <h3>{{ $user->username }}</h3>
                    <em>{{ $user->bio }}</em>
                </center>
            </div>
            <h1>Items</h1>
            <ul class="media-list">
                @if(isset($userMediaList))
                    @foreach($userMediaList as $media)
                        <li class="media">
                            <figure class="media-left">
                                <a  target="_blank" href="{{ $media->link }}"><img class="media-object" src="{{$media->images->thumbnail->url}}" alt=""/></a>
                            </figure>
                            <div class="media-body">
                                <a data-toggle="tooltip" title="View user info." href="{{ route('user.profile', $media->user->id)  }}">
                                    <h4 class="media-heading">{{$media->user->username}}</h4>
                                </a>
                                @if(isset($media->caption))
                                    <p>
                                        {{$media->caption->text}}
                                    </p>
                                @endif
                                @if(isset($media->location) && !is_null($media->location))
                                    @if( isset($media->location->latitude) && isset($media->location->longitude) )
                                    <button type="button" class="btn btn-success btnViewMap" data-toggle="modal" data-target="#mapView"
                                            data-latitude="{{ $media->location->latitude }}"
                                            data-longitude="{{ $media->location->longitude }}"
                                            data-location-name="{{ (isset($media->location->name)) ? $media->location->name : "No location name." }}">View Location</button>
                                    @endif
                                @endif
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
@endsection