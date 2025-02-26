<li class="text-xl font-[900]">
  <a href="#">
    {{ $title }}
  </a>
</li>
@if (!empty($submenus))
  <ul class="pl-4 font-[700]">
    @foreach ($submenus as $submenu)
      <li>
        <div class="flex">
          @if (!empty($submenu['icon']))
            <div class="flex w-8 items-center justify-center">
              <i class="{{ $submenu['icon'] }} pr-2"></i>
            </div>
          @else
            <div class="flex w-8 items-center justify-center">
              <i class="fa-solid fa-check pr-2"></i>
            </div>ß
          @endif
          <a href="{{ $submenu['url'] ?? '#' }}">{{ $submenu['name'] }}</a>
        </div>
      </li>
    @endforeach
  </ul>
@endif
<div class="pb-8"></div>
