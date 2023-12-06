<?php

namespace App\Helpers;

use Request;

use App\Models\ActivityLog as Log;

class ActivityLog {
	public static function create($subject) {
		$log = [];
		$log['subject'] = $subject;
		$log['url'] = Request::fullUrl();
		$log['ip_address'] = Request::ip();
		$log['method'] = Request::method();
		$log['user_agent'] = Request::header('user-agent');
		$log['user_id'] = auth()->check() ? auth()->user()->id : null;
		Log::create($log);
	}

	public static function latestLog() {
		$data = date('Y-m-d H:i:s');
		if (auth()->check()) {
			$data = Log::where('user_id', auth()->user()->id)
			->where('subject', 'Login')
			->orderByDesc('created_at')
			->take(1)
			->offset(1)
			->latest()
			->first()
			->created_at ?? date('Y-m-d H:i:s');
		}
		return date_time_indo_format($data);
	}
}