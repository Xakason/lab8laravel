<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    // Временное хранилище: в ЛПР № 9 его заменит база данных
    private function rooms(): array
    {
        return [
            ['id' => 1, 'code' => 'RM-0101', 'number' => '101', 'room_type' => 'Стандарт',
             'floor' => 1, 'night_price' => 3500.00, 'beds' => 1, 'has_balcony' => false],
            ['id' => 2, 'code' => 'RM-0102', 'number' => '102', 'room_type' => 'Стандарт',
             'floor' => 1, 'night_price' => 3800.00, 'beds' => 2, 'has_balcony' => false],
            ['id' => 3, 'code' => 'RM-0203', 'number' => '203', 'room_type' => 'Семейный',
             'floor' => 2, 'night_price' => 6200.00, 'beds' => 3, 'has_balcony' => true],
            ['id' => 4, 'code' => 'RM-0204', 'number' => '204', 'room_type' => 'Семейный',
             'floor' => 2, 'night_price' => 6900.50, 'beds' => 4, 'has_balcony' => true],
            ['id' => 5, 'code' => 'RM-0305', 'number' => '305', 'room_type' => 'Люкс',
             'floor' => 3, 'night_price' => 11500.00, 'beds' => 2, 'has_balcony' => true],
            ['id' => 6, 'code' => 'RM-0306', 'number' => '306', 'room_type' => 'Люкс',
             'floor' => 3, 'night_price' => 14900.00, 'beds' => 2, 'has_balcony' => true],
        ];
    }

    // GET /catalog?q=...&sort=...
    public function index(Request $request)
    {
        $rooms = collect($this->rooms());

        $search = $request->query('q');
        if ($search) {
            $rooms = $rooms->filter(fn ($r) => mb_stripos($r['number'], $search) !== false);
        }

        $sort = $request->query('sort', 'number');
        if (in_array($sort, ['number', 'floor', 'night_price'])) {
            $rooms = $rooms->sortBy($sort);
        }

        return view('catalog.index', [
            'title'  => 'Каталог номеров',
            'rooms'  => $rooms,
            'search' => $search,
            'sort'   => $sort,
        ]);
    }

    // GET /catalog/3
    public function show(int $id)
    {
        $room = collect($this->rooms())->firstWhere('id', $id);
        abort_if(! $room, 404);

        return view('catalog.show', ['title' => 'Номер ' . $room['number'], 'room' => $room]);
    }

    // GET /catalog/code/RM-0101
    public function byCode(string $code)
    {
        $room = collect($this->rooms())->firstWhere('code', $code);
        abort_if(! $room, 404);

        return view('catalog.show', ['title' => 'Номер ' . $room['number'], 'room' => $room]);
    }

    // GET /catalog/roomtype/Люкс или /catalog/roomtype
    public function byRoomType(?string $roomType = null)
    {
        $rooms = collect($this->rooms());
        if ($roomType) {
            $rooms = $rooms->where('room_type', $roomType);
        }

        return view('catalog.index', [
            'title'  => $roomType ? "Номера типа: {$roomType}" : 'Все типы номеров',
            'rooms'  => $rooms,
            'search' => null,
            'sort'   => 'number',
        ]);
    }
}