@extends('layouts.app')

@section('tieude', 'Liên hệ')
@section('noidung')
<div class="lienhe-wrapper">
    <div class="lienhe-container">
        <div class="lienhe-left">
            <div class="duongdan">
                <a href="{{ url('/') }}">Trang chủ</a> &raquo; <span>Liên hệ</span>
            </div>

            <div class="tt-lienhe">
                <p><i class="fas fa-map-marker-alt text-danger"></i> 22B ngõ 20B Tả Thanh Oai , Thanh Trì, Hà Nội</p>
                <p><i class="fas fa-phone-alt text-danger"></i> 0946797598</p>
                <p><i class="fas fa-envelope text-danger"></i> bienngu2003@gmail.com</p>
            </div>

            <h4>Liên hệ với chúng tôi</h4>
            <form method="POST" action="#">
                @csrf
                <input type="text" name="ten" class="input-lienhe" placeholder="Họ và tên">
                <input type="email" name="email" class="input-lienhe" placeholder="Email">
                <textarea name="noidung" class="textarea-lienhe" rows="4" placeholder="Nội dung"></textarea>
                <button type="submit" class="nut-lienhe">Gửi liên hệ</button>
            </form>
        </div>

        <div class="lienhe-right">
            <div class="map-responsive">
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.7288815283185!2d105.81424901488217!3d21.003370586011286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab64f233ec5f%3A0x5e239775961caed2!2zUGjhuqFtIG3huq1uIFF14bqjbiBseSBiw6FuIGjhu41nIC0gU2FwbyBQT1M!5e0!3m2!1svi!2s!4v1617188539057!5m2!1svi!2s"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection