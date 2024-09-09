<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle dashboard redirection based on user role.
     */
    public function index(Request $request)
    {
        // Retrieve the authenticated user's role (ensure 'user_type' is correct)
        $user_type = auth()->user()->user_type;

        // Assets to be used in the view
        $assets = ['chart', 'animation'];

        // Redirect based on the user's role
        if ($user_type === 'admin') {
            return view('Admin.dashboard', compact('assets')); // Admin dashboard view
        } elseif ($user_type === 'user') {
            return view('user.dashboard', compact('assets')); // User dashboard view
        } else {
            return abort(403, 'Unauthorized action.'); // Unauthorized access response
        }
    }

    // Remaining methods for other routes...

    public function horizontal(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.horizontal',compact('assets'));
    }

    public function dualhorizontal(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.dual-horizontal',compact('assets'));
    }

    public function dualcompact(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.dual-compact',compact('assets'));
    }

    public function boxed(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.boxed',compact('assets'));
    }

    public function boxedfancy(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.boxed-fancy',compact('assets'));
    }

    public function billing(Request $request)
    {
        return view('special-pages.billing');
    }

    public function calender(Request $request)
    {
        $assets = ['calender'];
        return view('special-pages.calender',compact('assets'));
    }

    public function kanban(Request $request)
    {
        return view('special-pages.kanban');
    }

    public function pricing(Request $request)
    {
        return view('special-pages.pricing');
    }

    public function rtlsupport(Request $request)
    {
        return view('special-pages.rtl-support');
    }

    public function timeline(Request $request)
    {
        return view('special-pages.timeline');
    }

    public function widgetbasic(Request $request)
    {
        return view('widget.widget-basic');
    }

    public function widgetchart(Request $request)
    {
        $assets = ['chart'];
        return view('widget.widget-chart', compact('assets'));
    }

    public function widgetcard(Request $request)
    {
        return view('widget.widget-card');
    }

    public function google(Request $request)
    {
        return view('maps.google');
    }

    public function vector(Request $request)
    {
        return view('maps.vector');
    }

    public function signin(Request $request)
    {
        return view('auth.login');
    }

    public function signup(Request $request)
    {
        return view('auth.register');
    }

    public function confirmmail(Request $request)
    {
        return view('auth.confirm-mail');
    }

    public function lockscreen(Request $request)
    {
        return view('auth.lockscreen');
    }

    public function recoverpw(Request $request)
    {
        return view('auth.recoverpw');
    }

    public function userprivacysetting(Request $request)
    {
        return view('auth.user-privacy-setting');
    }

    public function error404(Request $request)
    {
        return view('errors.error404');
    }

    public function error500(Request $request)
    {
        return view('errors.error500');
    }

    public function maintenance(Request $request)
    {
        return view('errors.maintenance');
    }

    public function uisheet(Request $request)
    {
        return view('index');
    }

    public function element(Request $request)
    {
        return view('forms.element');
    }

    public function wizard(Request $request)
    {
        return view('forms.wizard');
    }

    public function validation(Request $request)
    {
        return view('forms.validation');
    }

    public function bootstraptable(Request $request)
    {
        return view('table.bootstraptable');
    }

    public function datatable(Request $request)
    {
        return view('table.datatable');
    }

    public function solid(Request $request)
    {
        return view('icons.solid');
    }

    public function outline(Request $request)
    {
        return view('icons.outline');
    }

    public function dualtone(Request $request)
    {
        return view('icons.dualtone');
    }

    public function colored(Request $request)
    {
        return view('icons.colored');
    }

    public function privacypolicy(Request $request)
    {
        return view('privacy-policy');
    }

    public function termsofuse(Request $request)
    {
        return view('terms-of-use');
    }

    public function Homeindex()
    {
        // Fetch packages from the database
        $packages = Package::all(); // Adjust this query based on your needs

        // Return the view with packages data
        return view('index', compact('packages'));
    }
}
