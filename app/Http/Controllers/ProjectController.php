<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignMarketer;
use App\Models\LandingPage;
use App\Models\Project;
use App\Models\ProjectCity;
use App\Models\ProjectLink;
use App\Models\ProjectTeam;
use App\Models\Team;
use Illuminate\Http\Request;
use App\User;

class ProjectController extends Controller
{
    private $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Project $model)
    {
        $this->model = $model;
    }

    /**
     * view  index of projects
     */
    public function index()
    {
        $requestData = $this->model::where('idParent', null)->get()->toArray();

        return View('projects.view', compact('requestData'));
    }

    public function getAllData(Request $request)
    {
        $paginationOptions = $request->input('pagination');
        if ($paginationOptions['perpage'] == -1) {
            $paginationOptions['perpage'] = 0;
        }

        $data = $this->model::where('idParent', null)
            ->paginate($paginationOptions['perpage'], ['*'], 'page', $paginationOptions['page']);

        $meta = [
            "page" => $data->currentPage(),
            "pages" => intval($data->total() / $data->perPage()),
            "perpage" => $data->perPage(),
            "total" => $data->total(),
            "sort" => "asc",
            "field" => "id",
        ];

        $requestData = [
            'meta' => $meta,
            'data' => $data->items(),
        ];

        return $requestData;

    }

    /**
     * view create page to store project
     */
    public function create()
    {
        $teams = Team::all()->toArray();
        return View('projects.add', compact('teams'));
    }


    public function dropDownCity(Request $request)
    {
        $country = $request->option;

        $cities = ProjectCity::where('country', $country)->get();

        return $cities;

    }

    /**
     * store project
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'teams' => 'required',
        ]);
        $imageName = null;
        if ($request->image) {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $imageName);
        }

        $cityId = $request->cityId;
        if ($request->cityId == 0) {
            $cityId = null;
        }

        $data = array(
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName,
            'country' => $request->country,
            'cityId' => $cityId,
            'location' => $request->location,

        );
//
//        //insert record
        $project = $this->model->create($data);

//        foreach ($request->links as $link){
//            $linkData = [
//                'link' => $link,
//                'projectId' =>$project->id,
//            ];
//
//            ProjectLink::create($linkData);
//        }

        foreach ($request->teams as $team) {

            $teamData = [
                'teamId' => $team,
                'projectId' => $project->id,
            ];

            ProjectTeam::create($teamData);
        }

        return redirect('/projects')->with('success', 'Stored successfully');
    }

    /**
     * view edit page to update project
     */
    public function edit($id)
    {
        $requestData = $this->model->find($id);

        return View('projects.edit', compact('requestData'));
    }

    /**
     * update project
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|unique:projects|max:255',
        ]);

        $model = $this->model->find($id);
        $model->name = $request->name;
        $model->description = $request->description;
        $model->save();

        return redirect('/projects')->with('success', 'Updated successfully');
    }

    /**
     * delete project
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return redirect('/projects')->with('success', 'Deleted successfully');
    }

    /**
     * view create page to store project
     */
    public function createSubProject()
    {
        $projects = Project::where('idParent', null)->get()->toArray();
        return View('projects.sub_project', compact('projects'));
    }

    /**
     * store sub project
     */
    public function storeSubProject(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'projectId' => 'required|integer',
            'teams' => 'required',
        ]);


        $data = array(
            'name' => $request->name,
            'idParent' => $request->projectId,
        );
//
//        //insert record
        $project = $this->model->create($data);

        foreach ($request->teams as $team) {

            $teamData = [
                'teamId' => $team,
                'projectId' => $project->id,
            ];

            ProjectTeam::create($teamData);
        }

        return redirect('/projects')->with('success', 'Stored successfully');
    }


    public function dropDownTeams(Request $request)
    {
        $project = Project::find($request->option);
        $teams = $project->teams()->get();
        return $teams;

    }

    public function createProjectDetail($id)
    {
        $project = Project::where('id', $id)->first();
        $marketers = User::where('roleId', 6)->get()->toArray();
        return View('projects.custom', compact('project', 'marketers'));

    }

    public function storeProjectDetail(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'projectId' => 'required|integer',
            'marketers' => 'required',
            'description' => 'required',
            'link' => 'required|alpha_dash',
        ]);
        //campaign
        $data = array(
            'name' => $request->name,
            'description' => $request->description,
            'projectId' => $request->projectId,
        );
        $campaignCreated = Campaign::create($data);

        //campaign marketers
        foreach ($request->marketers as $marketer) {

            $marketerData = [
                'marketerId' => $marketer,
                'campaignId' => $campaignCreated->id,
            ];

            CampaignMarketer::create($marketerData);
        }

        //campaign links

        $baseUrl = url('/');

            $linkData = [
                'link' => $baseUrl . '/landing_page/' . $request->link,
                'alias' => $baseUrl . '/landing_page/' . $request->link,
                'projectId' => $request->projectId,
                'campaignId' => $campaignCreated->id,
                'platform' => $request->platform,
            ];

            $linkCreated = ProjectLink::create($linkData);
//

        //landing page

        $content = array(
            'article' => $request->article,
            'image' => 'test',
        );

        $content = json_encode($content);

        $pageData = [
            'templateName' => $request->templateName,
            'linkId' => $linkCreated->id,
            'content' => $content,
        ];

        LandingPage::create($pageData);

        return redirect('/projects')->with('success', 'Stored successfully');
    }

    public function show($link)
    {
        $baseUrl = url('/');
        $url = $baseUrl . '/landing_page/' . $link;
        $projectLink = ProjectLink::where('link', $url)->orwhere('alias', $url)->first();
        if ($projectLink) {
            $linkId = $projectLink['id'];
            $landingPage = LandingPage::where('linkId', $linkId)->first();
            if ($landingPage) {
                $content = json_decode($landingPage['content']);
                return view('projects.' . $landingPage['templateName'], compact('content'));
            }
        }

        return abort(404);
    }


}
