<div class="card-body">
    <div class="row">
        <div class="col-md-6 px-0">
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
            <table class="table table-hover align-middle">
                <tbody>
                    @foreach ($data as $index => $info)
                    <tr>
                        @if ($updateMode === $info->id)
                        <td>
                            <input type="text" id="info" class="form-control" wire:model="informations">
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm" wire:click="saveEdit({{ $info->id }})">Simpan</button>
                        </td>
                        @else
                        <td style="font-size: 15px;">
                            <p class="mb-0" style="cursor: pointer;" wire:click="edit({{ $info->id }})">{{ $info->information }}</p>
                        </td>
                        <td><button class="btn btn-danger btn-sm" wire:click="delete({{ $info->id }})">Hapus</button></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <form class="row g-3 justify-content-end">
                <div class="col-8">
                    <label class="visually-hidden">Information</label>
                    <input type="text" class="form-control" wire:model="information.0" placeholder="Type Information">
                    @error('information.0') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="col-2">
                    <button class="btn btn-primary mb-3" wire:click.prevent="add({{$i}})"><i class='bx bx-plus'></i></button>
                </div>
                {{-- Add Form --}}
                @foreach ($inputs as $key => $value)
                <div class="col-8">
                    <label class="visually-hidden">Information</label>
                    <input type="text" class="form-control" wire:model="information.{{ $value }}" placeholder="Type Information">
                    @error('information.') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="col-2">
                    <button class="btn btn-light mb-3" wire:click.prevent="remove({{$key}})"><i class='bx bx-x'></i></button>
                </div>
                @endforeach

            </form>
            <div class="row me-2 justify-content-end">
                <div class="col-2 p-0">
                    <button type="button" class="btn btn-primary" wire:click.prevent="store()">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>