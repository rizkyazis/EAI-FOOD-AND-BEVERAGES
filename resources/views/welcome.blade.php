@extends('layouts.app')
@section('content')
<!-- Masthead-->
<header class="masthead">
    <div class="container">
        <div class="masthead-subheading">Welcome To Our FnB ALCOBA!</div>
        <div class="masthead-heading text-uppercase">It's Nice To Serve You</div>
        <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#portfolio">Tell Me More</a>
    </div>
</header>
<!-- Portfolio Grid-->
<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Category</h2>
            <h3 class="section-subheading text-muted">This is our category.</h3>
        </div>
        <div class="row">
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="{{'/images/category/vegetables.jpg'}}" alt="" />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Vegetables</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="{{'/images/category/fruits.jpg'}}" alt="" />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Fruits</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="{{'/images/category/seeds.jpg'}}" alt="" />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Grains, legumes, nuts and seeds</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                <div class="portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="{{'/images/category/meats.jpg'}}" alt="" />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Meat and poultry</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 mb-4 mb-sm-0">
                <div class="portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="{{'/images/category/seafood.jpeg'}}" alt="" />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Fish and seafood</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="{{'/images/category/dairy.jpeg'}}" alt="" />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Dairy foods</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="{{'/images/category/eggs.jpg'}}" alt="" />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Eggs</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About-->
<section class="page-section" id="about">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">About Our Team</h2>
            <h3 class="section-subheading text-muted">Hi Guys!</h3>
        </div>
        <ul class="timeline">
            <li>
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{'/style/assets/img/about/1.jpg'}}" alt="" /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4>nama gue ji pyeong dong</h4>
                        <h4 class="subheading">Azifah Dhafin R.A</h4>
                    </div>
                    <div class="timeline-body"><p class="text-muted">Front-End Developer</p></div>
                </div>
            </li>
            <li class="timeline-inverted">
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{'/style/assets/img/about/2.jpg'}}" alt="" /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4>Fakhririfi</h4>
                        <h4 class="subheading">Fakhri Rifqi Firdaus</h4>
                    </div>
                    <div class="timeline-body"><p class="text-muted">Front-End Developer</p></div>
                </div>
            </li>
            <li>
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{'/style/assets/img/about/6.jpg'}}" alt="" /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4>HaDe</h4>
                        <h4 class="subheading">Haryo Dewanto</h4>
                    </div>
                    <div class="timeline-body"><p class="text-muted">Front-End Developer</p></div>
                </div>
            </li>
            <li class="timeline-inverted">
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{'/style/assets/img/about/3.jpg'}}" alt="" /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4>Riizkyazis</h4>
                        <h4 class="subheading">Rizky Azis Jayasutisna</h4>
                    </div>
                    <div class="timeline-body"><p class="text-muted">Fullstack Web Developer</p></div>
                </div>
            </li>
            <li class="timeline-inverted">
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{'/style/assets/img/about/4.jpg'}}" alt="" /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4>Hellochh</h4>
                        <h4 class="subheading">Rosanicha</h4>
                    </div>
                    <div class="timeline-body"><p class="text-muted">Front-End Developer</p></div>
                </div>
            </li>
            <li class="timeline-inverted">
                <div class="timeline-image">
                    <h4>
                        Be Part
                        <br />
                        Of Our
                        <br />
                        Story!
                    </h4>
                </div>
            </li>
        </ul>
    </div>
</section>
@push('script')
@endpush
@endsection
