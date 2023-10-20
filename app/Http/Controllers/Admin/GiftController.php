<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gift;
use App\Http\Requests\StoreGift;
use App\Http\Requests\UpdateGift;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GiftController extends Controller {

    function __construct(Gift $Gift) {
        $this->gift = $Gift;
        $this->middleware('role:gifts_all', ['only' => ['index']]);
        $this->middleware('role:gifts_add', ['only' => ['create', 'store']]);
        $this->middleware('role:gifts_edit', ['only' => ['edit', 'update']]);
        $this->middleware('role:gifts_delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بفتح صفحة الهدايا';
        $action->en_action = 'Open gifts page';
        $action->ip = request()->ip();
        $action->save();

        $gifts = $this->gift->getAll();
        return view('admin.gifts.index', ['gifts' => $gifts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return view('admin.gifts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGift $request) {
        $destinationPath = public_path('upload/gifts/');
        $file = $request['image'];
        $filename = Str::random(5) . '.' . $file->getClientOriginalName();
        $file->move($destinationPath, $filename);

        $this->gift->add($request, $filename);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بإضافة هدية جديدة ' . $request['ar_name'];
        $action->en_action = 'Add new gift ' . $request['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.add_suc');
        return back()->with(['message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $gift = $this->gift->getById($id);

        return view('admin.gifts.edit', ['gift' => $gift]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGift $request, $id) {
        $filename = FALSE;
        if ($request->hasFile('image')) {
            $file = $request['image'];
            $filename = Str::random(5) . '.' . $file->getClientOriginalName();
            $destinationPath = public_path('upload/gifts/');
            $file->move($destinationPath, $filename);
        }

        $this->gift->edit($id, $request, $filename);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل  هدية حالية ' . $request['ar_name'];
        $action->en_action = 'Edit current gift ' . $request['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return redirect('admin/gifts')->with(['message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $gift = $this->gift->getById($id);
        $this->gift->remove($id);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بحذف هدية حالية ' . $gift['ar_name'];
        $action->en_action = 'Delete current gifts ' . $gift['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.delete_suc');
        return back()->with(['message' => $message]);
    }

}
