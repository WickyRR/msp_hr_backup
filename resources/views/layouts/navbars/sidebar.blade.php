<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('MSP') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('Dashboard - HRMS') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>

            <li>
                    <a data-toggle="collapse" href="#laravel-examples6" aria-expanded="true">
                        <i class="tim-icons icon-puzzle-10" ></i>
                        <span class="nav-link-text" >{{ __('Crew Member Details') }}</span>
                        <b class="caret mt-1"></b>
                    </a>

                    <div class="collapse show" id="laravel-examples6">
                       
                        <ul class="nav pl-4">
                            <li>
                                <a data-toggle="collapse" href="#laravel-examples8" aria-expanded="true">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p class="nav-link-text" >{{ __('HR Pillar') }}</p>
                                    <b class="caret mt-1"></b>
                                </a>

                                <div class="collapse show" id="laravel-examples8">
                                    <ul class="nav pl-4">
                                        <li @if ($pageSlug == 'hr.view') class="active " @endif>
                                            <a href="{{ route('hr.view')}}">
                                                <i class="tim-icons icon-align-left-2"></i>
                                                <p>{{ __('Member Details') }}</p>
                                            </a>
                                        </li>

                                        <li @if ($pageSlug == 'hrkpi.view') class="active " @endif>
                                            <a href="{{route('hrkpi.view')}}">
                                                <i class="tim-icons icon-chart-bar-32"></i>
                                                <p>{{ __('KPI Analysis') }}</p>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a data-toggle="collapse" href="#laravel-examples9" aria-expanded="true">
                                    <i class="tim-icons icon-palette"></i>
                                    <p class="nav-link-text" >{{ __('Design Pillar') }}</p>
                                    <b class="caret mt-1"></b>
                                </a>

                                <div class="collapse show" id="laravel-examples9">
                                    <ul class="nav pl-4">
                                        <li @if ($pageSlug == 'design.view') class="active " @endif>
                                            <a href="{{ route('design.view')}}">
                                                <i class="tim-icons icon-align-left-2"></i>
                                                <p>{{ __('Member Details') }}</p>
                                            </a>
                                        </li>

                                        <li @if ($pageSlug == 'designkpi.view') class="active " @endif>
                                            <a href="{{ route('designkpi.view')}}">
                                                <i class="tim-icons icon-chart-bar-32"></i>
                                                <p>{{ __('KPI Analysis') }}</p>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a data-toggle="collapse" href="#laravel-examples10" aria-expanded="true">
                                    <i class="tim-icons icon-notes"></i>
                                    <p class="nav-link-text" >{{ __('News Pillar') }}</p>
                                    <b class="caret mt-1"></b>
                                </a>

                                <div class="collapse show" id="laravel-examples10">
                                    <ul class="nav pl-4">
                                        <li @if ($pageSlug == 'news.view') class="active " @endif>
                                            <a href="{{ route('news.view')  }}">
                                                <i class="tim-icons icon-align-left-2"></i>
                                                <p>{{ __('Member Details') }}</p>
                                            </a>
                                        </li>

                                        <li @if ($pageSlug == 'newskpi.view') class="active " @endif>
                                            <a href="{{ route('newskpi.view')  }}">
                                                <i class="tim-icons icon-chart-bar-32"></i>
                                                <p>{{ __('KPI Analysis') }}</p>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a data-toggle="collapse" href="#laravel-examples11" aria-expanded="true">
                                    <i class="tim-icons icon-chart-pie-36"></i>
                                    <p class="nav-link-text" >{{ __('Marketing Pillar') }}</p>
                                    <b class="caret mt-1"></b>
                                </a>

                                <div class="collapse show" id="laravel-examples11">
                                    <ul class="nav pl-4">
                                        <li @if ($pageSlug == 'markerting.view') class="active " @endif>
                                            <a href="{{ route('markerting.view')  }}">
                                            
                                                <i class="tim-icons icon-align-left-2"></i>
                                                <p>{{ __('Member Details') }}</p>
                                            </a>
                                        </li>

                                        <li @if ($pageSlug =='marketingkpi.view') class="active " @endif>
                                            <a href="{{ route('marketingkpi.view')  }}">
                                                <i class="tim-icons icon-chart-bar-32"></i>
                                                <p>{{ __('KPI Analysis') }}</p>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a data-toggle="collapse" href="#laravel-examples12" aria-expanded="true">
                                    <i class="tim-icons icon-shape-star"></i>
                                    <p class="nav-link-text" >{{ __('Special Pillar') }}</p>
                                    <b class="caret mt-1"></b>
                                </a>

                                <div class="collapse show" id="laravel-examples12">
                                    <ul class="nav pl-4">
                                        <li @if ($pageSlug == 'special.view') class="active " @endif>
                                            <a href="{{ route('sProjects.view')  }}">
                                                <i class="tim-icons icon-align-left-2"></i>
                                                <p>{{ __('Member Details') }}</p>
                                            </a>
                                        </li>

                                        <li @if ($pageSlug == 'specialkpi.view') class="active " @endif>
                                            <a href="{{ route('specialkpi.view')  }}">
                                                <i class="tim-icons icon-chart-bar-32"></i>
                                                <p>{{ __('KPI Analysis') }}</p>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a data-toggle="collapse" href="#laravel-examples13" aria-expanded="true">
                                    <i class="tim-icons icon-puzzle-10"></i>
                                    <p class="nav-link-text" >{{ __('Cooperative Pillar') }}</p>
                                    <b class="caret mt-1"></b>
                                </a>

                                <div class="collapse show" id="laravel-examples13">
                                    <ul class="nav pl-4">
                                        <li @if ($pageSlug == 'cDevelopment.view') class="active " @endif>
                                            <a href="{{ route('cDevelopment.view')  }}">
                                                <i class="tim-icons icon-align-left-2"></i>
                                                <p>{{ __('Member Details') }}</p>
                                            </a>
                                        </li>

                                        <li @if ($pageSlug == 'coopkpi.view') class="active " @endif>
                                            <a href="{{ route('coopkpi.view')  }}">
                                                <i class="tim-icons icon-chart-bar-32"></i>
                                                <p>{{ __('KPI Analysis') }}</p>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a data-toggle="collapse" href="#laravel-examples14" aria-expanded="true">
                                    <i class="tim-icons icon-pencil"></i>
                                    <p class="nav-link-text" >{{ __('Editorial Pillar') }}</p>
                                    <b class="caret mt-1"></b>
                                </a>

                                <div class="collapse show" id="laravel-examples14">
                                    <ul class="nav pl-4">
                                        <li @if ($pageSlug == 'editorial.view') class="active " @endif>
                                            <a href="{{ route('editorial.view')  }}">
                                                <i class="tim-icons icon-align-left-2"></i>
                                                <p>{{ __('Member Details') }}</p>
                                            </a>
                                        </li>

                                        <li @if ($pageSlug == 'editorialkpi.view') class="active " @endif>
                                            <a href="{{ route('editorialkpi.view')  }}">
                                                <i class="tim-icons icon-chart-bar-32"></i>
                                                <p>{{ __('KPI Analysis') }}</p>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a data-toggle="collapse" href="#laravel-examples15" aria-expanded="true">
                                    <i class="tim-icons icon-html5"></i>
                                    <p class="nav-link-text" >{{ __('Web Pillar') }}</p>
                                    <b class="caret mt-1"></b>
                                </a>

                                <div class="collapse show" id="laravel-examples15">
                                    <ul class="nav pl-4">
                                        <li @if ($pageSlug == 'web.view') class="active " @endif>
                                            <a href="{{ route('web.view')  }}">
                                                <i class="tim-icons icon-align-left-2"></i>
                                                <p>{{ __('Member Details') }}</p>
                                            </a>
                                        </li>

                                        <li @if ($pageSlug == 'webkpi.view') class="active " @endif>
                                            <a href="{{ route('webkpi.view')  }}">
                                                <i class="tim-icons icon-chart-bar-32"></i>
                                                <p>{{ __('KPI Analysis') }}</p>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a data-toggle="collapse" href="#laravel-examples7" aria-expanded="true">
                                    <i class="tim-icons icon-video-66"></i>
                                    <p class="nav-link-text" >{{ __('Video Pillar') }}</p>
                                    <b class="caret mt-1"></b>
                                </a>

                                <div class="collapse show" id="laravel-examples7">
                                    <ul class="nav pl-4">
                                        <li @if ($pageSlug == 'video.view') class="active " @endif>
                                            <a href="{{ route('VEditting.view')  }}">
                                                <i class="tim-icons icon-align-left-2"></i>
                                                <p>{{ __('Member Details') }}</p>
                                            </a>
                                        </li>

                                        <li @if ($pageSlug == 'videokpi.view') class="active " @endif>
                                            <a href="{{ route('videokpi.view')  }}">
                                                <i class="tim-icons icon-chart-bar-32"></i>
                                                <p>{{ __('KPI Analysis') }}</p>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>

                </li>

            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="fab fa-laravel" ></i>
                    <span class="nav-link-text" >{{ __('User Management') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit')  }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ __('User Profile') }}</p>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li @if ($pageSlug == 'applicants.view') class="active " @endif>
                <a href="{{ route('pages.members') }}">
                    <i class="tim-icons icon-notes"></i>
                    <p>{{ __('Applicants') }}</p>
                </a>
            </li>

            <!--Projects Sidebar-->
            <li>
                <a data-toggle="collapse" href="#laravel-examples2" aria-expanded="true">
                    <i class="tim-icons icon-puzzle-10" ></i>
                    <span class="nav-link-text" >{{ __('Projects') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples2">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'projects.add') class="active " @endif>
                            <a href="{{ route('projects.add')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Add Project') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'projects.view') class="active " @endif>
                            <a href="{{ route('projects.view')  }}">
                                <i class="tim-icons icon-paper"></i>
                                <p>{{ __('Edit/View Projects') }}</p>
                            </a>
                        </li>
                        <!--<li if ($pageSlug == 'projects.roles') class="active " endif> //add @ to if and end if when using
                            <a href="{ route('projects.roles')  }"> //Double { & }
                                <i class="tim-icons icon-paper"></i>
                                <p>{ __('Crew Roles') }</p> //Double { & }
                            </a>
                        </li>-->
                    </ul>
                </div>

            </li>
            <li>
                <a data-toggle="collapse" href="#laravel-examples2" aria-expanded="true">
                    <i class="tim-icons icon-puzzle-10" ></i>
                    <span class="nav-link-text" >{{ __('Recruitment Process') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples2">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'recruitprocess.add') class="active " @endif>
                            <a href="{{ route('recruitment.add')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Add Process') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'recruitprocess.view') class="active " @endif>
                            <a href="{{ route('recruitment.view')  }}">
                                <i class="tim-icons icon-paper"></i>
                                <p>{{ __('Edit/View Process') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>

            </li>

            <li>
                <a data-toggle="collapse" href="#laravel-examples3" aria-expanded="true">
                    <i class="tim-icons icon-puzzle-10" ></i>
                    <span class="nav-link-text" >{{ __('Finance Process') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples3">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'finance.add') class="active " @endif>
                            <a href="{{ route('finance.add')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Add Process') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'finance.view') class="active " @endif>
                            <a href="{{ route('finance.view')  }}">
                                <i class="tim-icons icon-paper"></i>
                                <p>{{ __('Edit/View Process') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>

            </li>

                <li>
                    <a data-toggle="collapse" href="#laravel-examples4" aria-expanded="true">
                        <i class="tim-icons icon-puzzle-10" ></i>
                        <span class="nav-link-text" >{{ __('Crew Members') }}</span>
                        <b class="caret mt-1"></b>
                    </a>

                    <div class="collapse show" id="laravel-examples4">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'crewMember.add') class="active " @endif>
                                <a href="{{ route('crewMember.add')  }}">
                                    <i class="tim-icons icon-bullet-list-67"></i>
                                    <p>{{ __('Add Member') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'crewMember.view') class="active " @endif>
                                <a href="{{ route('crewMember.view')  }}">
                                    <i class="tim-icons icon-paper"></i>
                                    <p>{{ __('View Members') }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>

                </li>
        </ul>
    </div>
</div>
