  {{-- session return: --}}
  @if (session('flash_msg'))
      <div class="alert alert-success m-4">
          {{ session('flash_msg') }}
      </div>
  @endif
