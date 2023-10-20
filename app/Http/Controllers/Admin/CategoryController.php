<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller {

    function __construct(Category $Category) {
        $this->category = $Category;
        $this->middleware('role:categories_all', ['only' => ['index']]);
        $this->middleware('role:categories_add', ['only' => ['create', 'store']]);
        $this->middleware('role:categories_edit', ['only' => ['edit', 'update']]);
        $this->middleware('role:categories_delete', ['only' => ['destroy']]);
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
        $action->ar_action = 'قام بفتح صفحة أنواع المشاريع';
        $action->en_action = 'Open projects types page';
        $action->ip = request()->ip();
        $action->save();

        $categories = $this->category->getAll();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request) {
        $destinationPath = public_path('upload/categories/');
        $file = $request['image'];
        $filename = Str::random(5) . '.' . $file->getClientOriginalName();
        $file->move($destinationPath, $filename);

        $this->category->add($request, $filename);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بإضافة نوع مشزوع جديد ' . $request['ar_name'];
        $action->en_action = 'Add new project type ' . $request['en_name'];
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
        $category = $this->category->getById($id);

        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategory $request, $id) {
        $filename = FALSE;
        if ($request->hasFile('image')) {
            $file = $request['image'];
            $filename = Str::random(5) . '.' . $file->getClientOriginalName();
            $destinationPath = public_path('upload/categories/');
            $file->move($destinationPath, $filename);
        }

        $this->category->edit($id, $request, $filename);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل  نوع مشروع حالي ' . $request['ar_name'];
        $action->en_action = 'Edit current project type ' . $request['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return redirect('admin/categories')->with(['message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $category = $this->category->getById($id);
        $this->category->remove($id);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بحذف نوع مشروع حالي ' . $category['ar_name'];
        $action->en_action = 'Delete current categories ' . $category['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.delete_suc');
        return back()->with(['message' => $message]);
    }

}
