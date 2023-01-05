<?php

namespace App\Http\Controllers;

use App\Helpers\Utilities;
use App\Models\EntryK;
use App\Models\Sls;
use App\Models\StatusDoc;
use App\Models\Subdistrict;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subdistricts = Subdistrict::all();
        return view('entry', ['subdistricts' => $subdistricts]);
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
            'begin' => 'required',
            'sls' => 'required',
            'village' => 'required',
            'subdistrict' => 'required'
        ]);

        EntryK::create([
            'sls_id' => $request->sls,
            'begin' => $request->begin,
            'status_id' => 2,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('/')->with('success-create', 'Data Entrian telah direkap!');
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
        $entry = EntryK::find($id);
        $isAllowed = $entry->user_id == Auth::user()->id;

        if (!$isAllowed) {
            abort(403);
        }

        return view('edit', ['entry' => $entry]);
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
        $entry = EntryK::find($id);
        $isAllowed = $entry->user_id == Auth::user()->id;

        if (!$isAllowed) {
            abort(403);
        }

        $request->validate([
            'finish' => 'required|after_or_equal:begin',
            'begin' => 'required|before_or_equal:finish',
            'total_entry' => 'required',
            'status_doc' => 'required',
        ]);

        $data = ([
            'finish' => $request->finish,
            'begin' => $request->begin,
            'total_entry' => $request->total_entry,
            'status_doc_id' => $request->status_doc,
            'note' => $request->note,
            'status_id' => 3
        ]);
        $entry->update($data);

        return redirect('/')->with('success-edit', 'Data Rekap Entri Telah Disimpan!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entry = EntryK::find($id);
        $isAllowed = $entry->user_id == Auth::user()->id;

        if (!$isAllowed) {
            abort(403);
        }

        EntryK::destroy($id);
        return redirect('/')->with('success-delete', 'Data Entrian telah dihapus!');
    }

    public function recap($id)
    {
        $entry = EntryK::find($id);
        $isAllowed = $entry->user_id == Auth::user()->id;

        if (!$isAllowed) {
            abort(403);
        }

        return view('finish', ['entry' => $entry]);
    }

    public function finish($id, Request $request)
    {
        $entry = EntryK::find($id);
        $isAllowed = $entry->user_id == Auth::user()->id;

        if (!$isAllowed) {
            abort(403);
        }

        $request->validate([
            'finish' => 'required|after_or_equal:begin',
            'total_entry' => 'required',
            'status_doc' => 'required',
        ]);

        $data = ([
            'finish' => $request->finish,
            'total_entry' => $request->total_entry,
            'status_doc_id' => $request->status_doc,
            'note' => $request->note,
            'status_id' => 3
        ]);
        $entry->update($data);

        return redirect('/')->with('success-finish', 'Data Rekap Entri Telah Disimpan!');;
    }

    public function getVillage($id)
    {
        return json_encode(Village::where('subdistrict_id', $id)->get());
    }

    public function getSls($id)
    {
        return json_encode(Sls::where('village_id', $id)->get());
    }

    public function getSlsEntried(Request $request)
    {
        $recordsTotal = EntryK::where(['user_id' => Auth::user()->id])->count();

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
        $entries = EntryK::where(['user_id' => Auth::user()->id])->get();
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

    public function checkSls($id)
    {
        $entries = Sls::find($id)->entriesK()->get();
        $entriesArray = array();
        foreach ($entries as $entry) {
            $entryData = array();
            $entryData['user_name'] = $entry->userdetail->name;
            $entryData['total_entry'] = $entry->total_entry ?? "-";
            $entryData['status'] = $entry->statusdetail->name;
            $entryData['status_id'] = $entry->statusdetail->id;
            $entriesArray[] = $entryData;
        }
        $hasEntriedBefore = count(Sls::find($id)->entriesK()->where(['user_id' => Auth::user()->id])->get()) > 0 ? true : false;
        return json_encode(["hasEntriedBefore" => $hasEntriedBefore, "data" => $entriesArray]);
    }

    public function checkIsEntrying()
    {
        $entries = EntryK::where(['user_id' => Auth::user()->id])->where(['status_id' => 2])->get();
        $isEntrying = count($entries) > 0 ? true : false;
        $id = count($entries) == 1 ? $entries[0]->id : null;
        $fullnameArray = [];
        foreach ($entries as $entry) {
            $fullnameArray[] = "[" . $entry->slsdetail->fullcode() . "] " . $entry->slsdetail->fullname();
        }
        return json_encode(['canEntry' => !$isEntrying, 'message' => Utilities::getSentenceFromArray($fullnameArray, '; '), 'id' => $id]);
    }
}
