<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectReport;
use App\Http\Requests\UpdateProjectCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller {

    function __construct(Project $Project, ProjectReport $ProjectReport) {
        $this->project = $Project;
        $this->project_report = $ProjectReport;
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
        $action->ar_action = 'قام بفتح صفحة مشاريع الشركة';
        $action->en_action = 'Open company projects page';
        $action->ip = request()->ip();
        $action->save();

        return view('dashboard.projects.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $project = $this->project->getById($id);

        return view('dashboard.projects.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectCompany $request, $id) {
        //
        $project = $this->project->getById($id);
        if ($project['company_id'] != Auth::User()->id) {
            return redirect('dashboard/not_allow');
        }

        if ($project['active'] == 'yet') {
            $this->project->edit_company($id, $request);
        }

        if (isset($request['files'])) {
            $destinationPath = public_path('upload/projects/');
            $i = 0;
            $files = $request['files'];
            $ar_names = $request['ar_names'];
            $en_names = $request['en_names'];
            foreach ($files as $file) {
                if ($file != "") {
                    $filename = Str::random(5) . '.' . $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);

                    $this->project_report->add($id, $ar_names[$i], $en_names[$i], 'yet', $filename);
                }
                $i++;
            }
        }

        $action = new \App\Models\Action();
        $action->user_id = Auth::User()->id;
        $action->ar_action = 'قام برفع تقرير مشروع حالي ' . $request['ar_name'];
        $action->en_action = 'Upload report for current project ' . $request['en_name'];
        $action->ip = request()->ip();
        $action->save();

        $message = trans('admin.edit_suc');
        return redirect('dashboard/projects')->with(['message' => $message]);
    }

}
