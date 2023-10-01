@if(session()->has('is_success'))
<div class="{{ session('is_success') === true ? 
            'bg-green-200 border border-green-400 text-green-700' : 
            'bg-red-100 border border-red-400 text-red-700' }} px-4 py-3 rounded relative" 
    role="alert">
    <span class="block sm:inline">{{ session('response') }}</span>
</div>
@endif
