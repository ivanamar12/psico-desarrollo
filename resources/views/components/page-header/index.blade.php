@props([
    'title' => '',
    'icon' => '',
])

<section class="container-fluid">
  <article class="page-header" style="display: flex; justify-content: space-between; align-items: center">
    <h1 class="text-titles" style="display: flex; align-items: center; margin: 0">
      @if ($icon)
        <i class="{{ $icon }}"></i>
      @endif
      {{ $title }}
    </h1>
    <x-oclock />
  </article>
</section>
