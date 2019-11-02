<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Note;
use App\Record;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function error($msg, $url)
    {
        return view('error', ['msg' => $msg, 'url' => $url]);
    }

    public function index()
    {
        $notes = Note::all();
        return view('home', ['notes' => $notes]);
    }

    public function record()
    {
        $records = Record::all()->where('user_id', Auth::id());
        return view('record', ['records' => $records]);
    }

    public function purchase(Request $request, $id)
    {
        $note = Note::find($id);
        $user_id = Auth::id();
        if ($note and $user_id) {
            if (!Record::where('user_id', $user_id)->where('note_id', $note->id)->first()) {
                $user = User::find($user_id);
                if ($user->coin < $note->coin) return $this->error('残高不足', route('home'));
                $user->coin = $user->coin - $note->coin;
                $user->save();
                $note->sale = $note->sale + 1;
                $note->save();
                $seller_user = User::find($note->user_id);
                $seller_user->coin = $seller_user->coin + $note->coin / 2;
                $seller_user->save();
                $record = new Record;
                $record->user_id = $user_id;
                $record->note_id = $note->id;
                $record->save();
                return redirect()->route('home');
            } else {
                return 'すでに購入されています';
            }
        } else {
            return 'error';
        }
    }

    public function share(Request $request)
    {
        if ($request->isMethod('post') and $request->hasFile('notefile')) {
            $request->validate([
                'title' => 'required|max:20',
                'coin' => 'required',
            ]);
            $file = $request->file('notefile');
            $input = $request->all();
            $fileName = $this->upload($file);
            if ($fileName) {
                $note = new Note;
                $note->user_id = Auth::id();
                $note->title = $input['title'];
                $note->coin = $input['coin'];
                $note->filepath = $fileName;
                $note->save();
                return redirect()->route('home');
            }
            return 'アップロード失敗しました';
        }
        return view('share');
    }

    public function upload($file, $disk = 'public')
    {
        if (!$file->isValid()) {
            return false;
        }
        $fileExtension = $file->getClientOriginalExtension();
        if (!in_array($fileExtension, ['pdf'])) {
            return false;
        }
        $tmpFile = $file->getRealPath();
        if (filesize($tmpFile) >= 2048000) {
            return false;
        }
        if (!is_uploaded_file($tmpFile)) {
            return false;
        }
        $fileName = date('Y_m_d') . '/' . md5(time()) . mt_rand(0, 9999) . '.' . $fileExtension;
        if (Storage::disk($disk)->put($fileName, file_get_contents($tmpFile))) {
            return Storage::url($fileName);
        }
    }
}
