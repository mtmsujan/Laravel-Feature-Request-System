<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\FeatureStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeatureRequest;
use App\Models\Feature;
use App\Models\User;
use App\Models\Vote;
use App\Notifications\VerificationCodeNotification;
use App\Services\FeatureService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Mauricius\LaravelHtmx\Http\HtmxResponseClientRefresh;

class FeatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('email.exists', [
            'only' => ['create', 'store'],
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Vote::create([
        //     'feature_id' => 3,
        //     'email'      => request()->cookie('feature_requester_email'),
        //     'count'      => -1,
        //  ]);

        $features = match (request()->query('query')) {
            'trending' => Feature::with(['comments', 'votes'])
                ->withVotesCount()
                ->withCount('comments')
                ->orderBy('votes_count', 'DESC')
                ->get(),
            'latest' => Feature::with(['comments', 'votes'])->withSum('votes as votes_count', 'count')
                ->withCount('comments')->latest()->get(),
            default => Feature::with(['comments', 'votes'])->withSum('votes as votes_count', 'count')
                ->withCount('comments')
                ->where(function (Builder $q) {
                    if (! empty(request()->query('query'))) {
                        $q->where('title', 'like', '%'.request()->query('query').'%');
                    }
                })
                ->latest()->get(),
        };
        // dd($features);
        $alert = [];
        if (session('logged_in')) {
            $alert = ['success', session('logged_in')];
        }

        return view('frontend.features.index', compact('features'))->with($alert);
    }

    public function vote(string $type, Feature $feedback)
    {
        if (! Str::contains($type, ['up', 'down'])) {
            throw new \Exception("Invalid vote type. Expected type is \"up\" or \"down\". Found \"$type\"", 1);
        }
        $count = ($type == 'up') ? 1 : -1;
        FeatureService::vote($feedback, $count);

        return back();
    }

    public function userLogin()
    {
        return view('frontend.features.partials.login');
    }

    public function userLoginStore(Request $request)
    {
        $name = Str::substr($request->email, 0, Str::position($request->email, '@'));
        $user = User::updateOrCreate(['email' => $request->email], [
            'email' => $request->email,
            'name' => $name,
            'username' => $name,
            'password' => Hash::make($name),
            'avatar' => avatar($name),
        ]);
        session()->put('login_user', $user);
        if ($user->hasVerifiedEmail()) {
            Auth::login($user, true);
            session()->flash('verified', 'Logged In Successfully!');

            return new HtmxResponseClientRefresh();
        } else {
            return redirect()->intended(route('user.verify'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeatureRequest $request)
    {
        $feature = FeatureService::store($request);

        return redirect(route('feedback.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feedback)
    {
        $feature = $feedback;
        $feature->load('comments.user');

        return view('frontend.features.show', compact('feature'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feedback)
    {
        $feature = $feedback;

        return view('frontend.features.partials.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feedback)
    {
        $feedback->update([
            ...$request->only('title', 'body', 'priority'),
        ]);

        return back();
    }

    public function updateStatus(Request $request, Feature $feedback)
    {
        $request->validate([
            'status' => ['sometimes', Rule::enum(FeatureStatusEnum::class)],

        ]);
        $feedback->update([
            ...$request->only('status'),
        ]);

        return redirect(route('feedback.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feedback)
    {
        $feedback->delete();
        notify()->success('Feature Deleted!');

        return back();
    }

    public function logout(Request $request)
    {
        $cookie = Cookie::forget('feature_requester_email');

        return back()->withCookie($cookie);
    }

    public function verify(Request $request)
    {
        $code = random_int(1000, 9999);
        session('login_user')->update([
            'verification_code' => $code,
            'code_expired_at' => now()->addMinutes(5),
        ]);
        session('login_user')->notify(new VerificationCodeNotification(session('login_user')));

        return view('auth.partials.verify')->with('link-sent', 'A new verification code has been sent to your email.');
    }

    public function verifyStore(Request $request)
    {
        if (session('login_user')->code_expired_at->lessThan(now())) {
            return back(304)->with('error', 'Verification Code Expired!');
        }
        $matched = session('login_user')->verification_code == implode($request->code);
        if (! $matched) {
            Session::forget('login_user');
            notify()->error('Verification code invalid');

            return back();
        }
        session('login_user')->update([
            'email_verified_at' => now(),
        ]);
        Auth::login(session('login_user'), true);
        Session::forget('login_user');

        return redirect()->intended()->with('success', 'Verification Successful!');
    }
}
