<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        // Mencari data berdasarkan nama, telepon, atau alamat jika ada input pencarian
        $members = Member::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%");
        })->paginate(20)->withQueryString(); // withQueryString agar pagination tetap bekerja saat searching

        return view('admin.anggota', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        Member::create($request->all());
        return redirect()->route('member.index')->with('success', 'Member berhasil ditambahkan.');
    }

    public function create()
    {
        return view('admin.create_anggota');
    }

    public function update(Request $request, Member $member)
    {
        // Tambahkan ini agar data yang masuk tetap valid
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $member->update($request->all());
        return redirect()->route('member.index')->with('success', 'Data member diperbarui.');
    }

    public function edit(Member $member)
    {
        //  menampilkan form edit
        return view('admin.edit_anggota', compact('member'));
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('member.index')->with('success', 'Member telah dihapus.');
    }
}
