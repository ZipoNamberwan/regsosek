<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
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
        $begin = new DateTime('2023-01-01');
        $now = new DateTime(date('Y-m-d H:i:s') . ' +7 hours');

        $attendanceToday = Attendance::where(['user_id' => Auth::user()->id])->where(['date' => $now->format('Y-m-d')])->first();
        $in = null;
        $out = null;
        if ($attendanceToday != null) {
            $in = $attendanceToday->in != null ? (new DateTime($attendanceToday->in))->format('H:i') : null;
            $out = $attendanceToday->out != null ? (new DateTime($attendanceToday->out))->format('H:i') : null;
        }

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $now);

        $dataArray = array();
        foreach ($period as $dt) {
            $row = array();
            $row['date'] = $dt->format("Y-m-d H:i:s");
            $dataArray[] = $row;
        }

        return view('attendance/index', ['in' => $in, 'out' => $out]);
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
            // dd($attendanceToday);
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

        return redirect('/attendance');
    }
}
