<div class="p-4 mb-4 rounded-md transition-all duration-500 
    @if($type == 'success') bg-green-100 text-sky-800 
    @elseif($type == 'error') bg-red-100 text-rose-600
    @elseif($type == 'warning') bg-yellow-100 text-yellow-700 
    @else bg-blue-100 text-sky-700 @endif">
    <div class="flex justify-between items-center">
        <p>{{ $message }}</p>
        <button class="ml-4 text-xl text-gray-500 hover:text-gray-800" onclick="this.parentElement.parentElement.classList.add('opacity-0'); setTimeout(() => this.parentElement.parentElement.style.display = 'none', 500)">
            &times;
        </button>
    </div>
</div>
