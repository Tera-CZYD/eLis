<?php

namespace App\Http\Controllers;

use App\Models\LogBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogBookController extends Controller
{
  /**
  * Display a listing of the resource.
  */
  public function index()
  {
    return LogBook::where('visible', 1)->paginate(25);
  }
  
  /**
  * Show the form for creating a new resource.
  */
  public function create()
  {
    //
  }
  
  /**
  * Store a newly created resource in storage.
  */
  public function store(Request $request)
  {
    $request->validate([
      'refno' => 'required',
      'name' => 'required',
      'department_id' => 'required',
      'log_inquiry_type' => 'required',
      'concerns' => 'required'
    ]);

    return LogBook::create($request->all());
  }
  
  /**
  * Display the specified resource.
  */
  public function show($id)
  {
    $logbook = LogBook::find($id);

    if (!$logbook) {
        return response()->json(['message' => 'Logbook not found'], 404);
    }

    return $logbook;
  }
  
  /**
  * Show the form for editing the specified resource.
  */
  public function edit(LogBook $logBook)
  {
    //
  }
  
  /**
  * Update the specified resource in storage.
  */
  public function update(Request $request, LogBook $logBook)
  {
    $request->validate([
      'refno' => 'required',
      'name' => 'required',
      'department_id' => 'required',
      'log_inquiry_type' => 'required',
      'concerns' => 'required'
    ]);
    $request->merge(['created' => (new \DateTime($request->input('created')))->format('Y-m-d H:i:s')]);
    $request->merge(['modified' => (new \DateTime($request->input('modified')))->format('Y-m-d H:i:s')]);
    $id = $request->input('id');
    // $data = $request->except(['id']);

    $affected = DB::table('log_books')
              ->where('id', $id)
              ->update($request->except(['id']));

    return $request;
  }
  
  /**
  * Remove the specified resource from storage.
  */
  public function destroy($id)
  {
    // dd($id);
    // $logBook->delete();

    $affected = DB::table('log_books')
              ->where('id', $id)
              ->update(['visible' => 0]);
        
    return LogBook::find($id);
  }
  
}
