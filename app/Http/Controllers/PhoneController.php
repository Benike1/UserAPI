<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PhoneController extends Controller
{

    /**
     * @return Phone[]|Collection
     */
    public function index(): Collection|array
    {
        return Phone::all();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request): mixed
    {
        $request->validate([
            'user_id' => 'required',
            'phone' => 'required|regex:/((?:\+?3|0)6)(?:-|\()?(\d{1,2})(?:-|\))?(\d{3})-?(\d{3,4})/',
        ]);

        return Phone::create($request->all());
    }
    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed
    {
        return Phone::find($id);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function update(Request $request, int $id): mixed
    {
        $phone = Phone::find($id);
        $phone->update($request->all());

        return $phone;
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id): int
    {
        return Phone::destroy($id);
    }
}
