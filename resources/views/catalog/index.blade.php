@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>

    <form method="GET" action="{{ route('catalog.index') }}" class="row g-2 mb-3">
        <div class="col-auto">
            <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="Номер...">
        </div>
        <div class="col-auto">
            <select name="sort" class="form-select">
                <option value="number" @selected($sort === 'number')>По номеру</option>
                <option value="floor" @selected($sort === 'floor')>По этажу</option>
                <option value="night_price" @selected($sort === 'night_price')>По цене</option>
            </select>
        </div>
        <div class="col-auto"><button class="btn btn-secondary">Найти</button></div>
    </form>

    <table class="table">
        <tr><th>№</th><th>Номер</th><th>Тип номера</th><th>Этаж</th><th>Цена за ночь</th><th></th></tr>
        @forelse ($rooms as $room)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a href="{{ route('catalog.show', ['id' => $room['id']]) }}">{{ $room['number'] }}</a></td>
                <td><a href="{{ route('catalog.roomtype', $room['room_type']) }}">{{ $room['room_type'] }}</a></td>
                <td>{{ $room['floor'] }}</td>
                <td>{{ number_format($room['night_price'], 2, ',', ' ') }} ₽</td>
                <td>@if ($room['has_balcony']) <span class="badge bg-success">Балкон</span> @endif</td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-muted">Ничего не найдено.</td></tr>
        @endforelse
    </table>
@endsection