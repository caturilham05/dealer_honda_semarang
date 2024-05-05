<div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <h4 class="text-light mb-4">Alamat Lengkap</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{!!$contact['address']!!}</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>{!!$contact['whatsapp_number']!!}</p>
            </div>
            <div class="col-lg-4 col-md-6">
                <h4 class="text-light mb-4">Jam Operasional</h4>
                <h6 class="text-light">Senin - Jumat:</h6>
                <p class="mb-4">09.00 AM - 09.00 PM</p>
                <h6 class="text-light">Sabtu - Minggu:</h6>
                <p class="mb-0">09.00 AM - 12.00 PM</p>
            </div>
            <div class="col-lg-4 col-md-6">
                <h4 class="text-light mb-4">Newsletter</h4>
                <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                <div class="position-relative mx-auto" style="max-width: 400px;">
                    <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Email Anda">
                    <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">Kirim</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">{{url('/')}}</a>, All Right Reserved.
                </div>
            </div>
        </div>
    </div>
</div>
