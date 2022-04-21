<?php

namespace App\Http\Controllers;

use App\Models\StockIn;
use App\Models\Medicine;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Pharmacist;
use App\Models\Prescription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PharmacistController extends Controller
{
    public function entryData(Request $request)
    {
        $title = "Tambah Data Obat";
        $data = Pharmacist::find(Auth::guard('pharmacist')->user()->id);
        if($request->input('date')) {
            $medicine = Medicine::where('date_of_entry', 'LIKE', $request->input('date'))->paginate(10);
        } elseif($request->input('search_data')) {
            $medicine = Medicine::where('name', 'LIKE', $request->input('search_data'))
                        ->orWhere('supplier', 'LIKE', $request->input('search_data'))
                        ->paginate(10);
        } else {
            $medicine = Medicine::paginate(10);
        }
        return view('pages.pharmacist.add_medicine', compact('title', 'data', 'medicine'));
    }

    public function insert(Request $request)
    {
        Medicine::create([
            'name' => $request->name,
            'unit' => $request->unit,
            'quantity' => $request->quantity,
            'cost' => $request->cost,
            'date_expired' => $request->date_expired,
            'supplier' => $request->supplier,
            'date_of_entry' => $request->date_of_entry
        ]);
        StockIn::create([
            'name' => $request->name,
            'unit' => $request->unit,
            'quantity' => $request->quantity,
            'cost' => $request->cost,
            'date_expired' => $request->date_expired,
            'supplier' => $request->supplier,
            'date_of_entry' => $request->date_of_entry
        ]);

        return redirect()->back()->with("success", "Selamat obat $request->name berhasil ditambahkan.");

    }
    public function stockIn(Request $request)
    {
        
        $title = "Laporan Stok Masuk";
        $data = Pharmacist::find(Auth::guard('pharmacist')->user()->id);
        if(!empty($request->input('start') && $request->input('end') && $request->input('medicine'))) {
            $stock_in = StockIn::whereBetween('date_of_entry',[$request->input('start'), $request->input('end')])
                                ->where('name', 'LIKE', $request->input('medicine'))
                                ->orWhere('supplier', 'LIKE', $request->input('medicine'))
                                ->paginate(7);
        }
        elseif(!empty($request->input('medicine') && $request->input('start')) && empty($request->input('end')) ) {
            $stock_in = StockIn::where('name', 'LIKE', $request->input('medicine'))
                                ->orWhere('supplier', 'LIKE', $request->input('medicine'))
                                ->whereDate('date_of_entry','LIKE', $request->input('start'))
                                ->paginate(7);
        }
        elseif(!empty($request->input('medicine') && $request->input('end')) && empty($request->input('start')) ) {
            $stock_in = StockIn::where('name', 'LIKE', $request->input('medicine'))
                                ->orWhere('supplier', 'LIKE', $request->input('medicine'))
                                ->whereDate('date_of_entry','LIKE', $request->input('end'))
                                ->paginate(7);
        }
        elseif(!empty($request->input('start') && $request->input('end')) && empty($request->input('medicine'))) {
            // Start annd END tidak kosong.
            $stock_in = StockIn::whereBetween('date_of_entry',[$request->input('start'), $request->input('end')])
                                ->orderBy('date_of_entry', 'asc')
                                ->paginate(7);
        } 
            // Jika Medicine dan (START and END) kosong
        elseif(!empty($request->input('medicine')) && empty($request->input('start') && $request->input('end'))) {
            $stock_in = StockIn::where('name', $request->input('medicine'))
                                ->orWhere('supplier', 'LIKE', $request->input('medicine'))
                                ->paginate(7);
        }
            // Jika START atau END tidak ksong dan Medicine Kosong
        
        elseif(!empty($request->input('start') || $request->input('end')) && empty($request->input('medicine')) )
        {
            $stock_in = StockIn::whereDate('date_of_entry','LIKE', $request->input('start'))
                                ->orwhereDate('date_of_entry','LIKE', $request->input('end'))
                                ->paginate(7);
        }
        


        else {
            $stock_in = StockIn::paginate(7);
        }
        return view('pages.pharmacist.reports_stock_in', compact('title', 'data', 'stock_in'));
    }
    public function stockOut(Request $request)
    {
        
        $title = "Laporan Stok Keluar";
        $data = Pharmacist::find(Auth::guard('pharmacist')->user()->id);
        $medicine = Medicine::all();

        if( !$request->input('medicine') == null && $request->input('start') == null && $request->input('end') == null )
        {
            $prescription = Prescription::where('medicine_id', $request->input('medicine'))->paginate(7);
        }
        elseif( !($request->input('medicine') && $request->input('start')) == null && $request->input('end') == null )
        {
            
            $prescription = Prescription::where('medicine_id', $request->input('medicine'))
                            ->whereDate('created_at', 'LIKE', $request->input('start'))
                            ->paginate(7);
        }
        elseif( !($request->input('medicine') && $request->input('end')) == null && $request->input('start') == null )
        {
            $prescription = Prescription::where('medicine_id', $request->input('medicine'))
                            ->whereDate('created_at', 'LIKE', $request->input('end'))
                            ->paginate(7);
        }
        elseif( !($request->input('start') && $request->input('end')) == null && $request->input('medicine') == null )
        {
            $prescription = Prescription::whereBetween('created_at',[$request->input('start'), $request->input('end')])->paginate(7);
        }
        elseif( !( $request->input('start') && $request->input('end') && $request->input('medicine') ) == null )
        {
            $prescription = Prescription::where('medicine_id', $request->input('medicine'))
                            ->whereBetween('created_at',[$request->input('start'), $request->input('end')])
                            ->paginate(7);
        } 
        elseif( !empty($request->input('start')) || !empty($request->input('end')) || !empty($request->input('medicine')))
        {
            $prescription = Prescription::where('medicine_id', $request->input('medicine'))
                            ->orWhereDate('created_at', 'LIKE', $request->input('start'))
                            ->orWhereDate('created_at', 'LIKE', $request->input('end'))
                            ->paginate(7);
        } 
        else {
            $prescription = Prescription::paginate(7);
        }
        
        return view('pages.pharmacist.reports_stock_out', compact('title', 'data', 'medicine', 'prescription'));
    }

    public function inputStock()
    {
        $title = "Tambah Stock Obat";
        $medicine = Medicine::all();
        $data = Pharmacist::find(Auth::guard('pharmacist')->user()->id);
        return view('pages.pharmacist.add_stock', compact('title', 'data', 'medicine'));
    }

    public function updateStock(Request $request, $id)
    {
        Medicine::find($id)->update([
            'name' => $request->new_name,
            'unit' => $request->new_unit,
            'quantity' => $request->new_quantity,
            'cost' => $request->new_cost,
            'date_expired' => $request->new_date_expired,
            'supplier' => $request->new_supplier,
            'date_of_entry' => $request->new_date_entry
        ]);
        
        return redirect()->back()->with("success", "Data obat $request->new_name berhasil diperbaharui.");
    }

    public function deleteStock($id)
    {
        Medicine::find($id)->delete();
        return redirect()->back()->with("success", "Data obat berhasil dihapus.");
    }

    public function insertStock(Request $request)
    {
        // dd(request());
        $dataMedicine = Medicine::find($request->medicine_id);
        $dataMedicine->increment('quantity',$request->quantity);
        Medicine::find($request->medicine_id)
                        ->update([
                        'date_expired' => $request->date_expired,
                        'date_of_entry' => $request->date_entry,
                    ]);
        StockIn::create([
            'name' => $dataMedicine->name,
            'unit' => $request->unit,
            'quantity' => $request->quantity,
            'cost' => $dataMedicine->cost,
            'date_expired' => $request->date_expired,
            'supplier' => $request->supplier,
            'date_of_entry' => $request->date_entry
        ]);

        return redirect()->back()->with("success", "Stok obat $dataMedicine->name berhasil ditambahkan.");
    }

    public function updateExpired($id)
    {
        Medicine::find($id)->update([
            'date_expired' => request()->new_date,
        ]);
        return redirect()->back()->with('success','Selamat data obat berhasil diperbaharui');
    }

    public function updateStockLess($id)
    {
        Medicine::find($id)->increment('quantity', request()->new_stock);
        return redirect()->back()->with('success','Selamat data obat berhasil diperbaharui');
    }

    public function stockPullTrash($id)
    {
        Medicine::find($id)->delete();
        return redirect()->back()->with("success", "Selamat data berhasil ditarik dari databases.");
    }
    public function downloadStockIn(Request $request)
    {
        if(!empty($request->input('start_filter') && $request->input('end_filter') && $request->input('name_filter'))) {
            $stock_in = StockIn::where('name', 'LIKE', $request->input('name_filter'))
                                ->orWhere('supplier', 'LIKE', $request->input('name_filter'))
                                ->whereBetween('date_of_entry',[$request->input('start_filter'), $request->input('end_filter')])
                                ->get();
        }
        elseif(!empty($request->input('name_filter') && $request->input('start_filter')) && empty($request->input('end_filter')) ) {
            $stock_in = StockIn::where('name', 'LIKE', $request->input('name_filter'))
                                ->orWhere('supplier', 'LIKE', $request->input('name_filter'))
                                ->whereDate('date_of_entry','LIKE', $request->input('start_filter'))
                                ->get();
        }
        elseif(!empty($request->input('name_filter') && $request->input('end_filter')) && empty($request->input('start_filter')) ) {
            $stock_in = StockIn::where('name', 'LIKE', $request->input('name_filter'))
                                ->orWhere('supplier', 'LIKE', $request->input('name_filter'))
                                ->whereDate('date_of_entry','LIKE', $request->input('end_filter'))
                                ->get();
        }
        elseif(!empty($request->input('start_filter_filter') && $request->input('end_filter_filter')) && empty($request->input('name_filter'))) {
            $stock_in = StockIn::whereBetween('date_of_entry',[$request->input('start_filter_filter'), $request->input('end_filter_filter')])
                                ->orderBy('date_of_entry', 'asc')
                                ->get();
        } 

        elseif(!empty($request->input('name_filter')) && empty($request->input('start_filter') && $request->input('end_filter'))) {
            $stock_in = StockIn::where('name', $request->input('name_filter'))
                                ->orWhere('supplier', 'LIKE', $request->input('name_filter'))
                                ->get();
        }
        elseif(!empty($request->input('start_filter') || $request->input('end_filter')) && empty($request->input('name_filter')) )
        {
            $stock_in = StockIn::whereDate('date_of_entry','LIKE', $request->input('start_filter'))
                                ->orwhereDate('date_of_entry','LIKE', $request->input('end_filter'))
                                ->get();
        }
        else {
            $stock_in = StockIn::all();
        }

        $dateNow = Carbon::now();
        $mark = $dateNow->year.$dateNow->month.$dateNow->day.$dateNow->second; 
        $pdf = PDF::loadview('pages.pharmacist.pdf.download_stock_in', compact('stock_in', 'mark'))->setPaper('A4', 'portrait');
        return $pdf->stream("Invoice_stock_in_".$mark.".pdf");
    }

    public function downloadStockOut()
    {
        if(!empty(request()->name_filter) && empty(request()->start_filter) && empty(request()->end_filter)) {
            $stock_out = Prescription::where('medicine_id', 'LIKE', request()->name_filter)->get();
        } elseif(!empty(request()->start_filter && request()->end_filter) && empty(request()->name_filter)) {
            $stock_out = Prescription::whereBetween('created_at', [request()->start_filter, request()->end_filter])->get();
        } elseif(!empty(request()->name_filter) && !empty(request()->start_filter) && !empty(request()->end_filter)) {
            $stock_out = Prescription::where('medicine_id', 'LIKE', request()->name_filter)
                                ->whereBetween('created_at', [request()->start_filter, request()->end_filter])
                                ->get();
        } elseif(!empty( request()->name_filter || request()->start_filter || request()->end_filter )) {
            $stock_out = Prescription::where('medicine_id', 'LIKE', request()->name_filter)
                                ->orWhereDate('created_at', 'LIKE', request()->start_filter)
                                ->orWhereDate('created_at', 'LIKE', request()->end_filter)
                                ->get();
        } 
        else {
            $stock_out = Prescription::all();
            
        }

        $dateNow = Carbon::now();
        $mark = $dateNow->year.$dateNow->month.$dateNow->day.$dateNow->second; 
        $pdf = PDF::loadview('pages.pharmacist.pdf.download_stock_out', compact('stock_out', 'mark'))->setPaper('A4', 'portrait');
        return $pdf->stream("Invoice_stock_in_".$mark.".pdf");
    }
}
