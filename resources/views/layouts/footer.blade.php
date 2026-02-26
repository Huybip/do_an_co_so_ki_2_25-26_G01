<footer class="bg-white border-top mt-5 pt-4 pb-3">
    <div class="container">
        <div class="row">
            {{-- Introduction --}}
            <div class="col-md-4 mb-4">
                <h6 class="text-uppercase fw-bold mb-3">Giới thiệu</h6>
                <p class="small text-muted">
                    Cửa hàng BanmyShop chuyên cung cấp các loại bánh mì tươi ngon, đa dạng và chất lượng cao. Chúng tôi cam kết mang đến cho khách hàng những trải nghiệm ẩm thực tuyệt vời nhất với dịch vụ tận tâm và chuyên nghiệp.
                </p>
                <img src="{{ asset('images/breads/logo192.png') }}"
                     alt="Đã qua kiểm duyệt"
                     style="height:50px;">
            </div>

            {{-- Chemistry --}}
            <div class="col-md-3 mb-4">
                <h6 class="text-uppercase fw-bold mb-3">Liên kết</h6>
                <ul class="list-unstyled small">
                    <li><a href="#" class="text-decoration-none text-brown">Giới thiệu</a></li>
                    <li><a href="#" class="text-decoration-none text-brown">Chính sách bảo mật</a></li>
                    <li><a href="#" class="text-decoration-none text-brown">Điều khoản sử dụng</a></li>
                    <li><a href="#" class="text-decoration-none text-brown">Chính sách đổi trả</a></li>
                    <li><a href="#" class="text-decoration-none text-brown">Tuyển dụng</a></li>
                </ul>
            </div>

            {{-- Thông tin công ty --}}
            <div class="col-md-3 mb-4">
                <h6 class="text-uppercase fw-bold mb-3">Thông tin liên hệ</h6>
                <ul class="list-unstyled small text-muted">
                    <li>P. Nguyên Trác, Yên Nghĩa, Hà Đông, Hà Nội</li>
                    <li>Điện thoại: <a href="tel:0844825565" class="text-brown text-decoration-none">084 482 5565</a></li>
                    <li>Email: <a href="mailto:huytranhh3@gmail.com" class="text-brown text-decoration-none">huytranhh3@gmail.com</a></li>
                </ul>
            </div>

            {{-- Fanpage --}}
            <div class="col-md-2 mb-4">
                <h6 class="text-uppercase fw-bold mb-3">Fanpage</h6>
                <div class="small">
                    <div class="border p-2 rounded bg-light">
                        <strong>BanmyShop</strong><br>
                        <span class="text-muted">Theo dõi chúng tôi để biết những tin tức mới nhất!</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-top pt-3 mt-2 text-center small text-muted">
            Copyright © {{ date('Y') }} BanmyShop. All rights reserved.
        </div>
    </div>
</footer>

