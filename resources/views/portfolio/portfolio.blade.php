@php
    use App\Models\PortfolioCategory;
    use App\Models\Portfolio;

    $portfolioctegorys = PortfolioCategory::where('status', 'show')->get();
    $portfolios = Portfolio::where('status', 'show')->with('category')->get();
@endphp
<style>
    .owl-dots {
        text-align: center;
        margin-top: 0px;
        padding-top: 10px;
    }
</style>
@if ($portfolioctegorys->count() > 0 && $portfolios->count() > 0)
    <section class="portfolio-section" id="works-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    {{-- Filter Buttons --}}
                    <div class="portfolio-filter text-center wow fadeInUp" data-wow-delay=".5s">
                        <div class="button-group filter-button-group">
                            <button data-filter="*" class="active">All</button>
                            @foreach($portfolioctegorys as $portfolioctegory)
                                <button data-filter=".{{ Str::slug($portfolioctegory->slug ?? $portfolioctegory->title) }}">
                                    {{ $portfolioctegory->title }}
                                </button>
                            @endforeach
                            <div class="active-bg"></div>
                        </div>
                    </div>

                    {{-- Portfolio Grid --}}
                    <div class="portfolio-box wow fadeInUp" data-wow-delay=".6s">
                        <div class="portfolio-sizer"></div>
                        <div class="gutter-sizer"></div>

                        @foreach($portfolios as $portfolio)
                            @php
                                $categoryClass = Str::slug($portfolio->category->slug ?? $portfolio->category->title ?? 'uncategorized');
                            @endphp

                            <div class="portfolio-item {{ $categoryClass }}">
                                <div class="image-box">
                                    <img src="{{ asset('/') . $portfolio->image }}" alt="{{ $portfolio->title }}">
                                </div>
                                <div class="content-box">
                                    <h3 class="portfolio-title">{{ $portfolio->title }}</h3>
                                    <p>{{ $portfolio->short_desc ?? 'No short desc available.' }}</p>
                                    <i class="flaticon-up-right-arrow"></i>
                                    {{-- <button data-mfp-src="#portfolio-wrapper" class="portfolio-link modal-popup"></button>
                                    --}}
                                    <button data-id="{{ $portfolio->id }}" class="portfolio-link modal-popup"></button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>
@endif

<div id="portfolio-wrapper" class="popup_content_area zoom-anim-dialog mfp-hide" data-lenis-prevent=""></div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const modalWrapper = document.getElementById("portfolio-wrapper");

        document.querySelectorAll(".portfolio-link").forEach(button => {
            button.addEventListener("click", function () {
                const id = this.getAttribute("data-id");

                fetch(`/modal/portfolio/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);

                        modalWrapper.innerHTML = `
                        <div class="popup_modal_img">
                            <img src="${data.image}" alt="${data.title}" width="100%">
                        </div>
                        <div class="popup_modal_content">
                            <div class="portfolio_info">
                                <div class="portfolio_info_text">
                                    <h2 class="title">${data.title}</h2>
                                    <div class="desc">
                                        <p>${data.short_desc}</p>
                                    </div>
                                    <a href="${data.live_preview_url ?? '#'}" target="_blank" class="btn tj-btn-primary">Live Preview <i class="fal fa-arrow-right"></i></a>
                                </div>
                                <div class="portfolio_info_items">
                                    <div class="info_item"><div class="key">Category</div><div class="value">${data.category}</div></div>
                                    <div class="info_item"><div class="key">Client</div><div class="value">${data.client}</div></div>
                                    <div class="info_item"><div class="key">Start Date</div><div class="value">${data.start_date}</div></div>
                                    <div class="info_item"><div class="key">Designer</div><div class="value">${data.designer}</div></div>
                                </div>
                            </div>

                            ${Array.isArray(data.gallery) && data.gallery.length > 0 ? `
                                <div class="portfolio_gallery owl-carousel">
                                    ${data.gallery.map(imgObj => `<div class="gallery_item"><img src="${imgObj.image}" width="100%"></div>`).join('')}
                                </div>` : ''
                            }

                            <div class="portfolio_description">
                                <div class="desc"><p>${data.description}</p></div>
                            </div>

                        </div>
                    `;

                        $.magnificPopup.open({
                            items: {
                                src: '#portfolio-wrapper'
                            },
                            type: 'inline',
                            closeBtnInside: true
                        });

                        setTimeout(() => {
                            if ($('.owl-carousel').length) {
                                $('.owl-carousel').owlCarousel({
                                    items: 1,
                                    loop: true,
                                    nav: false,
                                    dots: true
                                });
                            }
                        }, 100);
                    })
                    .catch(error => {
                        console.error('Error loading portfolio:', error);
                    });
            });
        });
    });
</script>