@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Starting the Platform</div>

                <div class="panel-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        <a href="https://www.facebook.com/v2.12/dialog/oauth?client_id={{ env('FACEBOOK_ID') }}&amp;state=3cb35334f83e64f34489d070075f97c5&amp;response_type=code&amp;sdk=php-sdk-5.0.0&amp;redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fauth%2Ffacebook%2Fredirect&amp;scope=email%2Cmanage_pages%2Cpublish_pages%2Cpages_messaging%2Cpublic_profile%2Cread_page_mailboxes%2Cpages_messaging_subscriptions%2Cpages_manage_cta">
                            <img src="http://www.sousdeycambodia.com/facebook_login_with_php/images/fblogin-btn.png">
                            {{--<img src="https://cdn0.iconfinder.com/data/icons/round-ui-icons/512/add_blue.png" width="100">--}}
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
