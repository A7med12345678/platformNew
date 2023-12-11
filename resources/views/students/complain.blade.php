@extends('layouts.students.studentApp')
@section('title', 'Complain - Student')
@section('styles')
<style>
    /* Media query for screens with a maximum width of 768 pixels */
    @media (max-width: 768px) {
        .navbar-brand-div {
            transform: scale(0.7);
            padding-right: 15%;
            /*padding-top:5px;*/
        }
    }

</style>
@endsection

@section('content')

<div class="container mt-5 p-5">
    <!--<div class="h2 text-center mb-4">Complaint or suggestion</div>-->
    <div class="h2 text-center mb-4" style="font-family:Marhey;">اسأل المستر</div>


    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if (session('done'))
    <div class="alert alert-success text-center">
        {{ session('done') }}
    </div>
    @endif

    <form action="{{ route('complainInsert') }}" method="post">
        @csrf
        <div class="form-group">
            {{-- <label for="content">نص الشكوى أو المقترح</label> --}}
            <textarea name="content" id="content" class="form-control" rows="5" placeholder="..اكتب هنا" dir="rtl"></textarea>
        </div>

        <!--<button type="submit" class="btn btn-success m-3">Go !</button>-->
        <button type="submit" class="btn btn-success m-3">تسجيل</button>
    </form>

    <hr class="m-5">


    <div class="h2 text-center mt-5 mb-5" style="font-family:Marhey;">
        <!--Previous Complaints ! -->
        أسئلتك السابقة
        </div>

    <table class="table table-striped text-center">
        <thead>
            <tr>
              
                <th>
                    <!--Asked at-->
                    ميعاد إرسال السؤال
                    </th>
                    
                    
                <th>
                    <!--Aproved ?-->
                    الرفع للأسئلة العامة
                    </th>
                    
                      <th>
                    <!--Response-->
                    رد المستر
                    </th>
                    
                     <th>
                    <!--Content-->
                    السؤال
                    </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($complaints as $complaint)
            <tr>
              
                <td>{{ $complaint->created_at }}</td>
               <td>
                    @if ($complaint->aprove == "1")
                    @include('components.xy.tickMark')
                    @else
                    @include('components.xy.xMark')
                    @endif
                </td>
             <td>
                    @if ($complaint->response)
                    {{ $complaint->response }}
                    @else
                    <div class="text-danger">
                        <!--Not responded yet!-->
                        لم يتم الإجابة بعد
                    </div>
                    @endif
                </td>
                <td>{{ $complaint->content }}</td>
            </tr>

            @empty
            <tr>

                <td colspan="2" class="text-center h5 p-3">
                    <!--No Comlaints for you !-->
                    ليس لديك أسئلة سابقة
                    </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
