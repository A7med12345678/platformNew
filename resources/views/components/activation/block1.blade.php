@if (Auth::check() && Auth::user()->force_stop === '1')
<div class="container">
    <div class="alert alert-danger m-5 text-center font-weight-bold h3" role="alert">
        عذرا, تم ايقاف حسابك على منصة الوافي بسبب سلوك غير أخلاقي أو خطأ ما
        <br>
        <br>
        الرجاء الرجوع للإدارة لمراجعة نشاطك
    </div>
</div>
@endif