<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    // create member
    public function createMember(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50',
            'nim' => 'required|string|max:20',
            'wa' => 'required|string|max:13',
        ]);

        Member::create([
            'username' => $request->username,
            'nim' => $request->nim,
            'wa' => $request->wa,
        ]);

        return redirect()->route('readMember');
    }

    public function readMember(Request $request)
    {
        $search = $request->input('search');

        $users = Member::query()
            ->when($search, function ($query, $search) {
                return $query->where('username', 'like', '%' . $search . '%');
            })
            ->orderBy('username', 'asc')
            ->paginate(10);

        return view('admin.member', compact('users'));
    }


    // get member
    public function getMember($id)
    {
        $member = Member::findOrFail($id);
        return response()->json($member);
    }

    // update member
    public function updateMember(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:50',
            'nim' => 'required|string|max:20',
            'wa' => 'required|string|max:13',
        ]);

        $user = Member::findOrFail($id);
        $user->username = $request->username;
        $user->nim = $request->nim;
        $user->wa = $request->wa;
        $user->save();

        return redirect()->route('readMember');
    }

    // delete member
    public function deleteMember($id)
    {
        $user = Member::findOrFail($id);
        $user->delete();

        return redirect()->route('readMember');
    }

}
