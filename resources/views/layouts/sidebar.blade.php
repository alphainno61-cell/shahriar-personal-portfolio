<div class="sidebar-wrapper">
  <nav class="mt-2">
    <!--begin::Sidebar Menu-->
    <ul
      class="nav sidebar-menu flex-column"
      data-lte-toggle="treeview"
      role="navigation"
      aria-label="Main navigation"
      data-accordion="false"
      id="navigation"
    >
      <!--begin::Dashboard-->
      <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">
          <i class="nav-icon bi bi-palette"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <!--end::Dashboard-->

      <!--begin::Home-->
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon bi bi-house"></i>
          <p>
            Home
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('home.landing') }}" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Landing Page</p>
            </a>
          </li>
          <li class="nav-item">
<<<<<<< HEAD
            <a href="#" class="nav-link">
=======
            <a href="{{ route('main.page.index') }}" class="nav-link">
>>>>>>> master
              <i class="nav-icon bi bi-circle"></i>
              <p>Main Page</p>
            </a>
          </li>
        </ul>
      </li>
      <!--end::Home-->

      <!--begin::About Me-->
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon bi bi-file-earmark-person"></i>
          <p>
            About Me
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('home.landing') }}" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Landing Page</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Main Page</p>
            </a>
          </li>
        </ul>
      </li>
      <!--end::About Me-->

      <!--begin::Publications-->
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon bi bi-feather"></i>
          <p>
            Publications
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('home.landing') }}" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Landing Page</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Main Page</p>
            </a>
          </li>
        </ul>
      </li>
      <!--end::Publications-->

      <!--begin::Books-->
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon bi bi-book"></i>
          <p>
            Books
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('home.landing') }}" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Landing Page</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Main Page</p>
            </a>
          </li>
        </ul>
      </li>
      <!--end::Books-->

      <!--begin::Events-->
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon bi bi-calendar-event"></i>
          <p>
            Events
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('home.landing') }}" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Landing Page</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Main Page</p>
            </a>
          </li>
        </ul>
      </li>
      <!--end::Events-->

      <!--begin::Blogs-->
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon bi bi-substack"></i>
          <p>
            Blogs
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('home.landing') }}" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Landing Page</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Main Page</p>
            </a>
          </li>
        </ul>
      </li>
      <!--end::Blogs-->

      <!--begin::Technology-->
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon bi bi-cpu"></i>
          <p>
            Technology
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('home.landing') }}" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Landing Page</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Main Page</p>
            </a>
          </li>
        </ul>
      </li>
      <!--end::Technology-->

      <!--begin::Donation-->
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon bi bi-archive"></i>
          <p>
            Donation
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('home.landing') }}" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Landing Page</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Main Page</p>
            </a>
          </li>
        </ul>
      </li>
      <!--end::Donation-->

      <!--begin::Videos-->
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon bi bi-camera-reels"></i>
          <p>
            Videos
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('home.landing') }}" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Landing Page</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Main Page</p>
            </a>
          </li>
        </ul>
      </li>
      <!--end::Videos-->

      <!--begin::Life Events-->
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon bi bi-calendar-event"></i>
          <p>
            Life Events
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('home.landing') }}" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Landing Page</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Main Page</p>
            </a>
          </li>
        </ul>
      </li>
      <!--end::Life Events-->

      <!--begin::Contacts-->
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon bi bi-person-lines-fill"></i>
          <p>
            Contacts
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('home.landing') }}" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Landing Page</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Main Page</p>
            </a>
          </li>
        </ul>
      </li>
      <!--end::Contacts-->
    </ul>
    <!--end::Sidebar Menu-->
  </nav>
</div>
