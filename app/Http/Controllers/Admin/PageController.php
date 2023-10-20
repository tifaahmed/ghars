<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Http\Requests\StorePage;
use App\Http\Requests\UpdatePage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PageController extends Controller {

    //
    function __construct(Page $Page) {
        $this->page = $Page;
        $this->middleware('role:pages_all', ['only' => ['index']]);
        $this->middleware('role:pages_add', ['only' => ['create', 'store']]);
        $this->middleware('role:pages_edit', ['only' => ['edit', 'update']]);
        $this->middleware('role:pages_delete', ['only' => ['destroy']]);
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
        $action->ar_action = 'قام بفتح صفحة صفحات الموقع';
        $action->en_action = 'Open website pages';
        $action->ip = request()->ip();
        $action->save();

        $pages = $this->page->getAll();
        return view('admin.pages.index', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePage $request) {
        $this->page->add($request);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بإضافة صفحة جديدة ' . $request['ar_title'];
        $action->en_action = 'Add new page ' . $request['en_title'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.add_suc');
        return back()->with(['message' => $message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $page = $this->page->getById($id);
        return view('admin.pages.edit', ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePage $request, $id) {
        //
        $filename = FALSE;
        if ($request->hasFile('image')) {
            $file = $request['image'];
            $filename = Str::random(5) . '.' . $file->getClientOriginalName();
            $destinationPath = public_path('upload/pages/');
            $file->move($destinationPath, $filename);
        }
        $this->page->edit($id, $request, $filename);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل  صفحة حالية ' . $request['ar_title'];
        $action->en_action = 'Edit current page ' . $request['en_title'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return redirect('admin/pages')->with(['message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $page = $this->page->getById($id);
        $this->page->remove($id);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بحذف صفحة حالية ' . $page['ar_title'];
        $action->en_action = 'Delete current page ' . $page['en_title'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.delete_suc');
        return back()->with(['message' => $message]);
    }

}
