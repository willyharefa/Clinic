<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function insert(Request $request, $id)
    {
        Schedule::create([
            'doctor_id' => $id,
            'date' => $request->date,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return redirect()->route('schedule')->with('success', 'Selamat, jadwal berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        Schedule::where('id', $id)->update([
            'date' => $request->new_date,
            'start' => $request->new_start,
            'end' => $request->new_end,
        ]);
        return redirect()->route('schedule')->with('success', 'Selamat tanggal ' . Carbon::parse($request['new_date'])->format('d F Y') .' berhasil diperbaharui.');
    }

    public function delete($id)
    {
        $data = Schedule::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'Selamat, tanggal '. Carbon::parse($data['date'])->format('d F Y') .' berhasil dihapus');
    }
}
