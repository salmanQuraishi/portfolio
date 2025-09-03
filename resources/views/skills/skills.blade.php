@php
    use App\Models\Skills;
        $skills = Skills::where('status', 'show')->get();
        $skillsCount = $skills->count();
@endphp
@if ($skillsCount > 0)
<section class="skills-section" id="skills-section">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="section-header text-center">
                <h2 class="section-title wow fadeInUp" data-wow-delay=".3s">My Skills</h2>
                <p class="wow fadeInUp" data-wow-delay=".4s">
                We put your ideas and thus your wishes in the form of a unique web project that inspires you and
                you customers.
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="skills-widget d-flex flex-wrap justify-content-center align-items-center">
                @foreach ($skills as $skill)
                    <div class="skill-item wow fadeInUp" data-wow-delay="{{ number_format(0.1 * ($loop->index + 1), 1) }}s">
                        <div class="skill-inner">
                            <div class="icon-box">
                                <img src="{{ $skill->image }}" alt="{{ $skill->title }}">
                            </div>
                            {{-- <div class="number">{{ $skill->percent }}%</div> --}}
                        </div>
                        <p>{{ $skill->title }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
</section>
@endif