@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>InstagramCrawler</h1>
        <form action="{{ route('home.search') }}" method="POST" role="form">
            <div class="form-group">
                <label for="">Tag</label>
                <input autocomplete="off" name="tag" type="text" class="form-control" id="" placeholder="tag...">
                @if(isset($errors))
                   {!! $errors->first('tag','<span class="help-block">:message</span>') !!}
                @endif
                <input type="hidden" name="_token" value="{{ csrf_token()  }}"/>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h2>Results</h2>
        <ul class="media-list">
            @if(isset($mediaList))
                @foreach($mediaList as $media)
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
                            <a href="{{ route('user.profile', $media->user->id)  }}" class="btn btn-primary">More.</a>

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