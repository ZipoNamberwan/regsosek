<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

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
        return view('report/attendance-list');
    }

    public function attendanceListData(Request $request)
    {
        $recordsTotal = User::role('user')->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 4)->get();

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

        $users = User::role('user')->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 4)->get();
        $now = date('Y-m-d');
        $now = '2023-01-05';

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
}
