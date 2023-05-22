@if(session()->has('message'))

<div x-data="{show=true}" x-init="setTimeout(()=> show = false, 5000)" 
    x-show="show" 
    class="left-1/2 fixed top-0 transform -translate-x-1/2 bg-laravel text-white px-48 py-3">

<p>
    {{session('message')}}
</p>

</div>
@endif