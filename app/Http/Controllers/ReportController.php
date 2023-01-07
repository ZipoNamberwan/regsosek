<?php

namespace App\Http\Controllers;

use App\Helpers\Utilities;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Shift;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

use function PHPSTORM_META\type;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('report/index');
    }

    public function attendanceList()
    {
        $shifts = Shift::all();
        return view('report/attendance-list', ['shifts' => $shifts]);
    }

    public function attendanceListData(Request $request, $id = null)
    {
        $recordsTotal = User::role('user')->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 4);
        if ($id != null) {
            $recordsTotal = $recordsTotal->where(['status_shift_id' => $id]);
        }
        $recordsTotal = $recordsTotal->get()->count();

        $orderColumn = 'name';
        $orderDir = SORT_DESC;
        if ($request->order != null) {
            if ($request->order[0]['dir'] == 'asc') {
                $orderDir = SORT_ASC;
            } else {
                $orderDir = SORT_DESC;
            }
            if ($request->order[0]['column'] == '0') {
                $orderColumn = 'name';
            } else if ($request->order[0]['column'] == '1') {
                $orderColumn = 'in';
            } else if ($request->order[0]['column'] == '2') {
                $orderColumn = 'out';
            }
        }
        $searchkeyword = $request->search['value'];

        $users = User::role('user')->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 4);
        if ($id != null) {
            $users = $users->where(['status_shift_id' => $id]);
        }
        $users = $users->get();

        $now = date('Y-m-d');
        // $now = '2023-01-05';

        $data = array();
        foreach ($users as $user) {
            $row = array();
            $row['name'] = $user->name;
            $att = Attendance::where(['user_id' => $user->id, 'date' => $now])->first();
            $row['in'] = '-';
            $row['out'] = '-';

            if ($att != null) {
                $row['in'] = $att->in ?? '-';
                $row['out'] = $att->out ?? '-';
            }
            $data[] = $row;
        }

        if ($searchkeyword != null) {
            $data = Arr::where($data, function ($value, $key) use ($searchkeyword) {
                return Str::contains(strtolower($value['name']), strtolower($searchkeyword));
            });
        }
        $recordsFiltered = count($data);

        $date  = array_column($data, $orderColumn);
        array_multisort($date, $orderDir, $data);

        if ($request->length != -1) {
            $data = array_slice($data, $request->start, $request->length);
        }

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['in'] = $data[$i]['in'] != '-' ? (new DateTime($data[$i]['in']))->format('H:i') : '-';
            if ($data[$i]['out'] != '-') {
                $format = (new DateTime($data[$i]['out']))->format('Y-m-d') != $now ? 'H:i d M' : 'H:i';
                $data[$i]['out'] = (new DateTime($data[$i]['out']))->format($format);
            }
        }

        return json_encode([
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data
        ]);
    }

    public function generateMessage($idshift, $type)
    {
        $shift = Shift::find($idshift);
        $users = User::role('user')->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 4)->where(['status_shift_id' => $shift->id])->get();

        $now = date('Y-m-d');
        // $now = '2023-01-05';

        $data = array();
        foreach ($users as $user) {
            $att = Attendance::where(['user_id' => $user->id, 'date' => $now])->first();
            if ($att == null) {
                $data[] = $user->name;
            } else {
                if ($type == 'in') {
                    if ($att->in == null) $data[] = $user->name;
                } else {
                    if ($att->out == null) $data[] = $user->name;
                }
            }
        }

        return json_encode(['message' => $shift->name . ($type == 'in' ? ' yang belum absen datang hari ini: <br>' : ' yang belum absen pulang hari ini: <br>') . Utilities::getSentenceFromArray($data, '<br>', '<br>')]);
    }

    public function attendanceEdit()
    {
        $users = User::role('user')->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 4)->get();
        return view('report/attendance-change', ['users' => $users]);
    }

    public function attendanceUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        $att = Attendance::where(['user_id' => $request->name])->where(['date' => $request->date])->first();
        if ($att != null) {
            $att->update(
                [
                    $request->type => $request->time
                ]
            );
        } else {
            Attendance::create([
                'user_id' => $request->name,
                'date' => $request->date,
                $request->type => $request->time
            ]);
        }

        return redirect('/attendance/list')->with('success-edit', 'Data Absensi Telah Diubah!');
    }
}
