<?php

namespace App\Http\Controllers;

use App\Helpers\Utilities;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\EntryK;
use App\Models\Shift;
use App\Models\Sls;
use App\Models\User;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    public function attendanceDownload()
    {
        $attArray = [];
        $attendances = Attendance::all();

        foreach ($attendances as $attendance) {
            $userArray = null;
            if (array_key_exists($attendance->userdetail->id, $attArray)) {
                $userArray = $attArray[$attendance->userdetail->id];
            } else {
                $userArray = [];
            }

            $userArray[$attendance->date] = [];
            $userArray[$attendance->date]['in'] = (new DateTime($attendance->in))->format('H:i');
            if ($attendance->out != null) {
                $format = (new DateTime($attendance->out))->format('Y-m-d') != (new DateTime($attendance->date))->format("Y-m-d") ? 'H:i d M' : 'H:i';
                $userArray[$attendance->date]['out'] = (new DateTime($attendance->out))->format($format);
            } else {
                $userArray[$attendance->date]['out'] = $attendance->out;
            }


            $userArray[$attendance->date]['is_in_manual'] = $attendance->is_in_manual;
            $userArray[$attendance->date]['is_out_manual'] = $attendance->is_out_manual;
            if ($attendance->statusattdetail != null) {
                $userArray[$attendance->date]['status'] = $attendance->statusattdetail->name;
            } else {
                $userArray[$attendance->date]['status'] = null;
            }

            $attArray[$attendance->userdetail->id] = $userArray;
        }

        // dd($attArray);


        // Create a new spreadsheet object
        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        // Set some data in the spreadsheet
        $startRow = 3;

        $users = User::where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 4)->get();

        $first = new DateTime('2023-01-05');
        $last = new DateTime(date('Y-m-d H:i:s') . ' -17 hours');
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($first, $interval, $last);
        $colStart = 0;
        foreach ($period as $dt) {
            $worksheet->setCellValue(Utilities::excelColumnJumpByNumber($colStart, 2) . $startRow, $dt->format("Y-m-d"));
            $worksheet->mergeCells(Utilities::excelColumnJumpByNumber($colStart, 2) . $startRow . ':' . Utilities::excelColumnJumpByNumber($colStart, 3) . $startRow);
            $style = $worksheet->getStyle(Utilities::excelColumnJumpByNumber($colStart, 2) . $startRow);
            $alignment = $style->getAlignment();
            $alignment->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $alignment->setVertical(Alignment::VERTICAL_CENTER);

            $worksheet->setCellValue(Utilities::excelColumnJumpByNumber($colStart, 2) . ($startRow + 1), 'Datang');
            $worksheet->setCellValue(Utilities::excelColumnJumpByNumber($colStart, 3) . ($startRow + 1), 'Pulang');

            $colStart = $colStart + 2;
        }

        $styleNoAtt = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'FF0000',
                ],
            ],
        ];

        $i = $startRow + 2;

        foreach ($users as $user) {
            $worksheet->setCellValue('A' . $i, $user->name);

            $first = new DateTime('2023-01-05');
            $last = new DateTime(date('Y-m-d H:i:s') . ' -17 hours');
            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($first, $interval, $last);
            $colStart = 0;
            foreach ($period as $dt) {
                $in = null;
                $out = null;
                $isneedpermission = false;
                if (array_key_exists($dt->format("Y-m-d"), $attArray[$user->id])) {
                    $in = $attArray[$user->id][$dt->format("Y-m-d")]['in'];
                    $out = $attArray[$user->id][$dt->format("Y-m-d")]['out'];
                    if ($attArray[$user->id][$dt->format("Y-m-d")]['status'] != null) {
                        $isneedpermission = true;
                    }
                }
                $inCol = Utilities::excelColumnJumpByNumber($colStart, 2);
                $outCol = Utilities::excelColumnJumpByNumber($colStart, 3);
                if (!$isneedpermission) {
                    $worksheet->setCellValue($inCol . $i, $in);
                    $worksheet->setCellValue($outCol . $i, $out);

                    if ($in == null) {
                        $worksheet->getStyle($inCol . $i)->applyFromArray($styleNoAtt);
                    }
                    if ($out == null) {
                        $worksheet->getStyle($outCol . $i)->applyFromArray($styleNoAtt);
                    }
                } else {
                    $worksheet->setCellValue($inCol . $i, $attArray[$user->id][$dt->format("Y-m-d")]['status']);
                }

                $columnDimension = $worksheet->getColumnDimension($inCol);
                $columnDimension->setAutoSize(true);
                $columnDimension = $worksheet->getColumnDimension($outCol);
                $columnDimension->setAutoSize(true);

                $colStart = $colStart + 2;
            }

            $i++;
        }

        $columnDimension = $worksheet->getColumnDimension('A');
        $columnDimension->setAutoSize(true);

        // Create a writer object
        $writer = new Xlsx($spreadsheet);

        // Set headers to download the file rather than displaying it
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="attendance.xlsx"');
        header('Cache-Control: max-age=0');

        // Output the generated file to browser
        $writer->save('php://output');
    }

    public function downloadReportSls()
    {
        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $i = 1;

        $worksheet->setCellValue('A' . $i, 'ID Wilayah');
        $worksheet->setCellValue('B' . $i, 'Kode Kec');
        $worksheet->setCellValue('C' . $i, 'Nama Kec');
        $worksheet->setCellValue('D' . $i, 'Kode Desa');
        $worksheet->setCellValue('E' . $i, 'Nama Desa');
        $worksheet->setCellValue('F' . $i, 'Kode SLS');
        $worksheet->setCellValue('G' . $i, 'Nama SLS');
        $worksheet->setCellValue('H' . $i, 'Status Entri');
        $worksheet->setCellValue('I' . $i, 'Nama Operator');
        $worksheet->setCellValue('J' . $i, 'Tgl Mulai Entri');
        $worksheet->setCellValue('K' . $i, 'Tgl Selesai Entri');
        $worksheet->setCellValue('L' . $i, 'Status Dokumen');
        $worksheet->setCellValue('M' . $i, 'Catatan');

        $i++;
        $sls = Sls::all();
        foreach ($sls as $s) {
            $entries = $s->entriesK()->get();
            if (count($entries) > 0) {
                foreach ($entries as $entry) {
                    $worksheet->setCellValueExplicit('A' . $i, $s->fullcode(), DataType::TYPE_STRING);
                    $worksheet->setCellValueExplicit('B' . $i, $s->villagedetail->subdistrictdetail->code, DataType::TYPE_STRING);
                    $worksheet->setCellValue('C' . $i, $s->villagedetail->subdistrictdetail->name);
                    $worksheet->setCellValueExplicit('D' . $i, $s->villagedetail->code, DataType::TYPE_STRING);
                    $worksheet->setCellValue('E' . $i, $s->villagedetail->name);
                    $worksheet->setCellValueExplicit('F' . $i, $s->code, DataType::TYPE_STRING);
                    $worksheet->setCellValue('G' . $i, $s->name);
                    $worksheet->setCellValue('H' . $i, $entry->statusdetail->name);
                    $worksheet->setCellValue('I' . $i, $entry->userdetail->name);
                    $worksheet->setCellValue('J' . $i, (new DateTime($entry->begin))->format('d M Y'));
                    $worksheet->setCellValue('K' . $i, $entry->finish != null ? (new DateTime($entry->finish))->format('d M Y') : '');
                    $worksheet->setCellValue('L' . $i, $entry->statusdocdetail != null ? $entry->statusdocdetail->name : '');
                    $worksheet->setCellValue('M' . $i, $entry->note);

                    $i++;
                }
            } else {
                $worksheet->setCellValueExplicit('A' . $i, $s->fullcode(), DataType::TYPE_STRING);
                $worksheet->setCellValueExplicit('B' . $i, $s->villagedetail->subdistrictdetail->code, DataType::TYPE_STRING);
                $worksheet->setCellValue('C' . $i, $s->villagedetail->subdistrictdetail->name);
                $worksheet->setCellValueExplicit('D' . $i, $s->villagedetail->code, DataType::TYPE_STRING);
                $worksheet->setCellValue('E' . $i, $s->villagedetail->name);
                $worksheet->setCellValueExplicit('F' . $i, $s->code, DataType::TYPE_STRING);
                $worksheet->setCellValue('G' . $i, $s->name);
                $worksheet->setCellValue('H' . $i, 'Belum Entri');

                $i++;
            }
        }

        for ($i = 65; $i <= 90; $i++) {
            $letter = chr($i);
            $columnDimension = $worksheet->getColumnDimension($letter);
            $columnDimension->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);

        // Set headers to download the file rather than displaying it
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="report SLS.xlsx"');
        header('Cache-Control: max-age=0');

        // Output the generated file to browser
        $writer->save('php://output');
    }
}
