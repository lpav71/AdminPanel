@extends('layouts.admin_layout')

@section('title', 'Добавить статью')
@section('content')
<style>
    section.content {
        max-width: 100% !important;
        width: 100% !important;
    }
    section.content .container-fluid {
        max-width: 100% !important;
        width: 100% !important;
        padding-left: 15px;
        padding-right: 15px;
        margin-left: 0 !important;
        margin-right: 0 !important;
    }
    section.content .row {
        margin-left: 0 !important;
        margin-right: 0 !important;
        width: 100% !important;
    }
    section.content .col-lg-12 {
        padding-left: 15px;
        padding-right: 15px;
        max-width: 100% !important;
        width: 100% !important;
        flex: 0 0 100% !important;
    }
    section.content .card {
        max-width: 100% !important;
        width: 100% !important;
    }
</style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить статью</h1>
                </div>
            </div>
        @if(session('success'))<!-- Зеленая полоска -->
            <div class="alert alert-success col-lg-12" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-check"></i>{{session('success')}} </h4>
            </div>
            @endif
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <form action="{{route('post.store')}}" method="POST">
                        @csrf <!-- какая-то защита -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Название статьи </label>
                                    <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="Введите название статьи" required>
                                </div>
                                <div class="form-group">

                                    <label>Выберите категрию</label>
                                            <select name="categories_id" class="form-control" required>
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->title}}</option>
                                                @endforeach
                                            </select>
                                </div>
                            <div class="form-group" >
                                    <textarea  id="editor" name="text" class="editor">
                                    </textarea>
                            </div>
                            <div class="form-group">
                                <label for="feature_image">Изображение статьи</label>
                                <div id="image_preview" style="display: none; margin-bottom: 10px;">
                                    <img src="" alt="Превью" style="max-width: 200px; max-height: 150px;">
                                </div>
                                <input type="text" id="feature_image" class="form-control"  name="img" value="" readonly required>
                                <a href="" class="popup_selector btn btn-primary mt-2"  data-inputid="feature_image">Выбрать изображение</a>
                            </div>
                    </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
