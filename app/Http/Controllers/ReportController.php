<?php

namespace App\Http\Controllers;

use App\Helpers\Utilities;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\EntryK;
use App\Models\Shift;
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

    public function reportSls()
    {
        return view('report/user-sls');
    }

    public function reportSlsData(Request $request)
    {
        $recordsTotal = EntryK::all()->count();

        $orderColumn = 'begin';
        $orderDir = 'desc';
        if ($request->order != null) {
            if ($request->order[0]['dir'] == 'asc') {
                $orderDir = 'asc';
            } else {
                $orderDir = 'desc';
            }
            if ($request->order[0]['column'] == '2') {
                $orderColumn = 'sls_id';
            } else if ($request->order[0]['column'] == '3') {
                $orderColumn = 'sls_id';
            } else if ($request->order[0]['column'] == '4') {
                $orderColumn = 'sls_id';
            }
        }
        $searchkeyword = $request->search['value'];
        $entries = EntryK::all();
        if ($searchkeyword != null) {
            $entries = $entries->filter(function ($q) use (
                $searchkeyword
            ) {
                return Str::contains(strtolower($q->slsdetail->subdistrictdetail->name), strtolower($searchkeyword)) ||
                    Str::contains(strtolower($q->slsdetail->villagedetail->name), strtolower($searchkeyword)) ||
                    Str::contains(strtolower($q->slsdetail->name), strtolower($searchkeyword)) ||
                    Str::contains($q->slsdetail->fullcode(), $searchkeyword);
            });
        }
        $recordsFiltered = $entries->count();

        if ($orderDir == 'asc') {
            $entries = $entries->sortBy($orderColumn);
        } else {
            $entries = $entries->sortByDesc($orderColumn);
        }

        if ($request->length != -1) {
            $entries = $entries->skip($request->start)
                ->take($request->length);
        }

        $entriesArray = array();
        $i = $request->start + 1;
        foreach ($entries as $entry) {
            $entryData = array();
            $entryData["index"] = $i;
            $entryData["status"] = $entry->statusdetail->name;
            $entryData["status_id"] = $entry->statusdetail->id;
            $entryData["subdistrict"] = $entry->slsdetail->villagedetail->subdistrictdetail->name;
            $entryData["subdistrict_code"] = $entry->slsdetail->villagedetail->subdistrictdetail->code;
            $entryData["village"] = $entry->slsdetail->villagedetail->name;
            $entryData["village_code"] = $entry->slsdetail->villagedetail->code;
            $entryData["sls"] = $entry->slsdetail->name;
            $entryData["sls_code"] = $entry->slsdetail->code;
            $entryData["begin"] = $entry->begin;
            $entryData["finish"] = $entry->finish;
            $entryData["total_entry"] = $entry->total_entry;
            $entryData["id"] = $entry->id;
            $entryData["sls_fullname"] = $entry->slsdetail->fullname();
            $entryData["sls_fullcode"] = $entry->slsdetail->fullcode();
            $entryData["status_doc"] = $entry->statusdocdetail != null ? $entry->statusdocdetail->name : "-";
            $entryData["status_doc_id"] = $entry->status_doc_id;
            $entryData["user"] = $entry->userdetail->name;
            $entriesArray[] = $entryData;
            $i++;
        }
        return json_encode([
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $entriesArray
        ]);
    }

    public function reportUser()
    {
        return view('report/user-report');
    }

    public function reportUserData(Request $request)
    {
        $recordsTotal = User::role('user')->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 4)->get()->count();

        $orderColumn = 'name';
        $orderDir = SORT_ASC;
        if ($request->order != null) {
            if ($request->order[0]['dir'] == 'asc') {
                $orderDir = SORT_ASC;
            } else {
                $orderDir = SORT_DESC;
            }

            if ($request->order[0]['column'] == '0') {
                $orderColumn = 'name';
            } else if ($request->order[0]['column'] == '1') {
                $orderColumn = 'entried';
            } else if ($request->order[0]['column'] == '2') {
                $orderColumn = 'entrying';
            } else if ($request->order[0]['column'] == '3') {
                $orderColumn = 'total_sls';
            } else if ($request->order[0]['column'] == '4') {
                $orderColumn = 'total_entry';
            }
        }
        $searchkeyword = $request->search['value'];

        $users = User::role('user')->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 4)->get();
        if ($searchkeyword != null) {
            $users = $users->filter(function ($q) use (
                $searchkeyword
            ) {
                return Str::contains(strtolower($q->name), strtolower($searchkeyword));
            });
        }

        if ($orderDir == 'asc') {
            $users = $users->sortBy($orderColumn, SORT_NATURAL | SORT_FLAG_CASE);
        } else {
            $users = $users->sortByDesc($orderColumn, SORT_NATURAL | SORT_FLAG_CASE);
        }

        if ($request->length != -1) {
            $users = $users->skip($request->start)
                ->take($request->length);
        }

        $recordsFiltered = count($users);

        $usersArray = array();
        $i = $request->start + 1;
        foreach ($users as $user) {
            $userData = array();
            $userData["index"] = $i;
            $userData["name"] = $user->name;
            $userData["entried"] = count($user->entriesK()->where(['status_id' => 3])->get());
            $userData["entrying"] = count($user->entriesK()->where(['status_id' => 2])->get());
            $userData["total_sls"] = $userData['entried'] + $userData['entrying'];
            $userData["total_entry"] = $user->entriesK()->sum('total_entry');
            $userData["id"] = $user->id;
            $usersArray[] = $userData;
            $i++;
        }

        $date  = array_column($usersArray, $orderColumn);
        array_multisort($date, $orderDir, SORT_NATURAL | SORT_FLAG_CASE, $usersArray);

        return json_encode([
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $usersArray
        ]);
    }

    public function viewReport($id)
    {
        $user = User::find($id);
        return view('report/view-report', ['user' => $user]);
    }

    public function viewReportData(Request $request, $id)
    {
        $recordsTotal = EntryK::where(['user_id' => $id])->count();

        $orderColumn = 'begin';
        $orderDir = 'desc';
        if ($request->order != null) {
            if ($request->order[0]['dir'] == 'asc') {
                $orderDir = 'asc';
            } else {
                $orderDir = 'desc';
            }
            if ($request->order[0]['column'] == '2') {
                $orderColumn = 'sls_id';
            } else if ($request->order[0]['column'] == '3') {
                $orderColumn = 'sls_id';
            } else if ($request->order[0]['column'] == '4') {
                $orderColumn = 'sls_id';
            }
        }
        $searchkeyword = $request->search['value'];
        $entries = EntryK::where(['user_id' => $id])->get();
        if ($searchkeyword != null) {
            $entries = $entries->filter(function ($q) use (
                $searchkeyword
            ) {
                return Str::contains(strtolower($q->slsdetail->subdistrictdetail->name), strtolower($searchkeyword)) ||
                    Str::contains(strtolower($q->slsdetail->villagedetail->name), strtolower($searchkeyword)) ||
                    Str::contains(strtolower($q->slsdetail->name), strtolower($searchkeyword)) ||
                    Str::contains($q->slsdetail->fullcode(), $searchkeyword);
            });
        }
        $recordsFiltered = $entries->count();

        if ($orderDir == 'asc') {
            $entries = $entries->sortBy($orderColumn);
        } else {
            $entries = $entries->sortByDesc($orderColumn);
        }

        if ($request->length != -1) {
            $entries = $entries->skip($request->start)
                ->take($request->length);
        }

        $entriesArray = array();
        $i = $request->start + 1;
        foreach ($entries as $entry) {
            $entryData = array();
            $entryData["index"] = $i;
            $entryData["status"] = $entry->statusdetail->name;
            $entryData["status_id"] = $entry->statusdetail->id;
            $entryData["subdistrict"] = $entry->slsdetail->villagedetail->subdistrictdetail->name;
            $entryData["subdistrict_code"] = $entry->slsdetail->villagedetail->subdistrictdetail->code;
            $entryData["village"] = $entry->slsdetail->villagedetail->name;
            $entryData["village_code"] = $entry->slsdetail->villagedetail->code;
            $entryData["sls"] = $entry->slsdetail->name;
            $entryData["sls_code"] = $entry->slsdetail->code;
            $entryData["begin"] = $entry->begin;
            $entryData["finish"] = $entry->finish;
            $entryData["total_entry"] = $entry->total_entry;
            $entryData["id"] = $entry->id;
            $entryData["sls_fullname"] = $entry->slsdetail->fullname();
            $entryData["sls_fullcode"] = $entry->slsdetail->fullcode();
            $entryData["status_doc"] = $entry->statusdocdetail != null ? $entry->statusdocdetail->name : "-";
            $entryData["status_doc_id"] = $entry->status_doc_id;
            $entriesArray[] = $entryData;
            $i++;
        }
        return json_encode([
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $entriesArray
        ]);
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
        $orderDir = SORT_ASC;
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
        array_multisort($date, $orderDir, SORT_NATURAL | SORT_FLAG_CASE, $data);

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
