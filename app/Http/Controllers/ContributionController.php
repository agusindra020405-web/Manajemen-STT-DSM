<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Contribution;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    public function index(Request $request)
    {
        $bulanSekarang = $request->get('bulan', date('F'));
        $tahunSekarang = $request->get('tahun', date('Y'));

        // Mengambil anggota dan data iuran pada bulan/tahun tertentu
        $members = Member::with(['contributions' => function ($query) use ($bulanSekarang, $tahunSekarang) {
            $query->where('month', $bulanSekarang)->where('year', $tahunSekarang);
        }])->paginate(20);

        // Hitung ringkasan untuk kartu di atas
        $totalTerbayar = Contribution::where('month', $bulanSekarang)->where('status', 'PAID')->sum('amount');
        $totalTunggakan = Contribution::where('month', $bulanSekarang)->where('status', 'UNPAID')->sum('amount');

        return view('admin.contributions.index', compact('members', 'totalTerbayar', 'totalTunggakan', 'bulanSekarang'));
    }
}
