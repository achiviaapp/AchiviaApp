<?php

namespace App\Console\Commands;

use App\Transformers\MigrateOldDataTransform;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateOldData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:old-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $migrate;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(MigrateOldDataTransform $migrate)
    {
        parent::__construct();
        $this->migrate = $migrate;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //clients
        // select from old data base
        $model = DB::connection('old_data')->table('requests');

        $old_data = $model->select(['in_code', 'r_mobile', 'in_email', 'r_name', 'in_notes', 'r_assigned', 'r_state', 'r_link', 'r_id'])->get();
        foreach ($old_data as $user) {
            // transform to new shape
            $transformedData = $this->migrate->userTransform($user);

            // insert into data base
            $user = DB::connection('mysql')->table('users');
            $client = DB::connection('mysql')->table('client_details');
            $history = DB::connection('mysql')->table('client_history');
            $userCreatedId = $user->insertGetId($transformedData['user']);
            $transformedData['detail']['userId'] = $userCreatedId;
            $client->insert($transformedData['detail']);
            foreach ($transformedData['history'] as $one) {
                $one['userId'] = $userCreatedId;
                $history->insert($one);
            }
            $this->info('users has been saved');
        }

        //users
        // select from old data base
        $modelUsers = DB::connection('old_data')->table('users');
        $old_data_users = $modelUsers->select(['id', 'name', 'email', 'role', 'password'])->get();
        foreach ($old_data_users as $oneUser) {
            // transform to new shape
            $transformedDataUser = ($this->migrate->allUserTransform($oneUser));
            // insert into data base
            $user = DB::connection('mysql')->table('users');
            $userCreated = $user->insert($transformedDataUser);
            $this->info('users has been saved');
        }

//        //projects
        // select from old data base
        $modelProject = DB::connection('old_data')->table('projects');
        $old_data_projects = $modelProject->select(['p_id', 'p_name', 'p_desc', 'p_icon'])->get();
        foreach ($old_data_projects as $project) {
            // transform to new shape
            $transformedDataUser = ($this->migrate->projectTransform($project));
            // insert into data base
            $project = DB::connection('mysql')->table('projects');
            $userCreated = $project->insert($transformedDataUser);
            $this->info('project has been saved');
        }

//        //projects links
        // select from old data base
        $modelLink = DB::connection('old_data')->table('Links');
        $old_data_links = $modelLink->select(['l_id', 'l_link', 'l_platform', 'l_project' ,'l_alias','l_r_no'])->get();
        foreach ($old_data_links as $link) {
            // transform to new shape
            $transformedDataLinkr = ($this->migrate->linkTransform($link));
            // insert into data base
            $link = DB::connection('mysql')->table('project_links');
            $Created = $link->insert($transformedDataLinkr);
            $this->info('link has been saved');
        }

    }
}
