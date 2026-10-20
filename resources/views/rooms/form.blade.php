
@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">

        <h1 class="mb-4">{{ $title }}</h1>

        <form method="POST"
              action="{{ $room->exists
                ? route('rooms.update', $room)
                : route('rooms.store') }}">

            @csrf

            @if($room->exists)
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Тип номера</label>

                <select name="room_type_id"
                        class="form-select @error('room_type_id') is-invalid @enderror">
                    <option value="">Выберите тип</option>

                    @foreach($roomTypes as $type)
                        <option value="{{ $type->id }}"
                            @selected(old('room_type_id', $room->room_type_id) == $type->id)>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>

                @error('room_type_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Номер</label>

                <input type="text"
                       name="number"
                       value="{{ old('number', $room->number) }}"
                       placeholder="RM-0101"
                       class="form-control @error('number') is-invalid @enderror">

                @error('number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Описание</label>

                <textarea name="description"
                          rows="3"
                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $room->description) }}</textarea>

                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Этаж</label>

                <input type="number"
                       name="floor"
                       value="{{ old('floor', $room->floor) }}"
                       class="form-control @error('floor') is-invalid @enderror">

                @error('floor')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Цена за ночь (₸)</label>

                <input type="number"
                       step="0.01"
                       name="night_price"
                       value="{{ old('night_price', $room->night_price) }}"
                       class="form-control @error('night_price') is-invalid @enderror">

                @error('night_price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Количество кроватей</label>

                <input type="number"
                       name="beds"
                       value="{{ old('beds', $room->beds) }}"
                       class="form-control @error('beds') is-invalid @enderror">

                @error('beds')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-4">
                <input type="checkbox"
                       name="has_balcony"
                       value="1"
                       class="form-check-input"
                       id="has_balcony"
                       @checked(old('has_balcony', $room->has_balcony))>

                <label class="form-check-label" for="has_balcony">
                    Есть балкон
                </label>
            </div>

            <button type="submit" class="btn btn-primary">
                Сохранить
            </button>

            <a href="{{ route('rooms.index') }}"
               class="btn btn-secondary">
                Отмена
            </a>

        </form>
    </div>
</div>

@endsection
