<?php

use Livewire\Component;

new class extends Component {
    public string $name = '';

    public function save()
    {
        $this->validate([
            'name' => 'required|max:255',
        ]);

        dd($this->name);
    }
};
?>

<form wire:submit="save">
    <label>
        Name
        <input type="text" wire:model="name">
        @error('name')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </label>



    <button type="submit">Save Member</button>
</form>
