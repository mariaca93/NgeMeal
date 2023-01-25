<!-- Back to Top Button Start Here -->
<div id="back-to-top">
    <a class="btn text-primary">
        <i class="fa-solid fa-angle-up"></i>
    </a>
</div>
<!-- Back to Top Button End Here -->
<!-- Footer Start Here -->
<footer>
    <div class="footer" style="background : linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6) ), url('{{Helper::image_path(@Helper::appdata()->footer_bg_image)}}')
     center center/cover no-repeat rgba(0, 0, 0, .6) !important;">
        <div class="container">
            <div class="row footer-area border-bottom-primary">
                <div class="row text-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ Helper::image_path(@Helper::appdata()->logo) }}" width="75" class="my-3" alt="footer_logo">
                    </a>
                    <h1>{{ @Helper::appdata()->footer_title }}</h1>
                    <p style="color:white!important">{{ @Helper::appdata()->footer_description }}</p>
                </div>
                <p class="text-white my-3 text-center">{{Helper::appdata()->copyright }}</p>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End here -->
