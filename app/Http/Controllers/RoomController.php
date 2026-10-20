<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::with('roomType');

        if ($request->filled('q')) {
            $query->where('number', 'like', '%' . $request->query('q') . '%');
        }

        $query->latest();

        return view('rooms.index', [
            'title' => 'Номера гостиницы',
            'rooms' => $query->paginate(5)->withQueryString(),
        ]);
    }

    public function create()
    {
        return view('rooms.form', [
            'title' => 'Добавить номер',
            'room' => new Room(),
            'roomTypes' => RoomType::orderBy('name')->get(),
        ]);
    }

    public function store(RoomRequest $request)
    {
        $room = Room::create($request->validated());

        return redirect()
            ->route('rooms.index')
            ->with('status', "Номер {$room->number} успешно добавлен!");
    }

    public function edit(Room $room)
    {
        return view('rooms.form', [
            'title' => 'Редактирование номера',
            'room' => $room,
            'roomTypes' => RoomType::orderBy('name')->get(),
        ]);
    }

    public function update(RoomRequest $request, Room $room)
    {
        $room->update($request->validated());

        return redirect()
            ->route('rooms.index')
            ->with('status', "Номер {$room->number} обновлён!");
    }

    public function destroy(Room $room)
    {
        $number = $room->number;
        $room->delete();

        return redirect()
            ->route('rooms.index')
            ->with('status', "Номер {$number} удалён!");
    }
}
