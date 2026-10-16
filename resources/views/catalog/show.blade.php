@extends('layouts.app')

@section('content')
    <h1>Номер {{ $room['number'] }}</h1>

    <dl class="row">
        <dt class="col-sm-3">Код</dt>          <dd class="col-sm-9">{{ $room['code'] }}</dd>
        <dt class="col-sm-3">Номер</dt>        <dd class="col-sm-9">{{ $room['number'] }}</dd>
        <dt class="col-sm-3">Тип номера</dt>   <dd class="col-sm-9">{{ $room['room_type'] }}</dd>
        <dt class="col-sm-3">Этаж</dt>         <dd class="col-sm-9">{{ $room['floor'] }}</dd>
        <dt class="col-sm-3">Цена за ночь</dt>
        <dd class="col-sm-9">{{ number_format($room['night_price'], 2, ',', ' ') }} ₽</dd>
        <dt class="col-sm-3">Кроватей</dt>     <dd class="col-sm-9">{{ $room['beds'] }}</dd>
        <dt class="col-sm-3">Балкон</dt>       <dd class="col-sm-9">{{ $room['has_balcony'] ? 'Да' : 'Нет' }}</dd>
    </dl>

    <a href="{{ route('catalog.index') }}">&larr; К каталогу</a>
@endsection