<div class="bg-white rounded-top shadow-sm mb-3">

    <div class="row g-0">
        <div class="col col-lg-7 mt-6 p-4 pe-md-0">

            <h2 class="mt-2 text-dark fw-light">
                {{__("Empowering the ") . Config::get('anikultura.programFullName') . "!"  }}
            </h2>

            <p>
                {{__("Anikultura is a centralized farm management and monitoring application. Use the navigation on the right to manage platform resources. See the available links below for more actions.")  }}
            </p>
        </div>
        <div class="d-none d-lg-block col align-self-center text-end text-muted p-4">
            <img src="/img/ani-logo-color.png" style="margin-right: 5px; max-width: 111px;" type="image/png">
        </div>
    </div>

    <div class="row bg-light m-0 p-4 border-top rounded-bottom">

        <div class="col-md-6 my-2">
            <h3 class="text-muted fw-light">
                <x-orchid-icon path="bar-chart" />

                <span class="ms-3 text-dark">{{__('Analytics Dashboard')}}</span>
            </h3>
            <p class="ms-md-5 ps-md-1">
                {{__("See more insights in the platform. The Grafana analytics dashboard is accessible")  }} <a
                    href="{{ Config::get('anikultura.grafanaUrl') }}" target="_blank" class="text-u-l">{{__("here")  }}</a>.
            </p>
        </div>
    </div>
</div>
