<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryStep;
use App\Http\Requests\StoreCategoryStep;
use App\Http\Requests\UpdateCategoryStep;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryStepController extends Controller {

    function __construct(Category $Category, CategoryStep $CategoryStep) {
        $this->category = $Category;
        $this->category_step = $CategoryStep;
        $this->middleware('role:categories_add', ['only' => ['create', 'store']]);
        $this->middleware('role:categories_edit', ['only' => ['edit', 'update']]);
        $this->middleware('role:categories_all', ['only' => ['show']]);
        $this->middleware('role:categories_delete', ['only' => ['destroy']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $category = $this->category->getById(request()->get('category_id'));
        return view('admin.categories_steps.create', ['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryStep $request) {
        // die;
        $this->category_step->add($request);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بإضافة مرحلة نوع مشروع جديدة ' . $request['ar_name'];
        $action->en_action = 'Add new step for project type ' . $request['en_name'];
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
        $category_step = $this->category_step->getById($id);
        return view('admin.categories_steps.edit', ['category_step' => $category_step]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryStep $request, $id) {
        //
        $category_step = $this->category_step->getById($id);

        $this->category_step->edit($id, $request);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل  مرحلة نوع مشروع حالية ' . $request['ar_name'];
        $action->en_action = 'Edit current step for project type ' . $request['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return redirect('admin/categories_steps/'.$category_step['category_id'])->with(['message' => $message]);
    }

    public function show($id) {
        $category = $this->category->getById($id);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بعرض  مراحل نوع مشروع  ' . $category['ar_name'];
        $action->en_action = 'show steps for project type ' . $category['en_name'];
        $action->ip = request()->ip();
        $action->save();

        return view('admin.categories_steps.show', ['category' => $category]);
    }
    public function destroy($id) {
        //
        $category_step = $this->category_step->getById($id);
        $this->category_step->remove($id);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بحذف  مرحلة نوع مشروع حالية ' . $category_step['ar_name'];
        $action->en_action = 'Delete current step for project type ' . $category_step['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.delete_suc');
        return back()->with(['message' => $message]);
    }

}
