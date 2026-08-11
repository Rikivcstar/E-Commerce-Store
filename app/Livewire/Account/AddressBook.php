<?php

namespace App\Livewire\Account;

use App\Data\RegionData;
use App\Models\UserAddress;
use App\Services\RegionQueryService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\LaravelData\DataCollection;

class AddressBook extends Component
{
    public bool $showForm = false;

    public ?int $editingId = null;

    public array $form = [
        'label' => 'Utama',
        'full_name' => '',
        'phone' => '',
        'address_line' => '',
        'region_code' => '',
        'province' => '',
        'city' => '',
        'district' => '',
        'sub_district' => '',
        'postal_code' => '',
    ];

    public array $region_selector = [
        'keyword' => '',
        'region_selected' => null,
        'region_label' => '',
    ];

    public function mount(): void
    {
        if (! Auth::check()) {
            redirect()->route('login');

            return;
        }

        $this->form['full_name'] = Auth::user()->name ?? '';
        $this->form['phone'] = '';
    }

    public function rules(): array
    {
        return [
            'form.label' => ['nullable', 'string', 'max:60'],
            'form.full_name' => ['required', 'string', 'max:255'],
            'form.phone' => ['required', 'string', 'max:13', 'min:7'],
            'form.address_line' => ['required', 'string', 'max:500'],
            'region_selector.region_selected' => ['required', 'exists:regions,code'],
        ];
    }

    public function getAddressesProperty(): Collection
    {
        return Auth::user()->addresses()->get();
    }

    public function getRegionsProperty(RegionQueryService $query_service): DataCollection
    {
        $keyword = data_get($this->region_selector, 'keyword');

        if (! $keyword) {
            return new DataCollection(RegionData::class, []);
        }

        return $query_service->searchRegionByName((string) $keyword);
    }

    public function updatedRegionSelectorRegionSelected($value): void
    {
        $region = app(RegionQueryService::class)->searchRegionByCode((string) $value);

        if (! $region) {
            return;
        }

        data_set($this->form, 'region_code', $region->code);
        data_set($this->form, 'province', $region->province);
        data_set($this->form, 'city', $region->city);
        data_set($this->form, 'district', $region->district);
        data_set($this->form, 'sub_district', $region->sub_district);
        data_set($this->form, 'postal_code', $region->postal_code);
        data_set($this->region_selector, 'region_label', $region->label);
    }

    public function startCreate(): void
    {
        $this->reset('form', 'region_selector');
        $this->form['full_name'] = Auth::user()->name ?? '';
        $this->editingId = null;
        $this->showForm = true;
        $this->resetErrorBag();
    }

    public function startEdit(int $id): void
    {
        $address = Auth::user()->addresses()->findOrFail($id);

        $this->form = $address->only([
            'label', 'full_name', 'phone', 'address_line', 'region_code',
            'province', 'city', 'district', 'sub_district', 'postal_code',
        ]);

        data_set($this->region_selector, 'region_selected', $address->region_code);
        data_set($this->region_selector, 'region_label', $address->region_label);

        $this->editingId = $address->id;
        $this->showForm = true;
        $this->resetErrorBag();
    }

    public function cancelEdit(): void
    {
        $this->reset('form', 'region_selector', 'editingId', 'showForm');
        $this->resetErrorBag();
    }

    public function save(): void
    {
        $this->validate();

        $payload = [...$this->form, 'is_default' => false];

        if ($this->editingId) {
            $address = Auth::user()->addresses()->findOrFail($this->editingId);
            $address->update($payload);
        } else {
            $address = Auth::user()->addresses()->create($payload);

            // Alamat pertama otomatis jadi default
            if (Auth::user()->addresses()->count() === 1) {
                $address->update(['is_default' => true]);
            }
        }

        toast($this->editingId ? 'Alamat berhasil diperbarui.' : 'Alamat berhasil ditambahkan.', 'success');

        $this->cancelEdit();
    }

    public function setDefault(int $id): void
    {
        $address = Auth::user()->addresses()->findOrFail($id);

        Auth::user()->addresses()->update(['is_default' => false]);
        $address->update(['is_default' => true]);

        toast('Alamat utama berhasil diubah.', 'success');
    }

    public function delete(int $id): void
    {
        $address = Auth::user()->addresses()->findOrFail($id);
        $wasDefault = $address->is_default;

        $address->delete();

        if ($wasDefault && Auth::user()->addresses()->exists()) {
            Auth::user()->addresses()->first()->update(['is_default' => true]);
        }

        toast('Alamat berhasil dihapus.', 'info');
    }

    public function render()
    {
        return view('livewire.account.address-book', [
            'addresses' => $this->addresses,
        ])->layout('components.layouts.app');
    }
}