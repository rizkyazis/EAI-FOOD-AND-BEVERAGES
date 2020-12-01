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
                        <img class="img-fluid" src="{{'/style/assets/img/portfolio/01-thumbnail.jpg'}}" alt="" />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Threads</div>
                        <div class="portfolio-caption-subheading text-muted">Illustration</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="{{'/style/assets/img/portfolio/02-thumbnail.jpg'}}" alt="" />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Explore</div>
                        <div class="portfolio-caption-subheading text-muted">Graphic Design</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="{{'/style/assets/img/portfolio/03-thumbnail.jpg'}}" alt="" />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Finish</div>
                        <div class="portfolio-caption-subheading text-muted">Identity</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                <div class="portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="{{'/style/assets/img/portfolio/04-thumbnail.jpg'}}" alt="" />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Lines</div>
                        <div class="portfolio-caption-subheading text-muted">Branding</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 mb-4 mb-sm-0">
                <div class="portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="{{'/style/assets/img/portfolio/05-thumbnail.jpg'}}" alt="" />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Southwest</div>
                        <div class="portfolio-caption-subheading text-muted">Website Design</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="{{'/style/assets/img/portfolio/06-thumbnail.jpg'}}" alt="" />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Window</div>
                        <div class="portfolio-caption-subheading text-muted">Photography</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="{{'/style/assets/img/portfolio/01-thumbnail.jpg'}}" alt="" />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Window</div>
                        <div class="portfolio-caption-subheading text-muted">Photography</div>
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
