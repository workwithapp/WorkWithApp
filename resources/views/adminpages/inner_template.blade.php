<!DOCTYPE html>
@if(Illuminate\Support\Facades\Auth::check())
	 @include('includee.header')
	 @include('includee.left_menu')
	 @else 
             {{ redirect_now('/') }}

 @endif
    <main role="main" class="">
		@yield('main')
	</main>
	@if(Illuminate\Support\Facades\Auth::check())
 @include('includee.footer')
@endif