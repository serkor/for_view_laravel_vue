@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="bs-example">
                            <h2 class="sub-header">@lang('form.edit') - {{$article->name}}</h2>
                            <div class="table-responsive">
                                {!! Form::model($article,['method' => 'PUT', 'files' => TRUE, 'route' => ['update_admin_blog_article', $article->id]])!!}
                                <div class="col-md-6 form-group">
                                    {!! Form::label('name', trans('blog_article.name'),['class' => 'control-label'])!!}
                                    {!! Form::text('name', old('name'), array_merge(['class' =>'form-control'])) !!}
                                </div>
                                <div class="col-md-6 form-group">
                                    {!! Form::label('description', trans('blog_article.description'),['class' => 'control-label'])!!}
                                    {!! Form::textarea('description', old('description'), array_merge(['class' =>'form-control','required'])) !!}
                                </div>
                                <div class="form-group col-md-6">
                                    {!! Form::label('category_id', trans('blog_article.blog_category_id'),['class' => 'control-label']) !!}
                                    {!! Form::select('blog_category_id', $categories, old('blog_category_id'), array_merge(['class'=>'form-control', 'required'])) !!}
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        @if($article->image ?? [])
                                            <img id="blah" class="img-thumbnail logo_service"
                                                 src="{{URL::to('/public')}}/upload/{{$article->image}}" alt="logo">
                                        @else
                                            <img id="blah" class="img-thumbnail logo_service"
                                                 src="{{ asset('public/images/service_no.png') }}" alt="logo">
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="file">@lang('blog_article.preview')</label>
                                        <input id="file" class="form-control-file" type="file" name="image">
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::submit(trans('form.save'),array_merge(['class' => 'btn btn-primary'] )) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#file").change(function () {
            readURL(this);
        });
    </script>
@endsection
