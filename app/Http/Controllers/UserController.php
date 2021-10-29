<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * @return User[]|Collection
     */
    public function index(): Collection|array
    {
        return User::all();
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'date_of_birth' => 'required|date',
            'phone.number' => ['required', 'regex:/((?:\+?3|0)6)(?:-|\()?(\d{1,2})(?:-|\))?(\d{3})-?(\d{3,4})/']
        ]);

        if (!$user = User::create($request->all())) {
            return back()->with('error', 'Unknown error occurred!');
        }

        $phone = new Phone([
            'number' => $request['phone.number'],
        ]);
        $user->phoneNumbers()->save($phone);

        return back()->with('success', 'User has been created.');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed
    {
        return User::find($id);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function search($name)
    {
        return User::where('name', 'like', '%' . $name . '%')->get();
    }

    /**
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function update(Request $request, int $id)
    {
        $user = User::find($id);
        $user->update($request->all());

        return $user;
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id): int
    {
        return User::destroy($id);
    }

}
