<div>
    <form wire:submit='logout' method="POST">
        @csrf
        <button type="submit" class="duration-300 hover:text-primary">Logout</button>
    </form>
</div>
