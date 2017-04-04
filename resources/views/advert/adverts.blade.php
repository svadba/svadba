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
                    <a href="{{url('adverts/get?content=my')}}" class="btn btn-default">
                        <i class="fa fa-star"></i> Мои объявления
                    </a>
                    <a href="{{url('adverts/get')}}" class="btn btn-default">
                        <i class="fa fa-list-ul"></i> Все объявления
                    </a>
                </div>
                
                <div class="panel-body">
                    <h5>Мною добавленные подрядчики:</h5>
                    <table class="table table-striped table-bordered table-hover table-condensed" cellspacing='0'>
                        <tr>
                            <th style="background: #d0d0d0;">#</th>
                            <th style="background: #d0d0d0;">Имя</th>
                            <th style="background: #d0d0d0;">Описание</th>
                            <th style="background: #d0d0d0;">Функции</th>
                        </tr>
                    <?php $count = 1;?>
                    @foreach ($adverts as $adv)
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td>{{$adv->name}}</td>
                            <td>{{$adv->description}}</td>
                            <?php  $count++; ?>
                            <td style=" width:172px; text-align: right;">
                                            <a style="" class="btn btn-info" title="Открыть объявление" href="{{url('/adverts/view/'.$adv->id)}}"><i class="fa fa-external-link"></i></a>
                                            <a style="" class="btn btn-warning" title="Редактировать объявление" href="{{url('adverts/edit/'.$adv->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a style="" class="btn btn-danger" title="Удалить объявление" href="{{url('adverts/delete/'.$adv->id)}}"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>  
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
