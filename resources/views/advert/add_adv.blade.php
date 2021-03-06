@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 style="font-size:20px; margin-bottom:15px;">Объявления подрядчиков</h3>
                    <div>
                        <ul style="margin:5px 0px 10px -35px;">
                        </ul>
                    </div>
                    <a href="{{url('adverts/my')}}" class="btn btn-default">
                        <i class="fa fa-star"></i> Мои объявления
                    </a>
                    <a href="{{url('adverts/all')}}" class="btn btn-default">
                        <i class="fa fa-list-ul"></i> Все объявления
                    </a>
                </div>
                
                <div class="panel-body">
                <!-- Отображение ошибок проверки ввода -->
                @include('common.errors')
                    <div class="row">
                        <form action="{{url('advert/save')}}" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input type="text" hidden="" name="contractor_id" id="contractor_id" value="{{$contr->id}}"/>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Наименование</label>
                                <input type="text" class="form-control" placeholder="Наименование">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Описание</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                            <div class="form-group">                                
                                <select style="" name="adv_cat" id="advt_cat" class="form-control">
                                @foreach ($adv_cats as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach            
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Изображения</label>
                                <input type="file" name="photos[]" multiple/>
                            </div>
                            <div class="form-group">
                                <label>Ссылки на видео</label>
                                <div class="form-group input-group">
                                    <input type="text" name="videos[]" class="form-control">
                                    <span class="input-group-btn"><button type="button" class="btn btn-success btn-add">✚</button></span>
                                </div>
                                <script>
                                    $(document).on('click', '.btn-add', function(event) {
                                        event.preventDefault();

                                        var field = $(this).closest('.form-group');
                                        var field_new = field.clone();

                                        $(this)
                                        .toggleClass('btn-success')
                                        .toggleClass('btn-add')
                                        .toggleClass('btn-danger')
                                        .toggleClass('btn-remove')
                                        .html('✖');

                                        field_new.find('input').val('');
                                        field_new.insertAfter(field);
                                    });

                                    $(document).on('click', '.btn-remove', function(event) {
                                        event.preventDefault();
                                        $(this).closest('.form-group').remove();
                                    });
                                </script>
                                <button type="submit" class="btn btn-primary">Опубликовать</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

