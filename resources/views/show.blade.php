@extends('base.BaseFormat')
@section('content')

<h2>اطلاعات کاربر</h2>

<p>نام: {{ $firstname }}</p>
<p>نام خانوادگی: {{ $lastname }}</p>
<p>نام مستعار: {{ $nickname }}</p>
<p>ایمیل: {{ $email }}</p>

@endsection