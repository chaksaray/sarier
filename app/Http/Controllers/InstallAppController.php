<?php

namespace App\Http\Controllers;

use App\Http\Models\PageModel;
use Illuminate\Http\Request;
use App\Http\Operators\FBPageOperator;
use App\Http\Converters\FBPageConverter;
use Auth;
use App\Http\Models\PlatformModel;
use Config;

class InstallAppController extends Controller
{
    private $fbPageOperator;
    private $fbPageConverter;
    private $mdPage;
    private $mdPlatform;
    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('platform.installed');
        $this->fbPageOperator = new FBPageOperator();
        $this->fbPageConverter = new FBPageConverter();
        $this->mdPage = new PageModel();
        $this->mdPlatform = new PlatformModel();
    }

    /**
     * Handle the request from facebook [code, access token, pages list] and insert page data to db
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleRedirect(Request $request){
        $query = $request->query();
        $code = $query['code'];
        $accessToken=  $this->fbPageOperator->getFBAcessToken($code);
        $rawPages = $this->fbPageOperator->getFBPage($accessToken);
        $pages = $this->fbPageConverter->pageData($rawPages);
        $this->mdPage->insert($pages);
        return redirect('/install');
    }

    /**
     * Display install page view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function installAppView(){
        $pages = $this->mdPage->listPageByUser(Auth::id());
       return view('install.install', ['pages' => $pages]);
    }

    /**
     * Installing app platform by insert data to db.pages
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function installApp(Request $request){
        $userID = null;
        if (Auth::check())
        {
            $data = [
                'user_id' => Auth::id(),
                'page_id' => $request->input('page'),
                'plan_id' => 1,
                'name' => $request->input('name'),
                'status' => 1
            ];
            $aPage = $this->mdPage->getPageByID($request->input('page'));
            $response = $this->fbPageOperator->subscribePage($aPage[0]->fb_page_id,$aPage[0]->access_token);
            $platform = $this->mdPlatform->insert($data);
            if($response['success']){
                session([Config::get('constant.global_name.PLATFORM') => $platform[0]]);
                return redirect('platform/dashboard');
            }else{

            }
        }else{

        }
    }
}