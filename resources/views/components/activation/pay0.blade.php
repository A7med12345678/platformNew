@if (Auth::user()->pay === '0')

<div class="container">
    <div class="alert alert-success m-5 h1 text-center p-5" role="alert" style="border-radius: 60px;">
        .
        الرجاء التواصل مع رقم
        01117235838
        لتفعيل اشتراكك
        <br>
        <br>
        <div class="text-right">
            كود الطالب
            :
            {{ Auth::user()->center_code }}
        </div>
        <div class="text-right mt-5 h4">
            (الرجاء الاحتفاظ بالكود وإرساله للرقم أعلاه عند دفع الاشتراك والتفعيل)
        </div>
        <br>
        <br>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success m-3">تسجيل خروج</button>
        </form>
        <a href="{{ route('welcome') }}" target="_blank" class="btn btn-warning text-white" style="font-weight: bold;">الصفحة الرئيسية</a>
    </div>
</div>
@endif
