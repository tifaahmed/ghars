<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserPortfolio;
use App\Models\UserPortfolioImage;
use App\Http\Requests\StorePortfolio;
use App\Http\Requests\UpdatePortfolio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class PortfolioController extends Controller {

    function __construct(UserPortfolio $UserPortfolio, UserPortfolioImage $UserPortfolioImage) {
        $this->user_portfolio = $UserPortfolio;
        $this->user_portfolio_image = $UserPortfolioImage;
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
        $action->ar_action = 'قام بفتح صفحة أعمال الشركة';
        $action->en_action = 'Open company portfolio page';
        $action->ip = request()->ip();
        $action->save();

        return view('dashboard.portfolio.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return view('dashboard.portfolio.create');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $portfolio = $this->user_portfolio->getById($id);

        return view('dashboard.portfolio.edit', ['portfolio' => $portfolio]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePortfolio $request, $id) {
        $portfolio = $this->user_portfolio->getById($id);
        if ($portfolio['user_id'] != Auth::User()->id) {
            return redirect('dashboard/not_allow');
        }
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
        return redirect('dashboard/portfolio')->with(['message' => $message]);
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
        if ($portfolio['user_id'] != Auth::User()->id) {
            return redirect('dashboard/not_allow');
        }
        
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

    public function show($id) {
        $this->user_portfolio_image->remove($id);
        $message = trans('admin.delete_suc');
        return back()->with(['message' => $message]);
    }

}
