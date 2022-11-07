@extends('layouts.default')
@section('content')
  <section class="content-header">
    <h1>
      {{langMessage('dashboard')}}
      <small>{{langMessage($pageHeading)}}</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> {{langMessage('dashboard')}}</a></li>
      <li class="active">{{langMessage($pageHeading)}}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{langMessage($pageHeading)}}</h3>
          </div>
          <!-- /.box-header -->
    <div class="box-body">
      @if($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{langMessage($message)}}</p>
      </div>
      @endif
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{langMessage($error)}}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form method="post" action="{{ route('video.update', ['video'=>$video->id,'locale'=>app()->getLocale()]) }}" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
        <div class="col-md-6">
          <div class="form-group">
            <label for="petrol_saved">{{langMessage('Video Title')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
            <input type="text" name="title" value="{{ $video->title }}" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Video Title')}}" />
            @error('title')
                <span class="text-danger" role="alert">
                    <strong>{{langMessage($message)}}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="petrol_saved">{{langMessage('Video Sub Title')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
            <input type="text" name="sub_title" value="{{ $video->sub_title }}" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Video Sub Title')}}" />
            @error('sub_title')
                <span class="text-danger" role="alert">
                    <strong>{{langMessage($message)}}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="petrol_saved">{{langMessage('Content')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
            <textarea name="content" rows="8" cols="80" class="form-control textarea border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="@lang('enter your content')">{{ $video->content }}</textarea>
            @error('content')
                <span class="text-danger" role="alert">
                    <strong>{{langMessage($message)}}</strong>
                </span>
            @enderror
          </div>
          <div class="checkbox">
          <label>
            <input type="checkbox" name="is_feature" value="1" {{$video->is_feature == '1' ? 'checked' : null}}><label> <b>{{langMessage('Featured')}}</b></label>
          </label>
        </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="petrol_saved">{{langMessage('Status')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
            <select class="form-control" name="status">
              <option value="1" {{$video->status == '1' ? 'selected' : '' }}>{{langMessage('Active')}}</option>
              <option value="2" {{$video->status == '2' ? 'selected' : '' }}>{{langMessage('Inactive')}}</option>
            </select>
            @error('status')
                <span class="text-danger" role="alert">
                    <strong>{{langMessage($message)}}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="petrol_saved">{{langMessage('Category / Playlist')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
            <select class="form-control" name="category_id">
              @if(!$categories->isEmpty())
                <option value="">{{langMessage('Select')}}</option>
                @foreach($categories as $category)
                  <option value="{{$category->id}}" {{ $video->category_id == $category->id ? 'selected' : '' }}>{{langMessage($category->title)}}</option>
                @endforeach
              @else
                  <option value="">{{langMessage('Empty')}}</option>
              @endif
            </select>
            @error('category_id')
                <span class="text-danger" role="alert">
                    <strong>{{langMessage($message)}}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="petrol_saved">{{langMessage('Tag')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
            <select class="form-control select2" multiple="multiple" name="tags_id[]" data-placeholder="{{langMessage('Select')}}">
              @if(!$tags->isEmpty())
                @foreach($tags as $tag)
                  <option value="{{$tag->id}}" {{ in_array($tag->id,$video->tags)? 'selected' : '' }}>{{langMessage($tag->title)}}</option>
                @endforeach
              @else
                  <option value="">@lang(strtolower('Empty'))</option>
              @endif
            </select>
            @error('tags_id')
                <span class="text-danger" role="alert">
                    <strong>{{langMessage($message)}}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="petrol_saved">{{langMessage('Youtube Link Id')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
            <input type="text" name="link_id" value="{{ $video->link_id }}" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Youtube Link Id')}}" />
            @error('link_id')
                <span class="text-danger" role="alert">
                    <strong>{{langMessage($message)}}</strong>
                </span>
            @enderror
          </div>
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">{{langMessage('Video Preview')}}</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $video->link_id }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">{{langMessage('Upload Image')}}</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
              <input type="file" name="image" class="form-control">
              @error('image')
                  <span class="text-danger" role="alert">
                      <strong>{{langMessage($message)}}</strong>
                  </span>
              @enderror
              </div>
              <div class="form-group">
                <img src="{{asset(env('AWS_URL').'/images/posts/video/listing/'.$video->image) }}" alt="">
                {{-- <img src="{{asset('images/posts/video/listing/'.$video->image)}}" alt=""> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="form-group col-sm-12 text-center">
        <input class="btn btn-primary" name="add" type="submit" value="{{langMessage('update')}}">
        </div>
    </form>
    </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
@stop
@section('pagejs')
<script>
$(document).ready(function(){
  $('.select2').select2();
  $('.textarea').wysihtml5();
});
</script>
@stop
