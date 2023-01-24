<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\StatusAttendance;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = new DateTime(date('Y-m-d H:i:s') . ' +7 hours');

        if ((int)$now->format('H') < 5) {
            $now = new DateTime(date('Y-m-d H:i:s') . ' +7 hours -1 day');
        }

        $attendanceToday = Attendance::where(['user_id' => Auth::user()->id])->where(['date' => $now->format('Y-m-d')])->first();
        $in = null;
        $out = null;
        $statatttoday = null;
        $note = null;
        if ($attendanceToday != null) {
            $in = $attendanceToday->in != null ? (new DateTime($attendanceToday->in))->format('H:i') : null;
            $out = $attendanceToday->out != null ? (new DateTime($attendanceToday->out))->format('H:i') : null;
            $statatttoday = $attendanceToday->statusattdetail;
            $note = $attendanceToday->note;
        }

        $statatts = StatusAttendance::all();

        //generate num no attendance
        $first = new DateTime('2023-01-05');
        $last = new DateTime(date('Y-m-d H:i:s') . ' -17 hours');
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($first, $interval, $last);

        $numnoatt = 0;
        $daytotal = 0;
        foreach ($period as $dt) {
            $row = array();
            $attendance = Attendance::where(['date' => $dt->format("Y-m-d")])->where(['user_id' => Auth::user()->id])->first();
            $row['date'] = $dt->format("Y-m-d");
            $row['in'] = '-';
            $row['out'] = '-';
            $row['status'] = '-';

            if ($attendance != null) {
                $row['in'] = $attendance->in != null ? (new DateTime($attendance->in))->format('H:i') : '-';

                if ($attendance->out != null) {
                    $format = (new DateTime($attendance->out))->format('Y-m-d') != $dt->format("Y-m-d") ? 'H:i d M' : 'H:i';
                    $row['out'] = (new DateTime($attendance->out))->format($format);
                } else {
                    $row['out'] = '-';
                }
                if ($attendance->statusattdetail != null) {
                    $row['status'] = $attendance->statusattdetail->id;
                }
            }
            if (($row['out'] == '-' || $row['in'] == '-') && $row['status'] == '-') {
                $numnoatt++;
            }
            $daytotal++;
        }

        // dd($numnoatt);

        return view('attendance/index', ['in' => $in, 'out' => $out, 'statatts' => $statatts, 'statatttoday' => $statatttoday, 'note' => $note, 'numnoatt' => $numnoatt, 'daytotal' => $daytotal]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkTime()
    {
        $now = new DateTime(date('Y-m-d H:i:s') . ' +7 hours');
        $time = $now->format('H:i');
        $dateTime = $now->format('Y-m-d H:i:s');

        return json_encode(['time' => $time, 'datetime' => $dateTime]);
    }

    public function markAttendance(Request $request)
    {
        $dateTime = new DateTime($request->datetime);
        $time = $dateTime->format('Y-m-d H:i:s');
        $date = $dateTime->format(('Y-m-d'));
        if ((int)$dateTime->format('H') < 5) {
            $date = (new DateTime($request->datetime . ' -12 hours'))->format('Y-m-d');
        }

        $attendanceToday = Attendance::where(['date' => $date])->where(['user_id' => Auth::user()->id])->first();
        if ($attendanceToday == null) {
            Attendance::create([
                'user_id' => Auth::user()->id,
                'date' => $date,
                'in' => ($request->type == 'in' ? $time : null),
                'out' => ($request->type == 'out' ? $time : null),
            ]);
        } else {
            $attendanceToday->update([
                'in' => ($request->type == 'in' ? $time : $attendanceToday->in),
                'out' => ($request->type == 'out' ? $time : $attendanceToday->out),
            ]);
        }

        return redirect('/attendance')->with('success-success', 'Absensi telah direkam!');;
    }

    public function markNoAttendance(Request $request)
    {
        if ($request->statatt == null) {
            return redirect('/attendance')->with('success-delete', 'Ketidakhadiran dan catatan belum diisi!');
        } else {
            $dateTime = new DateTime(date('Y-m-d H:i:s') . ' +7 hours');
            $date = $dateTime->format(('Y-m-d'));
            if ((int)$dateTime->format('H') < 5) {
                $date = (new DateTime(date('Y-m-d H:i:s') . ' -12 hours'))->format('Y-m-d');
            }

            $attendanceToday = Attendance::where(['date' => $date])->where(['user_id' => Auth::user()->id])->first();
            if ($attendanceToday == null) {
                Attendance::create([
                    'user_id' => Auth::user()->id,
                    'date' => $date,
                    'status_attendance_id' => $request->statatt,
                    'note' => $request->note,
                ]);
            } else {
                $attendanceToday->update([
                    'status_attendance_id' => $request->statatt,
                    'note' => $request->note,
                ]);
            }

            return redirect('/attendance')->with('success-create', 'Ketidakhadiran telah disimpan!');
        }
    }

    public function cancelNoAttendance()
    {
        $dateTime = new DateTime(date('Y-m-d H:i:s') . ' +7 hours');
        $date = $dateTime->format(('Y-m-d'));
        if ((int)$dateTime->format('H') < 5) {
            $date = (new DateTime(date('Y-m-d H:i:s') . ' -12 hours'))->format('Y-m-d');
        }

        $attendanceToday = Attendance::where(['date' => $date])->where(['user_id' => Auth::user()->id])->first();
        $attendanceToday->update([
            'status_attendance_id' => null,
            'note' => null,
        ]);

        return redirect('/attendance')->with('success-create', 'Ketidakhadiran dibatalkan, Absensi dibuka kembali!');
    }

    public function attendanceData(Request $request)
    {
        $first = new DateTime('2023-01-05');
        $last = new DateTime(date('Y-m-d H:i:s') . ' +7 hours');
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($first, $interval, $last);
        $numdate = iterator_count($period);
        
        $dataArray = array();
        $i = 0;
        foreach ($period as $dt) {
            $i++;
            $row = array();
            $attendance = Attendance::where(['date' => $dt->format("Y-m-d")])->where(['user_id' => Auth::user()->id])->first();
            $row['date'] = $dt->format("Y-m-d");
            $row['in'] = null;
            $row['out'] = null;
            $row['note'] = null;
            $row['status_id'] = null;
            $row['status_name'] = null;
            if ($attendance != null) {
                $row['in'] = $attendance->in != null ? (new DateTime($attendance->in))->format('H:i') : null;

                if ($attendance->out != null) {
                    $format = (new DateTime($attendance->out))->format('Y-m-d') != $dt->format("Y-m-d") ? 'H:i d M' : 'H:i';
                    $row['out'] = (new DateTime($attendance->out))->format($format);
                } else {
                    $row['out'] = null;
                }
                if ($attendance->statusattdetail != null) {
                    $row['status_id'] = $attendance->statusattdetail->id;
                    $row['status_name'] = $attendance->statusattdetail->name;
                    $row['in'] = '-';
                    $row['out'] = '-';
                    $row['note'] = $attendance->note ?? '-';
                }
            }
            if ($numdate == $i) {
                $row['out'] = '-';
            }
            $dataArray[] = $row;
        }

        if ($request->order != null) {
            if ($request->order[0]['dir'] == 'desc') {
                $dataArray = array_reverse($dataArray);
            }
        } else {
            $dataArray = array_reverse($dataArray);
        }

        if ($request->length != -1) {
            $dataArray = array_slice($dataArray, $request->start, $request->length);
        }

        $recordsTotal = $i;
        $recordsFiltered = $i;

        return json_encode([
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $dataArray
        ]);
    }
}
