<?php

namespace App\Http\Controllers;

use App\Http\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private AdminService $adminService;
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function panelUsers()
    {
        try {
            $users = $this->adminService->getAllUsers();
            return view('pages.admin.dashboard-user', [
                'users' => $users
            ]);
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => $e->getMessage()
            ])->withInput();
        }
    }
    public function panelUsersSearch(Request $request)
    {
        try {
            $search = $request->input('search');
            //dd($search);
            if ($search != '') {
                $users = $this->adminService->getAllUserSearch($search);;
            } else {
                $users = $this->adminService->getAllUsers();
            }
            //dd($users);
            return view('pages.admin.dashboard-user', [
                'users' => $users,
                'search' => $search
            ]);
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => $e->getMessage()
            ])->withInput();
        }
    }
}
