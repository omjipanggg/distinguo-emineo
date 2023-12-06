<div class="hero">
    <img class="d-block mx-auto mb-4 img-fluid img-hero" src="{{ asset('img/score.webp') }}" alt="Logo">
    <h1 class="display-5 fw-bold text-body-emphasis text-center">{{ config('app.name') }}™</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4 text-center">SABRINA is a comprehensive system designed to facilitate the evaluation and analysis of individual or team performance. It incorporates a scoring mechanism that assesses various criteria, providing insights into achievements and areas for improvement.</p>
      {{--
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <button type="button" class="btn btn-primary btn-lg rounded-1 px-4" onclick="underMaintenance(event);">
          Download
          <i class="bi bi-download ms-2"></i>
        </button>
        <button type="button" class="btn btn-outline-secondary btn-lg rounded-1 px-4" onclick="underMaintenance(event);">
          Explore
          <i class="bi bi-box-arrow-up-right ms-2"></i>
        </button>
      </div>
      --}}

      <div id="alertTokenHolder"></div>

      <form action="{{ route('server.checkToken') }}" id="formCheckToken" method="POST">
        @method('POST')
        @csrf

        <div class="d-flex gap-2 justify-content-center">
          <div class="flex-fill">
            <div class="form-floating">
              <input type="text" placeholder="Token" class="form-control" autofocus="" required="" name="token" id="token" autocomplete="off">
              <label for="token">Token</label>
            </div>
          </div>

          <button type="submit" class="btn btn-primary rounded-0 px-5" data-bs-text="Submitting" data-bs-initial-text="Submit" id="btnCheckToken">Submit<i class="bi bi-send ms-2"></i></button>
        </div>

      </form>

    </div>
  </div>