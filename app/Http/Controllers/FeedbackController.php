<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    // ✅ Save or Update Feedback
    public function store(Request $request)
    {
        $senderId = $request->input('sender_id');
        $receiverId = $request->input('receiver_id');
        $message = $request->input('message');
        $id = $request->input('id');

        if ($id) {
            // Update existing feedback
            DB::table('feedbacks')
                ->where('id', $id)
                ->update([
                    'message' => $message,
                    'updated_at' => now()
                ]);

            $updated = DB::table('feedbacks')->where('id', $id)->first();
            return response()->json($updated);
        } else {
            // Insert new feedback
            $newId = DB::table('feedbacks')->insertGetId([
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
                'message' => $message,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $newFeedback = DB::table('feedbacks')->where('id', $newId)->first();
            return response()->json($newFeedback);
        }
    }

    // ✅ Delete Feedback
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('delete_id');

            if (!$id) {
                return response()->json(['error' => 'Missing ID'], 400);
            }

            DB::table('feedbacks')->where('id', $id)->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error("Feedback delete failed: " . $e->getMessage());
            return response()->json(['error' => 'Server error', 'details' => $e->getMessage()], 500);
        }
    }

    public function all()
    {
        $feedbacks = DB::table('feedbacks')
            ->where('receiver_id', 1) // optional filter
            ->orderBy('id')
            ->get();

        return response()->json($feedbacks);
    }

}
