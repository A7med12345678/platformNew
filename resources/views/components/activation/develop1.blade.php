@if (Auth::user()->develop_mode === '1')
<div class="container">
    <div class="alert alert-primary m-5 h1 text-center p-5" role="alert">
        .
        جاري التعديل على المنصة الآن, الرجاء الدخول لاحقًا
        <br>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary text-white m-3">تسجيل خروج</button>
        </form>
    </div>
</div>
@endif