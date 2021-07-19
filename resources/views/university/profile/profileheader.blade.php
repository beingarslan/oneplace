<div class="row">
    <div class="col-12">
      <div class="card profile-header mb-2">
        <!-- profile cover photo -->
        <img
          class="card-img-top"
          src="{{asset('university/cover/'.$universityInformation->cover)}}"
          alt="User Profile Image"
        />
        <!--/ profile cover photo -->

        <div class="position-relative">
          <!-- profile picture -->
          <div class="profile-img-container d-flex align-items-center">
            <div class="profile-img">
              <img
                src="{{asset('university/logo/'.$universityInformation->logo)}}"
                class="rounded img-fluid"
                alt="Card image"
              />
            </div>
            <!-- profile title -->
            <div class="profile-title ml-3">
              <h2 class="" style="color: red;">{{$universityInformation->name}}</h2>
              <p class="text-white">{{$universityInformation->username}}</p>
            </div>
          </div>
        </div>

        <!-- tabs pill -->
        <div class="profile-header-nav">
          <!-- navbar -->
          <nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
            <button
              class="btn btn-icon navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <i data-feather="align-justify" class="font-medium-5"></i>
            </button>

            <!-- collapse  -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
                <ul class="nav nav-pills mb-0">
                  <li class="nav-item">
                    <a class="nav-link font-weight-bold active" href="javascript:void(0)">
                      <span style="color: white;" class="d-none d-md-block">Feed</span>
                      <i data-feather="rss" class="d-block d-md-none"></i>
                    </a>
                  </li>
                  <!-- <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="javascript:void(0)">
                      <span style="color: white;" class="d-none d-md-block">About</span>
                      <i data-feather="info" class="d-block d-md-none"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="javascript:void(0)">
                      <span style="color: white;" class="d-none d-md-block">Photos</span>
                      <i data-feather="image" class="d-block d-md-none"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link font-weight-bold" href="javascript:void(0)">
                      <span style="color: white;" class="d-none d-md-block">Friends</span>
                      <i data-feather="users" class="d-block d-md-none"></i>
                    </a>
                  </li> -->
                </ul>
                <!-- edit button -->
                <a href="/university/edit/profile" class="btn btn-primary">
                  <i data-feather="edit" class="d-block d-md-none"></i>
                  <span class="font-weight-bold d-none d-md-block">Edit</span>
                </a>
              </div>
            </div>
            <!--/ collapse  -->
          </nav>
          <!--/ navbar -->
        </div>
      </div>
    </div>
  </div>