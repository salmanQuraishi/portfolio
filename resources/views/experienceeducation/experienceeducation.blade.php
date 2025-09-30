@php
    use App\Models\Education;
    use App\Models\Experience;
    $experiences = Experience::where('status', 'show')->get();
    $experienceCount = $experiences->count();
    $educations = Education::where('status', 'show')->get();
    $educationCount = $educations->count();
@endphp
@if ($educationCount > 0 && $experienceCount > 0)
    <section class="works-section style-2" id="resume-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="works-wrapper">
                        <div class="works-content-item">
                            <div class="section-header wow fadeInUp" data-wow-delay=".3s">
                                <h2 class="section-title"><i class="flaticon-recommendation"></i> My Education</h2>
                            </div>
                            <div class="works-inner wow fadeInUp" data-wow-delay=".4s">
                                @foreach ($educations as $education)
                                    <div class="works-item">
                                        <div class="works-icon">
                                            <i class="flaticon-graduation-cap"></i>
                                        </div>
                                        <div class="works-content">
                                            <span class="number">{{$education->year}}</span>
                                            <h5 class="title">{{$education->title}}</h5>
                                            <span class="sub-title">{{$education->university}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="works-content-item">
                            <div class="section-header wow fadeInUp" data-wow-delay=".3s">
                                <h2 class="section-title"><i class="flaticon-recommendation"></i> My Experience</h2>
                            </div>
                            <div class="works-inner wow fadeInUp" data-wow-delay=".4s">
                                @foreach ($experiences as $experience)
                                    <div class="works-item">
                                        <div class="works-icon">
                                            <i class="flaticon-suitcase"></i>
                                        </div>
                                        <div class="works-content">
                                            <span class="number">{{$experience->year}}</span>
                                            <h5 class="title">{{$experience->title}}</h5>
                                            <span class="sub-title">{{$experience->company}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif