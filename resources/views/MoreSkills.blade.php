@include ('include/header')
<section id="team" class="team mbr-box mbr-section mbr-section--relative">
    <svg preserveAspectRatio="none" viewBox="0 0 100 102" height="100" width="100%" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 0 L50 100 L100 0 Z" fill="#c33" stroke="#c33"></path>
    </svg>
    <div class="container">
        <div class="col-md-8 col-md-offset-2 col-sm-12">
            <div class="row center mb-100">
                <div class="section-title-parralax">
                    <div class="process-numbers">01</div>
                    <h2>{{ __('homepage.skill') }}</h2>
                    <p class="module-subtitle">{{ __('homepage.skillDescription') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="row center features" style="padding-bottom:20px;">
            @foreach($main_skills as $m_s)
            <div class="feature-item">
                <div class="col-md-3 col-sm-6">


                    <h4>
                        @if(Lang::locale()=='en')
                        {{ $m_s->freelancer_skill }}</h4>
                    @else
                    {{ $m_s->ar_freelancer_skill }}</h4>
                        @endif
                    @foreach($skills as $s)
                        @if($s->parent_id==$m_s->id)
                            <h6 class="item-style">   <a class="item-style" href="{{url('find/freelancer?find=')}}{{ urlencode($s->freelancer_skill) }}">
                                    @if(Lang::locale()=='en')
                                    {{ $s->freelancer_skill }}
                                        @else
                                        {{ $s->ar_freelancer_skill }}
                                @endif
                                </a></h6>
                            @endif
                        @endforeach

                </div>
            </div>
        @endforeach

            <!-- End features-item -->

            <!-- End features-item -->
        </div>
        <div style="padding-left:120px;display: none;">
            <a href="<?php echo url('/MoreSkills') ?>" class="default-btn"> {{ __('homepage.SeeMore') }}<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
    </div>
</section>
@include ('include/footer')