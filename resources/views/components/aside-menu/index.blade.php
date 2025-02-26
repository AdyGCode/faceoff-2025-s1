@props(['bgColor', 'textColor', 'profilePhoto', 'userName'])

<aside class="">
  <section {{ $attributes }}>
    <div class="{{ $bgColor }} {{ $textColor }} w-[300px] rounded-b-xl rounded-t-3xl px-8">
      <!-- Logo -->
      <a href="{{ route('dashboard.index') }}">
        <div class="flex justify-center">
          <div class="flex gap-4 py-4">
            <img
              src="https://www.northmetrotafe.wa.edu.au/themes/custom/tafewa_sites/images/logos/dtwd-logo-white.svg"
              alt=""
              width="70"
              height="70"
            >
            <img
              src="https://www.northmetrotafe.wa.edu.au/themes/custom/nmtafe_theme/images/logos/site-logo-white.svg"
              alt=""
              width="140"
              height="70"
            >
          </div>
        </div>
      </a>
      {{-- User Profile --}}
      <div class="flex">
        <x-aside-menu.user-profile-simple
          profilePhoto="{{ asset($profilePhoto) }}"
          userName="{{ $userName }}"
        />
      </div>
      {{-- Divider --}}
      <x-aside-menu.line-divider expend="-mx-8" />

      {{-- Display aside menu --}}
      <ul class="mt-4">
        <x-aside-menu.menu-list
          title="Dashboard"
        />
        <x-aside-menu.menu-list
          title="Students Management"
          :submenus="[['name' => 'View Students', 'url' => '#', 'icon' => 'fa-solid fa-users fa-sl'], ['name' => 'Add new Student', 'url' => '#', 'icon' => 'fa-solid fa-user-plus']]"
        />
        <x-aside-menu.menu-list
          title="Classes Management"
          :submenus="[['name' => 'View Classes', 'url' => '#', 'icon' => 'fa-regular fa-clipboard'], ['name' => 'Assign Lecturers', 'url' => '#', 'icon' => 'fa-solid fa-user-tie'], ['name'=>'Class Schedules', 'url'=>'#', 'icon'=>'fa-solid fa-calendar-days']]"
        />
        <x-aside-menu.menu-list
          title="Lectures"
          :submenus="[['name' => 'View Lectures', 'url' => '#', 'icon' => 'fa-solid fa-id-card'], ['name' => 'Assign Subjects', 'url' => '#', 'icon' => 'fa-solid fa-laptop-medical']]"
        />
        <x-aside-menu.menu-list title="Reports & Analytics" />
      </ul>
      <x-aside-menu.social-links/>
    </div>

  </section>

</aside>
