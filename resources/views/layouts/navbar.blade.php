<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->


            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-globe-americas"></i>
                <!-- Counter - Alerts -->
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  {{ trans('translate.select_lang')}}
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('set_local', ['locale'=> 'fr'])}}">
                  <div class="mr-3">
                    <div class="icon-circle ">
                      <img class="icon-circle " src="https://lipis.github.io/flag-icon-css/flags/4x3/fr.svg" alt="France Flag">
                    </div>
                  </div>
                  <div>
                    {{ trans('translate.french')}}
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('set_local', ['locale'=> 'en'])}}">
                  <div class="mr-3">
                    <div class="icon-circle">
                      <img class="icon-circle" src="https://lipis.github.io/flag-icon-css/flags/4x3/us.svg" alt="United States of America Flag">
                    </div>
                  </div>
                  <div>
                    {{ trans('translate.english')}}
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('set_local', ['locale'=> 'de'])}}">
                  <div class="mr-3">
                    <div class="icon-circle">
                      <img class="icon-circle" src="https://img.generation-nt.com/fake_016A011E01646413.jpg" alt="United States of America Flag">
                    </div>
                  </div>
                  <div>
                    fake
                  </div>
                </a>
              </div>
            </li>










            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter count_unread">{{messages_handle()['count_unread'] === 0 ? '' : messages_handle()['count_unread']}}</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <div  class="elements" >
                @if (messages_handle()['count_unread'] !== 0)
                    <?php $messages = messages_handle()['messages'] ;
                    //dd($messages);
                    ?>
                    @foreach ($messages as $message)
                        <a class="dropdown-item d-flex align-items-center contact_nav_{{$message['id']}}" href="{{route('read_msg', ['id_msg'=> $message['id']])}}">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div class="font-weight-bold">
                            <div class="text-truncate">{{$message['subject']}}.</div>
                            <div class="small text-gray-500">{{ $message['from_name']}} · 58m</div>
                        </div>
                        </a>
                    @endforeach
                @else
                    <div class="dropdown-item d-flex align-items-center count_unread_empty"  >
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="{{URL::asset('img/no-nothing.gif')}}" alt="">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div class="font-weight-bold">
                        <div class="text-truncate">{{ trans('translate.Not_message_found')}}</div>
                            <div class="small text-gray-500">--</div>
                        </div>
                    </div>
                @endif

                </div>




                <a class="dropdown-item text-center small text-gray-500" href="{{route('inbox', ['id_msg'=> 'all'])}}">{{ trans('translate.Read_More_Messages')}}</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow show">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->firstname}} {{ Auth::user()->lastname}}</span>
                <img class="img-profile rounded-circle" src="{{URL::asset('img/default_avatar.png')}}">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('show_profile')}}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  {{ trans('translate.logout')}}
                </a>
              </div>
            </li>

          </ul>

        </nav>
