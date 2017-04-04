@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 style="font-size:20px; margin-bottom:15px;">Подрядчики</h3>
                    <div>
                        <ul style="margin:5px 0px 10px -35px;">
                        </ul>
                    </div>
                    <a href="{{url('contractors/my')}}" class="btn btn-default">
                        <i class="fa fa-star"></i> Мои подрядчики
                    </a>
                    <a href="{{url('contractors/all')}}" class="btn btn-default">
                        <i class="fa fa-list-ul"></i> Все подрядчики
                    </a>
                    <a href="{{url('contractors/add')}}" class="btn btn-default">
                        <i class="fa fa-plus"></i> Добавить подрядчика
                    </a>
                </div>
                
                <div class="panel-body">
                    <h5>Мною добавленные подрядчики:</h5>
                    <table class="table table-striped table-bordered table-hover table-condensed" cellspacing='0'>
                        <tr>
                            <th>#</th>
                            <th>Имя</th>
                            <th>Фамилия</th>
                            <th>Отчество</th>
                            <th>Дата рождения</th>
                            <th>Телефон</th>
                            <th>Тип</th>
                            <th>Индентификатор</th>
                            <th>Функции</th>
                        </tr>
                    <?php $count = 1;?>
                    @foreach ($contractors as $contr)
                        <tr>
                        <a href="{{url('/home')}}">
                            <td><?php echo $count; ?></td>
                            <td>{{$contr->name}}</td>
                            <td>{{$contr->surname}}</td>
                            <td>{{$contr->middlename}}</td>
                            <td>{{$contr->birthday}}</td>
                            <td>
                            @foreach($contr->phones as $phone)
                                {{$phone->phone}}<br/>
                            @endforeach
                            </td>
                            <td>{{$contr->contype->name}}
                            <td><a href="{{url('/contractors/view/'.$contr->id)}}">{{$contr->id}}</a></td>
                            <?php  $count++; ?>
                            <td>
                                <a class="btn btn-danger" href="{{url('adverts/add/'.$contr->id)}}">Добавить заявку</a>
                                <a class="btn btn-danger" href="{{url('contractor/edit/'.$contr->id)}}">Редактировать</a>
                                <a class="btn btn-danger" href="{{url('contractor/delete/'.$contr->id)}}"><i class="fa fa-btn fa-trash"></i>Удалить</a>
                            </td>
                         </a>   
                        </tr>  
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
