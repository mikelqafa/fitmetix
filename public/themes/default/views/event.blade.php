<!-- main-section -->
<!-- <div class="main-content"> -->
<div class="container-fluid">
    <div class="row">
        <div class="visible-lg col-lg-2">
            {!! Theme::partial('home-leftbar',compact('trending_tags')) !!}
        </div>

        <div class="col-md-7 col-lg-6">
            @if (Session::has('message'))
                <div class="alert alert-{{ Session::get('status') }}" role="alert">
                    {!! Session::get('message') !!}
                </div>
            @endif


            @if(isset($active_announcement))
                <div class="announcement alert alert-info">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <h3>{{ $active_announcement->title }}</h3>
                    <p>{{ $active_announcement->description }}</p>
                </div>
            @endif

            @if($mode != "eventlist")
                {!! Theme::partial('create-post',compact('timeline','user_post')) !!}

                <div class="timeline-posts">
                    @if($posts->count() > 0)
                        @foreach($posts as $post)
                            <li class="list-group-item deleteevent">
                                <div class="connect-list">
                                    <div class="connect-link side-left">
                                        <div class="media">
                                            <div class="pull-left" style="border: 2px solid #e3e6e8;width: 45px;height: 45px;text-align: center;padding: 0px 2px;margin:0px 5px;">
                                                <a href="{{ url($post->timeline->username) }}" style="text-align:center;font-size:12px;">
                                                    <span class="event-date">
                                                        <?php echo (date('d', strtotime($post->start_date))) ?>
                                                        <?php echo (date('M', strtotime($post->start_date))) ?>
                                                    </span>
                                                    <span class="clearfix"></span>
                                                </a>
                                            </div>
                                            <div class="media-body" style="vertical-align:middle;padding-top: 10px;">
                                                <a style="font-size:18px;color: #5f5d5d !important;font-family: 'Source Sans Pro', sans-serif;" href="{{ url($post->timeline->username) }}">
                                                    {{ $post->timeline->name }} <small style="font-size:9px;"><i class="fa fa-external-link"></i></small>
                                                </a>
                                            </div>
                                        </div>
                                        <hr>
                                        Starts: <b>{{{ \Carbon\Carbon::createFromTimestamp(strtotime($post->start_date))->diffForHumans().' ('.(date('d-M-Y H:i', strtotime($post->start_date))).')' }}}</b> until <b>{{ \Carbon\Carbon::createFromTimestamp(strtotime($post->end_date))->diffForHumans().' ('.(date('d-M-Y H:i', strtotime($post->end_date))).')' }}</b>
                                        <hr>
                                        <b>Location: </b>
                                        <a target="_blank" href="{{ url('/get-location/'.$post->location) }}">
                                            <i class="fa fa-map-marker"></i> {{ $post->location }}
                                        </a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <div class="no-posts alert alert-warning">{{ trans('common.no_posts') }}</div>
                    @endif
                </div>
            @else
                {!! Theme::partial('eventslist',compact('user_events','username')) !!}
            @endif
        </div><!-- /col-md-6 -->

        <div class="col-md-5 col-lg-4">
            {!! Theme::partial('home-rightbar',compact('suggested_users', 'suggested_groups', 'suggested_pages')) !!}
        </div>
    </div>
</div>
<!-- </div> -->
<!-- /main-section -->