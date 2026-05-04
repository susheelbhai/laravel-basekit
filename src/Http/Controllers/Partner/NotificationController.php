<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $data = $this->user()->notifications()->paginate(15);

        $this->seo(title: 'Notifications — Partner');

        return $this->render('partner/resources/notification/index', compact('data'));
    }

    public function show($id)
    {
        $notification = $this->user()->notifications()->where('id', $id)->first();

        if ($notification && $notification->read_at === null) {
            $notification->markAsRead();
        }
        if (isset($notification['data']['url'])) {
            return redirect()->to($notification['data']['url']);
        }

        return redirect()->back();
    }

    protected function user()
    {
        /** @var Partner $user */
        $user = Auth::guard('partner')->user();

        return $user;
    }
}
