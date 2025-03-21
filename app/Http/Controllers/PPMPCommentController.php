<?php

namespace App\Http\Controllers;

use App\Models\PPMP;
use App\Models\PPMPComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PPMPCommentController extends Controller
{
    //

    public function budgetOfficeAddCommentToPPMP(Request $request)
    {
        $validatedData = $request->validate([
            'addCommentId' => 'required|numeric|exists:p_p_m_p_s,id',
            'addComment' => 'required|string|max:255',
        ]);

        PPMPComment::create([
            'ppmp_id' => $validatedData['addCommentId'],
            'comment' => $validatedData['addComment'],
            'from_user' => Auth::user()->id,
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'Comment Successfully Sent!']);
    }

    public function endUserAddCommentToPPMP(Request $request)
    {
        $validatedData = $request->validate([
            'addCommentId' => 'required|numeric|exists:p_p_m_p_s,id',
            'addComment' => 'required|string|max:255',
        ]);

        PPMPComment::create([
            'ppmp_id' => $validatedData['addCommentId'],
            'comment' => $validatedData['addComment'],
            'from_user' => Auth::user()->id,
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'Comment Successfully Sent!']);
    }
}
