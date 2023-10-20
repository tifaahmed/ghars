<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPortfolio;
use App\Models\UserPortfolioImage;
use App\Http\Requests\StorePortfolio;
use App\Http\Requests\UpdatePortfolio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class PortfolioController extends Controller {

    function __construct(User $User, UserPortfolio $UserPortfolio, UserPortfolioImage $UserPortfolioImage) {
        $this->user = $User;
        $this->user_portfolio = $UserPortfolio;
        $this->user_portfolio_image = $UserPortfolioImage;
        $this->middleware('role:portfolio_all', ['only' => ['index']]);
        $this->middleware('role:portfolio_add', ['only' => ['create', 'store']]);
        $this->middleware('role:portfolio_show', ['only' => ['show']]);
        $this->middleware('role:portfolio_edit', ['only' => ['edit', 'update']]);
        $this->middleware('role:portfolio_delete', ['only' => ['destroy']]);
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
        $action->ar_action = 'قام بفتح صفحة أعمال الشركات';
        $action->en_action = 'Open companies portfolio page';
        $action->ip = request()->ip();
        $action->save();

        $portfolio = $this->user_portfolio->getAll();
        return view('admin.portfolio.index', ['portfolio' => $portfolio]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $companies = $this->user->getList('company');
        $companies = Arr::add($companies, '', trans('admin.choose_company'));
        $companies = array_reverse($companies, TRUE);

        return view('admin.portfolio.create', ['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePortfolio $request) {
        $destinationPath = public_path('upload/portfolio/');
        $file = $request['image'];
        $filename = Str::random(5) . '.' . $file->getClientOriginalName();
        $file->move($destinationPath, $filename);

        $id = $this->user_portfolio->add($request, $filename);

        if (isset($request['images'])) {
            $images = $request['images'];
            foreach ($images as $image) {
                if ($image != "") {
                    $file = $image;
                    $filename = Str::random(5) . '.' . $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);

                    $this->user_portfolio_image->add($id, $filename);
                }
            }
        }

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بإضافة عمل جيد ' . $request['ar_name'];
        $action->en_action = 'Add new portfolio ' . $request['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.add_suc');
        return back()->with(['message' => $message]);
    }

    public function show($id) {
        $company = $this->user->getById($id);
        return view('admin.portfolio.show', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $portfolio = $this->user_portfolio->getById($id);

        $companies = $this->user->getList('company');
        $companies = Arr::add($companies, '', trans('admin.choose_company'));
        $companies = array_reverse($companies, TRUE);

        return view('admin.portfolio.edit', ['portfolio' => $portfolio, 'companies' => $companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePortfolio $request, $id) {
        $filename = FALSE;
        if ($request->hasFile('image')) {
            $file = $request['image'];
            $filename = Str::random(5) . '.' . $file->getClientOriginalName();
            $destinationPath = public_path('upload/portfolio/');
            $file->move($destinationPath, $filename);
        }

        $this->user_portfolio->edit($id, $request, $filename);

        if (isset($request['images'])) {
            $images = $request['images'];
            foreach ($images as $image) {
                if ($image != "") {
                    $file = $image;
                    $filename = Str::random(5) . '.' . $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);

                    $this->user_portfolio_image->add($id, $filename);
                }
            }
        }

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بتعديل عمل حالي' . $request['ar_name'];
        $action->en_action = 'Edit current portfolio ' . $request['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return redirect('admin/portfolio')->with(['message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $portfolio = $this->user_portfolio->getById($id);
        foreach ($portfolio['Images'] as $image) {
            $this->user_portfolio_image->remove($image['id']);
        }
        $this->user_portfolio->remove($id);

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام بحذف عمل حالي' . $portfolio['ar_name'];
        $action->en_action = 'Delete current portfolio ' . $portfolio['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.delete_suc');
        return back()->with(['message' => $message]);
    }

    public function delete_image($id) {
        $this->user_portfolio_image->remove($id);
        $message = trans('admin.delete_suc');
        return back()->with(['message' => $message]);
    }

}
