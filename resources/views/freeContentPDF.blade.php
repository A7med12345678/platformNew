@extends('layouts.welcomeApp')
@section('title', 'Free Content : ' . $Global_platFormName)

@section('styles')
    <link href="{{ asset('welcome/css/videoFreeContent.css') }}" rel="stylesheet">
@endsection

@section('page-content')

    <div class="m-5">
        <div id="container">
            <h2 class="mb-4" style="text-align: right; font-family:Marhey;">
                : Pdf المحتوى المجاني
            </h2>

            <form action="{{ route('freeContentPDF') }}" method="GET" class="mt-4">
                <div class="form-group">
                    <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
                        <optgroup>
                            <option value="2" {{ request('sort') === '2' ? ' selected' : '' }} dir="rtl">الصف
                                الثاني الثانوي</option>
                            <option value="3" {{ request('sort') === '3' ? ' selected' : '' }} dir="rtl">الصف
                                الثالث الثانوي</option>
                            </option>
                        </optgroup>

                    </select>
                </div>
            </form>

            <table class="table mt-5" dir="rtl">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>تحميل الملف</th>
                        <th>عرض الملف</th>
                        <th>اسم الملف</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pdfFiles as $index => $pdfFile)
                        @php
                            $extractedPath = Str::after($pdfFile, 'public');
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <a href="{{ asset('storage' . $extractedPath) }}" target="_blank" download>
                                    تحميل
                                </a>

                            </td>
                            <td>
                                <a href="{{ asset('storage' . $extractedPath) }}" target="_blank">عرض</a>
                            </td>
                            <td>{{ basename($pdfFile) }}</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="p-3">No Files found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>



@endsection
