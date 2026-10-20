<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $roomId = $this->route('room')?->id;

        return [
            'room_type_id' => [
                'required',
                'integer',
                'exists:room_types,id',
            ],

            'number' => [
                'required',
                'string',
                'min:3',
                'max:130',
                'regex:/^[A-Z]{2}-[0-9]{4}$/',
                Rule::unique('rooms')
                    ->where('room_type_id', $this->input('room_type_id'))
                    ->ignore($roomId),
            ],

            'description' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'floor' => [
                'required',
                'integer',
                'between:1,50',
            ],

            'night_price' => [
                'required',
                'numeric',
                'min:0',
                'max:10000000',
            ],

            'beds' => [
                'required',
                'integer',
                'between:1,10',
            ],

            'has_balcony' => [
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле «:attribute» обязательно.',
            'number.min' => 'Номер должен содержать минимум :min символа.',
            'number.max' => 'Номер не должен превышать :max символов.',
            'number.regex' => 'Формат номера: две заглавные буквы, дефис и четыре цифры (RM-0101).',
            'number.unique' => 'Номер с таким кодом уже существует у этого типа.',
            'room_type_id.exists' => 'Выбранного типа номера не существует.',
            'floor.between' => 'Этаж должен быть от 1 до 50.',
            'beds.between' => 'Количество кроватей должно быть от 1 до 10.',
            'night_price.min' => 'Цена не может быть отрицательной.',
        ];
    }

    public function attributes(): array
    {
        return [
            'room_type_id' => 'Тип номера',
            'number' => 'Номер',
            'description' => 'Описание',
            'floor' => 'Этаж',
            'night_price' => 'Цена за ночь',
            'beds' => 'Количество кроватей',
            'has_balcony' => 'Балкон',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'has_balcony' => $this->boolean('has_balcony'),
        ]);
    }
}
