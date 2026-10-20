
@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Номера гостиницы</h1>
    <a href="{{ route('rooms.index') }}" class="nav-link">
    Управление номерами
</a>

    <a href="{{ route('rooms.create') }}"
       class="btn btn-success">
        + Добавить номер
    </a>
</div>

@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form method="GET" action="{{ route('rooms.index') }}" class="mb-4">
    <div class="input-group">
        <input
            type="text"
            name="q"
            value="{{ request('q') }}"
            class="form-control"
            placeholder="Поиск по номеру">

        <button class="btn btn-primary" type="submit">
            Найти
        </button>

        <a href="{{ route('rooms.index') }}"
           class="btn btn-outline-secondary">
            Сброс
        </a>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Номер</th>
                <th>Тип номера</th>
                <th>Этаж</th>
                <th>Цена за ночь</th>
                <th>Кровати</th>
                <th>Балкон</th>
                <th>Действия</th>
            </tr>
        </thead>

        <tbody>
            @forelse($rooms as $room)
                <tr>
                    <td>{{ $room->id }}</td>
                    <td>{{ $room->number }}</td>
                    <td>{{ $room->roomType->name }}</td>
                    <td>{{ $room->floor }}</td>
                    <td>{{ number_format($room->night_price, 2, '.', ' ') }} ₸</td>
                    <td>{{ $room->beds }}</td>

                    <td>
                        @if($room->has_balcony)
                            <span class="badge bg-success">Да</span>
                        @else
                            <span class="badge bg-secondary">Нет</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('rooms.edit', $room) }}"
                           class="btn btn-sm btn-warning mb-1">
                            Изменить
                        </a>

                        <form
                            method="POST"
                            action="{{ route('rooms.destroy', $room) }}"
                            class="d-inline"
                            onsubmit="return confirm('Вы уверены, что хотите удалить номер?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-sm btn-danger mb-1">
                                Удалить
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">
                        Номера не найдены
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $rooms->links() }}
</div>

@endsection
