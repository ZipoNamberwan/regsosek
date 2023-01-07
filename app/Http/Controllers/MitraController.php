<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mitra/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shifts = Shift::all();
        return view('mitra/create', ['shifts' => $shifts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,email',
            'shift' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->username,
            'password' => bcrypt($request->username),
            'status_shift_id' => $request->shift
        ]);

        $user->assignRole('user');

        return redirect('/mitra')->with('success-create', 'Petugas Pengolahan telah ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $shifts = Shift::all();
        return view('mitra/edit', ['user' => $user, 'shifts' => $shifts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'shift' => 'required'
        ]);

        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->username,
            'password' => bcrypt($request->username),
            'status_shift_id' => $request->shift
        ]);

        return redirect('/mitra')->with('success-edit', 'Petugas Pengolahan telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/mitra')->with('success-delete', 'Petugas Pengolahan telah dihapus!');
    }

    public function mitraData(Request $request)
    {
        $recordsTotal = User::role('user')->count();

        $orderColumn = 'name';
        $orderDir = 'desc';
        if ($request->order != null) {
            if ($request->order[0]['dir'] == 'asc') {
                $orderDir = 'asc';
            } else {
                $orderDir = 'desc';
            }
            if ($request->order[0]['column'] == '0') {
                $orderColumn = 'name';
            } else if ($request->order[0]['column'] == '1') {
                $orderColumn = 'email';
            } else if ($request->order[0]['column'] == '2') {
                $orderColumn = 'shift';
            }
        }
        $searchkeyword = $request->search['value'];
        $users = User::role('user')->get();
        if ($searchkeyword != null) {
            $users = $users->filter(function ($q) use (
                $searchkeyword
            ) {
                return Str::contains(strtolower($q->name), strtolower($searchkeyword)) ||
                    Str::contains(strtolower($q->email), strtolower($searchkeyword));
            });
        }
        $recordsFiltered = $users->count();

        if ($orderDir == 'asc') {
            $users = $users->sortBy($orderColumn);
        } else {
            $users = $users->sortByDesc($orderColumn);
        }

        if ($request->length != -1) {
            $users = $users->skip($request->start)
                ->take($request->length);
        }

        $usersArray = array();
        $i = $request->start + 1;
        foreach ($users as $user) {
            $userData = array();
            $userData["name"] = $user->name;
             $userData["id"] = $user->id;
            $userData["username"] = $user->email;
            $userData["shift"] = $user->shiftdetail != null ? $user->shiftdetail->name : '';
            $usersArray[] = $userData;
            $i++;
        }
        return json_encode([
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $usersArray
        ]);
    }
}
