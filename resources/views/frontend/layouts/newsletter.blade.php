<!-- Start Shop Newsletter  -->
<div class="col-xl-3 col-md-6 col-sm-12 col-12">
    <div class="footer-widget footer-newsletter-widget">
        <h4 class="footer-title">Newsletter</h4>
        <p>Inscrivez ous à notre newsletter et bénéficiez de 10% de réduction sur votre premier achat</p>
        <div class="footer-newsletter">
            <form action="{{route('subscribe')}}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Email*" required>
                <div class="btn-wrapper">
                    <button class="theme-btn-1 btn" type="submit"><i class="fas fa-location-arrow"></i></button>
                </div>
            </form>
        </div>
        <h5 class="mt-30">Mode de payement</h5>
        <img src="{{asset('frontend/assets/img/icons/payment-4.png')}}" alt="Payment Image">
    </div>
</div>
<!-- End Shop Newsletter -->
