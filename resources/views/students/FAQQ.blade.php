@extends('layouts.students.studentApp')
@section('title', 'Complain - Student')
@section('styles')
@endsection

@section('content')


<div class="container mt-5 p-5">
    <!-- Your other HTML content here -->

    {{-- @foreach($complains as $complain)
    {{ $complain->id }}
    @endforeach --}}

    <div class="h2 mb-5" style="font-family:Marhey; text-align:right;">
        <!--Common Questions-->
        أسئلة عامة
        </div>

   
    <div class="accordion" id="accordion">
        @if ($complains)
        @forelse($complains as $complain)
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{ $complain->id }}">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $complain->id }}">
                    {{ $complain->content }}
                </button>
            </h2>
            <div id="collapse{{ $complain->id }}" class="accordion-collapse collapse">
                <div class="accordion-body">
                    {{ $complain->response }}
                </div>
            </div>
        </div>
        @empty
            <div class="h4 mb-5 text-center" style="font-family:Marhey;">
                (
            لا يوجد اسئلة عامة حتى الآن  
                )
            </div>
        @endforelse
        @endif
    </div>
    
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection
