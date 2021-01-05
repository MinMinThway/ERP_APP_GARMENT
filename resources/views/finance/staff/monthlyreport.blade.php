@php
$date = Account_detail::now()->startOfDay;

//one month / 30 days
$date = Account_detail::now()->subDays(30)->startOfDay;

App\User::where('field_name', '>=', $date)->orderBy('field_name', 'desc')->limit(3)->get();

@endphp