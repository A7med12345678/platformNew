  <!--Send report via whatsapp to parent : -->


  @if ($message)
      <hr class="mt-5">
      <div class="text-center mx-auto mt-4">
          <a class="btn btn-success text-center mx-auto" style="font-weight:bold;" target="_blank"
              href="https://wa.me/+2{{ $message }}?text=الرجاء%20متابعة%20درجات%20نجلكم%20في%20مادة%20اللغة%20الإنجليزية%20:%0A%0A{{ $Global_currentURL }}/storage/pdf/{{ session('downloadLink') }}%0A%0Aمع%20تحيات%20فريق%20عمل%20منصة%20English%20for%20All%20-%20ا/محمد%20الشربيني">

              <i class="fab fa-whatsapp"></i>
              إرسال لولي الأمر
          </a>

      </div>
  @endif

  <!-- Donwload report : -->

  @if ($filename)
      <div class="text-center mx-auto mt-3">
          <a class="btn btn-warning text-white" href="{{ asset('storage/pdf/' . $filename) }}"
              style="font-weight:bold;" download>
              <i class="fas fa-download"></i>
              تحميل التقرير
          </a>
      </div>

      <!-- View report : -->

      <div class="text-center mx-auto mt-3">
          <a class="btn btn-secondary text-white" target="_blank" href="{{ asset('storage/pdf/' . $filename) }}"
              style="font-weight:bold;">
              <i class="fas fa-file"></i>
              عرض التقرير
          </a>
      </div>
      {{-- <hr class="pb-5"> --}}
  @endif
